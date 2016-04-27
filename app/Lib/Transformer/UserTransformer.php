<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午5:09
 */
namespace App\Lib\Transformer;

use App\Lib\LibUtil;
use App\Models\User;
use App\Services\UserService;
use League\Fractal\TransformerAbstract;


class UserTransformer extends  TransformerAbstract{

    public function transform(User $user)
    {
        $follow_num = UserService::getInstance()->getFollowNum($user->id);
        $entry = [
            'id'    => (int) $user->id,
            'nick'  => $user->nick,
            'username'  => $user->username,
            'gender' => $user->gender,
            //'status' => $user->status,
            'pic_b'   => LibUtil::getUserAvatar($user->id,3),
            'pic_m'   =>  LibUtil::getUserAvatar($user->id, 1),
            'follow_num'=>$follow_num
        ];
        if (isset($user->is_follow)) {
           $entry['is_follow'] =  $user->is_follow;
        }
        if (empty($entry['pic_b']) && !empty($user->auth_avatar)) {
            $entry['pic_b'] = $entry['pic_m'] = $user->auth_avatar;
        }
        return $entry;
    }
}