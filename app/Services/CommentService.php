<?php
namespace App\Services;

/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/10
 * Time: 下午3:36
 */
use \App\Lib\LibUtil;
use App\Models\Comment;
use App\Models\CommentAction;
use App\Models\Coupon;
use App\Models\JourneyCoupon;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;

class CommentService extends \App\Services\ApiService
{

    public function addComment($userId, $data, $files = array())
    {
        $entry = [
            'user_id' => $userId,
            'good_id' => $data['good_id'],
            'content' => $data['content'],
        ];
        $id = Comment::insertGetId($entry);
        //上传图片
        if (isset($files['image']) && !empty($files['image'])) {
            $images = ImageService::getInstance()->uploadImage($userId, $files['image']);
            if (!empty($images)) {
                $images_ids = array_column($images, 'image_id');
                $image_ids = implode(',', $images_ids);
                Comment::where('id', $id)->update(['image_ids' => $image_ids]);
            }
        }
        return $id;
    }

    /**
     * 获取评论列表
     * @param int $shopId
     * @param int $couponId
     * @param int $lastId
     * @param int $num
     * @return array
     */
    public function getCommentList($good_id, $num = 20)
    {
        $cond = [];
        if ($good_id) $cond['good_id'] = $good_id;

        $rows = Comment::where($cond)->orderBy('id', 'desc')->paginate($num);
        $data = LibUtil::pageFomate($rows);

        if (!empty($data['list'])) {
            $userIds = array_column($data['list'], 'user_id');
            $userArr = UserService::getInstance()->getUserArr($userIds);
            foreach ($data['list'] as &$v) {
                if (isset($userArr[$v['user_id']])) {
                    $user = $userArr[$v['user_id']];
                    $v['user'] = $user;
                }
                if (!empty($v['image_ids'])) {
                    $image_ids = explode(',', $v['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $v['images'][] = [
                            'img_b' => LibUtil::getPicUrl($imageId, 4),
                            'img_o' => LibUtil::getPicUrl($imageId, 2)
                        ];
                    }
                }
            }
        }

        return $data;

    }

    public function getCommentFirst($good_ids)
    {
        $rows = Comment::whereIn('good_id', $good_ids)->groupBy('good_id')->orderBy('id', 'desc')->get()->toArray();
        $list = [];
        if (!empty($rows)) {
            $userIds = array_column($rows, 'user_id');
            $userArr = UserService::getInstance()->getUserArr($userIds);
            foreach ($rows as $v) {
                if (isset($userArr[$v['user_id']])) {
                    $user = $userArr[$v['user_id']];
                    $v['user'] = $user;
                }
                if (!empty($v['image_ids'])) {
                    $image_ids = explode(',', $v['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $img_o = LibUtil::getPicUrl($imageId, 4);
                        if (!empty($img_o)) {
                            $v['images'][] = [
                                'img_b' => LibUtil::getPicUrl($imageId, 2),
                                'img_o' => $img_o
                            ];
                        }

                    }
                }
                $list[$v['good_id']] = $v;
            }
        }
        return $list;
    }

    /**
     * 获取评论列表
     * @param int $shopId
     * @param int $couponId
     * @param int $lastId
     * @param int $num
     * @return array
     */
    public function getCommentsByPage($shopId = 0, $couponId = 0, $num = 10)
    {
        $condtion = [];
        if ($shopId) $condtion['shop_id'] = $shopId;
        if ($couponId) $condtion['coupon_id'] = $couponId;
        $rows = Comment::where($condtion)->orderBy('id', 'desc')->paginate($num);
        $outDate = ['render' => $rows->render(), 'list' => []];
        $rows = $rows->toArray();
        $rows = $rows['data'];
        if (!empty($rows)) {
            $uids = array_column($rows, 'user_id');
            $uids = array_unique($uids);
            $userRows = User::whereIn('id', $uids)->select('id', 'username', 'mobile')->get()->toArray();
            if (!empty($userRows)) {
                foreach ($userRows as $val) {
                    $val['pic_m'] = LibUtil::getUserAvatar($val['id'], 2);
                    if(!empty( $val['pic_m']))  $val['pic_m'] =  $val['pic_m']. '?' . time();
                    $userArr[$val['id']] = $val;
                }
            }
            foreach ($rows as $row) {
                $outDate['list'][] = [
                    'id' => $row['id'],
                    'point' => $row['point'],
                    'content' => $row['content'],
                    'praise_count'=>$row['praise_count'],
                    'created_at' => $row['created_at'],
                    'user' => isset($userArr[$row['user_id']]) ? $userArr[$row['user_id']] : []
                ];
            }
        }
        return $outDate;

    }


    public function addAction($user_id, $id, $action = 1)
    {
        $comment = Comment::find($id);
        if (empty($comment)) return false;
        $comment = $comment->toArray();
        $row = CommentAction::where(['user_id' => $user_id, 'comment_id' => $id, 'action' => $action])->first();
        $rs = true;
        if (empty($row)) {
            $entry = [
                'user_id' => $user_id,
                'comment_id' => $id,
                'action' => $action
            ];
            $rs = CommentAction::insert($entry);
            if ($rs) {
                $entry2['praise_count'] = $comment['praise_count'] + 1;

                Comment::where('id', $id)->update($entry2);
            }
        }
        return $rs;
    }
}