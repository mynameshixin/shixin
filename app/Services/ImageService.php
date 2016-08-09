<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/7/24
 * Time: 下午5:12
 */
namespace App\Services;

use App\Models\Images;
use App\Lib\Images as Image;
use App\Lib\LibUtil;

class ImageService extends ApiService
{

    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    //图片文件夹
    public static $image_dir = 'uploads/images/';

    public function __construct()
    {
    }

    //用户头像规则
    private $rules = array(
       // array('w' => 640, 'h' => 240, 'name' => '_b', 'isCut' => '1'),
        array('w' => 320, 'h' => 320, 'name' => '_m', 'isCut' => '1'),
       // array('w' => 264, 'h' => 169, 'name' => '_s', 'isCut' => '1'),
    );


    public function getImageIds($url)
    {
        $ext = strtolower(substr(strrchr($url,"."),1));
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
            $destinationPath = self::$image_dir;
            $entry = [
                'user_id' => isset($params['user_id']) ? $params['user_id'] : 0,
            ];
            $imageId = Images::insertGetId($entry);
            $destinationPath = $destinationPath . LibUtil::getFacePath($imageId);
            LibUtil::make_dir($destinationPath);
            $fileName = $imageId . '_o.'.$ext; // renameing image
           // $rs = move_uploaded_file($img, $destinationPath . $fileName);
            $fp2=@fopen($destinationPath . $fileName,'a');
            fwrite($fp2,$img);
            fclose($fp2);
            if (file_exists($destinationPath . $imageId . '_o.'.$ext)) {
                $rules = $this->rules;
                try {
                    $Image->creatThumbPi($destinationPath . $imageId . '_o.'.$ext, $destinationPath, $imageId, $rules);
                }catch(\Exception $e){

                }

                $images[] = array(
                    'image_id' => $imageId,
                    'pic_o' => $Image->getPicUrl($imageId, 4, self::$image_dir,$ext),
                    'pic_b' => $Image->getPicUrl($imageId, 2, self::$image_dir,$ext),
                    'pic_m' => $Image->getPicUrl($imageId, 1, self::$image_dir,$ext),
                );
            }
        }
        return isset($imageId) ? $imageId : '';
    }


    public function uploadImage ($userId=0,$files=array(),$rules=array()) {
        if (empty($files)) return false;
        $image_dir = self::$image_dir; // upload path
        $images = [];
         $Image = new Image();
        if (is_string($files["tmp_name"])) $files["tmp_name"] = array($files["tmp_name"]);
        if (is_string($files["name"])) $files["name"] = array($files["name"]);
        foreach ($files["tmp_name"] as $key => $tmp_name) {
            $entry = [
                'user_id'=> $userId,
                'name'=>isset($files['name'][$key]) ? $files['name'][$key] : ''

            ];
            $imageId = Images::insertGetId($entry);
            $destinationPath = $image_dir . LibUtil::getFacePath($imageId);
            LibUtil::make_dir($destinationPath);
            $fileName = $imageId . '_o.jpg'; // renameing image
            $ext = self::extend($entry['name']);

            if($ext=="jpg")
            {
                move_uploaded_file($tmp_name, $destinationPath . $fileName);
            }elseif($ext=="gif")
            {
                $im = imagecreatefromgif($tmp_name);
                ImageJpeg ($im, $destinationPath . $fileName);
            }elseif($ext=="png")
            {
                $im = imagecreatefrompng($tmp_name);
                ImageJpeg ($im, $destinationPath . $fileName);
            }
            //$imsge = new \App\Lib\Images();
            //$imsge->image_png_size_add($tmp_name, $destinationPath . $fileName);

            if ( file_exists($destinationPath . $imageId . '_o.jpg')) {
                $rules = !empty($rules) ? $rules : $this->rules;
                try{
                    $Image->creatThumbPi($destinationPath . $imageId . '_o.jpg', $destinationPath, $imageId,$rules);
                }catch (\Exception $e){
                    //Log::info($e);
                }

                $images[] = array(
                    'image_id' => $imageId,
                    'pic_o' => LibUtil::getPicUrl($imageId, 3,$image_dir),
                    //'pic_b' => self::getPicUrl($imageId, 2,$image_dir),
                    'pic_m' => LibUtil::getPicUrl($imageId, 1,$image_dir),
                );
            }
        }

        return $images;
    }

    function extend($file_name){
        $extend = pathinfo($file_name);
        $extend = strtolower($extend["extension"]);
        return $extend;
    }



}