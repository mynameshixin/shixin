<?php

namespace App\Models;

class School extends BaseModel
{
    protected $table = 'School';

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'city_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\Users', 'school_id');
    }
}
