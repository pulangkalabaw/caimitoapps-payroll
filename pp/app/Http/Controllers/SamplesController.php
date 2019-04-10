<?php namespace App\Http\Controllers;
use App\Sample;

class SamplesController extends Controller {

    const MODEL = "App\Sample";

    // use RESTActions;

    public function index(){
        $tax_type = 0;
        $basic_pay = 12500;
        $other_earnings = 500;
        $overtime = 0;
        $less_absences = 0;
        $government_deductions = 100;

        if($tax_type == 0){
            return $total = $basic_pay + $other_earnings + $overtime - $less_absences - $government_deductions;
        }
    }
}
