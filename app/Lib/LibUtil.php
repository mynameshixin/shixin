<?php
/**
 * Created by PhpStorm.
 * User: anne
 * Date: 15/5/4
 * Time: 下午4:36
 */
namespace App\Lib;

class LibUtil {
    public static $host = 'http://www.duitujia.com/';
    public static function pageFomate ($data) {
       $data = is_object($data) ? $data->toArray()  : $data;

        return [
            "total" => $data['total'],
            "per_page" => $data['per_page'],
            "current_page" => $data['current_page'],
            "last_page" => $data['last_page'],
            'list'=>$data['data']
        ];
    }

    /**
     * 获取分类的图片
     * @param $category_id
     * @return string
     */
    public static function getColumnPic($value,$kind=1)
    {
        if (empty($value)) return '';
        $dir = 'uploads/images/columns/';


        //检查图片是否存在，不存在返回空
        if ($kind==2) {
            $path = self::$host. $dir .'/web/'.$value;
        }else{
            $path = self::$host.$dir . $value;
        }

        $url = \url($path);
        return $url;
        /*$file_url = public_path($path);
        if (file_exists($file_url)) {
            return $url;
        }
        return '';*/
    }

    /**
     * 获取易班用户头像
     * @param unknown $userid
     * @param unknown $type
     * @return string
     */
    public static function userAvatar($userid,$type){
        $base_url = \Config::get('yb-center.avatar_server');
        $types = array('b'=>160,'m'=>88,'s'=>68,'t'=>36);
        $type = isset($types[$type]) ? $types[$type] : $type;
        $url = "{$base_url}/{$userid}/avatar/user/{$type}";
        return $url;
    }
    /**
     * @param $imageId
     * @param int $kind
     * @param string $dir
     * @return string
     */

    public  static function getPicUrl($imageId,$kind = 0,$dir=''){

        if ($imageId == '' || $imageId == null) {
            return '';
        }
        if (empty($dir)) {
            $dir = 'uploads/images/';
        }
        $path = LibUtil::getFacePath($imageId);

        $pic = $imageId.LibUtil::getPicName($kind).'.jpg' ;
        //检查图片是否存在，不存在返回空
        $basepath = self::$host.$dir.$path;
        $url = \url($basepath.$pic);
        return $url;
        /*$file_url = public_path($basepath.$pic);
        if(file_exists($file_url)){
            return $url;
        }
        return '';*/
    }
    public static function getUserAvatar($imageId, $kind = 0, $dir = '')
    {
        $dir = !empty ($dir) ? $dir : \Config::get('farm.avatar_dir');
        if (empty($dir)) {
            $dir = 'uploads/users/avatar/';
        }
        if ($imageId == '' || $imageId == null) {
            return '';
        }
        $path = LibUtil::getFacePath($imageId);
        $base = $path . '/';
        $pic = $imageId . LibUtil::getPicName($kind) . '.jpg';
        //检查图片是否存在，不存在返回空
        $basepath = self::$host.$dir.$path;
        $url = \url($basepath . $pic);
        return $url;
        /*$file_url = public_path($basepath . $pic);
        if (file_exists($file_url)) {
            $url = $url. '?' . time();
            return $url;
        }
        return '';*/
    }
    //创建文件夹
    public static function make_dir($folder) {
        $reval = false;

        if (! file_exists ( $folder )) {
            /* 如果目录不存在则尝试创建该目录 */
            @umask ( 0 );

            /* 将目录路径拆分成数组 */
            preg_match_all ( '/([^\/]*)\/?/i', $folder, $atmp );

            /* 如果第一个字符为/则当作物理路径处理 */
            $base = ($atmp [0] [0] == '/') ? '/' : '';

            /* 遍历包含路径信息的数组 */
            foreach ( $atmp [1] as $val ) {
                if ('' != $val) {
                    $base .= $val;

                    if ('..' == $val || '.' == $val) {
                        /* 如果目录为.或者..则直接补/继续下一个循环 */
                        $base .= '/';

                        continue;
                    }
                } else {
                    continue;
                }

                $base .= '/';

                if (! file_exists ( $base )) {
                    /* 尝试创建目录，如果创建失败则继续循环 */
                    if (@mkdir ( rtrim ( $base, '/' ), 0777 )) {
                        @chmod ( $base, 0777 );
                        $reval = true;
                    }
                }
            }
        } else {
            /* 路径已经存在。返回该路径是不是一个目录 */
            $reval = is_dir ( $folder );
        }

        clearstatcache ();

        return $reval;
    }

    public static function fieldPicArr($file,$path) {
        $arr['file'] = $file;
        $arr['path'] = $path;
        $arr['arr'] = array(
            array('w' => 640, 'h' => 240, 'name' => '_b', 'isCut' => '1'),
            array('w' => 320, 'h' => 320, 'name' => '_m', 'isCut' => '1'),
            array('w' => 240, 'h' => 240, 'name' => '_s', 'isCut' => '1'),
        );
        return $arr;
    }

    public static function getFacePath($imageid) {
        $key = "duododo.com$";
        $hash = md5($key."\t".$imageid."\t".strlen($imageid)."\t".$imageid % 10);
        $path = $hash{$imageid % 32} . "/" . abs(crc32($hash) % 100) . "/";

        return $path;
    }


    public static function getPicName($kind = 0) {
        $type = array(
            '_s','_m','_b','_o'
        );
        return isset($type[$kind]) ? $type[$kind] : $type[3];
    }

    /**
     * 请求地址
     *
     * @param string $url		请求地址
     * @param array $queries	请求参数
     * @return mixed
     *
     * @return JSON
     */
    public static function curlPost($url, $queries)
    {
        $ch = curl_init(); // 初始化curl
        curl_setopt($ch, CURLOPT_URL, $url); // 抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); // 设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1 ); // post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($queries));
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        $result = curl_exec($ch); //运行curl
        curl_close($ch);
        return json_decode($result, true);
    }

    public static function reqPost($url, $queries)
    {
        $ch = curl_init(); // 初始化curl
        curl_setopt($ch, CURLOPT_URL, $url); // 抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); // 设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1 ); // post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($queries));
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        $result = curl_exec($ch); //运行curl
        return $result;
    }
    /**
     * 请求地址
     *
     * @param string $url		请求地址
     * @return mixed
     *
     * @return JSON
     */
    public static function curlGet($url){
        $ch = curl_init(); // 初始化curl
        curl_setopt($ch, CURLOPT_URL, $url); // 抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); // 设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 要求结果为字符串且输出到屏幕上
        $result = curl_exec($ch); //运行curl
        curl_close($ch);
        return json_decode($result, true);
    }

    public static function getKeyValue($url) {
    $result = array();
    $mr = preg_match_all('/(\?|&)(.+?)=([^&?]*)/i', $url, $matchs);

    if ($mr !== FALSE) {
        for ($i = 0; $i < $mr; $i++) {
            $result[$matchs[2][$i]] = $matchs[3][$i];
        }
    }
    return $result;

    
    }

    /**
     * 版本检查
     * @param unknown $first
     * @param unknown $second
     * @return boolean
     */
    public static function isSecondBigger($first, $second) {
        //纯数字比较
        if (is_numeric ( $first ) && is_numeric ( $second )) {
            if ($second > $first) {
                return true;
            } else {
                return false;
            }
        }
        $first = str_replace('.','',$first);
        $second = str_replace('.','',$second);
        $f =  strlen($first);
        $s =  strlen($second);

        if ($f>$s) {
            $n = $f-$s;
            $m = 1;
            for ($i=0;$i<$n;$i++){
                $m = $m*10;
            }
            $second = $second * $m;
        }else if($s>$f) {
            $n = $s-$f;
            $m = 1;
            for ($i=0;$i<$n;$i++){
                $m = $m*10;
            }
            $first = $first * $m;
        }
        if (intval($second) > intval($first)) {
            return true;
        }

        return false;
    }

}