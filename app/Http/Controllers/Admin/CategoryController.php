<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:52
 */
namespace App\Http\Controllers\Admin;

use App\Lib\LibUtil;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;

use App\Models\Category;

class CategoryController extends ApiController
{
    protected $kinds = [''=>'选择分类','1'=>'商品分类','2'=>'图片分类'];
    protected $levels = [''=>'选择级别','1'=>'一级分类','2'=>'二级分类','3'=>'三级分类','4'=>'四级分类'];
    protected $recommend =  [''=>'推荐否','1'=>'推荐','0'=>'不推荐'];
    private  static $recommends = [1=>'推荐',0=>'不推荐'];

    protected $categories= [''=>'选择分类'];

    public function index(Request $request)
    {

        $categories = Category::orderBy('level')->lists("name", "id")->toArray();
        $categories[0]= ['选择分类'];
        $this->categories  = $categories;
        $filter = DataFilter::source( new Category());
        $filter->add('parent_id','上级分类','select')->options( $this->categories);
        $filter->add('level','级别','select')->options($this->levels);
        $filter->add('kind','分类','select')->options($this->kinds);
        $filter->add('recommend','推荐','select')->options($this->recommend);
        $filter->add('name','名称', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->link("/admin/category/action/edit","创建分类");

        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->add('level','级别', true)->cell( function ($value) {
            $status = $this->levels;
            return $status[$value];
        });
        $grid->add('name','名称', true); //field name, label, sortable
        $grid->add('name_e','英文名'); //relation.fieldname
        $grid->add('parent_id','上级分类')->cell( function ($value) {
            $categories = $this->categories;
            return $value>0 && isset($categories[$value]) ? $categories[$value] : '';
        });
        $grid->add('kind','分类')->cell( function ($value) {
            $kinds = $this->kinds;
            return isset($kinds[$value]) ? $kinds[$value] : '';
        });
        $grid->add('image_id','照片', true)->cell( function ($value) {

            if($value)$img = LibUtil::getPicUrl($value,4);
            if (isset($img) && $img) {
                return "<img src='".$img."' style='width:210px;'>";
            }
            return '';
        });
        if (Auth::user()->hasRole(['super_administrator', 'admin'])) {
            $grid->edit('/admin/category/action/edit', 'Edit','modify|show'); //shortcut to link DataEdit
        }else{
            $grid->edit('/admin/category/action/edit', 'Edit','show'); //shortcut to link DataEdit
        }

        $grid->paginate(15); //pagination

        return view('admin.grid', compact('grid', 'filter'));
    }


    public function anyEdit()
    {

        $edit = DataEdit::source( new Category());
        $dataInfo = $edit->model->toArray();
        $edit->link("/admin/categories","分类列表", "TR")->back();
        $edit->add('kind','类别','select')->options($this->kinds);


        if (isset($dataInfo['level']) && $dataInfo['level']==1) {
            $edit->add('level','级别','select')->options($this->levels)->attributes(array("readonly" => "true"));
            $edit->add('parent_id','上级分类','hidden')->insertValue(0);
        }else{
            $edit->add('level','级别','select')->options($this->levels);
            $categories = Category::where('level','<',3)->orderBy('level')->lists("name", "id")->toArray();
            $categories[0] = '请选择';
            $edit->add('parent_id','上级分类','select')->options($categories);
        }

        $edit->add('name','名称', 'text')->rule('required');
        $edit->add('name_e','英文名称', 'text')->insertValue(' ');
        $edit->add('recommend','是否推荐', 'Radiogroup')->options(self::$recommends)->rule('required');
        if(isset($data['show'])){

            if(!empty($dataInfo) && $dataInfo['image_id']){
                $edit->add('image_id', "图片（建议248px*254px)", 'text')->attributes(array("style" => "display:none;"))->insertValue('');
            }
        }else{
            $edit->add('image_id', "图片 （建议248px*254px)", 'text')->attributes(array("style" => "display:none"))->insertValue('');
        }

        return $edit->view('admin.category.edit', compact('edit'));
    }






}