<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 上午11:42
 */
namespace App\Services\Admin;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Services\ApiService;

class UserService extends ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    private $redisNameSpace = 'userPermission:';

    private $alias_key = ':Permissions';//alias关系redis前缀

    private $exptime = 300;//session过期时间

    private $redisDb = 'session';

    private $redis;//公共参数数据源

    public function __construct()
    {
        $this->redis = Redis::connection($this->redisDb);//redis
    }

    /**
     * 修改用户角色
     * @param $user_id
     * @param $role_id 支持role_ids 数组
     * @return bool
     */
    public function editUserRole ($user_id,$role_id) {
        $user = User::find($user_id);
        if (empty($user)) return false;

        $user->roles()->sync([]);
        $user->roles()->attach($role_id);

        return true;
    }
    /**
     * 修改角色权限
     * @param $role_id
     * @param $permissions
     * @return bool
     */
    public function editRolePermissions($role_id,$permissions){
        $role = Role::find($role_id);
        if ($role) {
            $role->perms()->sync([]);

            if (!empty($permissions)) {
                foreach ($permissions as $key=>$val) {
                    $entry[]=[
                        'role_id'=>$role_id,
                        'permission_id'=>$key,
                        'action'=>$val
                    ];
                }
                PermissionRole::insert($entry);
            }
            $alias_key = $this->redisNameSpace.'*';
            $keys = $this->redis->keys($alias_key);
            if ($keys) $this->redis->del($keys);
        }
        return true;
    }
    /**
     * 修改用户权限
     * @param $user_id
     * @param $permissions
     * @return bool
     */
    public function editUserPermissions($user_id,$permissions){

        //获取用户角色权限
        $rows = RoleUser::where('user_id','=',$user_id)->select('role_id')->get();
        if (!empty($rows)) {
            $rows = $rows->toArray();
            $role_ids = array_column($rows,'role_id');
            $rolePermissions =  Roleservice::getInstance()->getRolePermissions($role_ids);
            if (!empty($rolePermissions)) {
                foreach ($rolePermissions as $v) {
                    if (isset($permissions[$v['id']]) && $v['action']>=$permissions[$v['id']]){
                        unset($permissions[$v['id']]);
                    }
                }
            }
        }
        PermissionUser::where('user_id','=',$user_id)->delete();
        if (!empty($permissions)) {
            foreach ($permissions as $key=>$val) {
                $entry[]=[
                    'user_id'=>$user_id,
                    'permission_id'=>$key,
                    'action'=>$val
                ];
            }
            PermissionUser::insert($entry);
        }
        $alias_key = $this->redisNameSpace . $user_id . ':' . $this->alias_key;
        $this->redis->del($alias_key);
        return true;
    }
    /**
     * 获取用户权限
     * @param $userId
     * @return array
     */
    public function getUserPermissions($user_id)
    {
        $alias_key = $this->redisNameSpace . $user_id . ':' . $this->alias_key;
        $permissions = $this->redis->get($alias_key);
        if (!empty($permissions)) return unserialize($permissions);
        //用户的权限
        $rows = PermissionUser::with('permission')->where('user_id', $user_id)->get()->toArray();
        $permissions = [];
        if (!empty($rows)) {
            foreach ($rows as $val) {
                $val['permission']['action'] = $val['action'];
                $permissions[$val['permission']['id']] = $val['permission'];
            }
        }
        $user = User::with('roles')->find($user_id)->toArray();
        if (!empty($user['roles'])) {
            $role_ids = array_column($user['roles'], 'id');
            $role_permissions = RoleService::getInstance()->getRolePermissions($role_ids);
            if (!empty($role_permissions)) {
                foreach ($role_permissions as $permission) {
                    if (!isset( $permissions[$permission['id']])) $permissions[$permission['id']] = $permission;
                }

            }
            //$permissions = array_merge($permissions, $role_permissions);
        }
        //将用户的权限保存到redis
        if (!empty($permissions)) {
            $this->redis->setex($alias_key, $this->exptime, serialize($permissions));
        }

        return $permissions;
    }

    /**
     * 获取用户当前url 权限
     * @param $user_id
     * @param $url
     * @return int action 1 查看 2 编辑 3 增删除
     */
    public function getUserPermissionByUrl($user_id, $url)
    {
        $permissions = Permission::where('description', $url)->get()->toArray();
        $action = 0;
        if (!empty($permission)) {
            $permission_ids = array_column($permissions, 'id');
            $permission_ids = array_unique($permission_ids);
            $rows = PermissionUser::where('user_id', $user_id)->whereIn('permission_id', $permission_ids)->get()->toArray();
            $actions = array_column($rows, 'action');
            if (!empty($actions)) $action = array_search(max($action), $action);
        } else {
            $action = 3;
        }
        return $action;
    }

    /**
     * 根据url判断用户权限
     * @param $user_id
     * @param $url  当前访问url
     * @param int $action 1 查看 2 编辑
     * @return bool
     */
    public function checkUserPermissionByUrl($user_id, $url, $action = 1)
    {
        $permissions = self::getUserPermissions($user_id);
        if (!empty($permission)) {
            foreach ($permissions as $permission) {
                if ($permission['description'] == $url && $permission['action'] >= $action) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 根据权限名称用户权限
     * @param $user_id
     * @param $perm_name  权限名称
     * @param int $action 1 查看 2 编辑
     * @return bool
     */
    public function checkUserPermissionByName($user_id, $perm_name, $action = 1)
    {
        $permissions = self::getUserPermissions($user_id);
        if (!empty($permission)) {
            foreach ($permissions as $permission) {
                if ($permission['name'] == $perm_name && $permission['action'] >= $action) {
                    return true;
                }
            }
        }
        return false;
    }


}