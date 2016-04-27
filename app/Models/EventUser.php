<?php
/**
 * Created by ytt@yiban.cn
 * Comments: banner表
 *
 *
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $table = 'event_user';
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}