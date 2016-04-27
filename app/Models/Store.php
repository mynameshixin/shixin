<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'Stores';

    public function apps()
    {
        return $this->belongsToMany(App::class , 'StoreApps', 'store_id' ,'app_id');
    }

    public function manger(){
        return $this->belongsToMany(User::class ,'StoresMangers' ,'store_id');
    }
    
    public function storeTimelines()
    {
        return $this->hasMany(StoresTimeline::class, 'store_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    
}
