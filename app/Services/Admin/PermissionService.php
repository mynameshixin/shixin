<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/31
 * Time: 上午11:34
 */
namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Permission;
use App\Services\ApiService;

class PermissionService extends ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    /**
     *构造权限树
     * @param $perms
     * @return array
     */
    public function getpermissionTree($perms)
    {
        $rows = Permission::where('category_id', '>', '0')->get()->toArray();
        $permissions = [];
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $action = isset($perms[$row['id']]) ? $perms[$row['id']] : 0;
                $entry = [
                    'id' => $row['id'],
                    'text' => $row['display_name'],
                    'attributes' => 'node-name = perm',
                    'checked' => 0
                ];
                $entry['children'][1] = [
                    'id' => 1,
                    'text' => '查看',
                    'value'=>1,
                ];
                $entry['children'][2] = [
                    'id' => 2,
                    'text' => '编辑',
                    'value' => 2,
                ];

                if ($action ==1){
                    $entry['children'][1]['checked']  =1;
                }elseif($action==2){
                    $entry['checked'] = 1;
                    $entry['children'][1]['checked']  =1;
                    $entry['children'][2]['checked']  =1;
                }
                $entry['children'] = array_values($entry['children']);


                $permissions[$row['category_id']][] = $entry;

            }
        }
        return $permissions;
    }

    /**
     * 获取用户权限树
     * @param $user_id
     * @return array
     */
    public function getUserPermissionTree($user_id)
    {
        $permissions = UserService::getInstance()->getUserPermissions($user_id);
        $user_permissions = [];
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                $user_permissions[$permission['id']] = $permission['action'];
            }
        }
        $permissionTree = self::getpermissionTree($user_permissions);
        $tree = self::getCategoryTree(0,1,$permissionTree);
        return $tree;

    }


    /**获取角色权限树
     * @param $role_id
     * @return array
     */
    public function getRolePermissionTree($role_id){
        $permissions = RoleService::getInstance()->getRolePermissions($role_id);
        $role_permissions = [];
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                $role_permissions[$permission['id']] = $permission['action'];
            }
        }
        $permissionTree = self::getpermissionTree($role_permissions);
        $tree = self::getCategoryTree(0,1,$permissionTree);
        return $tree;

    }

    /**
     * 分类树
     * @param int $pid
     * @param int $level
     * @param array $perms
     * @return array
     */
    function getCategoryTree($pid = 0, $level = 0, $perms = array())
    {

        $data = Category::where(['parent_id' => $pid, 'level' => $level])->get()->toArray();
        //目录树
        $tree = array();
        //层级
        $level++;
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if (isset($perms[$v['id']])) {
                    $child = $perms[$v['id']];
                } else {
                    $child = self::getCategoryTree($v['id'], $level, $perms);

                }

                $tree[] = ['id' => $v['id'], 'text' => $v['name'], 'children' => $child];
            }
        }
        //$tree = json_encode($tree);
        return $tree;
    }


}