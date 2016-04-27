<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s', time());
        DB::table('permissions')->delete();
        DB::table('permission_role')->delete();
        $list[]= [
            'name' => 'edit-role',
            'display_name' => '编辑角色',
            'description' => '编辑角色',
            'created_at' => $now,
            'updated_at' => $now
        ];
        $list[]= [
            'name' => 'edit-user',
            'display_name' => '编辑用户',
            'description' => '编辑后台用户',
            'created_at' => $now,
            'updated_at' => $now
        ];
        $list[]= [
            'name' => 'create-shop',
            'display_name' => '创建店铺',
            'description' => '创建店铺',
            'created_at' => $now,
            'updated_at' => $now
        ];
        DB::table('permissions')->insert($list);
        $role = App\Models\Role::where('name','=','super_administrator')->first();
        if ($role) {
            $rows = App\Models\Permission::select('id')->get()->toArray();
            foreach ($rows as $row) {
                DB::table('permission_role')->insert(['permission_id'=>$row['id'],'role_id'=>$role->id]);
            }
        }


    }
}
