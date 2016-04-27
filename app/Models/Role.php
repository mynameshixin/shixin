<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:48
 */
namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class , 'permission_role', 'permission_id' ,'role_id');
    }
    public function users(){
        return $this->belongsToMany(User::class,'role_user','user_id','role_id');
    }
}