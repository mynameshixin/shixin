<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreApp extends Model
{
    protected $table = 'StoresApps';
    public $timestamps = false;

    public function app()
    {
        return $this->belongsTo(App::class);
    }

}
