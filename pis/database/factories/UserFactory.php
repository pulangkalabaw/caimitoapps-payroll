<?php

use Faker\Generator as Faker;
use App\Compensation;
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

    $user_payroll_details = new UserPayrollDetails();

    $compensation = new Compensation();
    $user_compensation = new UserCompensation();

    static $password;

    $user_id = $faker->bothify('***************##########');

    // User Payroll details
    $wage_type = array('fixed', 'daily');
    $payout_type = array('cash', 'cheque');
    $tax_computation = array('annual','table','none');
    $working_days = array(5, 6);

    $user_payroll_details->insert([
        'user_id' => $user_id,
        'wage_type' => $wage_type[array_rand($wage_type)],
        'bank_details' => $faker->bothify('###'.'-'.'######'.'-'.'##'),
        'payout_type' => $payout_type[array_rand($payout_type)],
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
