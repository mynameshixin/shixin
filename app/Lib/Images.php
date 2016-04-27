<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/7/21
 * Time: 下午12:36
 */
namespace App\Lib;
class Images
{
    /**
     *  生成缩率图
     * @param $file
     * @param $path
     * @param $imageId
     * @param $rules 生成图片规则
     *  $rules = array(
     *      array('w' => 640, 'h' => 240, 'name' => '_b', 'isCut' => '1'),
     *      array('w' => 320, 'h' => 320, 'name' => '_m', 'isCut' => '1'),
     *      array('w' => 240, 'h' => 240, 'name' => '_s', 'isCut' => '1'),
     *     );
     * @return resizeimage
     */
    function creatThumbPi($file, $path, $imageId,array $rules) {
        try {
            $picArr['file'] = $file;
            $picArr['path'] = $path;
            $picArr['arr']  = $rules;
            if ($picArr ['arr']) {
                foreach ( $picArr ['arr'] as $val ) {
                    $val ['name'] =$imageId.$val ['name'] . '.jpg';
                    $t = new ResizeImage ( $file, $val ['w'], $val ['h'], $val ['isCut'], $path . $val ['name'] );
                }
            }
            return $t;
        }catch (\Exception $e){

        }
        return ;
    }

    /**
     * 生产图片地址
     * @param $imageId
     * @param int $kind 大中小图
     * @param string $basepath 文件存储目录
     * @return string
     */
    public  function getPicUrl($imageId,$kind = 0,$dir=''){

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
        //if(file_exists($file_url)){
            return $url;
        //}

        //return '';
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
                    //header('Content-Type:image/gif');
                    $image_wp=imagecreatetruecolor($new_width, $new_height);
                    $image = imagecreatefromgif($imgsrc);
                    imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagejpeg($image_wp, $imgdst,75);
                    imagedestroy($image_wp);
                }
                break;
            case 2:
                //header('Content-Type:image/jpeg');
                $image_wp=imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefromjpeg($imgsrc);
                imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($image_wp, $imgdst,75);
                imagedestroy($image_wp);
                break;
            case 3:
                //header('Content-Type:image/png');
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