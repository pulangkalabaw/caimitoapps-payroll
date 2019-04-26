<?php

// $table->string('compensation_id')->unique();
// $table->string('name')->nullable();
// $table->float('amount')->nullable();
// $table->tinyInteger('taxable')->nullable();
// $table->string('type')->default('fixed'); //determines if fixed or variable
// $table->string('code')->nullable();

$factory->define(App\User::class, function (Faker\Generator $faker) {

    $type = array('fixed', 'variable');

    return [
        'compensation_id' => $faker->bothify('###???###???'),
        'name' => $faker->name,
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100000),
        'taxable' => $faker->biasedNumberBetween($min = 0, $max = 1, $function = null),
        'type' => array_rand($type),
        'code' => $faker->bothify('##??')
    ];
});
