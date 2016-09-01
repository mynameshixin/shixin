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

    public function getItemDetail ($url) {
        $tmp = $res = [];
        preg_match("/\d+/is", $url,$rurl);
        $url = "https://fancy.com/rest-api/v1/things/".$rurl[0];
        $response = file_get_contents($url);
        if(!empty($response)){
            $r_arr = json_decode($response,1);
           // dd($r_arr);
            $pic_url = $r_arr['image']['src'];
            $price = $r_arr['sales']['price'];
            $title = $r_arr['name'];

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

    public function getIkeaDetail ($url) {
        $tmp = $res = [];
        $response = $this->curl($url);
        // echo $response;die;
        if(!empty($response)){

            $preg_pic ="/<img id=\"productImg\" src=\'(.+)\.(jpg|gif|png)\'.+border=\"0\"  alt=\'.+\' title=\'(.*)\' width=\"500\" height=\"500\"\/>/is";
            preg_match($preg_pic,$response,$arr);
            $pic_url = $title = '';
            if(!empty($arr[0])){
                $pic_url = "http://www.ikea.com".$arr[1].'.'.$arr[2];
                $title = $arr[3];
            }

            $preg_price = "/<span id=\"price1\" class=\"packagePrice\">(.+?)<\/span>/is";
            preg_match($preg_price,$response,$o_price);
            if(!empty($o_price[1])){
                preg_match("/\d+\.\d{2}/is",$o_price[1],$price);
                $price = $price[0];
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

    public function getWowdsgnDetail ($url) {
        $tmp = $res = [];
        $response = $this->curl($url);

        if(!empty($response)){

            $preg_pic ="/<img id=\"product-pic\" class=\"img-responsive\" src=\"(.*?)\">/is";
            preg_match($preg_pic,$response,$arr);
            $pic_url = $title = '';
            if(!empty($arr[1])){
                $pic_url = $arr[1];
            }

            $preg_price = "/<p class=\"price-lg\">(.*?)<\/p>/is";
            preg_match($preg_price,$response,$o_price);
            if(!empty($o_price[1])){
                preg_match("/\d+\.\d{2}/is",$o_price[1],$price);
                $price = $price[0];
            }
            
            $preg_title = "/<title>(.*?)<\/title>/is";
            preg_match($preg_title,$response,$o_title);
            if(!empty($o_title[1])){
                $title = $o_title[1];
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
        $header = array (
        'User-Agent: Mozilla/5.0 (Windows NT 5.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36','X-FORWARDED-FOR:154.125.25.15', 'CLIENT-IP:154.125.25.15'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //构造用户IP
        curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com/");//构造来路 
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