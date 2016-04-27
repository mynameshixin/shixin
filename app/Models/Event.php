<?php
/**
 * Created by ytt@yiban.cn
 * Comments: banner表
 *
 *
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}