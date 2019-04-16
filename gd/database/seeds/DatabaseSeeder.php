<?php

use Illuminate\Database\Seeder;
use App\sss_deduction;
use App\tax_deduction;

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
        $this->call('sss_seeder');
        $this->call('tax_seeder');
    }
}
