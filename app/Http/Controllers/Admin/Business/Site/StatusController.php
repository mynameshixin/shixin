<?php

namespace App\Http\Controllers\Admin\Business\Site;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Store;
use App\Models\StoresTimeline;
use Illuminate\Http\Request;

class StatusController extends BaseController
{

    public function index(Request $request)
    {
        $store_id = (int)$request->get('store_id', 0);
        $stores = Store::whereIsuse(Store::ENABLE)->get();
        return view(
            'admin.business.site.status.index',
            ['store_id' => $store_id, 'stores' => $stores]
        );
    }

    public function calendarData(Request $request)
    {
        $start = $request->get('start', '');
        $end = $request->get('end', '');
        $store_id = (int)$request->get('store_id', 0);
        $timelines = StoresTimeline::whereStoreId($store_id)
            ->where('start_datetime', '>=', $start)
            ->where('end_datetime', '<=', $end)->get();
        $ret = [];
        foreach ($timelines as $timeline) {
            $color = StoresTimeline::statusColor($timeline->status);
            $ret[] = [
                'title'           => $timeline->purpose,
                'id'              => $timeline->id,
                'start'           => $timeline->start_datetime,
                'end'             => $timeline->end_datetime,
                'backgroundColor' => $color,
                'borderColor'     => $color,
            ];
        }
        return response()->json($ret);
    }

}
