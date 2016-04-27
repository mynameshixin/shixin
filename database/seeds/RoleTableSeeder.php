<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s', time());
        DB::table('roles')->delete();
        $list[]= [
            'name' => 'super_administrator',
            'display_name' => '超级管理员',
            'description' => '后台超级管理员角色',
            'created_at' => $now,
            'updated_at' => $now
        ];
        $list[]= [
            'name' => 'administrator',
            'display_name' => '管理员',
            'description' => '后台管理员角色',
            'created_at' => $now,
            'updated_at' => $now
        ];
        $list[]= [
            'name' => 'admin',
            'display_name' => '管理员',
            'description' => '后台管理员角色',
            'created_at' => $now,
            'updated_at' => $now
        ];
        DB::table('roles')->insert($list);
        $role = App\Models\Role::where('name','=','super_administrator')->first();
        if ($role) {
            $rows = App\Models\User::select('id')->take(2)->get()->toArray();
            foreach ($rows as $row) {
                DB::table('role_user')->insert(['user_id'=>$row['id'],'role_id'=>$role->id]);
            }
        }
    }
}
