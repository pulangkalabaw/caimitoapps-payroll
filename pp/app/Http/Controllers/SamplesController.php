<?php
namespace App\Http\Controllers;
use App\Sample;

class SamplesController extends Controller {

    // const MODEL = "App\Sample";

    public function index(){
        // From PIS
        $basic_pay = 13000.00;


        $working_days = 21.75;

        // DEDUCTIONS
        $lates = 0.43;
        $late_deduction = $basic_pay / $working_days / 8 * $lates;

        $absences = 4;
        $absent_deduction = $basic_pay / $working_days / 8 * $absences;

        $under_times = 0.9;
        $under_time_deduction = $basic_pay / $working_days / 8 * $under_times;

        $deduction = $late_deduction + $absent_deduction + $under_time_deduction;

        // COMPENSATIONS
        $compensation = 0;
        $overtime = 3.00;
        $overtime_comp = $basic_pay / $working_days / 8 * $overtime * 1.25;

        // GROSS INCOME COMPUTATIONS
        $gross_income = ($basic_pay / 2) - $late_deduction - $absent_deduction - $under_time_deduction;

        // GOVERNMENT DEDUCTION COMPUTATION
        $sss_deduction = find_sss_deduction($gross_income);
        $pagibig_deduction = 100;
        $philhealth_deduction = $basic_pay * .02;
        $total_government_deductions = $sss_deduction + $pagibig_deduction + $philhealth_deduction;

        $taxable_income = $gross_income - $total_government_deductions;
        // return $taxable_income;
        $withholding_tax = find_withholding_tax($taxable_income, 'semi-monthly');
        $total = $taxable_income + $withholding_tax;
        $data['emp_code'] = 1231;
        $data['basic_pay'] = $basic_pay;
        $data['compensation'] = $compensation;
        $data['deduction'] = $deduction;
        $data['government_deduction'] = $total_government_deductions;
        $data['lates'] = $late_deduction;
        $data['undertime'] = $under_time_deduction;
        $data['absent'] = $absent_deduction;
        $data['overtime'] = $overtime_comp;
        $data['tax'] = $withholding_tax;
    }
}
