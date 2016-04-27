<?php

namespace App\Models;

class CollectionGood extends BaseModel
{
    protected $table = 'collection_good';

    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at'];

}
