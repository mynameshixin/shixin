<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemMsg extends Model
{

    protected $table = 'system_msgs';
    
    protected $guarded = array('msg_id');
    

}
