<?php
namespace App\Lib;
/**
 * 等比例缩放图片
 * 16.5.4
 */
class ProportionImage {

//图片类型
	var $type;
	//实际宽度
	var $width;
	//实际高度
	var $height;
	//改变后的宽度
	var $resize_width;
	//改变后的高度
	var $resize_height;
	//源图象
	var $srcimg;
	//目标图象地址
	var $dstimg;
	//临时创建的图象
	var $im;

	function __construct ($img, $maxwidth, $maxheight,$dstpath)
	{
		$this->srcimg = $img;
		$this->resize_width = $maxwidth;
		$this->resize_height = $maxheight;
		//图片的类型
		$this->type = strtolower(substr(strrchr($this->srcimg,"."),1));
		//初始化图象
		$this->initi_img();
		//目标图象地址
		$this->dstimg = $dstpath;
		//--
		$this->width = imagesx($this->im);
		$this->height = imagesy($this->im);
		//生成图象
		$this->newimg();
	}

	function newimg(){
	  $pic_width = $this->width;
	  $pic_height = $this->height;
	  $maxwidth = $this->resize_width;
	  $maxheight = $this->resize_height;
	  $m = $this->im;
	  $filetype = $this->type;
	  $dstimg = $this->dstimg;

	  if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)){

		   if($maxwidth && $pic_width>$maxwidth){
			    $widthratio = $maxwidth/$pic_width;
			    $resizewidth_tag = true;
		   }
		   if($maxheight && $pic_height>$maxheight){
			    $heightratio = $maxheight/$pic_height;
			    $resizeheight_tag = true;
		   }
		 
		   if($resizewidth_tag && $resizeheight_tag){
			    if($widthratio < $heightratio)
			     $ratio = $widthratio;
			    else
			     $ratio = $heightratio;
		   }
		 
		   if($resizewidth_tag && !$resizeheight_tag) $ratio = $widthratio;
		   if($resizeheight_tag && !$resizewidth_tag) $ratio = $heightratio;
		 
		   $newwidth = $pic_width * $ratio;
		   $newheight = $pic_height * $ratio;
		 
		   if(function_exists("imagecopyresampled")){
		      $newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数
		      imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);//PHP系统函数
		   }else{
		      $newim = imagecreate($newwidth,$newheight);
		      imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
		   }

		   imagejpeg($newim,$dstimg);
		   imagedestroy($newim);

	  	}else{
		   imagejpeg($im,$dstimg);
  		}
	}
	//初始化图象
	function initi_img()
	{
		if($this->type=="jpg")
		{
			$this->im = imagecreatefromjpeg($this->srcimg);
		}
		if($this->type=="gif")
		{
			$this->im = imagecreatefromgif($this->srcimg);
		}
		if($this->type=="png")
		{
			$this->im = imagecreatefrompng($this->srcimg);
		}
	}
}
