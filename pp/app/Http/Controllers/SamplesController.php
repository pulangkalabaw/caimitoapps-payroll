<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sample;
use App\Payroll_Process;
use Carbon\Carbon;

class SamplesController extends Controller {

    // const MODEL = "App\Sample";

    public function index(){
        // return $result = guzzle('GET',env('API_PIS') . 'employee-info');
        // return $result = guzzle('GET',env('API_GD') . 'gd/government-deductions');
        // return sss_deduction();
        // return sss_deduction_bak();

        // From PIS
        $basic_pay = 13000.00;

        $allowances = 0;

        $working_days = 21.75;

        // DEDUCTIONS
        $lates = 0.43;
        $late_deduction = compute_late($basic_pay, $working_days, $lates);

        $absences = 4;
        $absent_deduction = compute_absence($basic_pay, $working_days, $absences);

        $under_times = 0.9;
        $under_time_deduction = compute_under_time($basic_pay, $working_days, $under_times);

        $deduction = 0;
        $deductions = compute_deductions($late_deduction, $absent_deduction, $under_time_deduction, $deduction);

        // COMPENSATIONS
        $compensations = 0;
        $overtime = 3.00;
        $ot_type = 'regot';
        $ot_percentage = get_ot($ot_type);
        $overtime_comp = compute_overtime($basic_pay, $working_days, $overtime, $ot_type);

        // GROSS INCOME COMPUTATIONS
        $gross_income = compute_gross_income($basic_pay, $late_deduction, $absent_deduction, $under_time_deduction);

        // GOVERNMENT DEDUCTION COMPUTATION
        $sss_deduction = find_sss_deduction($gross_income);
        $pagibig_deduction = 100;
        $philhealth_deduction = $basic_pay * .0275;
        $government_loan = 0;
        $total_government_deductions = compute_government_deductions($sss_deduction, $pagibig_deduction, $philhealth_deduction);

        // WITHHOLDING TAX
        $taxable_income = $gross_income - $total_government_deductions;
        $withholding_tax = find_withholding_tax($taxable_income, 'semi-monthly');

        // NON TAXABLE
        $nontaxable_income = $taxable_income - $withholding_tax - $deductions + $allowances;

        $total = $taxable_income + $withholding_tax;
        $data['emp_code'] = 1231;
        $data['basic_salary'] = $basic_pay;
        $data['gross_income'] = $gross_income;
        $data['compensation'] = $compensations;
        $data['deductions'] = $deductions;
        $data['sss_deduction'] = $sss_deduction;
        $data['pagibig_deduction'] = $pagibig_deduction;
        $data['philhealth_deduction'] = $philhealth_deduction;
        $data['government_loan'] = $government_loan;
        $data['total_government_deduction'] = $total_government_deductions;
        $data['lates'] = $late_deduction;
        $data['undertime'] = $under_time_deduction;
        $data['absences'] = $absent_deduction;
        $data['overtime'] = $overtime_comp;
        $data['taxable'] = $taxable_income;
        $data['non_taxable'] = $withholding_tax;
        $data['tax'] = $taxable_income;
        $data['total'] = $gross_income;
        $data['run_date'] = Carbon::now()->toDateString();
        // return Payroll_Process::all();
        return $data;
        Payroll_Process::create($data);
    }

    public function getGovernmentSSSDeduction(){
        return sss_deduction();
    }

    public function apiCombine(){

    }
}
