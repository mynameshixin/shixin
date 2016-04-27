<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 上午11:42
 */
namespace App\Services\Admin;

use App\Models\StoreManger;
use App\Services\ApiService;

class AppService extends ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }


    public function __construct() {

    }


    public function setApp($data)
    {
        //if()
    }

    //获得允许操作的门店
    public function getAllowStore($userId){
        //$allStore=Store::where('isuse',1)->lists("name","id")->toArray();
        $allStore=StoreManger::with('stores')->where('user_id',$userId)->get()->lists("stores.name","stores.id")->toArray();
        return $allStore;
    }
}