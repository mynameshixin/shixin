<?php

namespace App\Models;

class Follow extends BaseModel
{
    protected $table = 'user_follow';

    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at'];

}
