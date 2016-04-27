<?php
/**
 * Author:anneYan <ytt@yiban.cn>
 * Date: 15/9/22
 * Time: 下午12:58
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\ApiController;
use App\Lib\FileService;
use App\Lib\LibUtil;
use App\Models\Column;
use App\Services\Admin\AppService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;
use App\Models\Banner;


class ColumnController extends ApiController
{

    const LINK = '/admin/columns';
    const TMP_DIR = 'admin.banners.';

    // 状态 0 待审核  1已审核  2已拒绝
    private static $statusTpl = [
        0 => '<span class="badge bg-yellow">待审核</span>',
        1 => '<span class="badge bg-green">在线</span>',
        2 => '<span class="badge bg">下线</span>',
    ];

    //按钮
    private static $buttonTpl = [
        'offline' => '<button type="button" class="btn btn-success btn-xs">下线</button>',
        'top' => '<button type="button" class="btn btn-warning btn-xs">置顶</button>',
    ];
    private static $positions = [
        '0' => '首页',
        '1' => '首页',
        '2' => '分类页',
    ];

    public function index(Request $request)
    {
        $data = Input::all();
        $userId = Auth::user()->id;
        $query = [];
        //门店获取
        $position = $request->input('position');
        if ($position) $query['position'] = $position ? $position : '';

        $rows = Column::where($query);
        $filter = DataFilter::source($rows);
        //$filter->add('position', '位置', 'select')->options(self::$positions);
        $filter->add('status', '状态', 'select')->options(['' => '状态', 0 => '待审核', 1 => '在线', 2 => '下线']);
        $filter->add('title', '标题', 'text');
        $filter->submit('检索');
        $filter->reset('重置');
       // $filter->link("/admin/banner/action/edit", "发布新内容");


        $grid = DataGrid::source($filter);  //same source types of DataSet

        $grid->add('id', 'ID', true);


        $grid->add('title', '标题');
        $grid->add('key', '约定key')->attributes(array("readonly" => "true"));
        $grid->add('position', '位置')->cell(function ($val) {
         if (!array_key_exists($val, self::$positions)) $val = 0;
          return self::$positions[$val];
       });
        $grid->add('sort', '排序', true);
        $grid->add('img_b','照片', true)->cell( function ($value) {

            if($value)$img = LibUtil::getColumnPic($value);
            if (isset($img) && $img) {
                return "<img src='".$img."' style='height:180px;'>";
            }
            return '';
        });

        $grid->add('status', '状态')->cell(function ($val) {
            if (!array_key_exists($val, self::$statusTpl)) $val = 0;
            return self::$statusTpl[$val];
        });
        $grid->add('created_at', '发布时间');

        $actions = 'modify|delete|show';

        $grid->edit('/admin/column/action/edit', '操作', $actions);

        $grid->row(function ($row) {

            //$row->cell('status')->value .= ' ' . self::$isOfflineTpl[$row->data->status];


            switch ($row->data->status) {
                case 0:
                    $actions = ['show', 'modify'];
                    break;
                case 1:
                    $actions = ['show', 'modify'];
                    break;
                case 2:
                    $actions = ['show', 'modify'];
                    break;
                default:
                    $actions = ['show'];
                    break;
            }

            $view = \View::make('rapyd::datagrid.actions', [
                'uri' => '/admin/column/action/edit',
                'id' => $row->data->id,
                'actions' => $actions
            ]);
            $row->cell('_edit')->value($view);

        });

        //排序
        $grid->orderBy('id', 'desc');

        return view(self::TMP_DIR . 'grid', compact('grid', 'filter'));

    }

    public function anyEdit(Request $request)
    {
        $data = Input::all();
        $userId = Auth::user()->id;

        $edit = DataEdit::source(new Column());
        $edit->link("/admin/columns", "List", "TR")->back();
        $dataInfo = $edit->model->toArray();

        if (!isset($data['modify']) && !isset($data['delete'])) {
            $edit->add('key', '约定key', 'text')->rule('required')->attributes(array("readonly" => true));
            $edit->add('position', '位置', 'select')->options(self::$positions)->rule('required');
        } else {
            $edit->add('key', '约定key', 'text')->rule('required');
            $edit->add('position', '位置', 'select')->options(self::$positions)->rule('required')->attributes(array("readonly" => true));
        }
        $edit->add('title', '标题', 'text')->rule('required');
        //$edit->add('link', '链接', 'textarea')->rule('required');
        $edit->add('sort', '排序', 'text')->rule('required|integer');
        $edit->add('img_b','2倍图 （建议 276px*276px)', 'image')
            ->rule('mimes:jpeg,png')
            ->move('uploads/images/columns/')
            ->preview(240,240);
        $edit->add('img_o','3倍图 （建议 552px*552px)', 'image')
            ->rule('mimes:jpeg,png')
            ->move('uploads/images/columns/')
            ->preview(240,240);

//        if(isset($data['show'])){
//
//            if(!empty($dataInfo) && $dataInfo['image_id']){
//                $edit->add('image_id', "图片", 'text')->attributes(array("style" => "display:none;"))->insertValue('');
//            }
//        }else{
//            $edit->add('image_id', "图片", 'text')->attributes(array("style" => "display:none"))->insertValue('');
//        }

        $edit->add('status', '状态', 'Radiogroup')->rule('required')->options(['待审核', '在线', '下线']);

        $edit->add('user_id', '管理员id', 'hidden');



        return view(self::TMP_DIR . 'edit', compact('edit', 'userId'));
    }
}