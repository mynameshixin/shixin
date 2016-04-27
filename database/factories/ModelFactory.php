<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'nick' => $faker->nick,
        'mobile' => $faker->mobile,
        'status' => 1,
        'password' => \Illuminate\Support\Facades\Hash::make('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Posts::class, function ($faker) {
    return [
        'user_id' => rand(1, 50),
        'title' => $faker->paragraph,
        'content' => $faker->paragraph,
    ];

});

$factory->define(App\Models\Role::class, function ($faker) {
    return [
        'name' => $faker->name,
        'display_name' => $faker->paragraph,
        'description' => $faker->paragraph,
    ];
});


$factory->define(App\Models\Permission::class, function ($faker) {
    return [
        'name' => $faker->name,
        'display_name' => $faker->paragraph,
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\Models\LoseNotice::class, function ($faker) {
    return [
        'store_id'=>1,
        'yb_user_id'=>184740,
        'yb_nick'=> $faker->name,
        'title' => $faker->paragraph,
        'reason' => $faker->paragraph,
        'content' => $faker->paragraph,
        'mobile' => 1320000000,
        'kind'=>rand(1,2),
        'status' => rand(0,3),
    ];
});



