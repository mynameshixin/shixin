<?php
namespace App\Lib;
/**
 * Created by PhpStorm.
 * User: anne
 * Date: 15/5/4
 * Time: 下午4:36
 */
class ResizeImage {

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
	//是否裁图
	var $cut;
	//源图象
	var $srcimg;
	//目标图象地址
	var $dstimg;
	//临时创建的图象
	var $im;

	function __construct ($img, $wid, $hei,$c,$dstpath)
	{
		$this->srcimg = $img;
		$this->resize_width = $wid;
		$this->resize_height = $hei;
		$this->cut = $c;
		//图片的类型
		$this->type = exif_imagetype($this->srcimg);
		//初始化图象
		$this->initi_img();
		//目标图象地址
		$this -> dst_img($dstpath);
		//--
		$this->width = imagesx($this->im);
		$this->height = imagesy($this->im);
		//生成图象
		$this->newimg();
		ImageDestroy ($this->im);
	}

	function ResizeImage($img, $wid, $hei,$c,$dstpath)
	{
		$this->srcimg = $img;
		$this->resize_width = $wid;
		$this->resize_height = $hei;
		$this->cut = $c;
		//图片的类型
		$this->type = exif_imagetype($this->srcimg);
		//初始化图象
		$this->initi_img();
		//目标图象地址
		$this -> dst_img($dstpath);
		//--
		$this->width = imagesx($this->im);
		$this->height = imagesy($this->im);
		//生成图象
		$this->newimg();
		ImageDestroy ($this->im);
	}
	function newimg()
	{
		//改变后的图象的比例
		$resize_ratio = ($this->resize_width)/($this->resize_height);
		//实际图象的比例
		$ratio = ($this->width)/($this->height);
		if(($this->cut)=="1")
			//裁图
		{
			if($ratio>=$resize_ratio)
				//高度优先
			{
				$newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
				imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
				imagejpeg ($newimg,$this->dstimg);

			}
			if($ratio<$resize_ratio)
				//宽度优先
			{
				$newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
				imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width)/$resize_ratio));
				imagejpeg ($newimg,$this->dstimg);
			}
		}
		else
			//不裁图
		{
			if($ratio>=$resize_ratio)
			{
				$newimg = imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
				imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, ($this->resize_width)/$ratio, $this->width, $this->height);
				imagejpeg ($newimg,$this->dstimg);
			}
			if($ratio<$resize_ratio)
			{
				$newimg = imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
				imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($this->resize_height)*$ratio, $this->resize_height, $this->width, $this->height);
				imagejpeg ($newimg,$this->dstimg);
			}
		}
	}
	//初始化图象
	function initi_img()
	{
		if($this->type=="2")
		{
			$this->im = imagecreatefromjpeg($this->srcimg);
		}
		if($this->type=="1")
		{
			$this->im = imagecreatefromgif($this->srcimg);
		}
		if($this->type=="3")
		{
			$this->im = imagecreatefrompng($this->srcimg);
		}
	}
	//图象目标地址
	function dst_img($dstpath)
	{
		$this->dstimg = $dstpath;
	}
}
