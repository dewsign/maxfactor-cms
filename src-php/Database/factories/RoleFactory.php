<?php

use Faker\Generator as Faker;

$factory->define(Maxfactor\CMS\Models\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'slug' => $faker->unique()->slug,
    ];
});
