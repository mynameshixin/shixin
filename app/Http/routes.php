<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses'=>'\App\Http\Controllers\HomeController@index']);
//web index
Route::group(['namespace' => 'Web', 'prefix' => 'webd'], function () {
    Route::controllers([
        'home'=>'HomeController',
        'pics'=>'PicsController',
        'find'=>'FindController',
        'app'=>'AppController',
        'user'=>'UserController',
        'folder'=>'FolderController',
        'taobao'=>'TaoBaoController',
        'search'=>'SearchController',
        'contact'=>'ContactController',
        'tlogin'=>'TloginController',
        'goodaction'=>'GoodActionController',
        'notice'=>'NoticeController',
        'plugin'=>'PluginController',
        'cq'=>'CqController',
    ]);
    Route::resources([
        'pic'=>'PicsController',
        'cqpic'=>'CqController',
    ]);
});

Route::get('vr/{id}', 'Web\VrController@index')->where('id', '[0-9]+');
Route::controller('vrp','\App\Http\Controllers\Web\VrController');

Route::get('/home', ['uses'=>'\App\Http\Controllers\HomeController@index']);
//图片base64格式上传
Route::get('/file/base64/upload/demo', ['uses'=>'\App\Http\Controllers\FileController@base64UploadDemoView']);
Route::post('/file/base64/upload', ['uses'=>'\App\Http\Controllers\FileController@base64Upload']);
Route::post('/file/form/upload', ['uses'=>'\App\Http\Controllers\FileController@postUploadimage']);
Route::get('/file/get/images', ['uses'=>'\App\Http\Controllers\FileController@getPicurl']);

//管理员登录
Route::controllers([
    'auth' => 'Admin\AuthController',
    'password' => 'Auth\PasswordController',
    'demo' => 'DemoController',
    'image'=>'\App\Http\Controllers\Api\ImageController',
]);
//图片上传 获取接口
//Route::resources([
//    '/admin/image' => '\App\Http\Controllers\Api\ImageController',
//]);
Route::resource('image','Api\ImageController');
Route::get('wechat/login', 'Api\WechatController@login');
Route::get('wechat/callback', 'Api\WechatController@callback');
Route::post('wechat/auth', 'Api\WechatController@auth');
Route::get('qq/login', 'Api\QqController@login');
Route::get('qq/callback', 'Api\QqController@callback');
Route::post('qq/auth', 'Api\QqController@auth');
/**
 * 后台管理
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => 'auth'], function () {


    Route::get('/change/password', 'UserController@changePassword');
    Route::post('/change/password', 'UserController@changePassword');

    Route::group( ['middleware' => 'role:administrator;super_administrator'], function () {
        Route::get('/', 'UserController@main');
        Route::get('/profile', 'UserController@getProfile');
        Route::controllers([
            'user/action'=> 'UserController',
            'role/action'=> 'RoleController',
            'category/action' => 'CategoryController',
            'permission/action'=> 'PermissionController',
            'banner/action'=>'BannerController',
            'column/action'=>'ColumnController',
            'product/action' => 'ProductController',
            'event/action' => 'EventController',
            'taobao/action' => 'TaoBaoController',
        ]);
        Route::resources([
            'users'=> 'UserController',
            'roles'=> 'RoleController',
            'permissions'=> 'PermissionController',
            'banners' => 'BannerController',
            'products' => 'ProductController',
            'events' => 'EventController',
            'columns'=>'ColumnController',

        ]);
    });


    Route::group(['middleware' => 'auth.permission'], function() {
        Route::controllers([
            'store/action'=> 'StoreController',
            'storemanger/action'=>'StoremangerController',
            'dashboard/action'=> 'DashboardController',
            'app/action'=>'AppController',
            'folder/action'=>'FolderController'
        ]);


    });
    Route::resources([
        'stores'=> 'StoreController',
        'storemangers'=>'StoremangerController',
        'dashboard'=> 'DashboardController',
        'categories'=> 'CategoryController',
        'apps'=>'AppController',
        'folders'=>'FolderController'
    ]);


});

Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
    /**
     * 用户授权接口
     *
     */
    Route::post('qq/auth', 'QqController@auth');
    Route::post('wechat/auth', 'WechatController@auth');
    Route::any('/mobile/captcha', 'AuthController@mobileCaptcha');
    Route::post('/register/mail', 'AuthController@mailRegister');
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::post('/autologin', 'AuthController@autologin');
    Route::any('/logout', 'AuthController@logout');
    Route::post('/reset/password', 'AuthController@resetPassword');
    Route::post('/change/password', 'AuthController@changePassword');
    Route::controllers([
        'demo' => 'DemoController',
        'home'=>'HomeController',
        'message' => 'MessageController',
        'good/action'  => 'GoodActionController',
        'comment/action'  => 'CommentActionController',
        'good'  => 'ProductController',
        'user'  => 'UserController',
        'event' => 'EventController',
        'folder'  => 'FolderController',
        'category'=> 'CategoryController',
        'version' => 'VersionController',
        'share' => 'ShareController',
        'location'=> 'LocationController',
        'notice' => 'NoticeController',
        'vr' => 'VrController',
        'cq' => 'CqController',
    ]);

    Route::resources([
        'image' => 'ImageController',
        'feedback'=>'ReportController',
        'users'  => 'UserController',
        'folders'  => 'FolderController',
        'follows'  => 'FollowController',
        'good/actions'  => 'GoodActionController',
        'goods'  => 'ProductController',
        'notices' => 'NoticeController',
        'messages' => 'MessageController',
        'categories'=> 'CategoryController',
        'collection/folders'=> 'CollectionFolderController',
        'collections'=> 'CollectionController',
        'comments' => 'CommentController',
        'events' => 'EventController',
    ]);

});


//webadmin管理
Route::group(['namespace' => 'Webadmin', 'prefix' => 'webadmin'], function () {

    Route::group(['middleware' => 'webauth'],function(){
        //登陆后控制
        Route::controllers([
            'home'=>'HomeController',
        ]);
    });
    
    //login登陆
    Route::resources([
        '/'=> 'WebadminController',

    ]);

});

  
//新闻文章路由

  Route::group(['prefix' => 'Article','namespace'=>'Article'], function () {
    Route::resource('article', 'ArticleController');
});
Route::post('/Article/article/add','Article\ArticleController@add_eassat');
Route::any('/Article/pingx','Article\ArticleController@pingx');
Route::any('/Article/selectpingx','Article\ArticleController@select_pingx');
Route::any('/Article/addid/{pid}','Article\ArticleController@add_pingx');
Route::any('/Article/aqqid/{pid}','Article\ArticleController@aqq_pingx');
Route::any('/Article/comment/action','Article\ArticleController@add_int');
Route::any('/Article/comment/de','Article\ArticleController@comment_delete');
Route::any('/Article/search/{id}','Article\ArticleController@search');


