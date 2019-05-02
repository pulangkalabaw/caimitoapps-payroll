<?php

use Faker\Generator as Faker;

$factory->define(App\Compensation::class, function (Faker $faker) {

    //final value of the basic pay
    $basic_pay = [
        'compensation_id' => 'BS098765',
        'name' => 'Basic Pay',
        'amount' => 10000.00,
        'type' => 'variable',
        'code' => 'BP'
    ];

    App\Compensation::create($basic_pay);

    $type = array('fixed', 'variable');
    $taxable = array(1,0);

    return [
        'compensation_id' => $faker->bothify('##??###???'),
        'name' => $faker->firstName(),
        'amount' => $faker->randomFloat(2, 1, 500),
        'taxable' => array_rand($taxable),
        'type' => $type[array_rand($type)],
        'code' => $faker->bothify('##??')
    ];
});
