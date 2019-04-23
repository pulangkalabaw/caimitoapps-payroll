<?php

use Illuminate\Database\Seeder;

class UserPayrollDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\UserPayrollDetails::class, 5)->create();

    }
}
