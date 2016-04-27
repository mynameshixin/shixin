<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreManger extends Model
{
    protected $table = 'StoresMangers';
    public $timestamps = false;

    public function stores(){
        return $this->belongsTo(Store::class,'store_id');
    }

}
