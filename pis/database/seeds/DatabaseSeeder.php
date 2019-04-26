<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(DepartmentSeeder::class);
        $this->call(CompensationSeeder::class);
        // $this->call(JobsSeeder::class);
        // $this->call(UserDetailsSeeder::class);
        // $this->call(UserPayrollDetailsSeeder::class);
    }
}
