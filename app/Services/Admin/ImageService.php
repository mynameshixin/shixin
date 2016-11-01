<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/7/21
 * Time: 下午12:36
 */
namespace App\Services\Admin;

use App\Lib\LibUtil;
use App\Lib\ProportionImage;
use App\Models\Images;
use App\Lib\Images as Image;
use App\Services\ApiService;
use Illuminate\Support\Facades\Log;

class ImageService extends ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
    //用图片存储文件夹
    public $image_dir ;

    //图片切图规则规则
    private $rules = array(
        //array('w' => 640, 'h' => 240, 'name' => '_b', 'isCut' => '0'),
        array('w' => 320, 'h' => 320, 'name' => '_m', 'isCut' => '1'),
        //array('w' => 240, 'h' => 240, 'name' => '_s', 'isCut' => '1'),
    );

    public function __construct()
    {
        $image_dir = env('UPLOAD_IMAGE_PATH', public_path('uploads/images/'));

        $this->image_dir = $image_dir;
    }

    /**
     * 图片上传
     * @param int $userId 用户id
     * @param array $files 文件
     * @param array $rules  图片切图规则规则
     *
     * @return array|bool
     */
    public function uploadImage ($userId=0,$files=array(),$rules=array()) {
        if (empty($files)) return false;
        $image_dir = $this->image_dir; // upload path
        $images = [];

        if (is_string($files["tmp_name"])) $files["tmp_name"] = array($files["tmp_name"]);
        if (is_string($files["name"])) $files["name"] = array($files["name"]);
        // dd($files);
        foreach ($files["tmp_name"] as $key => $tmp_name) {
            if(empty($tmp_name)) continue;
            $entry = [
                'user_id'=> $userId,
                'name'=>isset($files['name'][$key]) ? $files['name'][$key] : ''

            ];
            $imageId = Images::insertGetId($entry);
            $destinationPath = $image_dir . LibUtil::getFacePath($imageId);

            LibUtil::make_dir($destinationPath);
            $fileName = $imageId . '_o.jpg'; // renameing image
            // dd($destinationPath);
            $ext = $this->extend($tmp_name);
            if($ext=="2")
            {
                move_uploaded_file($tmp_name, $destinationPath . $fileName);
            }elseif($ext=="1")
            {
                $im = imagecreatefromgif($tmp_name);
                ImageJpeg ($im, $destinationPath . $fileName);
            }elseif($ext=="3")
            {
                $im = imagecreatefrompng($tmp_name);
                ImageJpeg ($im, $destinationPath . $fileName);
            }
            //$imsge = new \App\Lib\Images();
            //$imsge->image_png_size_add($tmp_name, $destinationPath . $fileName);


            if ( file_exists($destinationPath . $imageId . '_o.jpg')) {
                $rules = !empty($rules) ? $rules : $this->rules;
                try{
                    $this->creatThumbPi($destinationPath . $imageId . '_o.jpg', $destinationPath, $imageId,$rules);
                }catch (\Exception $e){
                    //Log::info($e);
                }

                $images[] = array(
                    'image_id' => $imageId,
                    'pic_o' => self::getPicUrl($imageId, 3,$image_dir),
                    'pic_b' => self::getPicUrl($imageId, 2,$image_dir),
                    'pic_m' => self::getPicUrl($imageId, 1,$image_dir),
                );
            }
        }

        return $images;
    }



    /**
     * 生产图片地址
     * @param $imageId
     * @param int $kind 大中小图
     * @param string $basepath 文件存储目录
     * @return string
     */
    public  function getPicUrl($imageId,$kind = 0){

        $dir ='uploads/images/';

        if ($imageId == '' || $imageId == null) {
            return '';
        }
        $path = LibUtil::getFacePath($imageId);
        $base =  $path. '/';
        $pic = $imageId.LibUtil::getPicName($kind).'.jpg' ;
        //检查图片是否存在，不存在返回空
        $basepath =$dir.$path;
        $url = \url($basepath.$pic);
        $file_url = public_path($basepath.$pic);
        if(file_exists($file_url)){
            return $url;
        }

        return '';
    }

    /**
     *  生成等比例缩略图
     * @param $file
     * @param $path
     * @param $imageId
     * @param $rules 生成图片规则
     * @return resizeimage
     */
    function creatThumbPi($file, $path, $imageId,array $rules) {
        $maxwidth = '600';//生成的图的最大宽度
        $maxheight = '800';//生成的图的最大宽度
        $t = new ProportionImage ( $file, $maxwidth,$maxheight, $path.$imageId.'_m.jpg');

        //return $t;
    }

    function extend($file_name){
        if(function_exists('exif_imagetype')){
            return exif_imagetype($file_name);
        }
        
    }

    // 获取远程图片
     public function getImageIds($url){
        
        //获取远程文件所采用的方法
        $ch = curl_init();
        $timeout = 15;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $img = curl_exec($ch);
        curl_close($ch);
        

        if (!empty($img)) {
            $Image = new Image();
            $destinationPath = $this->image_dir;
            $entry = [
                'user_id' => isset($params['user_id']) ? $params['user_id'] : 0,
            ];
            $imageId = Images::insertGetId($entry);
            $destinationPath = $destinationPath . LibUtil::getFacePath($imageId);
            LibUtil::make_dir($destinationPath);
            $fileName = $imageId . '_o.jpg'; // renameing image
           // $rs = move_uploaded_file($img, $destinationPath . $fileName);
            $fp2=@fopen($destinationPath . $fileName,'a');
            fwrite($fp2,$img);
            fclose($fp2);
            $ext = self::ext($destinationPath . $fileName);
            if (file_exists($destinationPath . $imageId . '_o.jpg')) {
                $rules = $this->rules;
                try {
                    $this->creatThumbPi($destinationPath . $imageId . '_o.jpg', $destinationPath, $imageId, $rules);
                }catch(\Exception $e){

                }

                $images[] = array(
                    'image_id' => $imageId,
                    'pic_o' => $Image->getPicUrl($imageId, 4, $this->image_dir),
                    'pic_b' => $Image->getPicUrl($imageId, 2, $this->image_dir),
                    'pic_m' => $Image->getPicUrl($imageId, 1, $this->image_dir),
                );
            }
        }
        return isset($imageId) ? $imageId : '';
    }

    function ext($file_name){
        if(function_exists('exif_imagetype')){
            return exif_imagetype($file_name);
        }
        
    }
}