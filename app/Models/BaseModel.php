<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    
    const ENABLE = 1;
    const DISABLE = 0;
    
    const TAKE = 20;
    
    public static $_status = [
        self::ENABLE => '有效',
        self::DISABLE => '无效',
    ];
    
    //根据id查找数据
    public static function findById($id){
        $model_name = get_called_class();
        return $model_name::find($id);
    }
    
    public static function findByIdEnable($id){
        $model_name = get_called_class();
        return $model_name::whereId($id)->whereStatus(BaseModel::ENABLE)->first();
    }
    
    public static function getList(array $params = ['id', 'name'], $enable = true, $status_name = 'status'){
        if($enable){
            return self::where($status_name, '=', BaseModel::ENABLE)->get($params);
        }
        return self::get($params);
    }
    
    public static function getListToArr($list, $name = 'name'){
        $arr = [];
        foreach ($list as $value) {
            $arr[$value->id] = $value->$name;
        }
        return $arr;
    }

    public static function getListToIdValue($list){
        $arr = [];
        foreach ($list as $value) {
            $arr[$value->id] = $value;
        }
        return $arr;
    }
}