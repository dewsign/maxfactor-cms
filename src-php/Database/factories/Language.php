<?php

use Faker\Generator as Faker;
use Maxfactor\CMS\Models\Language;

$factory->define(Language::class, function (Faker $faker) {
    $locale = $faker->locale;

    return [
        'locale' => $locale,
        'name' => $locale,
    ];
});
