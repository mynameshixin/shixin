<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:52
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;

use App\Models\Role;
use App\Models\Permission;
use App\Models\Category;

class PermissionController extends ApiController
{

    public function index(Request $request)
    {
        $categories= [''=>'选择分类'];
        $rows = Category::lists("name", "id")->toArray();
        $categories = array_merge($categories,$rows);
        $filter = DataFilter::source( Permission::with('category'));
        $filter->add('name','名称', 'text');
        $filter->add('category_id','权限类型','select')->options($categories);
        $filter->submit('查询');
        $filter->reset('重置');
        $filter->link("/admin/permission/action/edit","新增权限");

        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->add('name','名称', true); //field name, label, sortable
        $grid->add('{{ @$category->name }}','权限类型'); //relation.fieldname
        $grid->add('display_name','权限名称'); //relation.fieldname
        $grid->add('description','描述'); //relation.fieldname
        $user = Auth::user();
        if ($user->hasRole(['super_administrator', 'admin'])) {
            $grid->edit('/admin/permission/action/edit', 'Edit', 'modify|show'); //shortcut to link DataEdit
        }else{
            $grid->edit('/admin/permission/action/edit', 'Edit', 'show'); //shortcut to link DataEdit
        }
        $grid->paginate(15); //pagination

        return view('admin.grid', compact('grid', 'filter'));
    }


    public function anyEdit()
    {
        $data = Input::all();
        if (isset($data['insert']) && $data['save']) {
            $rules = array(
                'name' => 'required|max:255|unique:permissions',
                'display_name' => 'required',
                'description' => 'required|unique:permissions',
            );
            //请求参数验证
            parent::validator($data, $rules);
        }

        $categories = Category::where('level','>','1')->orderBy('level','desc')->lists("name", "id")->toArray();
        $edit =  DataEdit::source( new Permission);

        $edit->link("/admin/permissions","权限列表", "TR")->back();
        $edit->add('category_id','权限类型','select')->options($categories)->attributes(array("style"=>"width:200px"))->rule('required');
        $edit->add('name','权限名称', 'text')->rule('required|alpha_dash')->attributes(array("style"=>"width:200px"));
        $edit->add('display_name','权限名称', 'text')->rule('required');
        $edit->add('description','描述', 'text')->rule('required');

        return $edit->view('admin.edit', compact('edit'));
    }






}