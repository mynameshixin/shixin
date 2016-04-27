<?php

namespace App\Http\Controllers;
use App\Lib\FileService;

class FileController extends ApiController{
    
    public function base64UploadDemoView(){
        return view('demo.file_base64_upload_demo');
    }
    //base64图片上传
    public function base64Upload(){
        $img_content = \Input::get("img_content", '');//文件内容
        $content_arr = explode(',', $img_content);
        //过滤非文件内容的请求参数
        if(!(count($content_arr) > 1 && strpos($content_arr[0], 'base64') > 0)){
            $this->jsonError('内容有误');
        }
        //获取文件mimetype
        $img_type = $this->_getFileMimeType($content_arr[0]);
        //解析文件内容
        $content = base64_decode(substr($img_content,strpos($img_content,',')+1));
        //文件上传
        $md5 = FileService::base64PutImg($content, $img_type);
        if(!$md5){
            $this->jsonError('上传失败');
        }
        $this->jsonSuccess(['img_md5' => $md5]);
    }
    
    //根据文件内容获取文件的mimetype，内容格式为 'data:image/jpeg;base64'
    private function _getFileMimeType($img_content){
        $colon_pos = strpos($img_content, ':') === false ? 0 : strpos($img_content, ':') + 1;//冒号的位置
        $semicolon_pos = strpos($img_content, ';') === false ? strlen($img_content) : strpos($img_content, ';');//分号的位置
        return substr($img_content, $colon_pos, $semicolon_pos - $colon_pos);
    }
    
    //form上传图片
    public function postUploadimage(){
        if(!isset($_FILES['image'])) return;
        $md5=FileService::putImg($_FILES['image']);
        if($md5){
            $file=FileService::get($md5);
            $img=array(
                'image_id'=>$md5,
                'picUrl'=>$file,
            );
            $this->jsonSuccess($img);
        }
        $this->jsonError('上传失败');
    }
    
    //获取图片
    public function getPicurl(){
        $data=  \Input::all();
        $this->validator($data, [
            'image_ids' => 'required',
            'width'=>'sometimes|integer|min:1',
        ]);
        $img_ids=explode(',',$data['image_ids']);
        $img_ids=array_unique($img_ids);
        $images=array();
        foreach($img_ids as $image_id){
            if(isset($data['width'])){//width
                $file=FileService::getImg($image_id,$data['width']);
            }else{//原图
                $file=FileService::get($image_id);
            }
            if($file){
                $images[]=array(
                    'image_id'=>$image_id,
                    'picUrl'=>$file,
                );
            }
        }
        $this->jsonSuccess($images);
    }
    
}