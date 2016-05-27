<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use DB;
class CmWebsupply {
	public static $defaultPic;
	public function __construct(){
		self::$defaultPic = url('uploads/sundry/blogo.jpg');
	}
	
}