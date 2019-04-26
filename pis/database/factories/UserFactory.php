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
    $user_id = $faker->bothify('***************##########');

    // Compensation seeder
    // $compensation_id = $faker->randomElement(compensation::get()->pluck('id')); // [1, 2, 3, 4]
    // user_compensation::insert(
    //     'user_id' => $user_id,
    //     'compensation_id' => $compensation_id,
    // );

    // // Deduction Seeder
    // $deduction_id

    return [
        'user_id' => $user_id,
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
