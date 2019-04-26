<?php

use Illuminate\Database\Seeder;
use App\SssDeduction;
use App\TaxDeduction;
use App\Deductions;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call('SssTableSeeder');
        $this->call('TaxTableSeeder');
        $this->call('DeductionSeeder');

    }
}
