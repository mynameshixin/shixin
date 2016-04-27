<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Store;
use App\Models\App;
use App\Models\StoreApp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Lib\Transformer\UserTransformer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use PhpSpec\Exception\Exception;
use Symfony\Component\Console\Output\StreamOutput;
use Zofe\Rapyd\DataForm\DataForm;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;

use App\Services\Admin\AppService;


#use App\Services\Admin\ImageService;
use App\Lib\FileService;//oudong上传


class AppController extends ApiController
{

    public $isuse=array("1"=>"在线","0"=>"下线");
    public $isuseTpl = [
        1 => '<span class="badge bg-green">在线</span>',
        0 => '<span class="badge bg-red">下线</span>',
    ];
    public function index(Request $request)
    {
        //var_dump(Auth::user());
        $userId=Auth::user()->id;
        $appService=AppService::getInstance();
        $allStore=$appService->getAllowStore($userId);
        if(empty($allStore)) $this->error('无门店管理员权限');//die("无门店管理员权限");

        if(!isset($_GET['store_id'])){
            return redirect()->guest('/admin/apps?store_id='.key($allStore).'&search=1');
        }else{
            if(!isset($allStore[intval($_GET['store_id'])])) $this->error('无该门店管理员权限');//die("无该门店管理员权限");
        }

        $filter = DataFilter::source(StoreApp::with('app'));
        $filter->add('store_id','门店', 'select')->options($allStore);
        $filter->submit('检索');

        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->add('app_id',"选择")->cell(function($val){
            return "<input type='checkbox' name='appIds' value='".$val."'>";
        });
        $grid->add('app.id','ID', true);
        $grid->add('app.name','功能名称');
        $grid->add('sort','位置', true);
        $grid->add('app.link','链接');
        $grid->add('app.img','图片')->cell(function($val){
            if($val=="") return "";
            $file=FileService::get($val);
            if($file!=""){
                return "<a href='".$file."' target='_blank' text='点击打开原图' style='display:block;'><img src='".$file."' style='width:20px;height:20px;'></a>";
            }
            return "";

        });
        $grid->add('app.status','状态')->cell(function($val){
            return isset($this->isuseTpl[$val])?$this->isuseTpl[$val]:'<span class="badge bg">未知</span>';
        });

        $grid->add('{{$app_id}}','操作')->cell(function($val){
            return '<a class="" title="Show" href="javascript:win_edit('.$val.',0)"><span class="glyphicon glyphicon-eye-open"> </span></a> <a class="" title="Modify" href="javascript:win_edit('.$val.',1)"><span class="glyphicon glyphicon-edit"> </span></a>';
        });

        $grid->orderBy('sort','desc'); //default orderby
        $isuse=$this->isuse;
        return view('admin.apps.index', compact('grid', 'filter','allStore','isuse'));
    }

    //获得应用的详细信息
    public function getIndex(){
       $data=Input::all();
       $_token=csrf_token();
       $rules = array(
            "id"=>'required|integer',
            "_token"=>'required|in:'.$_token,
       );
       parent::validator($data, $rules,[],1);
       $id=$data['id'];
       $appInfo=App::where('id',$id)->get()->toArray();
       $data=[];
       if(!empty($appInfo)){
            $data=$appInfo[0];
            if($data['img']!=""){
                $data['img']=FileService::get($data['img']);
            }
            $data['stores']=[];
            $stores_apps=StoreApp::where('app_id',$appInfo[0]['id'])->select('store_id','sort')->get()->toArray();
            if(!empty($stores_apps)){
                $store_ids=array();$sort_store_ids=array();
                foreach($stores_apps as $store_id){
                    $store_ids[]=$store_id['store_id'];
                    $sort_store_ids[$store_id['store_id']]=$store_id['sort'];
                }
                if(!empty($store_ids)){
                    $data['stores']=Store::whereIn('id',$store_ids)->get()->toArray();
                    foreach($data['stores'] as $key=>$storeInfo){
                        $data['stores'][$key]['sort']=$sort_store_ids[$storeInfo['id']];
                    }
                }
            }
       }
        return response()->forApi($data);
    }




    public function anyEdit()
    {
        $data=Input::all();

        if(isset($data['insert'])){//4
            return $this->insert_app($data);
        }

        if(isset($data['modify'])){//3
            return $this->modify_app($data);
        }

        if(isset($data['delete'])){//2
            return $this->delete_app($data);
        }

        if(isset($data['show'])){//1
            return $this->show_app($data);
        }

    }

    //添加应用
    private function insert_app($data){
        $_token=csrf_token();
        $rules = array(
            "name"=>'required',
            "link"=>'required',
            "stores"=>'required',
            "image[]"=>'sometimes|required|image',
            "sort"=>'sometimes|array',
            "status"=>'sometimes|required|integer|in:0,1',
            "style"=>'required',
            "_token"=>'required|in:'.$_token,
        );
        //请求参数验证
        parent::validator($data, $rules,[],1);
        $app['name']=$data['name'];$app['link']=$data['link'];
        $app['status']=isset($data['status'])?$data['status']:0; $app['user_id']=Auth::user()->id;
        $app['created_at']=$app['updated_at']=date('Y-m-d H:i:s');$app['style']=$data['style'];
        if(isset($data['image'])){
            /*
            $rs = ImageService::getInstance()->uploadImage($app['user_id'],$_FILES['image']);
            if($rs){
                $app['img']=$rs[0]['pic_o'];
                $app['image_id']=$rs[0]['image_id'];
            }
            */
            $md5=FileService::putImg($_FILES['image']);
            if($md5){
                $app['img']=$md5;
            }
        }

        $appid=App::insertGetId($app);
        $retrun=false;
        if($appid){
            $stores=explode(",",$data['stores']);
            $sort=isset($data['sort'])?$data['sort']:array();
            //$store_app['sort']=$sort;
            //$store_app['appid']=$appid;
            $store_apps=[];

            foreach($stores as $store_id){
                $store_apps[]=array(
                    'store_id'=>intval($store_id),
                    'app_id'=>$appid,
                    'sort'=>$sort[intval($store_id)]?intval($sort[intval($store_id)]):100,
                );
            }
            if(!empty($store_apps)){
               StoreApp::insert($store_apps);
            }
            $retrun=true;
        }
        return response()->forApi($retrun);

    }

    //设置上线下线
    public function postSetstatus(){
        $data=Input::all();
        $_token=csrf_token();
        $rules = array(
            "status"=>'required|in:0,1',
            "_token"=>'required|in:'.$_token,
            "appIds"=>'required|array',
        );
        parent::validator($data, $rules,[],1);
        $setIds=array();
        foreach($data['appIds'] as $id){
            if(!in_array($id,$setIds)) $setIds[]=$id;
        }
        if(empty($setIds)) return;
        $rs=App::whereIn('id', $setIds)->update(['status' => $data['status']]);
        return response()->forApi($rs);
    }

    //修改应用
    private function modify_app($data){
        $_token=csrf_token();
        $rules = array(
            'modify'=>'required|integer|min:1',
            "name"=>'required',
            "link"=>'required',
            "stores"=>'required',
            "image[]"=>'sometimes|required|image',
            "sort"=>'sometimes|array',
            "status"=>'sometimes|required|integer|in:0,1',
            "style"=>'required',
            "_token"=>'required|in:'.$_token,
        );
        $userId=Auth::user()->id;
        $appService=AppService::getInstance();
        $allStore=$appService->getAllowStore($userId);
        if(empty($allStore)) return;

        parent::validator($data, $rules,[],1);
        $id=$data['modify'];
        $app['name']=$data['name'];$app['link']=$data['link'];
        $app['status']=isset($data['status'])?$data['status']:0; $app['user_id']=$userId;
        $app['created_at']=$app['updated_at']=date('Y-m-d H:i:s');$app['style']=$data['style'];
        if(isset($data['image'])){
            /*
            $rs = ImageService::getInstance()->uploadImage($app['user_id'],$_FILES['image']);
            if($rs){
                $app['img']=$rs[0]['pic_o'];
                $app['image_id']=$rs[0]['image_id'];
            }
            */
            $md5=FileService::putImg($_FILES['image']);
            if($md5){
                $app['img']=$md5;
            }
        }

        //修改app信息
        App::where('id', $id)->update($app);



        $stores=explode(",",$data['stores']);
        $sort=isset($data['sort'])?$data['sort']:array();
        $store_apps=[];
        foreach($stores as $store_id){
            if(isset($allStore[$store_id])){
                $store_apps[]=array(
                    'store_id'=>intval($store_id),
                    'app_id'=>$id,
                    'sort'=>$sort[intval($store_id)]?intval($sort[intval($store_id)]):100,
                );
            }
        }
        if(!empty($store_apps)){
            foreach($store_apps as $store_app){
                try{
                    StoreApp::insert($store_app);
                }catch (\Exception $e){
                    StoreApp::where('store_id',$store_app['store_id'])->where('app_id',$store_app['app_id'])->update(array('sort'=>$store_app['sort']));
                }
            }
        }
        return response()->forApi(true);
    }

    //删除应用
    private function delete_app($data){
        $_token=csrf_token();
        $rules = array(
            "appIds"=>'required',
            "_token"=>'required|in:'.$_token,
        );
        //请求参数验证
        parent::validator($data, $rules,[],1);
        $delIds=array();
        foreach($data['appIds'] as $id){
            if(!in_array($id,$delIds)) $delIds[]=$id;
        }
        if(empty($delIds)) return;
        StoreApp::whereIn('app_id',$delIds)->delete();
        App::whereIn('id', $delIds)->delete();
        return response()->forApi(true);


    }

    //展示应用
    private function show_app($data){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * @param Request $request
     * @return static
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }


}
