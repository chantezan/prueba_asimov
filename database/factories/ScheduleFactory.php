<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'day' => 1,
        'start_hour' => '09:00',
        'end_hour' => '18:00',
        'start_date' => '2019-01-01',
        'end_date' => '2019-12-31',
    ];
});
