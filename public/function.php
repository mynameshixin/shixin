<?php 

	function P($arr){
		echo '<pre>';
		print_r($arr);
		die;
	}

	function fstr($str){
		$str =  htmlspecialchars(trim($str));
		return $str;
	}

	function fparam($param){
		if(is_string($param)) return fstr($param);
		if(is_array($param)){
			foreach ($param as $k=>$v) {
				$param[$k] = fstr($v);
			}
			return $param;
		}
	}

 ?>