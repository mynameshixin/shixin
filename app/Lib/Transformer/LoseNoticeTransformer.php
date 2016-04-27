<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午5:09
 */
namespace App\Lib\Transformer;

use App\Lib\FileService;
use App\Lib\LibUtil;
use App\Models\LoseNotice;
use League\Fractal\TransformerAbstract;


class LoseNoticeTransformer extends  TransformerAbstract{

    public function transform(LoseNotice $loseNotice)
    {
        $return =  [
            'id'    => (int) $loseNotice->id,
            'kind'  => $loseNotice->kind,
            'ispubic'  => $loseNotice->ispubish,
            'status'  => $loseNotice->status,
            'offline' => $loseNotice->offline,
            'mobile'  => $loseNotice->mobile,
            'contact' => $loseNotice->contact,
            'title'  => $loseNotice->title,
            'content' => $loseNotice->content,
            'yb_user_id'=>$loseNotice->yb_user_id,
            'yb_nick'=>$loseNotice->yb_nick,
            'yb_user_pic'=>$loseNotice->yb_user_id ? LibUtil::userAvatar($loseNotice->yb_user_id,'b') : '',
            'created_at'=>$loseNotice->created_at,
        ];
        if (!empty($loseNotice->image_keys)) {
            $image_keys = explode(',',$loseNotice->image_keys);
            if (!empty($image_keys)) {
                foreach ($image_keys as $image) {
                    $return['images'][] = FileService::getImg($image,240);
                }
            }
        }
        if (!empty($loseNotice->user)) {
            $return['user'] = [
                 'id' => $loseNotice->user->id,
                 'name' => $loseNotice->user->name,
                 'nick' => $loseNotice->user->nick,
            ];
        }
        return $return;
    }
}