<?php

use Illuminate\Database\Seeder;

class CompensationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Compensation::class, 1)->create();
    }
}
