<?php

use Illuminate\Database\Seeder;

class UserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\UserDetails::class, 5)->create();

    }
}
