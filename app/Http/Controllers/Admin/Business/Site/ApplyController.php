<?php

namespace App\Http\Controllers\Admin\Business\Site;

use App\Models\OdUsers;
use App\Models\RecruitCompany;
use App\Models\RecruitPosition;
use App\Http\Controllers\Admin\BaseController;
use App\Models\School;
use App\Models\StoresActivity;
use App\Models\StoresActivityApply;
use App\Models\User;
use Illuminate\Http\Request;
use Zofe\Rapyd\Facades\DataEdit;
use App\Lib\Requests;
use App\Models\BaseModel;
use App\Lib\Pagination;
use App\Models\Region;

class ApplyController extends BaseController
{

    public function index(Request $request)
    {
        $page = intval($request->get('page', 1));
        $params = $request->all();
        $query = new StoresActivityApply();
        if(!empty($params['id'])){
            $query = $query->where('id', '=', $params['id']);
        }
        if(isset($params['status']) && $params['status'] != -2){
            $query = $query->where('status', '=', $params['status']);
        }
        if(!empty($params['name'])){
            $activities = StoresActivity::where('is_apply', '=', BaseModel::ENABLE)->where('content', 'like', '%'.$params['name'].'%')->get(['id']);
            $query = $query->whereIn('stores_activity_id', Requests::getIds($activities));
        }
        //活动状态
        if(isset($params['activity_status']) && $params['activity_status'] != -1){
            $status_arr = $params['activity_status'] == 1 ? [1] : [0,3];
            $activities = StoresActivity::where('is_apply', '=', BaseModel::ENABLE)->whereIn('status', $status_arr)->get(['id']);
            $query = $query->whereIn('stores_activity_id', Requests::getIds($activities));
        }
        //活动类型
        if(isset($params['activity_is_online']) && $params['activity_is_online'] != -1){
            $activities = StoresActivity::where('is_apply', '=', BaseModel::ENABLE)->where('is_online', '=', $params['activity_is_online'])->get(['id']);
            $query = $query->whereIn('stores_activity_id', Requests::getIds($activities));
        }

        $count = $query->count();
        $lists = Requests::paging($query, $page, BaseModel::TAKE)->get();
        $page_size = Pagination::getPageSize($count);
        //用户信息数组
        $od_user_ids = Requests::getIds($lists,'user_id');//用户ids
        $od_users = OdUsers::whereIn('id',$od_user_ids)->get();
        $od_user_list_arr = BaseModel::getListToIdValue($od_users);
        $school = School::whereIn('id',Requests::getIds($od_users,'school_id'))->get();
        $school_arr = BaseModel::getListToArr($school, 'name');
        $school_arr[0] = '-';
        //活动信息数组
        $activity_ids = Requests::getIds($lists,'stores_activity_id');//活动ids
        $activities = StoresActivity::whereIn('id',$activity_ids)->get();
        //添加活动的剩余名额属性
        foreach($activities as &$act){
            $act->had_apply_num = StoresActivity::getApplyNum($act);
        }
        //审核人员数组
        $auditors = User::whereIn('id', Requests::getIds($lists,'auditor'))->get();
        $auditors_arr = BaseModel::getListToArr($auditors);
        $auditors_arr[0] = '-';
        return view('admin.business.site.apply.index', [
            'lists' => $lists,
            'od_user_list_arr' => $od_user_list_arr,
            'activity_list_arr' => BaseModel::getListToIdValue($activities),
            'school_arr' => $school_arr,
            'auditors_arr' => $auditors_arr,
            'page' => $page,
            'page_size' => $page_size,
            'params' => $params,
            'list_url' => url('/admin/business/site/applies'),
            'edit_url' => url('/admin/business/site/apply/action/edit'),
        ]);
    }

    public function anyEdit(Request $request)
    {
        $id = (int)$request->get('id', 0);
        $data = StoresActivityApply::findById($id);
        if(empty($data)){
            return view('admin.error');
        }
        $operate = $request->get('operate','');
        //通过
        if($operate == 'pass'){
            $activity = StoresActivity::findById($data->stores_activity_id);
            if(StoresActivity::getApplyNum($activity) >= $activity->people_num){
                $this->jsonError('报名人数已满');
            }
            $data->status = StoresActivityApply::STATUS_AUDIT_OK;
            $data->auditor = \Auth::user()->id;
            $data->save();
            $this->jsonSuccess([]);
        }
        //拒绝
        if($request->ajax()){
            if(empty($data)){
                $this->jsonError('id有误');
            }
            $reason = $request->get('reason', '');
            if(empty($reason)){
                $this->jsonError('请输入原因');
            }
            $data->status = StoresActivityApply::STATUS_AUDIT_REJECT;
            $data->reason = $reason;
            $data->auditor = \Auth::user()->id;
            $data->save();
            $this->jsonSuccess([]);
        }
        return view('admin.business.site.apply.edit', ['id'=>$id]);
    }


}
