<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/10/29
 * Time: 下午2:52
 */

namespace App\Services;


use App\Lib\LibUtil;
use App\Models\CollectionFolder;
use App\Models\Folder;
use App\Models\Follow;
use App\Models\User;

class FollowService extends ApiService
{
    /**
     * 添加关注
     * @param $user_id
     * @param $userid_follow
     * @return mixed
     */
    public function addFollow($user_id, $userid_follow)
    {
        $row = Follow::where(['user_id' => $user_id, 'userid_follow' => $userid_follow])->first();
        if (empty($row) && $user_id != $userid_follow) {
            $rs = Follow::insertGetId(['user_id' => $user_id, 'userid_follow' => $userid_follow]);
            //给被关注用户发信息

            if ($user_id != $userid_follow) {
                $user = User::select('username', 'nick', 'mobile')->find($user_id)->toArray();
                $nick = $user['username'] ? $user['username'] : $user['mobile'];
                $msg_content = "用户 {$nick} 关注了你！";
                MessageService::getInstance()->addMessage($user_id, $userid_follow, 1, $msg_content, 1);
            }

        }

        return true;
    }

    /**
     * 删除关注
     * @param $user_id
     * @param $userid_follow
     * @return mixed
     */
    public function delFollow($user_id, $userid_follow)
    {
        //$folder_ids = Folder::where('user_id',$userid_follow)->lists('id')->toArray();
        //if(!empty($folder_ids))CollectionFolder::where('user_id',$user_id)->whereIn('folder_id',$folder_ids)->delete();
        $rs = Follow::where(['user_id' => $user_id, 'userid_follow' => $userid_follow])->delete();
        return true;
    }

    public function getFollows($user_id, $num = 10,$current_uid=0)
    {
        $rs = Follow::where('user_id', $user_id)->select('userid_follow','user_id')->paginate($num);
        $data = LibUtil::pageFomate($rs);
        if (!empty($data['list'])) {
            $userIds = array_column($data['list'], 'userid_follow');
            $userArr = UserService::getInstance()->getUserArr($userIds);
            $list = [];
            $arr = Follow::where('user_id', $current_uid)->select('userid_follow')->get()->toArray();
            $user_ids = array_column($arr, 'userid_follow');
            foreach ($data['list'] as $v) {
                if (isset($userArr[$v['userid_follow']])) {
                    $user = $userArr[$v['userid_follow']];
                    $user['fan_num'] = Follow::where('userid_follow', $user['id'])->count();
                    if ($user_id==$current_uid || in_array($v['userid_follow'], $user_ids)) {
                        $user['is_follow'] = 1;
                    }else{
                        $user['is_follow'] = 0;
                    }

                    $list[] = $user;
                }
            }
            $data['list'] = $list;
        }
        return $data;


    }

    public function getFans($user_id, $num = 10,$current_uid)
    {
        $rs = Follow::where('userid_follow', $user_id)->select('user_id')->paginate($num);
        $data = LibUtil::pageFomate($rs);
        if (!empty($data['list'])) {
            $userIds = array_column($data['list'], 'user_id');
            $userArr = UserService::getInstance()->getUserArr($userIds);
            $list = [];
            $arr = Follow::where('user_id', $current_uid)->select('userid_follow')->get()->toArray();
            $user_ids = array_column($arr, 'userid_follow');
            foreach ($data['list'] as $v) {
                if (isset($userArr[$v['user_id']])) {
                    $user = $userArr[$v['user_id']];
                    $user['fan_num'] = Follow::where('userid_follow', $user['id'])->count();
                    if (in_array($v['user_id'], $user_ids)) {
                        $user['is_follow'] = 1;
                    } else {
                        $user['is_follow'] = 0;
                    }
                    $list[] = $user;
                }
            }
            $data['list'] = $list;
        }
        return $data;
    }


}