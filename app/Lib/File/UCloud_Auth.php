<?php
namespace App\Lib\File;
use App\Lib\File\HttpUtil;
use App\Lib\File\ActionType;

class UCloud_Auth
{

    public $PublicKey;
    public $PrivateKey;

    public function __construct($publicKey, $privateKey)
    {
        $this->PublicKey = $publicKey;
        $this->PrivateKey = $privateKey;
    }

    private function Sign($data)
    {
        $sign = base64_encode(hash_hmac('sha1', $data, $this->PrivateKey, true));
        return "UCloud " . $this->PublicKey . ":" . $sign;
    }

    //@results: $token
    public function SignRequest($req, $mimetype = null, $type = ActionType::HEAD_FIELD_CHECK)
    {
        $url = $req->URL;
        $url = parse_url($url['path']);
        $data = '';
        $data .= strtoupper($req->METHOD) . "\n";
        $data .= HttpUtil::UCloud_Header_Get($req->Header, 'Content-MD5') . "\n";
        if ($mimetype)
            $data .= $mimetype . "\n";
        else
            $data .= HttpUtil::UCloud_Header_Get($req->Header, 'Content-Type') . "\n";
        if ($type === ActionType::HEAD_FIELD_CHECK)
            $data .= HttpUtil::UCloud_Header_Get($req->Header, 'Date') . "\n";
        else
            $data .= HttpUtil::UCloud_Header_Get($req->Header, 'Expires') . "\n";
        $data .= "/" . $req->Bucket . "/" . $req->Key;
        $data .= $this->CanonicalizedUCloudHeaders($req->Header);
        return $this->Sign($data);
    }

    private function CanonicalizedUCloudHeaders($headers)
    {

        $keys = array();
        foreach ($headers as $header) {
            $header = trim($header);
            $arr = explode(':', $header);
            if (count($arr) < 2) continue;
            list($k, $v) = $arr;
            $k = strtolower($k);
            $header_str = 'x-ucloud';
            if (strncasecmp($k, $header_str, strlen($header_str)) === 0) {
                $keys[] = $k;
            }
        }

        $c = '';
        sort($keys, SORT_STRING);
        foreach ($keys as $k) {
            $c .= $k . ":" . trim($headers[$v], " ") . "\n";
        }
        return $c;
    }

}

