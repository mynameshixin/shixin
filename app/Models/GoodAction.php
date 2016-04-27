<?php

namespace App\Models;

class GoodAction extends BaseModel
{
    protected $table = 'good_action';

    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at'];

}
