<?php
/**
 * @author zhangxu@yiban.cn
 */


namespace App\Http\Controllers\Admin\Business\Secondhand;

use App\Http\Controllers\Admin\BaseController;
use App\Models\SecondhandOrders;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use App\Services\Admin\AppService;
use Zofe\Rapyd\DataForm\DataForm;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;


class ManageController extends BaseController
{

    const LINK = '/admin/business/secondhand';
    const TMP_DIR = 'admin.business.secondhand.';

    // 状态 0 待审核  1已审核  2已拒绝
    private static $statusTpl = [
        0 => '<span class="badge bg-yellow">待审核</span>',
        1 => '<span class="badge bg-green">已审核</span>',
        2 => '<span class="badge bg">已拒绝</span>',
    ];

    //下线状态：  0 在线  1 下线
    private static $isOfflineTpl = [
        0 => '<span class="badge bg-green">在线</span>',
        1 => '<span class="badge bg">下线</span>',
    ];

    //按钮
    private static $buttonTpl = [
        'public' => '<button type="button" class="btn btn-info btn-xs">体验中心发布</button>',
        'pass' => '<button type="button" class="btn btn-success btn-xs">通过</button>',
        'refuse' => '<button type="button" class="btn btn-warning btn-xs">拒绝</button>',
        'offline' => '<button type="button" class="btn btn-success btn-xs">下线</button>',
        'top' => '<button type="button" class="btn btn-warning btn-xs">置顶</button>',
    ];


    public function index(Request $request)
    {
        $data = Input::all();
        $userId = Auth::user()->id;

        //门店获取
        $appService = AppService::getInstance();
        $allStore = $appService->getAllowStore($userId);

        $filter = DataFilter::source(SecondhandOrders::with('store')->whereIn('store_id', array_keys($allStore)));


        $filter->add('status', '状态', 'select')->options(['' => '状态',0 => '待审核', 1 => '已审核', 2 => '已拒绝']);
        $filter->add('store_id', '门店', 'select')->options($allStore);
        $filter->add('title', '物品名称', 'text');
        $filter->submit('检索');
        $filter->reset('重置');
        $filter->link("/admin/business/secondhand/manage/action/edit", "发布新内容");

        $grid = DataGrid::source($filter);  //same source types of DataSet

        $grid->add('id', 'ID', true);

        $grid->add('created_at', '发布时间');

        $grid->add('title', '标题');
//        $grid->add('{{ substr($content,0,20) }}...', '描述');
        $grid->add('price', '价格');
        $grid->add('yb_nick', '发布人');
        $grid->add('mobile', '手机号');
        $grid->add('contact', '其他联系方式');

        $grid->add('store.name', '来源')->cell(function ($val) {

            return '<span class="badge bg-blue">' . $val . '</span>';

        });

        $grid->add('status', '状态')->cell(function ($val) {
            return self::$statusTpl[$val];
        });

        $actions = 'modify|delete|show';

        $grid->edit('/admin/business/secondhand/manage/action/edit', 'Edit', $actions);

        $grid->row(function ($row) {

            if ($row->data->ispublic == 1) {
                $row->cell('store.name')->value = '<span class="badge bg-yellow">体验中心发布</span>';
            }

            $row->cell('status')->value .= ' ' . self::$isOfflineTpl[$row->data->offline];


            switch ($row->data->status) {
                case 0:
                    $actions = ['show', 'modify'];
                    break;
                case 1:
                    $actions = ['show', 'modify'];
                    break;
                case 2:
                    $actions = ['show', 'modify', 'delete'];
                    break;
            }

            $view = \View::make('rapyd::datagrid.actions', [
                'uri' => '/admin/business/secondhand/manage/action/edit',
                'id' => $row->data->id,
                'actions' => $actions
            ]);

            $row->cell('_edit')->value($view);

        });

        //排序
        $grid->orderBy('id', 'desc');

        return view(self::TMP_DIR . 'grid', compact('grid', 'filter'));

    }

    public function anyEdit()
    {
        $data = Input::all();
        $userId = Auth::user()->id;

        //门店获取
        $appService = AppService::getInstance();
        $allStore = $appService->getAllowStore($userId);

        $edit = DataEdit::source(new SecondhandOrders);

        $dataInfo = $edit->model->toArray();
        $readOnly = false;
        if (!empty($dataInfo)) {
            if ($dataInfo['ispublic'] != 1) {
                $readOnly = true;
            }
        }

        if (!$readOnly) {
            $edit->add('title', '商品标题', 'text')->rule('required');
            $edit->add('content', '商品描述', 'textarea')->rule('required');
            $edit->add('store_id', '发布到', 'select')->options($allStore);
            $edit->add('yb_nick', '发布人', 'text');
            $edit->add('price', '价格', 'text')->rule('required');
            $edit->add('mobile', '手机号', 'text');
            $edit->add('contact', '其他联系方式', 'text');
        } else {
            $edit->add('title', '商品标题', 'text')->attributes(array("readonly" => true));
            $edit->add('content', '商品描述', 'textarea')->attributes(array("readonly" => true));
            $edit->add('store_id', '发布到', 'select')->options($allStore)->attributes(array("readonly" => true));
            $edit->add('yb_nick', '发布人', 'text')->attributes(array("readonly" => true));
            $edit->add('price', '价格', 'text')->attributes(array("readonly" => true));
            $edit->add('mobile', '手机号', 'text')->attributes(array("readonly" => true));
            $edit->add('contact', '其他联系方式', 'text')->attributes(array("readonly" => true));
        }

//        $edit->add('yb_user_id', '易班用户id', 'text')->attributes(array("readonly" => true));

        if (isset($data['show'])) {
            if (!empty($dataInfo) && $dataInfo['image_keys']) {
                $edit->add('image_keys', "图片", 'text')->attributes(array("style" => "display:none;"));
            }
        } else {
            $edit->add('image_keys', "图片", 'text')->attributes(array("style" => "display:none;"));
        }

        $edit->add('offline', '上下架状态', 'Radiogroup')->rule('required')->options(['上架', '下架']);
        $edit->add('status', '审核状态', 'Radiogroup')->rule('required')->options(['待审核', '已审核', '已拒绝']);
        $edit->add('ispublic', '是否体验中心发布', 'Radiogroup')->rule('required')->options([0 => '否', 1 => '是']);

        if (isset($data['modify']) || isset($data['show'])) {
            $edit->add('remark', '拒绝理由', 'text');
        }

        $edit->add('user_id', '管理员id', 'hidden');



        $edit->link("/admin/business/secondhand/manage", "List", "TR");

        return view(self::TMP_DIR . 'edit', compact('edit', 'userId'));
    }

    public function store()
    {

    }


    public function delete()
    {

    }


    /**
     * 现在物品审核操作
     * @param id
     * @param staus 状态 0 待审核  1已审核  2已拒绝
     * @return mixed
     */
    public function anyPass()
    {
        $params = Input::all();
        $rules = array(
            'id' => 'required|exists:secondhand_orders,id',
            'status' => 'required|in:1,2',
        );
        parent::validator($params, $rules, [], 1);
        $order = SecondhandOrders::findOrFail($params['id']);
        if ($order['status'] >= 1) {
            return response()->forApi([], 105, '该条记录已审核');
        }
        $user_id = Auth::user()->id;
        $entry = [
            'status' => $params['status'],
            'user_id' => $user_id,
            'reason' => isset($params['reason']) ? $params['reason'] : ''
        ];
        $rs = SecondhandOrders::where('id', $params['id'])->update($entry);

        return response()->forApi(['status' => $rs ? 1 : 0]);
    }

    /**
     * 闲置物品下架操作
     * @param id
     * @param action 0 上架 1 下架
     * @return mixed
     */
    public function anyShelves()
    {
        $params = Input::all();
        $rules = array(
            'id' => 'required|exists:secondhand_orders,id',
            'action' => 'required|in:0,1',
        );
        parent::validator($params, $rules, [], 1);
        $order = SecondhandOrders::findOrFail($params['id']);
        if ($params['action'] != $order['action']) {
            $rs = SecondhandOrders::where('id', $params['id'])->update(['offline' => $params['action']]);
        }
        return response()->forApi(['status' => 1]);

    }

}
