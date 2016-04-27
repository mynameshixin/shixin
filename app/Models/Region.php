<?php

namespace App\Models;

class Region extends BaseModel
{
    protected $table = 'region';
    public $timestamps = false;

    const LEVEL_PROVINCE = 1;//省
    const LEVEL_CITY = 2;//市
    const LEVEL_DISTRICT = 3;//区
    
    public function schools()
    {
        return $this->hasMany('App\Models\School', 'city_id');
    }
    
    public static function getCityArr(){
        $return_arr = [];
        $list = self::where('level', '=', self::LEVEL_CITY)->orderBy('alpha', 'asc')->get(['id', 'region_name']);
        foreach ($list as $city) {
            $return_arr[$city->id] = $city['region_name'];
        }
        return $return_arr;
    }
}
