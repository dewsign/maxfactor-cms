<?php

use Faker\Generator as Faker;
use Maxfactor\CMS\Models\User;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => Hash::make(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
