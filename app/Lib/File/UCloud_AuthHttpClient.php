<?php
namespace App\Lib\File;
use App\Lib\File\UCloud_Auth;
use App\Lib\File\ActionType;
use App\Lib\File\HttpUtil;
use App\Lib\File\HTTP_Response;
use App\Lib\File\UCloud_Error;

class UCloud_AuthHttpClient
{
    public $Auth;
    public $Type;
    public $MimeType;

    public function __construct($auth, $mimetype = null, $type = HEAD_FIELD_CHECK, $public_key, $private_key)
    {
        $this->Type = $type;
        $this->MimeType = $mimetype;
        $this->Auth = self::UCloud_MakeAuth($auth, $public_key, $private_key);
    }

    private function UCloud_MakeAuth($auth, $public_key, $private_key)
    {
        if (isset($auth)) {
            return $auth;
        }
        return new UCloud_Auth($public_key, $private_key);
    }

    public function RoundTrip($req)
    {
        if ($this->Type === ActionType::HEAD_FIELD_CHECK) {
            $token = $this->Auth->SignRequest($req, $this->MimeType, $this->Type);
            $req->Header['Authorization'] = $token;
        }
        return $this->UCloud_Client_Do($req);
    }

    private function UCloud_Client_Do($req)
    {
        $ch = curl_init();
        $url = $req->URL;

        $options = array(
            CURLOPT_USERAGENT => $req->UA,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => false,
            CURLOPT_CUSTOMREQUEST => $req->METHOD,
            CURLOPT_URL => $url['host'] . "/" . rawurlencode($url['path']),
            CURLOPT_TIMEOUT => $req->Timeout,
            CURLOPT_CONNECTTIMEOUT => $req->Timeout
        );

        $httpHeader = $req->Header;
        if (!empty($httpHeader)) {
            $header = array();
            foreach ($httpHeader as $key => $parsedUrlValue) {
                $header[] = "$key: $parsedUrlValue";
            }
            $options[CURLOPT_HTTPHEADER] = $header;
        }
        $body = $req->Body;
        if (!empty($body)) {
            $options[CURLOPT_POSTFIELDS] = $body;
        } else {
            $options[CURLOPT_POSTFIELDS] = "";
        }
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        $ret = curl_errno($ch);
        if ($ret !== 0) {
            $err = new UCloud_Error(0, $ret, curl_error($ch));
            curl_close($ch);
            return array(null, $err);
        }
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);

        $responseArray = explode("\r\n\r\n", $result);
        $responseArraySize = sizeof($responseArray);
        $headerString = $responseArray[$responseArraySize - 2];
        $respBody = $responseArray[$responseArraySize - 1];

        $headers = HttpUtil::parseHeaders($headerString);
        $resp = new HTTP_Response($code, $respBody);
        $resp->Header = $headers;
        $err = null;
        if (floor($resp->StatusCode / 100) != 2) {
            list($r, $m) = HttpUtil::parseError($respBody);
            $err = new UCloud_Error($resp->StatusCode, $r, $m);
        }
        return array($resp, $err);
    }
}

