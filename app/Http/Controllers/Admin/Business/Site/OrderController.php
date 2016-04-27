<?php

namespace App\Http\Controllers\Admin\Business\Site;

use App\Http\Controllers\Admin\BaseController;
use App\Lib\Pagination;
use App\Lib\Requests;
use App\Models\BaseModel;
use App\Models\OdUsers;
use App\Models\Store;
use App\Models\StoresTimeline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{

    public function index(Request $request)
    {
        $page = intval(\Input::get('page', 1));
        $params = \Input::all();
        $query = new StoresTimeline;
        if (!empty($params['id'])) {
            $query = $query->where('id', '=', $params['id']);
        }
        if (isset($params['status']) && $params['status'] != -9) {
            $query = $query->where('status', '=', $params['status']);
        }
        if (!empty($params['store_id'])) {
            $query = $query->where('store_id', '=', $params['store_id']);
        }

        $count = $query->count();
        $lists = Requests::paging($query, $page, BaseModel::TAKE)
            ->orderBy('id','desc')->get();
        $page_size = Pagination::getPageSize($count);
        return view('admin.business.site.order.index', [
            'lists'         => $lists,
            'page'          => $page,
            'page_size'     => $page_size,
            'params'        => $params,
            'list_url'      => url('/admin/business/site/orders'),
            'edit_url'      => url('/admin/business/site/order/action/edit'),
            'show_url'      => url('/admin/business/site/order/action/show'),
            'status_search' => StoresTimeline::$statusSearch,
            'stores_list'   => Store::getListToArr(Store::getList(['id', 'name'], false, 'isuse')),
        ]);
    }

    public function getShow(Request $request)
    {
        $timeline_id = (int)$request->get('id', 0);
        $timeline = StoresTimeline::find($timeline_id);
        return view(
            'admin.business.site.order.show',
            [
                'timeline_id' => $timeline_id,
                'row'         => $timeline,
                'status_map'  => StoresTimeline::$statusMap,
                'stores'      => Store::whereIsuse(Store::ENABLE)->get(),
                'admin'       => User::find(@$timeline->admin_id),
                'user'        => OdUsers::find(@$timeline->user_id),
            ]
        );
    }

    public function getEdit(Request $request)
    {
        $id = (int)$request->get('id', 0);
        $purpose = $request->get('purpose', '');
        $store_id = (int)$request->get('store_id', 0);
        $start_datetime = $request->get('start_datetime', '');
        $end_datetime = $request->get('end_datetime', '');
        $reason = $request->get('reason', '');
        $status = (int)$request->get('status', 0);
        $timeline = StoresTimeline::find($id);
        if (!$timeline) {
            $timeline = new StoresTimeline;
        }
        $start_t = strtotime($start_datetime);
        $end_t = strtotime($end_datetime);
        if ($end_t <= $start_t) $this->jsonError('结束时间需大于开始时间');
        $store = Store::whereIsuse(Store::ENABLE)->whereId($store_id)->first();
        if (!$store) $this->jsonError('场地没找到');
        if (!isset(StoresTimeline::$statusMap[$status])) $this->jsonError('状态错误');
        $timeline->purpose = $purpose;
        $timeline->store_id = $store_id;
        $timeline->start_datetime = $start_datetime;
        $timeline->end_datetime = $end_datetime;
        $timeline->reason = $reason;
        $timeline->status = $status;
        $timeline->admin_id = Auth::user()->id;
        $timeline->save();
        $this->jsonSuccess([]);
    }

}
