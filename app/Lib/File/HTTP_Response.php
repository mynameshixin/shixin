<?php
namespace App\Lib\File;

class HTTP_Response
{
    public $StatusCode;
    public $Header;
    public $ContentLength;
    public $Body;
    public $Timeout;

    public function __construct($code, $body)
    {
        $this->StatusCode = $code;
        $this->Header = array();
        $this->Body = $body;
        $this->ContentLength = strlen($body);
    }
}
