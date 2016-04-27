<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $table = 'Apps';

    public function stores()
    {
        return $this->belongsToMany(Store::class , 'store_apps', 'store_id' ,'app_id');
    }


}
