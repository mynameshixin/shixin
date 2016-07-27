<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:52
 */
namespace App\Http\Controllers\Admin;


use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;

use App\Models\Role;
use App\Services\Admin\PermissionService;


class RoleController extends ApiController
{

    public function index(Request $request)
    {
        
        $user = Auth::user();
        $filter = DataFilter::source( new Role);
        $filter->add('name','名称', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->link("/admin/role/edit","create role");

        $grid = DataGrid::source($filter);  //same source types of DataSet

        $grid->add('name','角色名称', true); //field name, label, sortable
        $grid->add('display_name','角色描述'); //relation.fieldname
        $grid->add('description','描述'); //relation.fieldname
        if ($user->hasRole(['super_administrator', 'admin'])) {
            $grid->edit('/admin/role/action/edit', 'Edit','modify|show'); //shortcut to link DataEdit
        }

        $grid->paginate(15); //pagination

        return view('admin.grid', compact('grid', 'filter'));
    }


    public function anyEdit(Request $request)
    {
        $data = Input::all();
        if (isset($data['show']) && $data['show']) {
            return  self::detail($data['show']);
        }elseif (isset($data['update']) && $data['update']) {
            return self::modify($request,$data['update']);
        }
        $edit = DataEdit::source(new Role());
        $edit->link("/admin/role/action/edit","Roles", "TR")->back();
        $edit->add('name','角色名称', 'text')->attributes(array("style"=>"width:620px;",'readonly'=>'readonly'));
        $edit->add('display_name','角色描述', 'text')->rule('required');
        $edit->add('description','描述', 'text')->rule('required');
        return $edit->view('admin.edit', compact('edit'));
    }
    /**
     * 修改用户权限
     *
     */
    public function postPermission (Request $request) {
        $user = Auth::user();
        if (!$user->hasRole(['super_administrator', 'admin']) ) {
            return response()->forApi([],106,'没有权限修改用户权限！');
        }
        $data = Input::all();
        $rules = array(
            'id'=>'required|exists:roles,id',
            'permissions' => 'required',
        );
        if (is_string($data['permissions'])) $data['permissions'] = json_decode($data['permissions'],true);
        //请求参数验证
        parent::validator($data, $rules,[],$request->ajax());
        //修改用户权限
        UserService::getInstance()->editRolePermissions($data['id'],$data['permissions']);
        if ($request->ajax()) {
            return response()->forApi(['status'=>1]);
        }else{
            return redirect('admin/role/action/edit?show='.$data['id']);
        }

    }
    /**
     * 角色详情页
     *
     * @param  int  $id
     * @return Response
     */
    protected function detail($id)
    {
        $role = Role::find($id);
        if (empty($role)) {
            $message = Lang::get('admin.unreg_user');
            return parent::error($message);
        }
        $role = $role->toArray();
        $tree = PermissionService::getInstance()->getRolePermissionTree($id);
        return view('admin.roles.detail',['role'=>$role,'tree'=>$tree,'url'=>url('/admin/role/action/permission')]);

    }

    protected function modify($request,$id){
        $data = Input::all();
        $data['id'] = $id;
        $rules = array(
            'id'=>'required|integer',
            'name' => 'required|min:5',
            'display_name' => 'required',
            'description' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules,[],$request->ajax());
        $id = $data['id'];
        $entry = [
            'name'=>$data['name'],
            'display_name'=>$data['display'],
            'description'=>$data['description']
        ];

        Role::where('id','=',$id)->update($entry);

        if ($request->ajax()) {
            return response()->forApi(['status'=>1]);
        }else{
            return redirect('admin/user/action/edit?show='.$id);
        }

    }



}