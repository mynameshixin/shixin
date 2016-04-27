<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $list[]= [
            'name' => '管理权限',
            'name_e' => 'Administrative authority',
            'level' => 0,
            'parent_id' => 0,
            'kind'=>1,
        ];
        $list[]= [
            'name' => '运营权限',
            'name_e' => 'Operating authority',
            'level' => 0,
            'parent_id' => 0,
            'kind'=>1,
        ];

        DB::table('categories')->insert($list);
    }
}
