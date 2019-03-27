<?php

use Faker\Generator as Faker;

$factory->define(App\Department::class, function (Faker $faker) {
    return [
        //
        'department_id' => $faker->bothify('######'),
        'department_name' => $faker->firstNameMale,
        'description' => $faker->firstNameFemale,
    ];
});
