<?php
/**
 * Created by ytt@yiban.cn
 * Comments: banner表
 *
 *
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}