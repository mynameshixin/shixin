<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:52
 */
namespace App\Http\Controllers\Admin;

use App\Lib\LibUtil;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;

use App\Models\Category;

class BannerController extends ApiController
{


    public function index(Request $request)
    {

        $filter = DataFilter::source( new Banner());
        $filter->add('title','标题', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->link("/admin/banner/action/edit","创建分类");

        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->add('id','ID', true);
        $grid->add('title','标题', true); //field name, label, sortable
        $grid->add('url','连接'); //relation.fieldname

        $grid->add('image_id','照片', true)->cell( function ($value) {

            if($value)$img = LibUtil::getPicUrl($value,4);
            if (isset($img) && $img) {
                return "<img src='".$img."' style='width:420px;height:180px;'>";
            }
            return '';
        });
        if (Auth::user()->hasRole(['super_administrator', 'admin'])) {
            $grid->edit('/admin/banner/action/edit', 'Edit','modify|show|delete'); //shortcut to link DataEdit
        }else{
            $grid->edit('/admin/banner/action/edit', 'Edit','show'); //shortcut to link DataEdit
        }

        $grid->paginate(15); //pagination

        return view('admin.grid', compact('grid', 'filter'));
    }


    public function anyEdit()
    {
        $edit = DataEdit::source( new Banner());
        $edit->add('title','标题', 'text')->rule('required');
        $edit->add('folder_id','关联文件夹', 'text')->rule('required');
        if(isset($data['show'])){
            if(!empty($dataInfo) && $dataInfo['image_id']){
                $edit->add('image_id', "图片（建议 1242px*620px)", 'text')->attributes(array("style" => "display:none;"))->insertValue('');
            }
        }else{
            $edit->add('image_id', "图片 （建议 1242px*620px)", 'text')->attributes(array("style" => "display:none"))->insertValue('');
        }

        return $edit->view('admin.site.edit', compact('edit'));
    }



}