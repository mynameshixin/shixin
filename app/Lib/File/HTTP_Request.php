<?php
namespace App\Lib\File;
use App\Lib\File\ActionType;

class HTTP_Request
{
    public $URL;
    public $Header;
    public $Body;
    public $UA;
    public $METHOD;
    public $Params;      //map
    public $Bucket;
    public $Key;
    public $Timeout;

    public function __construct($method, $url, $body, $bucket, $key, $action_type = ActionType::NONE)
    {
        $this->URL = $url;
        $this->Header = array();
        $this->Body = $body;
        $this->UA = $this->uCloudUserAgent();
        $this->METHOD = $method;
        $this->Bucket = $bucket;
        $this->Key = $key;
        $this->Timeout = 10;
    }

    private function uCloudUserAgent()
    {
        $sdkInfo = "UCloudPHP/1.0.4";
        $systemInfo = php_uname("s");
        $machineInfo = php_uname("m");
        $envInfo = "($systemInfo/$machineInfo)";
        $phpVer = phpversion();
        $ua = "$sdkInfo $envInfo PHP/$phpVer";
        return $ua;
    }
}

