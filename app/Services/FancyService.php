<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/11/9
 * Time: 下午2:09
 */
namespace App\Services;

use App\Models\Images;
use App\Lib\Images as Image;
use App\Lib\LibUtil;
use App\Lib\Top\TopClient;
use App\Lib\Top\Request\ProductGetRequest;
use App\Lib\Top\Request\TaeItemsListRequest;
use App\Lib\Top\Request\TaeItemDetailGetRequest;
use App\Lib\Top\Request\ItemGetRequest;


class FancyService extends ApiService
{

    public function getItemDetail ($url,$type = 2) {
        $tmp = $res = [];
        $response = $this->curl($url);
        if(!empty($response)){
            if($type==2){
                $preg_pic ="/<span class=\"figure-img\"><img src=\".+\" style=\"background-image:url\(\/\/thingd-media-ec\d+\.thefancy\.com\/.+\.(jpg|gif|png)\)\"><\/span>/is";
            }
            if($type == 1){
                $preg_pic ="/<img src=\"\/\/thingd-media-ec\d+\.thefancy\.com\/.+\.(jpg|gif|png)\" class=\"fit\">/is";
            }
            preg_match($preg_pic,$response,$arr);
            // dd($arr);
            $imageurl = isset($arr[0])?$arr[0]:'';
            
            preg_match("/\/\/thingd-media-ec\d+\.thefancy\.com\/.+\.(jpg|gif|png)/is",$imageurl,$pic_url);
            $pic_url  = $pic_url[0]?'https:'.$pic_url[0]:'';

            if($type==2){
                $preg_title = "/<figcaption>(.*?)<\/figcaption>/is";
            }
            if($type == 1){
                $preg_title = "/<h3 class=\"title\">(.*?)<\/h3>/is";
            }
            preg_match($preg_title,$response,$o_title);
            $o_title = isset($o_title[1])?$o_title[1]:'';
            $o_t2 = str_replace('\n','',$o_title);
            $o_t3 = str_replace('\t','',$o_t2);
            $title = trim($o_t3);

            if($type==2){
                $preg_price = "/<b class=\"price\s\">(.*?)\s<a class=\"currency\">USD<\/a><\/b>/is";
                preg_match($preg_price,$response,$o_price);
                $o_price = isset($o_price[1])?$o_price[1]:'';
                preg_match("/\d+/is",$o_price,$price);
                $price = isset($price[0])?$price[0]:'';
            }
            if($type == 1){
                $preg_price = "/<big class=\"\">(.*)$(.*)\d+(.*)<small class=\"usd\"><a class=\"code\">USD</a></small></big>/is";
                preg_match($preg_price,$response,$o_price);
                dd($o_price);
            }
            

            $tmp = [
                'pic_url'=>$pic_url,
                'price' => $price,
                'price_wap' => $price,
                'reserve_price' => $price,
                'title' => $title
            ];
            $res[0] = $tmp;
            return $res;
        }
        return 0;

    }



    public function curl($url, $postFields = null,$readTimeout = 15,$connectTimeout = 15){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $readTimeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields)){
            $postBodyString = "";
            $postMultipart = false;
            foreach ($postFields as $k => $v){
                if("@" != substr($v, 0, 1)){//判断是不是文件上传
                    $postBodyString .= "$k=" . urlencode($v) . "&"; 
                }else{//文件上传用multipart/form-data，否则用www-form-urlencoded
                    $postMultipart = true;
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart){
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }else{
                $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
                curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
            }
        }
        $reponse = curl_exec($ch);
        
        if (curl_errno($ch)){
            return 0;
        }else{
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode){
                throw new Exception($reponse,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }



}