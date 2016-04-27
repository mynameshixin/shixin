<?php
/**
 * Created by zhangxu@yiban.cn
 * Date: 15/9/7
 * Comments: 闲置物品分类表
 *
 *
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoseNotice extends Model
{
    protected $table = 'LoseNotices';


    public function store(){
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}