<?php

use Illuminate\Database\Seeder;
use App\SssDeduction;
use App\TaxDeduction;


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

    }
}
