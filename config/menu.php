<?php
/**
 *
 * menu 侧边栏菜单配置
 *
 * roles 角色权限
 * title 标题
 * fontAwesome 小图标样式  样式参考表 http://www.bootcss.com/p/font-awesome/design.html
 * color 图标颜色 默认白色
 * child 子菜单  最多支持2级菜单
 */
return [
    /**
     * 角色的对应菜单权限
     */
    'permission' => [
        //super_administrator 超级管理员
        '1' => [
            'yes' => 'all',
        ],
        //administrator 管理员
        '2' => [
            'yes' => [
                'account',
                'goods'

            ]
        ],
        //operate 运营
        '3' => [
            'yes' => [
                'account',
            ],
        ],
        //area 区域
        '4' => [
            'yes' => [
                'account',
            ],
        ],
        //store 门店
        '5' => [
        ],
    ],
    /**
     * 菜单列表
     */
    'list' => [

        'account' => [
            'roles' => '',
            'title' => '账号管理管理',//标题 路由
            'fontAwesome' => 'dashboard',
            'color' => 'white',
            'child' => [
                'profile' => [
                    'title' => '账号信息',
                    'route' => 'admin/profile',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'white',
                ],
                'password' => [
                    'title' => '修改密码',
                    'route' => 'admin/change/password',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'white',
                ],
            ],
        ],
        'users' => [
            'title' => '用户管理',
            'route' => 'admin/users',
            'fontAwesome' => 'user',
            'child' => [
                'users' => [
                    'title' => '用户管理',
                    'route' => 'admin/users',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'th',
                ],
                'roles' => [
                    'title' => '角色管理',
                    'route' => 'admin/roles',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'white',
                ],
            ],
        ],
        'goods' => [
            'title' => '业务管理',
            'route' => 'admin/products',
            'fontAwesome' => 'list',
            'child' => [
//                'taobao' => [
//                    'title' => '发布淘宝商品',
//                    'route' => 'admin/taobao/action/item',//url
//                    'fontAwesome' => 'circle-o',
//                    'color' => 'white',
//                ],
//                'image' => [
//                    'title' => '发布灵感图',
//                    'route' => '/admin/product/action/edit',//url
//                    'fontAwesome' => 'circle-o',
//                    'color' => 'white',
//                ],
                'good' => [
                    'title' => '商品列表',
                    'route' => 'admin/products?kind=1',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'white',
                ],
                'good2' => [
                    'title' => '图集列表',
                    'route' => 'admin/products?kind=2',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'white',
                ],
                'event' => [
                    'title' => '活动列表',
                    'route' => 'admin/events',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'white',
                ],
                'folders' => [
                    'title' => '文件夹列表',
                    'route' => 'admin/folders',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'white',
                ]
            ],
        ],
        'site' => [
            'title' => '设置',
            'route' => 'admin/categories',
            'fontAwesome' => 'list',
            'child' => [
                'category' => [
                    'title' => '分类管理',
                    'route' => 'admin/categories',//url
                    'fontAwesome' => 'circle-o',
                    'color' => 'white',
                ],
                'banner' => [
                    'title' => 'Banner管理',
                    'route' => 'admin/banners',
                    'fontAwesome' => 'th',
                ],
                'column' => [
                    'title' => '行家推荐栏目管理',
                    'route' => 'admin/columns',
                    'fontAwesome' => 'th',
                ],


            ],
        ],


    ],

];
