<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        $this->call(UserTableSeeder::class);
        //$this->call(PostTableSeeder::class);
        $this->command->info('User table seeded!');
        $this->call(RoleTableSeeder::class);
        $this->command->info('Role table seeded!');
        $this->call(CategoryTableSeeder::class);
        $this->command->info('Role table seeded!');
        $this->call(PermissionTableSeeder::class);
        $this->command->info('Venues table seeded!');

        Model::reguard();
    }
}
