<?php
namespace App\Services;

use App\Models\Follow;
use App\Models\FundLog;
use App\Models\InvitationCode;
use App\Models\RoleUser;
use App\Models\User;
use App\Lib\Images;
use App\Lib\LibUtil;
use App\Lib\Sms;
use DB;

class UserService extends ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    //用户头像图片文件夹
    public static $avatar_dir = 'uploads/users/avatar/';

    public function __construct()
    {
        //self::$avatar_dir = \Config::get('farm.avatar_dir');
    }

    //用户头像规则
    private $avater_rules = array(
        array('w' => 160, 'h' => 160, 'name' => '_b', 'isCut' => '1'),
        array('w' => 88, 'h' => 88, 'name' => '_m', 'isCut' => '1'),
    );

    /**
     * 用户上传头像
     * @param $userId
     * @param $file
     * @return array
     */
    public function uploadAvatar($userId, $file)
    {
        $destinationPath = self::$avatar_dir; // upload path
        $Image = new Images();
        $destinationPath = $destinationPath . LibUtil::getFacePath($userId);
        LibUtil::make_dir($destinationPath);
        $fileName = $userId . '_o.jpg'; // renameing image
        $tmp_name = $file["tmp_name"];
        //move_uploaded_file($tmp_name, $destinationPath . $fileName);
        $ext = ImageService::getInstance()->extend($file['name']);
        if($ext=="jpg")
        {
            move_uploaded_file($tmp_name, $destinationPath . $fileName);
        }elseif($ext=="gif")
        {
            $im = imagecreatefromgif($tmp_name);
            ImageJpeg ($im, $destinationPath . $fileName);
        }elseif($ext=="png")
        {
            $im = imagecreatefrompng($tmp_name);
            ImageJpeg ($im, $destinationPath . $fileName);
        }
        if (file_exists($destinationPath . $userId . '_o.jpg')) {
            $Image->creatThumbPi($destinationPath . $userId . '_o.jpg', $destinationPath, $userId, $this->avater_rules);
        }

        $images = array(
            'id' => $userId,
            'pic_o' => LibUtil::getUserAvatar($userId, 4),
            'pic_b' =>  LibUtil::getUserAvatar($userId, 2),
            'pic_m' =>  LibUtil::getUserAvatar($userId, 1),
        );
        return $images;
    }

    /**
     * 获取用户邀请码
     * @param $userId
     * @return $string
     */
    public function getInvitationCode($userId)
    {
        $row = InvitationCode::where('user_id', '=', $userId)->first();
        if (empty($row)) {
            //生成用户邀请码
            $code = LibUtil::makeCouponCard();
            $entry = ['user_id' => $userId, 'invitation_code' => $code, 'status' => 1, 'updated_at' => date('Y-m-d h:i:s')];
            $row = InvitationCode::create($entry);

        }
        $row = $row->toArray();
        return $row['invitation_code'];
    }

    /**
     * 用户邀请操作
     * @param $userId
     * @param $code
     */
    public function addInvitation($userId, $code)
    {
        $row = InvitationCode::where('invitation_code', '=', $code)->first();
        if (empty($row)) return false;
        $row = $row->toArray();
        $count = $row['count'] + 1;
        InvitationCode::where('user_id', '=', $row['user_id'])->update(['count' => $count]);
        //邀请奖励,更新用户邀请人
        $fund1 = FundService::getInstance()->addUserFund($userId, 0, 'invited_rewards', 0, 1);
        //通知被邀请人
        if (!isset($fund1['error'])) {
            $msg_content = "被好友邀请注册成功,获得现金奖励 {$fund1}元，快去使用吧！";
            MessageService::getInstance()->addMessage(0, $userId, 1, 0, $msg_content);
        }
        //邀请人添加奖励
        $fund2 = FundService::getInstance()->addUserFund($row['user_id'], 0, 'invite_rewards', 0, 1);
        if (!isset($fund2['error'])) {
            //通知邀请人
            $msg_content = "好友邀请注册成功,获得现金奖励 {$fund2}元，快去使用吧！";
            MessageService::getInstance()->addMessage(0, $row['user_id'], 1, 0, $msg_content);
        }

        return true;
    }


    public function getUserArr($userIds)
    {
        // $users = User::where('username', "like" , "%{$keyword}%")->orWhere('nick', "like" , "%{$keyword}%")->orWhere('mobile', "like" , "%{$keyword}%")->select('id', 'username', 'nick','gender','auth_avatar','wechat')->get()->toArray();
        $users = User::whereIn('id', $userIds)->select('id', 'username', 'nick','gender','auth_avatar','wechat')->get()->toArray();
        $userArr = [];
        if ($users) {
            $Image = new Images();
            foreach ($users as $user) {
                $user['pic_m'] = LibUtil::getUserAvatar($user['id'], 1);
                //$user['pic_m'] = $Image->getPicUrl($user['id'], 1, self::$avatar_dir);
                if (empty($user['pic_m']) && !empty($user['auth_avatar'])) {
                    //$user['auth_avatar'] = $user['auth_avatar'].'?'.time();
                    $user['pic_m'] = $user['auth_avatar'];
                    //unset($user['auth_avatar']);
                }
                if(empty($user['pic_m']) && empty($user['auth_avatar'])){
                        $user['pic_m'] = url('uploads/sundry/blogo.jpg');
                }
                $userArr[$user['id']] = $user;


            }
        }
        return $userArr;
    }

    public function getFollowNum($user_id)
    {
        return Follow::where('user_id', $user_id)->count();

    }

    public function getFanNum($user_id)
    {
        return Follow::where('userid_follow', $user_id)->count();
    }


    public function isFollow($userId, $userid_follow)
    {
        $row = Follow::where(['user_id' => $userId, 'userid_follow' => $userid_follow])->first();
        return $row ? 1 : 0;
    }

    public function getUserList($params,$num){

        if (isset($params['keyword']) && !empty($params['keyword'])) {
            $keyword = $params['keyword'];
            $rows = User::where('username', "like" , "%{$keyword}%")->orWhere('nick', "like" , "%{$keyword}%")->orWhere('mobile', "like" , "%{$keyword}%")->paginate($num);
            //$rows = User::where('username', "like" , "%{$keyword}%")->paginate($num);
        }else{
            $rows = User::paginate($num);
        }
        $data = LibUtil::pageFomate ($rows);

        if (!empty($data['list'])){

            $list = [] ;
            if (isset($params['current_uid']) && !empty($params['current_uid'])) {
                $arr = Follow::where('user_id',$params['current_uid'])->select('userid_follow')->get()->toArray();
                $user_ids = array_column($arr,'userid_follow');
            }

            foreach ($data['list'] as $val) {
                //$follow_num = self::getFollowNum($val['id']);
                $entry = [
                    'id'    => $val['id'],
                    'nick'  => $val['nick'],
                    'username'  =>$val['username'],
                    'gender' => $val['gender'],
                    //'status' => $user->status,
                    'pic_b'   => LibUtil::getUserAvatar($val['id'],4),
                    'pic_b'   => LibUtil::getUserAvatar($val['id'],3),
                    'pic_m'   =>  LibUtil::getUserAvatar($val['id'], 1),
                    //'follow_num'=>$follow_num,
                    'fan_num'=>self::getFanNum($val['id']),
                    'is_follow'=>0
                ];
                if (isset($params['current_uid']) && !empty($params['current_uid']) && in_array($val['id'],$user_ids)) {
                    $entry['is_follow'] = 1;
                }
                if (empty($entry['pic_b']) && !empty($val['auth_avatar'])) {
                    $entry['pic_o'] = $entry['pic_b'] = $entry['pic_m'] = $val['auth_avatar'];
                }
                $list[] = $entry;
            }
            $data['list'] = $list;
        }
        return $data;

    }
     public function getBindUserList($params,$num,$page= null){
        if(!empty($page)){
            $skip = ($page-1)*$num;
            $data = DB::table('users')->where('is_recommend',1)->skip($skip)->take($num)->get();
        }else{
            $arr = DB::table('users')->where('is_recommend',1)->lists('id');
            $data = DB::table('users')->where('id', $arr[$num])->get();
        }

        $rdata= [];
        if (!empty($data)){

            $list = [] ;
            if (isset($params['current_uid']) && !empty($params['current_uid'])) {
                $arr = Follow::where('user_id',$params['current_uid'])->select('userid_follow')->get()->toArray();
                $user_ids = array_column($arr,'userid_follow');
            }

            foreach ($data as $val) {
                //$follow_num = self::getFollowNum($val['id']);
                $entry = [
                    'id'    => $val['id'],
                    'nick'  => $val['nick'],
                    'username'  =>$val['username'],
                    'gender' => $val['gender'],
                    //'status' => $user->status,
                    'pic_b'   => LibUtil::getUserAvatar($val['id'],4),
                    'pic_b'   => LibUtil::getUserAvatar($val['id'],3),
                    'pic_m'   =>  LibUtil::getUserAvatar($val['id'], 1),
                    //'follow_num'=>$follow_num,
                    'fan_num'=>self::getFanNum($val['id']),
                    'is_follow'=>0
                ];
                if (isset($params['current_uid']) && !empty($params['current_uid']) && in_array($val['id'],$user_ids)) {
                    $entry['is_follow'] = 1;
                }
                if (empty($entry['pic_b']) && !empty($val['auth_avatar'])) {
                    $entry['pic_o'] = $entry['pic_b'] = $entry['pic_m'] = $val['auth_avatar'];
                }
                $list[] = $entry;
            }
            $rdata['list'] = $list;
        }
        return $rdata;

    }
    public function getSearchCount ($keyword) {
        $keyword = fparam($keyword);
        return User::where('username', "like" , "%{$keyword}%")->orWhere('nick', "like" , "%{$keyword}%")->orWhere('mobile', "like" , "%{$keyword}%")->count();
    }

    public function getAdminIds () {
        return RoleUser::whereIn('role_id',[1,2])->lists('user_id')->toArray();
    }



}
