<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Http\Controllers\ApiController;
use App\Services\Admin\PermissionService;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;
use Zizaco\Entrust;


class UserController extends ApiController
{
    private  $statusArr =  ['0'=>'受限','1'=>'使用中','2'=>'已停用'];

    public function main() {
        return view('admin.main');
    }

    public function index(Request $request)
    {
        $roles['']='角色';
        $lists = Role::lists('display_name','id')->toArray();
        $statusArr['']= '状态';
        $statusArr = $statusArr + $this->statusArr;

        $roles = $roles + $lists;
        $filter = DataFilter::source(User::with('roles'));
        $filter->add('username','用户名', 'text');
        $filter->add('roles.id', '角色', 'select')->options($roles);
        $filter->add('status', '用户状态', 'select')->options($statusArr);
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();

        $grid = DataGrid::source($filter);  //same source types of DataSet
//        $grid->add('id','选择')->cell( function ($value) {
//            return "<input type='checkbox'>";
//        });
        $grid->add('id','Id', true);
        //$grid->add('id','ID', true); //field name, label, sortable
        $grid->add('{{  implode(", ", $roles->lists("display_name")->toArray()) }}','角色');
        $grid->add('username','用户名', true); //field name, label, sortable
        $grid->add('email','邮箱'); //relation.fieldname
        $grid->add('{{  implode(", ", $roles->lists("description")->toArray()) }}','角色描述');
        $grid->add('status','使用状态')->cell( function ($value) {
            $status = $this->statusArr;
            return $status[$value];
        });
        //row and cell manipulation via closure
        $grid->edit("/admin/user/{{ id }}","查看");
        if (\Entrust::hasRole(['administrator','super_administrator'])) {
            $grid->edit('/admin/user/action/edit', '编辑','show'); //shortcut to link DataEdit
        }else{
            //$grid->edit('/admin/user/action/profile', '查看','show'); //shortcut to link DataEdit
        }
        $grid->link('/admin/user/action/edit',"添加", "TR");
        $grid->orderBy('id','asc'); //default orderby
        $grid->paginate(15); //pagination

        return view('admin.users.index', compact('grid', 'filter'));

    }




    public function anyEdit(Request $request)
    {
        $data = Input::all();
        //$action = parent::checkUrlPermission($request);
        if (isset($data['show']) && $data['show']) {
            return  self::detail($data['show']);
        }elseif (isset($data['update']) && $data['update']) {
            return self::modify($request,$data['update']);
        }elseif (isset($data['insert']) && $data['insert']) {
            return self::create($request);

        }
        $roles = Role::lists('display_name','id')->toArray();
        $edit = DataEdit::source(new User);
        $edit->add('username','名称', 'text')->rule('required');
        $edit->add('email','邮箱', 'text')->rule('required');
        $edit->add('mobile','电话', 'text');
        $edit->add('nick','昵称', 'text');
        $edit->add('signature','签名', 'text');
        $edit->add('qq','qq', 'text');
        $edit->add('wechat','微信号', 'text');

        $edit->add('status','是否使用','radiogroup')->options($this->statusArr)->rule('required|in:1,2,3');
        $edit->autocomplete('role_id','角色','radiogroup')->options($roles)->rule('required');
        return $edit->view('admin.edit', compact('edit'));
    }


    public function changePassword(Request $request)
    {
        if ('GET' == $request->method()) {
            return view('admin.users.password');
        }
        $data = $request->input();
        $rules = array(
            'password' => 'required|min:6',
            'new_password' => 'required|min:6'
        );
        //请求参数验证
        self::validator($data, $rules);

        if (!Auth::validate(['password' => $data['password'], 'status' => 1])) {
            return response()->forApi(array(), 1004, '密码不正确');
        }
        $newPassword = Hash::make($request->input('new_password'));
        $user = Auth::user();
        $user->password = $newPassword;
        $status = $user->save();
        return response()->forApi(['status' => $status ? 1 : 0]);

    }


    /**
     * 用户信息
     * @return Response
     */
    public function getProfile(Request $request){

        $user_id = Auth::user()->id;
        $user = User::with('roles')->find($user_id);
        if (empty($user)) {
            $message = Lang::get('admin.unreg_user');
            parent::error($message);
        }
        $user = $user->toArray();
        $user['status'] = $this->statusArr[$user['status']];
        //获取用户权限树
        $permissions = UserService::getInstance()->getUserPermissions($user_id);
        if ($request->ajax()) {
            return response()->forApi($user);
        }else{
            return view('admin.users.profile',['user'=>$user,'permissions'=>$permissions]);
        }

    }

    /**
     * 修改用户信息
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postProfile(Request $request){
        $data = Input::all();
        $rules = array(
            'email' => 'email',
            'nick' => 'min:2',
        );
        //请求参数验证
        parent::validator($data, $rules,[],1);
        $id = Auth::user()->id;
        $entry = [];
        if (isset($data['nick'])) $entry['nick'] = $data['nick'];
        if (isset($data['email'])) $entry['email'] = $data['email'];
        if (isset($data['qq'])) $entry['qq'] = $data['qq'];
        if (isset($data['wechat'])) $entry['wechat'] = $data['wechat'];
        if (!empty($entry)) {
            User::where('id','=',$id)->update($entry);
        }

        if ($request->ajax()) {
            return response()->forApi(['status'=>1]);
        }else{
            return redirect('admin/profile');
        }

    }
    /**
     * 修改用户权限
     *
     */
    public function postPermission (Request $request) {
        $user = Auth::user();
        if (!$user->hasRole(['super_administrator', 'admin'])) {
            return response()->forApi([],106,'没有权限修改用户权限！');
        }

        $data = Input::all();
        $rules = array(
            'user_id'=>'required|exists:users,id',
            'permissions' => 'required',
        );
        if (is_string($data['permissions'])) $data['permissions'] = json_decode($data['permissions'],true);
        //请求参数验证
        parent::validator($data, $rules,[],$request->ajax());
        //修改用户权限
        UserService::getInstance()->editUserPermissions($data['user_id'],$data['permissions']);
        if ($request->ajax()) {
            return response()->forApi(['status'=>1]);
        }else{
            return redirect('admin/user/action/edit?show='.$data['user_id']);
        }

    }
    /**
     * 修改用户角色
     *
     */
    public function anyRole (Request $request) {
        $user = Auth::user();
        if (!$user->hasRole(['super_administrator', 'admin'])) {
            return response()->forApi([],106,'没有权限修改用户权限！');
        }

        $data = Input::all();
        $rules = array(
            'id'=>'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        );
        //请求参数验证
        parent::validator($data, $rules,[],$request->ajax());
        //修改用户权限
        UserService::getInstance()->editUserRole($data['id'],$data['role_id']);

        return response()->forApi(['status'=>1]);

    }

    /**
     * 创建账号
     */
    protected  function create ($request){
        $data = Input::all();
        $rules = array(
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:0,1,2',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'unique:users,mobile',
            'username' => 'required|min:2',
           // 'password'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules,[],1);
        $data['password'] = isset($data['password']) ? $data['password'] : '123456';
        $entry = [
            'username'=>$data['username'],
            'status'=>$data['status'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'nick' => isset($data['nick']) ? $data['nick'] : '',
            'signature' => isset($data['signature']) ? $data['signature'] : '',
            'mobile' => isset($data['mobile']) ? $data['mobile'] : '',
        ];
        $user_id = User::insertGetId($entry);
        UserService::getInstance()->editUserRole ($user_id,$data['role_id']);
        return redirect('admin/user/action/edit?show='.$user_id);
    }
    /**
     * 用户详情页
     *
     * @param  int  $id
     * @return Response
     */
    protected function detail($id)
    {

        $user = User::with('roles')->find($id);
        if (empty($user)) {
            $message = Lang::get('admin.unreg_user');
            return parent::error($message);
        }
        $user = $user->toArray();
        $tree = PermissionService::getInstance()->getUserPermissionTree($id);
        $roles = Role::lists('display_name','id')->toArray();
        $role_ids = array_column($user['roles'],'id');
        $data = ['user'=>$user,'status'=>$this->statusArr,'roles'=>$roles,'role_ids'=>$role_ids,'tree'=>$tree,'url'=>url('/admin/user/action/permission')];
        return view('admin.users.detail',$data);

    }

   protected function modify($request,$id){
        $data = Input::all();
        $data['id'] = isset($data['id']) ? $data['id'] : $id;
        $rules = array(
            'id'=>'required|min:integer',
            'status' => 'required|in:0,1,2',
            'email' => 'email',
            'nick' => 'min:2',
        );
        //请求参数验证
        parent::validator($data, $rules,[],1);
        $id = $data['id'];
        $entry = [];
        if (isset($data['mobile']) && parent::validateMobile($data['mobile'])) {
            $entry['mobile'] = $data['mobile'];
        }
        if (isset($data['nick'])) $entry['nick'] = $data['nick'];
        if (isset($data['email'])) $entry['email'] = $data['email'];
       if (isset($data['status'])) $entry['status'] = $data['status'];
       if (isset($data[' signature'])) $entry[' signature'] = $data[' signature'];

        if (!empty($entry)) {
            User::where('id','=',$id)->update($entry);
        }


        return response()->forApi(['status'=>1]);


    }


}
