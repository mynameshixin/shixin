<?php

namespace App\Http\Controllers\Api;

use App\Lib\LibUtil;
use App\Models\Images;
use App\Services\Admin\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Lib\FileService;

class ImageController extends BaseController
{

    public function index()
    {
        $data = Input::all();
        $this->validator($data, [
            'image_ids' => 'required',
        ]);
        $img_ids = explode(',', $data['image_ids']);
        $img_ids = array_unique($img_ids);
        $images = array();
        $fileNames = Images::whereIn('id',$img_ids)->where('name','>','0')->lists('name','id')->toArray();
        foreach ($img_ids as $image_id) {
            $file = LibUtil::getPicUrl($image_id,3);
            if ($file) {
                $images[] = array(
                    'image_id' => $image_id,
                    'picUrl' => $file,
                    'name' =>isset($fileNames[$image_id]) ? $fileNames[$image_id] : '',
                );
            }
        }

        return response()->forApi($images);
    }


    public function store()
    {

        if (!isset($_FILES['image'])) return;
        $userId = 1;
        $user = Auth::user();
        if ($user) {
            $userId = $user->id;
        }
        $rs = ImageService::getInstance()->uploadImage ($userId,$_FILES['image']);
        if ($rs) {
            $file = isset($rs[0]) ? $rs[0] : current($rs);
            $fileNames = Images::where('id',$file['image_id'])->lists('name','id')->toArray();
            $img = array(
                'image_id' => $file['image_id'],
                'picUrl' => $file['pic_o'],
                'name' =>isset($fileNames[$file['image_id']]) ? $fileNames[$file['image_id']] : '',
            );
            return response()->forApi($img);

        }
        return response()->forApi('failed');
    }


}

