<?php

use Faker\Generator as Faker;
use App\Compensation;
use App\UserDetails;
use App\UserCompensation;
use App\UserPayrollDetails;

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

    $user_details = new UserDetails();
    $compensation = new Compensation();
    $user_compensation = new UserCompensation();
    $user_payroll_details = new UserPayrollDetails();

    static $password;

    $user_id = $faker->bothify('***************##########');

    $wage_type = array('semi-montly');

    $tax_computation = array('annual','table','none');
    $working_days = array(5, 6);

    UserPayrollDetails::insert([
        'user_id' => $user_id,
        'wage_type' => $wage_type[array_rand($wage_type)],
        'payout_type' => 'bank',
        'bank_name' => 'BDO',
        'account_number' => $faker->bothify('****#######'),
        'working_days' => $working_days[array_rand($working_days)],
        'tax_code' => $faker->bothify('**##'),
        'tax_computation' => $tax_computation[array_rand($tax_computation)],
        'tin_number' => $faker->bothify('########'),
        'sss_number' => $faker->bothify('##'.'-'.'######'.'-'.'#'),
        'tin_number' => $faker->bothify('########'),
        'philhealth_number' => $faker->bothify('########'),
        'hdmf_number' => $faker->bothify('########')
    ]);

    // Compensation seeder
    // Gives the basic salary of the user
    $compensation = $compensation->where('compensation_id', 'BS098765');
    $compensation_id = $compensation->value('compensation_id');
    $compensation_amount = $compensation->value('amount');
    $compensation_type = $compensation->value('type');

    $user_compensation->insert([
        'user_id' => $user_id,
        'user_compensation_id' => $faker->bothify('*****#####'),
        'compensation_id' => $compensation_id,
        'amount' => $compensation_amount,
        'type' => $compensation_type,
    ]);

    $user_details->insert([
        'user_id' => $user_id,
        'date_hired' => $faker->dateTime($max = 'now', $timezone = 'GMT+8')
    ]);

    // User seeder
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
});
