<?php
/**
 * Created by PhpStorm.
 * User: zhangxu
 * Date: 15/9/8
 * Time: 上午9:35
 */
namespace App\Services\Admin;

use App\Models\User;
use App\Services\ApiService;


class MenuService extends ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    /**
     * 根据用户id获取menu
     * @param @user_id
     *
     */
    public function dumpUserMenusById($user_id)
    {
        $menu = \Config::get('menu.list');//列表配置

        $permission = \Config::get('menu.permission');//权限配置

        $userInfo = User::with('roles')->find($user_id)->toArray();

        $rolesPermission = array();
        foreach ($userInfo['roles'] as $v) {
            if (isset($permission[$v['id']]['yes'])) {
                if ($permission[$v['id']]['yes'] == 'all') {
                    $rolesPermission = 'all';
                    break;
                } else {
                    $rolesPermission = array_merge($rolesPermission, $permission[$v['id']]['yes']);
                }

            }
        }

        $tmp = '';

        foreach ($menu as $k => $v) {
            if ($rolesPermission != 'all' && !in_array($k, $rolesPermission))
                continue;


            $colorClassB = isset($v['color']) ? "text-{$v['color']}" : '';

            if (isset($v['child']) && !empty($v['child'])) {
                $tmp .= <<<EOT
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-{$v['fontAwesome']} {$colorClassB}"></i> <span>{$v['title']}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
EOT;


                foreach ($v['child'] as $ck => $cv) {

                    if (isset($cv['child']) && !empty($cv['child'])) {

                        $tmp .= <<<EOT
                  <li> <a href="#"><i class="fa fa-{$cv['fontAwesome']}"></i> {$cv['title']} <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
EOT;

                        foreach ($cv['child'] as $cck => $ccv){

                            $route = url($ccv['route']);

                            $tmp .= <<<EOT
                    <li><a href="{$route}" target="contentIframe"><i class="fa fa-{$ccv['fontAwesome']}"></i> {$ccv['title']}</a></li>
EOT;

                        }

                        $tmp .= <<<EOT
                        </ul></li>
EOT;



                    } else {
                        $route = url($cv['route']);
                        $colorClass = isset($cv['color']) ? "text-{$cv['color']}" : '';
                        $tmp .= <<<EOT
                    <li><a href="{$route}" target="contentIframe"><i class="fa fa-{$cv['fontAwesome']} {$colorClass}"></i>{$cv['title']}</a></li>
EOT;
                    }


                }
                $tmp .= '</ul></li>';
            } else {

                $route = url($v['route']);

                $tmp .= <<<EOT
                    <li><a href="{$route}" target="contentIframe"><i class="fa fa-{$v['fontAwesome']}"></i> <span>{$v['title']}</span></a></li>
EOT;
            }
        }


        echo $tmp;
    }
}