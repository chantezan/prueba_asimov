<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'date' => '2019-02-01 16:00',
        'name' => 'name',
        'last_name' => '',
        'phone' => '',
        'email' => ''
    ];
});
