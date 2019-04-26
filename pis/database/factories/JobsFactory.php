<?php

use Faker\Generator as Faker;

$factory->define(App\Jobs::class, function (Faker $faker) {
	
    return [
        //
        'job_id' => $faker->bothify('######'),
        'job_name' => $faker->firstNameMale,
        'job_description' => $faker->firstNameFemale,
    ];
});
