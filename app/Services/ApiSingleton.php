<?php
namespace App\Services;

abstract class ApiSingleton {
    protected static $_singletonStack;

    public static function getInstance(){
        $class = get_called_class();
        if (empty(self::$_singletonStack[$class])){
            self::$_singletonStack[$class] = new $class();
        }
        return self::$_singletonStack[$class];
    }

    protected function __construct()
    {

    }
}