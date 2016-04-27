<?php
namespace App\Lib\File;
use App\Lib\File\UCloud_Error;

class HttpUtil
{
    public static function parseHeaders($headerString)
    {
        $headers = explode("\r\n", $headerString);
        foreach ($headers as $header) {
            if (strstr($header, ":")) {
                $header = trim($header);
                list($k, $v) = explode(":", $header);
                $headers[$k] = trim($v);
            }
        }
        return $headers;
    }

    public static function parseError($bodyString)
    {
        $r = 0;
        $m = '';
        $mp = json_decode($bodyString);
        if (isset($mp->{'ErrRet'})) $r = $mp->{'ErrRet'};
        if (isset($mp->{'ErrMsg'})) $m = $mp->{'ErrMsg'};
        return array($r, $m);
    }

    public static function UCloud_Header_Get($header, $key)
    {
        $val = @$header[$key];
        if (isset($val)) {
            if (is_array($val)) {
                return $val[0];
            }
            return $val;
        } else {
            return '';
        }
    }

    public static function UCloud_ResponseError($resp)
    {
        $header = $resp->Header;
        $err = new UCloud_Error($resp->StatusCode, null, null);

        if ($err->Code > 299) {
            if ($resp->ContentLength !== 0) {
                if (HttpUtil::UCloud_Header_Get($header, 'Content-Type') === 'application/json') {
                    $ret = json_decode($resp->Body, true);
                    $err->ErrRet = $ret['ErrRet'];
                    $err->ErrMsg = $ret['ErrMsg'];
                }
            }
        }
        $err->Reqid = HttpUtil::UCloud_Header_Get($header, 'X-SessionId');
        return $err;
    }
}
