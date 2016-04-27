<?php
/**
 * Created by ytt@yiban.cn
 * Comments: banner表
 *
 *
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}