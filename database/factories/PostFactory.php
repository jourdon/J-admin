<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    $now =$faker->dateTime();
    $sentence =$faker->sentence();
    return [
        'title' =>  $sentence,
        'body'  =>  $faker->text(),
        'excerpt'   =>  $sentence,
        'created_at'    =>  $now,
        'updated_at'    =>  $now,
    ];
});
