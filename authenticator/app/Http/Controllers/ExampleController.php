<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function try(){
            return $results = app('db')->connection('tenant')->select("SELECT * FROM users");
    }

    //
}
