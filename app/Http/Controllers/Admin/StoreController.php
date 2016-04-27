<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Store;
use App\Models\StoreManger;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use App\Lib\Transformer\UserTransformer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;


#use App\Services\Admin\ImageService;
use App\Lib\FileService;//oudong上传


class StoreController extends ApiController
{

    public $isuse=array("1"=>"使用中","0"=>"已停用");

    public function index(Request $request)
    {
        //dd(User::with('manger_stores')->get()->toArray());
        //dd(Store::with('manger')->get()->toArray());
        $filter = DataFilter::source(new Store());
        //$filter = DataFilter::source(Store::with('manger'));
        $filter->add('name','名称', 'text');
        $filter->submit('检索');
        $filter->link("/admin/store/action/edit","新增门店", "TR");

        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->add('{{$id}}','Id', true);

        //$grid->add('{{  implode(", ", $roles->lists("name")->toArray()) }}','角色');
        $grid->add('name','门店名称', true); //field name, label, sortable
        //$grid->add('{{  implode(", ", $manger->lists("name")->toArray()) }}','门店管理员');
        $grid->add('tel','预约电话');
        $grid->add('created_at','创建日期');

        //$grid->
        $grid->orderBy('id','asc'); //default orderby
        $grid->edit('/admin/store/action/edit', '操作','show|modify|delete');
        $grid->paginate(20);

        return view('admin.stores.index', compact('grid', 'filter'));
    }




    public function anyEdit()
    {
        $data=Input::all();
        $edit = DataEdit::source(new Store());
        $edit->link("/admin/stores","List", "TR");

        $edit->add('name','门店名称', 'text')->rule('required')->attributes(array("style"=>"width:620px;"));
        $edit->add('desc','简介', 'textarea')->rule('required')->attributes(array("style"=>"width:620px;"));
        $edit->add('tel','门店电话','text')->rule('required')->attributes(array("style"=>"width:620px;"));

        $edit->add('business_hours','营业时间','text')->rule('required')->attributes(array("style"=>"width:620px;"));
        $edit->add('isuse','是否使用','radiogroup')->options($this->isuse)->rule('required|integer|in:1,2');

        if(isset($data['update'])){
            $storeInfo=$edit->model->toArray();
            if($storeInfo['school_id']!=$data['school_id']){
                $edit->add('school_id','学校','select')->options(School::lists("stores.name","stores.id")->toArray())->rule('required|integer|min:1|unique:stores')->attributes(array("style"=>"width:620px;height:34px;","class"=>"easyui-combobox"));
            }
        }else{
            $edit->add('school_id','学校','select')->options(School::lists("stores.name","stores.id")->toArray())->rule('required|integer|min:1|unique:stores')->attributes(array("style"=>"width:620px;height:34px;","class"=>"easyui-combobox"));
        }
        $edit->add('address','门店地址','text')->rule('required')->attributes(array("style"=>"width:484px;float:left"));
        $edit->add('map_lng','地图','text')->attributes(array("readonly"=>"true","style"=>"display:none"));
        $edit->add('map_lat','','text')->attributes(array("readonly"=>"true","style"=>"display:none"));
        $edit->add('map_md5','地图截图','text')->attributes(array("style"=>"display:none;"));
        $edit->add('pics',"图片",'text')->attributes(array("style"=>"display:none;"));

        if(isset($data['do_delete'])){
            if(is_numeric($data['do_delete'])){
                StoreManger::where('store_id',$data['do_delete'])->delete();
            }
        }
        return $edit->view('admin.stores.edit', compact('edit'));
    }
    //上传图片到od
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
    //del
    public function un_postUploadimage(){
        return;
        $userid=Auth::user()->id;
        $rs = ImageService::getInstance()->uploadImage($userid,$_FILES['image']);

        $return = array(
            'response' 	=> '101',
            'message' 	=> '请求失败',
            'data' 		=>array()
        );
        if($rs){
            if(!empty($rs)){
                $return['response']='100';
                $return['message']="请求成功";
                $return['data']=$rs;
            }
        }
        header('Content-type: application/json');
        echo json_encode($return);
        exit;
    }
    //获取od图片
    public function getPicurl(){
        $data=Input::all();
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
    public function un_getPicurl(){
        $data=Input::all();
        $this->validator($data, [
            'image_ids' => 'required',
        ]);
        $img_ids=explode(',',$data['image_ids']);
        $imageService=new ImageService();
        $images=array();
        foreach($img_ids as $image_id){
            $image_id=intval($image_id);
            $images[]=array(
                'image_id'=>$image_id,
                'pic_o'=>$imageService->getPicUrl($image_id,4),
                'pic_b'=>$imageService->getPicUrl($image_id,2),
                'pic_m'=>$imageService->getPicUrl($image_id,1),
            );
        }
        $return['response']='100';
        $return['message']="请求成功";
        $return['data']=$images;
        header('Content-type: application/json');
        exit(json_encode($return));
    }
}
