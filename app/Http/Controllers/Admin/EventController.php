<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:52
 */
namespace App\Http\Controllers\Admin;

use App\Lib\LibUtil;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;


class EventController extends ApiController
{

    private static $kinds ;

    private static $status = [0=>'待审核',1=>'审核通过',2=>'审核失败'];
    private static $types = [1=>'免费门票',2=>'免费索票',3=>'微信推荐'];

    private static $free = [0=>'否',1=>'是'];

    public function index(Request $request)
    {

        $kinds =  EventType::lists('name','id')->toArray();
        self::$kinds = $kinds;
        $status = self::$status;
        $filter = DataFilter::source( new Event());
        //$filter->add('kind', '类型', 'select')->options($kinds);
        //$filter->add('status', '状态', 'select')->options($status);
       // $filter->submit('查询');
        //$filter->reset('重置');
        $filter->link("/admin/event/action/edit","新增活动");

        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->add('id','ID', true);
        $grid->add('title','标题', true); //field name, label, sortable

        $grid->add('type','类型')->cell( function ($value) {
            return isset(self::$types[$value]) ? self::$types[$value] : '';
        });
        $grid->add('kind','详细分类')->cell( function ($value) {
            return isset(self::$kinds[$value]) ? self::$kinds[$value] : '';
        });
        $grid->add('price','价格', true);
        $grid->add('address','地址');
        $grid->add('is_free','免费索票')->cell( function ($value) {
            $free = self::$free;

            return isset($free[$value]) ? $free[$value] : $free[0];
        });
        $grid->add('status','状态')->cell( function ($value) {
            $status = self::$status;

            return isset($status[$value]) ? $status[$value] : $status[1];
        });
        $grid->add('sort','排序', true);
        $grid->add('image_ids','图片')->cell(function($val){
            if($val=="") return "";
            $str = '';
            $image_ids = explode(',',$val);
            if(!empty($image_ids)){
                    $image_id = $image_ids[0];
                    $file = LibUtil::getPicUrl($image_id,3);
                    //if(empty($file))$file = LibUtil::getPicUrl($image_id,3);
                    if($file) $str .= "<a href='".$file."' target='_blank' text='点击打开原图' style='display:block;'><img src='".$file."' style='width:80px;'></a>";
            }
            return $str;

        });
        $grid->edit('/admin/event/action/edit', 'Edit','modify|show'); //shortcut to link DataEdit
        $grid->paginate(15); //pagination

        return view('admin.grid', compact('grid', 'filter'));
    }


    public function anyEdit()
    {
        $data = Input::all();
        $kinds =  EventType::lists('name','id')->toArray();
        $status = self::$status;
        $user = Auth::user();
        $edit = DataEdit::source(new Event);
        $dataInfo = $edit->model->toArray();
        $edit->link("/admin/events","活动列表", "TR")->back();
        $edit->add('id','Id', 'hidden');
        $readOnly = false;
        if (!empty($dataInfo) && (isset($dataInfo['type']) && $dataInfo['type'] != 3)) {
            $readOnly = true;
            //$edit->add('user_id', '关联用户id', 'hidden')->insertValue($user->id);
        }
        $edit->add('user_id', '关联用户id', 'hidden')->insertValue($user->id);

        $edit->add('type','分类','select')->options(self::$types)->rule('required');
        $edit->add('kind','详细类型','select')->options($kinds)->rule('required');
        $edit->add('title','标题', 'text')->rule('required');
        $edit->add('contact','联系方式', 'text')->insertValue(' ');
        $edit->add('wechat','微信号', 'text')->insertValue(' ');
        $edit->add('wechat_nick','微信昵称', 'text')->insertValue(' ');
        $edit->add('wechat_img','微信头像', 'image')->rule('mimes:jpeg')->move('uploads/images/')->preview(320,240);
        $edit->add('explain','详情', 'text')->rule('required');
        $edit->add('address','地址', 'text')->insertValue(' ');
        $edit->add('price','价格', 'text')->insertValue(0);
        $edit->add('limitCount','报名人数限制', 'text')->rule('required');
        $edit->add('deadline','报名截至:','text')->attributes(array("class" => "form-control form-control datetimepicker"))->insertValue(' ');
        $edit->add('sTime','开始时间:','text')->attributes(array("class" => "form-control form-control datetimepicker"))->insertValue(' ');
        $edit->add('eTime','结束时间:','text')->attributes(array("class" => "form-control form-control datetimepicker"))->insertValue(' ');
        $edit->add('status','状态', 'Radiogroup')->options($status)->rule('required')->insertValue(1);
        $edit->add('is_free','免费索票', 'Radiogroup')->options(self::$free)->rule('required')->insertValue(0);
        $edit->add('sort','排序', 'text')->rule('required')->insertValue(999);
        if(isset($data['show'])){
            if(!empty($dataInfo) && $dataInfo['image_ids']){
                $edit->add('image_ids', "图片 （建议1194px*796px)", 'text')->attributes(array("style" => "display:none;"))->insertValue(' ');
            }
        }else{
            $edit->add('image_ids', "图片（建议1194px*796px)", 'text')->attributes(array("style" => "display:none"))->insertValue(' ');
        }
        return $edit->view('admin.events.edit', compact('edit'));
    }






}