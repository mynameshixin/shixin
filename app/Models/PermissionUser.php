<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:49
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    protected $table = 'permission_user';

    protected $hidden = ['created_at', 'updated_at'];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}