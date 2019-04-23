<?php

use Illuminate\Database\Seeder;
use App\sss_table;
use App\tax_table;

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
        $this->call('sss_table_seeder');
        $this->call('tax_table_seeder');
    }
}
