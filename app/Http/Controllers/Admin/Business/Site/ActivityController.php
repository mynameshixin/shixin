<?php

namespace App\Http\Controllers\Admin\Business\Site;

use App\Http\Controllers\Admin\BaseController;
use App\Lib\Requests;
use App\Models\BaseModel;
use App\Lib\Pagination;
use App\Models\StoresActivity;
use Illuminate\Http\Request;

class ActivityController extends BaseController
{

    public function index()
    {
        $page = intval(\Input::get('page', 1));
        $params = \Input::all();
        $query = $this->_search($params);
        $count = $query->count();
        $lists = Requests::paging($query, $page, BaseModel::TAKE)->get();
        $page_size = Pagination::getPageSize($count);
        return view('admin.business.site.activity.index', [
            'lists' => $lists,
            'page' => $page, 
            'page_size' => $page_size,
            'params' => $params, 
            'list_url' => url('/admin/business/site/activities'),
            'edit_url' => url('/admin/business/site/activity/action/edit'),
            'offline_url' => url('/admin/business/site/activity/action/offline'),
        ]);
    }

    private function _search($params){
        $query = new StoresActivity;
        if(!empty($params['id'])){
            $query = $query->where('id', '=', $params['id']);
        }
        //报名状态 0、已结束 1、未结束
        if(isset($params['apply_status']) && $params['apply_status'] != -1){
            $today = date('Y-m-d');
            if($params['apply_status'] == 1){
                $query = $query->where('apply_end_time','>=',$today); 
            }else{
                $query = $query->where('apply_end_time','<',$today); 
            }
        }
        //活动状态 
        if(isset($params['status']) && $params['status'] != -1){
            $query = $query->where('status', '=', $params['status']);
        }
        //活动类型
        if(isset($params['is_online']) && $params['is_online'] != -1){
            $query = $query->where('is_online', '=', $params['is_online']);
        }
        return $query;
    }
    
    //编辑页
    public function getEdit(Request $request)
    {
        $id = (int)$request->get('id', 0);
        $data = StoresActivity::findById($id);
        if($id && empty($data)){
            return view('admin.error',['message'=>'数据有误']);
        }

        return view('admin.business.site.activity.edit',compact('data'));
    }

    public function postEdit(Request $request){
        $this->jsonSuccess($request->all());
    }

    //显示
    public function anyShow(){

    }
    
    //下线
    public function anyOffline(Request $request){
        $id = (int)$request->get('id', 0);
        $data = StoresActivity::findById($id);
        if(empty($data)){
            $this->jsonError('id有误，活动不存在');
        }
        $data->status = StoresActivity::STATUS_OFFLINE;
        $data->save();
        $this->jsonSuccess([]);
    }
    
}
