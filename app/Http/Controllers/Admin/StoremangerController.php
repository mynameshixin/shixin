<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Store;
use App\Models\StoreManger;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Output\StreamOutput;
use Zofe\Rapyd\DataForm\DataForm;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;


use App\Services\Admin\ImageService;
use App\Services\Admin\RoleService;


class StoremangerController extends ApiController
{



    public function index(Request $request)
    {

        $filter = DataFilter::source(Store::with('manger'));
        $filter->add('name','门店名称', 'text');
        $filter->add('manger.name', '管理员名称', 'text');
        $filter->submit('检索');
        $filter->reset('reset');

        $grid = DataGrid::source($filter);  //same source types of DataSet

        $grid->add('id','Id', true);

        $grid->add('name','门店名称', true); //field name, label, sortable
        $grid->add('{{  implode(", ", $manger->lists("name")->toArray()) }}','门店管理员');


        $grid->orderBy('id','asc'); //default orderby
        $grid->add('{{$id}}','操作')->cell(function($val){
            return '<a class="" title="设置管理员" href="javascript:win_edit('.$val.')"><span class="glyphicon glyphicon-edit"> </span></a>';
        });
        $grid->paginate(20);

        $allMangers=RoleService::getInstance()->getUsersByRole();//获得运营或者超管

        return view('admin.stores.manger', compact('grid', 'filter','allMangers'));
    }




    public function anyEdit()
    {   $data=Input::all();
        $_token=csrf_token();
        $rules = array(
            "modify"=>'required|integer|min:1',
            "_token"=>'required|in:'.$_token,
        );
        //删除门店所有管理员
        StoreManger::where("store_id",$data['modify'])->delete();
        $userids=isset($data['mangers'])?$data['mangers']:"";
        if($userids!=""){
            $userId_arr=explode(",",$userids);
            $userId_arr=array_unique($userId_arr);
            $setData=array();
            foreach($userId_arr as $userId){
                if(is_numeric($userId)){
                    $setData[]=array(
                     'store_id'=>$data['modify'],
                     'user_id'=>$userId,
                    );
                }
            }
            if(!empty($setData)) StoreManger::insert($setData);
        }
        return response()->forApi(true);
    }
    /*
     * 获得门店管理员
     * */
    public function getStoremanger(){

        $data=Input::all();
        $_token=csrf_token();
        $rules = array(
            "store_id"=>'required|integer|min:1',
            "_token"=>'required|in:'.$_token,
        );
        parent::validator($data, $rules,[],1);
        $store_manger=Store::with('manger')->where('id',$data['store_id'])->get()->toArray();

        return response()->forApi($store_manger?$store_manger[0]:array());
    }
}
