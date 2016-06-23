<?php
namespace App\Services;

use App\Models\SystemMsg;
use App\Lib\Jpush;
use App\Models\UserContact;
use App\Models\UserMsg;
use \App\Lib\LibUtil;
use Illuminate\Support\Facades\Log;

class MessageService extends ApiService
{

    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
    /**
     * 添加消息
     * @param  $from_userid 发起方ID
     * @param  $to_userid 接受方ID
     * @param  $msg_kind 消息类型 1
     * @param  $msg_content 消息内容
     * @param  $msg_type 消息类型: 1 => 系统通知， 2 => 交互类型
     * @param  $var1 扩展字段
     * @param  $ext_id 扩展字段
     * @return  int|boolean
     */
    public function addMessage($from_userid,$to_userid,$msg_kind,$msg_content,$msg_type=1,$var1='',$ext_id=0){
        $data = array(
            'from_userid'=>$from_userid,
            'to_userid'=>$to_userid,
            'msg_kind'=>$msg_kind,
            'msg_content'=>$msg_content,
            'msg_type'=>$msg_type,
            'var1'=>$var1,
            'ext_id'=>$ext_id,
            'status'=>0
        );

        $msg_id =SystemMsg::insertGetId($data);
        if ($msg_id) {
            //发起push推送
            try {
                $Jpush = new Jpush ();
                $Jpush->sendMsg($msg_id, 3, $to_userid, $msg_type, $msg_content, $platform = 'all', ['order_id' => $ext_id]);
            } catch (Exception $e) {
                Log::info($e->getMessage());
            }

        }
        return $msg_id;
    }

    /**
     * 获取消息列表
     * @param  $to_userid 接受方ID
     * @param  $user_type 用户类型 1 场馆方用户 2 普通用户
     * @param  $status  0 未读 1 已读
     * @param  $msg_kind 消息类型
     * @param int $last_id
     * @param int $num
     */
    public function getMessageList ($to_userid,$user_type,$last_id=0,$num=0,$status=null,$msg_kind='') {
        $rows = SystemMsg::where('to_userid','=',$to_userid)->where('user_type','=',$user_type);
        if ($status!==null && in_array($status,[0,1])) {
            $rows = $rows->where('status','=',$status);
        }else{
            $rows = $rows->where('status','<>',2);
        }
        if ($last_id) {
            $rows = $rows->where('id','<',$last_id);
        }
        if ($msg_kind) {
            $rows = $rows->where('msg_kind','=',$msg_kind);
        }
        if ($num) {
            $rows = $rows->take($num+1);
        }
        $rows = $rows->orderBy('id', 'desc')->get()->toArray();
        $outDate = array ('messages'=>array(),'havenext'=>0);
        if (!empty($rows)) {
            if ($num && count($rows)>$num) {
                array_pop($rows);
                $outDate['havenext'] =1;
            }
            foreach ($rows as &$row) {
                $row['var1']= json_decode($row['var1']);
            }
            $outDate['messages'] = $rows;
        }
        return $outDate;
    }

    public function getMessageByPage ($to_userid,$status=null,$msg_kind='',$num=10) {
        $rows = SystemMsg::where('to_userid','=',$to_userid);
        if ($status!==null && in_array($status,[0,1])) {
            $rows = $rows->where('status','=',$status);
        }else{
            $rows = $rows->where('status','<>',2);
        }
        if ($msg_kind) {
            $rows = $rows->where('msg_kind','=',$msg_kind);
        }
        $rows = $rows->orderBy('id', 'desc')->paginate($num);
        $data = LibUtil::pageFomate($rows);
        if (!empty($data['list'])){
            $userIds = array_column($data['list'],'from_userid');
            $userArr = UserService::getInstance()->getUserArr ($userIds);
            foreach ($data['list'] as $k=>&$v) {
                if(isset($userArr[$v['from_userid']])){
                    $user = $userArr[$v['from_userid']];
                    $v['user'] = $user;
                }else{
                    unset($data['list'][$k]);
                    continue;
                }
                if (!empty($v['var1'])) {
                    $var = json_decode($v['var1'],true);
                    if (isset($var['image_ids']) && !empty($var['image_ids'])) {
                        $image_ids = explode(',',$var['image_ids'],0);
                        $imageId = current($image_ids);
                        $image_o = LibUtil::getPicUrl($imageId, 3);
                        if (!empty($image_o)) {
                            $v['images'][] = [
                                //'img_b' => LibUtil::getPicUrl($imageId, 2),
                                //'img_m'  => LibUtil::getPicUrl($imageId, 1),
                                'img_s'  => LibUtil::getPicUrl($imageId, 0),
                                'img_o' => $image_o
                            ];
                        }
                    }
                    unset($v['var1']);
                }
            }
        }
        return $data;
    }

    /**
     * 私信联系人列表
     * @param unknown_type $user_id
     * @param unknown_type $num
     * @return multitype:
     */
    function getMsgContact($user_id, $num) {
        $rows = UserContact::where('user_id',$user_id)->orderBy('updated_at', 'desc')->paginate($num);
        $data = LibUtil::pageFomate($rows);
        if (!empty($data['list'])){
            $userIds = array_column($data['list'],'contact_id');
            $userArr = UserService::getInstance()->getUserArr ($userIds);
            foreach ($data['list'] as &$v) {
                if(isset($userArr[$v['contact_id']])){
                    $user = $userArr[$v['contact_id']];
                    $v['user'] = $user;
                }
            }
        }

        return $data;
    }
    /**
     * 私信对话列表
     * @param unknown_type $to_userid
     * @param unknown_type $from_userid
     * @param unknown_type $num
     * @param unknown_type $page
     * @param unknown_type $last_id
     * @return multitype:number NULL
     */
    function getMsgChat($to_userid, $from_userid, $num) {
        if ($to_userid > $from_userid) {
            $union_id = $to_userid . '-' . $from_userid;
            $undeleted_flag = array(0, 1);
        } else {
            $union_id = $from_userid . '-' . $to_userid;
            $undeleted_flag = array(0, 2);
        }
        $rows = UserMsg::where('union_id', $union_id)->whereIn('del',$undeleted_flag)->paginate($num);
        $data = LibUtil::pageFomate($rows);

        // 未读取的记录数清0
        UserContact::where(['user_id'=> $to_userid,'contact_id'=>$from_userid])->update(['unread_count'=>0]);
       return $data;
    }

    /**
     * 发私信
     * @param $fromUserid 发信人ID
     * @param $to_userid 收信人ID
     * @param $content 私信内容
     * @param $kind   1 => 私信对话， 2 => 借书私信,3=>乐享豆交易
     * @param $var1  扩展字段
     * @return int
     */
    public function sendMsg($fromUserid,$to_userid,$content,$kind=1,$var1=''){
        if ($to_userid > $fromUserid) {
            $union_id = $to_userid . '-' . $fromUserid;
        } else {
            $union_id = $fromUserid . '-' . $to_userid;
        }
        $data = array(
            'userid'=>$to_userid,
            'fid'=>$fromUserid,
            'content'=>$content,
            'union_id'=>$union_id,
            'kind'=>$kind,
            'var1'=>$var1,
        );
        $msg_id = UserMsg::insertGetId($data);
        if($msg_id){
            self::addMsgContact($fromUserid,$to_userid,$content);
        }
        return $msg_id;
    }
    /**
     * 私信联系人列表数据更新
     * @param unknown $from_userid
     * @param unknown $to_userid
     * @param unknown $content
     * @return multitype:unknown boolean
     */
    function addMsgContact($from_userid,$to_userid,$content){
        $contacts = array();
        $time = date('Y-m-d H:i:s',time());
        //发送人
        // 联系记录contactID
        $result = UserContact::where(['user_id'=>$from_userid,'contact_id'=>$to_userid])->first();

        //发送人自己只增加消息数
        if($result) {
            $result = $result->toArray();
            $contacts[] = $result['id'];
            $data = array(
                'total_count'=>$result['total_count']+1,
                //'last_time'=>$time,
            );
             UserContact::where('id',$result['id'])->update($data);
        }else{
            $data = array(
                'user_id'=>$from_userid,
                'contact_id'=>$to_userid,
                'is_receive'=>0,
                'total_count'=>1,
                'unread_count'=>0,
                'content'=>$content
            );
            UserContact::insertGetId($data);
        }
        //接收人
        //接收人要更新未读数和消息数
        // 联系记录contactID
        $result2  = UserContact::where(['user_id'=>$to_userid,'contact_id'=>$from_userid])->first();;

        if($result2) {
            $result2 = $result2->toArray();
            $contacts[] = $result2['id'];
            $data = array(
                //'id'=>$result2['id'],
                'total_count'=>$result2['total_count']+1,
                'unread_count'=>$result2['unread_count']+1,
            );
             UserContact::where('id',$result['id'])->update($data);
        }else{
            $data = array(
                'user_id'=>$to_userid,
                'contact_id'=>$from_userid,
                'is_receive'=>1,
                'total_count'=>1,
                'unread_count'=>1,
                'content'=>$content
            );
            UserContact::insertGetId($data);
        }

        return $contacts;
    }


}
