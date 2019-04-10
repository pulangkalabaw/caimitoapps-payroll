<?php
namespace App\Http\Controllers;
use App\Sample;

class SamplesController extends Controller {

    // const MODEL = "App\Sample";

    public function index(){
        // From PIS
        $basic_pay = 13000.00;

        $working_days = 21.75;

        $lates = 0.43;
        $late_deduction = $basic_pay / $working_days / 8 * $lates;

        $absences = 4;
        $absent_deduction = $basic_pay / $working_days / 8 * $absences;

        $under_times = 0.9;
        $under_time_deduction = $basic_pay / $working_days / 8 * $under_times;

        // GROSS INCOME COMPUTATIONS
        $gross_income = ($basic_pay / 2) - $late_deduction - $absent_deduction - $under_time_deduction;

        // GOVERNMENT DEDUCTION COMPUTATION
        $sss_deduction = find_sss_deduction($gross_income);
        $pagibig_deduction = 100;
        $philhealth_deduction = $basic_pay * .02;
        return $total_government_deductions = $sss_deduction + $pagibig_deduction + $philhealth_deduction;
        // $taxable_income =
    }
}
