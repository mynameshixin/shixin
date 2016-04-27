<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Lib\FileService;

class ImageController extends BaseController
{

    public function index()
    {
        $data = Input::all();
        $this->validator($data, [
            'image_ids' => 'required',
            'width' => 'sometimes|integer|min:1',
        ]);
        $img_ids = explode(',', $data['image_ids']);
        $img_ids = array_unique($img_ids);
        $images = array();
        foreach ($img_ids as $image_id) {
            if(trim($image_id) == '') continue;
            if (isset($data['width'])) {//width
                $file = FileService::getImg($image_id, $data['width']);
            } else {//原图
                $file = FileService::get($image_id);
            }
            if ($file) {
                $images[] = array(
                    'image_id' => $image_id,
                    'picUrl' => $file,
                );
            }
        }
        return response()->forApi($images);
    }


    public function store()
    {
        if (!isset($_FILES['image'])) return;
        $md5 = FileService::putImg($_FILES['image']);
        if ($md5) {
            $file = FileService::get($md5);
            $img = array(
                'image_id' => $md5,
                'picUrl' => $file,
            );
            return response()->forApi($img);

        }
        return response()->forApi('failed');
    }


}
