<?php

namespace App\Lib;

use App\Lib\File\ActionType;
use App\Lib\File\HTTP_Request;
use App\Lib\File\HttpUtil;
use App\Lib\File\UCloud_Auth;
use App\Lib\File\UCloud_AuthHttpClient;
use App\Lib\File\UCloud_Error;

class FileService
{
    //const BUCKET = 'odfile';
    //const UCLOUD_PUBLIC_KEY = 'ucloud19581143@qq.com14397759570001695093750';
    //const UCLOUD_PRIVATE_KEY = '256ee083ed96d1d3a52891725fdf6a9f2fefbaa8';

    const BUCKET = 'lhfile';
    const UCLOUD_PUBLIC_KEY = '';
    const UCLOUD_PRIVATE_KEY = '';

    public static function getImg($img_md5, $width)
    {
        return self::get($img_md5, 'img/')
        . "&iopcmd=thumbnail&type=4&width={$width}";
    }

    public static function get($img_md5, $dir = 'img/')
    {
        $path = $dir . $img_md5;
        $public_url = 'http://' . self::BUCKET . '.ufile.ucloud.cn/' . rawurlencode($path);
        $req = new HTTP_Request(
            'GET', ['path' => $public_url], null, self::BUCKET, $path
        );
        $client = new UCloud_Auth(self::UCLOUD_PUBLIC_KEY, self::UCLOUD_PRIVATE_KEY);
        $temp = $client->SignRequest($req, null, ActionType::QUERY_STRING_CHECK);
        $signature = substr($temp, -28, 28);
        $url = $public_url . "?UCloudPublicKey=" . self::UCLOUD_PUBLIC_KEY . "&Signature=" . $signature;
        return $url;
    }

    /**
     * 文件上传 form表单形式
     *
     * @param $file 上传的文件 $_FILES['file_name']
     * @param $dir  文件存放的目录，图片文件为 img/
     *
     * @return string 成功返回文件内容的md5值
     */
    public static function putImg($file)
    {
        if ((isset($file['error']) && $file['error'] != 0) || empty($file['tmp_name'])) {
            return false;
        }
        $dir = 'img/';
        $file = $file['tmp_name'];
        $action_type = ActionType::PUTFILE;
        $f = @fopen($file, "r");
        if (!$f) return [null, new UCloud_Error(-1, -1, "open $file error")];

        $host = self::BUCKET . '.ufile.ucloud.cn';
        $content = @fread($f, filesize($file));
        $img_md5 = md5($content);
        $path = $dir . $img_md5;
        list($mimetype, $err) = self::GetFileMimeType($file);
        if ($err) {
            fclose($f);
            return ["", $err];
        }
        $req = new HTTP_Request(
            'PUT', ['host' => $host, 'path' => $path], $content, self::BUCKET, $path, $action_type
        );
        $req->Header['Expect'] = '';
        $req->Header['Content-Type'] = $mimetype;

        $client = new UCloud_AuthHttpClient(
            null, $mimetype, ActionType::HEAD_FIELD_CHECK,
            self::UCLOUD_PUBLIC_KEY, self::UCLOUD_PRIVATE_KEY
        );
        list($data, $err) = self::UCloud_Client_Call($client, $req);
        fclose($f);

        if (empty($err)) {
            return $img_md5;
        }
        \Log::error('image upload error', (array)$err);
        return false;
    }

    /**
     * base64文件上传
     *
     * @param $content  上传文件的内容
     * @param $mimetype 文件类型
     *
     * @return string 成功返回文件内容的md5值
     */
    public static function base64PutImg($content, $mimetype)
    {
        $action_type = ActionType::PUTFILE;
        $host = self::BUCKET . '.ufile.ucloud.cn';
        $img_md5 = md5($content);
        $dir = 'img/';
        $path = $dir . $img_md5;
        $req = new HTTP_Request(
            'PUT', ['host' => $host, 'path' => $path], $content, self::BUCKET, $path, $action_type
        );
        $req->Header['Expect'] = '';
        $req->Header['Content-Type'] = $mimetype;

        $client = new UCloud_AuthHttpClient(
            null, $mimetype, ActionType::HEAD_FIELD_CHECK,
            self::UCLOUD_PUBLIC_KEY, self::UCLOUD_PRIVATE_KEY
        );
        list($data, $err) = self::UCloud_Client_Call($client, $req);

        if (empty($err)) {
            return $img_md5;
        }
        \Log::error($err);//打印文件上传错误日志
        return false;
    }

    private static function UCloud_Client_Call($self, $req, $type = ActionType::HEAD_FIELD_CHECK)
    {
        list($resp, $err) = $self->RoundTrip($req, $type);
        if ($err !== null) {
            return [null, $err];
        }
        return self::UCloud_Client_Ret($resp);
    }

    private static function UCloud_Client_Ret($resp)
    {
        $code = $resp->StatusCode;
        $data = null;
        if ($code >= 200 && $code <= 299) {
            if ($resp->ContentLength !== 0 && HttpUtil::UCloud_Header_Get($resp->Header, 'Content-Type') == 'application/json') {
                $data = json_decode($resp->Body, true);
                if ($data === null) {
                    $err = new UCloud_Error($code, 0, "");
                    return [null, $err];
                }
            }
        }

        $etag = HttpUtil::UCloud_Header_Get($resp->Header, 'ETag');
        if ($etag != '') $data['ETag'] = $etag;
        if (floor($code / 100) == 2) {
            return [$data, null];
        }
        return [$data, HttpUtil::UCloud_ResponseError($resp)];
    }

    private static function GetFileMimeType($filename)
    {
        if (function_exists('mime_content_type')) {
            $mimetype = mime_content_type($filename);
        } else if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE); // 返回 mime 类型
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
        } else {
            return ["application/octet-stream", null];
        }
        return [$mimetype, null];
    }

}

