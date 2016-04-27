<?php
/**
 * Created by PhpStorm.
 * User: ytt
 * Date: 15/11/14
 * Time: 下午3:09
 */
namespace App\Services;


use App\Lib\LibUtil;
use App\Models\Event;
use App\Models\EventType;
use App\Models\EventUser;
use App\Services\Admin\ImageService;

class EventService extends ApiService
{

    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    public function joinEvent ($id,$user_id,$contact='') {
        $event =  Event::find($id);
        if (empty($event)) return false;
        $event = $event->toArray();
        $now = date('Y-m-d');
        //$now = 1;
        if (empty($event['deadline']) || $now < $event['deadline']) {
           $row = EventUser::where(['event_id'=>$id,'user_id'=>$user_id])->first();
            if (empty($row)) {
                $rs = EventUser::insertGetId(['event_id'=>$id,'user_id'=>$user_id,'contact'=>$contact]);
            }
        }
        return isset($rs) ? $rs : false;
    }

    public function getJoinUsers ($data,$num=20) {
        $condtion['event_id'] = $data['id'];
        if(isset($data['status']) && $data['status'])$condtion['status'] = $data['status'];
        if(isset($data['type']) && $data['type'])$condtion['type'] = $data['type'];
        $rows = EventUser::where($condtion)->orderBy('id', 'desc')->paginate($num);
        $outDate = LibUtil::pageFomate($rows);
        if (!empty($outDate['list'])) {
            $userIds = array_column($outDate['list'] , 'user_id');
            $userArr = UserService::getInstance()->getUserArr($userIds);

            foreach ($outDate['list'] as &$row) {
              $row['user'] = isset($userArr[$row['user_id']]) ? $userArr[$row['user_id']] : [];
            }
        }
        return $outDate;
    }

    public function getEventList ($params,$num) {
        $condtion ['status'] = 1;
        if (isset($params['type'])) $condtion['type'] = $params['type'];
        if (isset($params['kind'])) $condtion['kind'] = $params['kind'];
        if (isset($params['user_id'])) $condtion['user_id'] = $params['user_id'];


        $rows = Event::where($condtion);
        if (isset($params['keyword']) && !empty($params['keyword'])) {
            $params['keyword'] = urldecode($params['keyword']);
            //模糊查询
            $rows = $rows->where('title', "like", "%{$params['keyword']}%");
        }
        $rows = $rows->orderBy('sort', 'asc');
        $rows = $rows->orderBy('id', 'desc');

        $rows = $rows->paginate($num);
        $outDate = LibUtil::pageFomate($rows);
        $types = EventType::lists('name','id')->toArray();

        if (!empty($outDate['list'])) {
            $user_ids = array_column($outDate['list'],'user_id');
            $userArr = UserService::getInstance()->getUserArr($user_ids);
            foreach ($outDate['list'] as &$row) {
                if (!empty($row['image_ids'])) {
                    $image_ids = explode(',', $row['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $img_o =  LibUtil::getPicUrl($imageId, 4);
                        if (!empty($img_o)) {
                            $row['images'][] = [
                                'img_b' => LibUtil::getPicUrl($imageId, 2),
                                'img_o' => $img_o
                            ];
                        }

                    }
                }
                $row['type_name'] = isset($types[$row['type']]) ? $types[$row['type']] : '';
                if(!empty($row['wechat_img'])) $row['wechat_img']= url('uploads/images/'.$row['wechat_img']);
                if(isset($userArr[$row['user_id']]))$row['user'] =  $userArr[$row['user_id']];
            }
        }

        return $outDate;
    }

}