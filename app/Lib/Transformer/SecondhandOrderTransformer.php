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
use App\Models\SecondhandOrders;
use League\Fractal\TransformerAbstract;


class SecondhandOrderTransformer extends  TransformerAbstract{

    public function transform(SecondhandOrders $order)
    {
        $return =  [
            'id'    => (int) $order->id,
            'ispubic'  => $order->ispubish,
            'status'  => $order->status,
            'offline' => $order->offline,
            'mobile'  => $order->mobile,
            'contact' => $order->contact,
            'price' => $order->price,
            'title'  => $order->title,
            'content' => $order->content,
            'yb_user_id'=>$order->yb_user_id,
            'yb_nick'=>$order->yb_nick,
            'yb_user_pic'=>$order->yb_user_id ? LibUtil::userAvatar($order->yb_user_id,'b') : '',
            'created_at'=>$order->created_at,
        ];
        if (!empty($order->image_keys)) {
            $image_keys = explode(',',$order->image_keys);
            if (!empty($image_keys)) {
                foreach ($image_keys as $image) {
                    $return['images'][] = FileService::getImg($image,'240');
                }
            }
        }
        if (!empty($order->user)) {
            $return['user'] = [
                 'id' => $order->user->id,
                 'name' => $order->user->name,
                 'nick' => $order->user->nick,
            ];
        }
        return $return;
    }
}