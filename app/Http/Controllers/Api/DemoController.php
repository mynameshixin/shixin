<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Lib\FileService;
use App\Lib\LibUtil;
use App\Models\Category;
use App\Models\CollectionGood;
use App\Models\FolderGood;
use App\Models\Product;
use App\Models\User;
use App\Services\Admin\ImageService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Psy\Readline\Libedit;


/**
 * @SWG\Resource(
 *  resourcePath="/demo",
 *  description="测试",
 * )
 */

class DemoController extends BaseController
{


    /**
     *
     *
     * @SWG\Api(
     *   path="/demo/test",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="测试接口",
     *       notes="Returns special list",
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function getTest () {
        //$_COOKIE['access_token'] = '123';
        //cookie('access_token',123,45000);
        //return response('')->withCookie(cookie('access_token','laravel',1000));
        $response =  response('Hello World');

        $response->withCookie('name', 'value', 45000);

        return $response;
    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/demo/upload",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="上传场地图片",
     *       notes="上传图片接口：POST ",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="image[]",
     *           description="图片",
     *           paramType="form",
     *           required=true,
     *           type="file"
     *         ),
     *        @SWG\Parameter(
     *           name="image[]",
     *           description="图片",
     *           paramType="form",
     *           required=true,
     *           type="file"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function postUpload()
    {
//        $image_keys = [];
//        if (!empty($_FILES['image'])) {
//            $files = $_FILES['image'];
//            for ($i=0;$i<count($files['name']);$i++) {
//                $file['name'] = $files['name'][$i];
//                $file['error'] = $files['error'][$i];
//                $file['type'] = $files['type'][$i];
//                $file['tmp_name'] = $files['tmp_name'][$i];
//                $file['size'] = $files['size'][$i];
//                $image_key = FileService::putImg($file);
//                if ($image_key){
//                    $picUrl = FileService::getImg($image_key,'');
//                    $image_keys[] = ['image_id' => $image_key,'picUrl'=>$picUrl];
//                }
//            }
//
//        }
//
//        return $this->response->array($image_keys);
        $rs = ImageService::getInstance()->uploadImage($userId=0,$_FILES['image']);

        dd($rs);
        $file = $_FILES['image'];
        $imgsrc = $file['tmp_name'];
        $imgdst = public_path('uploads/images/');
        $imgdst = $imgdst.'1.jpg';
        $rs = self::image_png_size_add($imgsrc,$imgdst);

    }

    /**
     * desription 压缩图片
     * @param sting $imgsrc 图片路径
     * @param string $imgdst 压缩后保存路径
     */
    function image_png_size_add($imgsrc,$imgdst){
        list($width,$height,$type)=getimagesize($imgsrc);
        $new_width = ($width>600?600:$width)*0.8;
        $new_height =($height>600?600:$height)*0.8;
        switch($type){
            case 1:
                $giftype=check_gifcartoon($imgsrc);
                if($giftype){
                    header('Content-Type:image/gif');
                    $image_wp=imagecreatetruecolor($new_width, $new_height);
                    $image = imagecreatefromgif($imgsrc);
                    imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagejpeg($image_wp, $imgdst,75);
                    imagedestroy($image_wp);
                }
                break;
            case 2:
                header('Content-Type:image/jpeg');
                $image_wp=imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefromjpeg($imgsrc);
                imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($image_wp, $imgdst,75);
                imagedestroy($image_wp);
                break;
            case 3:
                header('Content-Type:image/png');
                $image_wp=imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefrompng($imgsrc);
                imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($image_wp, $imgdst,75);
                imagedestroy($image_wp);
                break;
        }
    }
    /**
     * desription 判断是否gif动画
     * @param sting $image_file图片路径
     * @return boolean t 是 f 否
     */
    function check_gifcartoon($image_file){
        $fp = fopen($image_file,'rb');
        $image_head = fread($fp,1024);
        fclose($fp);
        return preg_match("/".chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0'."/",$image_head)?false:true;
    }


}
