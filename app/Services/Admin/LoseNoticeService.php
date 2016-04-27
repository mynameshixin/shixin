<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/9/14
 * Time: 下午12:40
 */
namespace App\Services\Admin;

use App\Lib\FileService;
use App\Models\LoseNotice;
use App\Services\ApiService;

class LoseNoticeService extends ApiService
{
    /**
     * 发布失物招领／寻物启事
     * @param $params
     * @param array $files
     * @return int
     */
    public function createLoseNotice ($params,$files=array()) {
        $entry = [
            'title' => $params['title'],
            'content' =>$params['content'],
            'store_id' =>$params['store_id'],
            'yb_user_id'=>isset($params['yb_user_id']) ? $params['yb_user_id'] : 0,
            'yb_nick' => isset($params['yb_nick']) ? $params['yb_nick'] : '',
            'user_id' => isset($params['user_id']) ? $params['user_id'] : 0,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : '',
            'contact' => isset($params['contact']) ? $params['contact'] : '',
            'image_keys' => isset($params['image_keys']) ? $params['image_keys'] : ''
        ];
        if (isset($params['ispublic']) && $params['sipublic']) {
            $entry['status'] = 1;
            $entry['ispublic'] = 1;
        }
        if (!empty($files)) {
            for ($i=0;$i<count($files['name']);$i++) {
                $file['name'] = $files['name'][$i];
                $file['error'] = $files['error'][$i];
                $file['type'] = $files['type'][$i];
                $file['tmp_name'] = $files['tmp_name'][$i];
                $file['size'] = $files['size'][$i];
                $image_key = FileService::putImg($file);
               if ($image_key)  $image_keys[] = $image_key;
            }
            if (isset($image_keys)) $entry['image_keys'] = implode(',',$image_keys);
        }
        $id = LoseNotice::insertGetId($entry);
        return $id;
    }
}