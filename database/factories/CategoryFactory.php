<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    $now =$faker->dateTime();
    return [
        'name'  =>  $faker->sentence(),
        'description'   =>  $faker->sentence(),
        'created_at'    =>  $now,
        'updated_at'    =>  $now,
    ];
});
