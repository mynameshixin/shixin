<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 上午11:42
 */
namespace App\Services\Admin;

use App\Models\PermissionRole;
use App\Models\Role;
use App\Services\ApiService;

class RoleService extends ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    /**
     * 获取角色
     * @param $role_id 支持多角色ids［］,数组形势查询
     * @return array
     */
    public function getRolePermissions ($role_id) {
        if (!is_array($role_id)) $role_id = array($role_id);
        $rows = PermissionRole::with('permission')->whereIn('role_id', $role_id)->get()->toArray();
        $permissions = [];
        if (!empty($rows)) {
            foreach ($rows as $val) {
                $val['permission']['action'] = $val['action'];
                $permissions[$val['permission']['id']] = $val['permission'];
            }
        }

        return $permissions;
    }

    /**
     * 取超级管理员或者运营管理员
     * @param array $role_arr
     * @return array
     */
    public function getUsersByRole($role_arr=array(1,3))
    {
        if (empty($role_arr)) return array();
        $roleUser = Role::with('users')->whereIn('id', $role_arr)->get()->toArray();
        $users = array();
        if (!empty($roleUser)) {
            foreach ($roleUser as $val) {
                if (!empty($val['users'])) {
                    foreach ($val['users'] as $user) {
                        if (!isset($users[$user['id']])) $users[$user['id']] = $user['name'];
                    }
                }
            }
        }
          return $users;
    }



}