<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'user_id' => $faker->bothify('***************##########'),
        'employee_code' => $faker->bothify('##########'),
        'lname' => $faker->firstNameMale,
        'fname' => $faker->firstNameMale,
        'mname' => $faker->firstNameFemale,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];

    // return [
    //     'user_id' => '75892A75F973TG',
    //     'employee_code' => 'AD309',
    //     'lname' => 'Smith',
    //     'fname' => 'John',
    //     'mname' => 'Doe',
    //     'email' => 'jsmith@payme.com',
    //     'password' => bcrypt('secret'),
    //     'remember_token' => str_random(10),
    // ];
});
