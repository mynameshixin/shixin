<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/11/9
 * Time: 下午3:23
 */

namespace App\Lib\Top\Request;

class Taobaoke {
    public $client_id = '';
    public $client_secret = '';
    public $debug = false;
    public $params = array ();
    public $api_url_http = 'http://127.0.0.1:8086/api/';
    public $api_url_https = 'http://127.0.0.1:8086/api/';

    function __construct() {
        $this->ci = & get_instance();
    }
    function initialize($params = array ()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset ($this-> $key)) {
                    $this-> $key = $val;
                }
            }
        }
    }
    public function generatesign($params) {
        ksort($params);
        $stringToBeSigned = $this->app_secret;
        foreach ($params as $k => $v) {
            if ("@" != substr($v, 0, 1)) {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset ($k, $v);
        $stringToBeSigned .= $this->app_secret;
        return strtoupper(md5($stringToBeSigned));
    }

    public function api($command = null, $params = array (), $method = 'POST', $multi = false, $extheaders = array ()) {
        $params['timestamp'] = time();
        $params['app_key'] = $this->app_key;
        $params['app_secret'] = $this->app_secret;
        $params['v'] = '2.0';
        $params['method']=trim($command, '/');
        $params['sign_method']='md5';
        $params['format']='json';
        $params["sign"] = $this->generateSign($params);
        $url = $this->apiUrlHttps;
        $r = $this->HttpRequest($url, $params, $method, $multi, $extheaders);
        $r = preg_replace('/[^\x20-\xff]*/', "", $r);
        $r = iconv("utf-8", "utf-8//ignore", $r);
        if ($this->debug) {
            echo '<pre>';
            echo '接口：' . $url;
            echo '<br>请求参数：<br>';
            print_r($params);
            echo '返回结果：' . $r;
            echo '</pre>';
        }
        return json_decode($r, true);
    }

    /**
     * 发起一个HTTP/HTTPS的请求
     * @param $url 接口的URL
     * @param $params 接口参数   array('content'=>'test', 'format'=>'json');
     * @param $method 请求类型    GET|POST
     * @param $multi 图片信息
     * @param $extheaders 扩展的包头信息
     * @return string
     */
    public function HttpRequest($url, $params = null, $method = 'POST', $multi = false, $extheaders = array ()) {
        if (!function_exists('curl_init')) {
            exit ('Need to open the curl extension');
        }
        $params = $params ? $params : $this->params;
        $method = strtoupper($method);
        $ci = curl_init();
        curl_setopt($ci, CURLOPT_USERAGENT, 'OAuth2.0');
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ci, CURLOPT_TIMEOUT, 3);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ci, CURLOPT_HEADER, false);
        $headers = (array) $extheaders;
        switch ($method) {
            case 'POST' :
                curl_setopt($ci, CURLOPT_POST, TRUE);
                if (!empty ($params)) {
                    if ($multi) {
                        foreach ($multi as $key => $file) {
                            $params[$key] = '@' . $file;
                        }
                        curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
                        $headers[] = 'Expect: ';
                    } else {
                        curl_setopt($ci, CURLOPT_POSTFIELDS, http_build_query($params));
                    }
                }
                break;
            case 'DELETE' :
            case 'GET' :
                $method == 'DELETE' && curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty ($params)) {
                    $url = $url . (strpos($url, '?') ? '&' : '?') . (is_array($params) ? http_build_query($params) : $params);
                }
                break;
        }

        curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($ci, CURLOPT_URL, $url);
        if ($headers) {
            curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ci);
        curl_close($ci);
        return $response;
    }
}
