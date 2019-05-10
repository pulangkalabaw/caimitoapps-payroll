<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sample;
use App\Payroll_Process;
use Carbon\Carbon;

class SamplesController extends Controller {

    // const MODEL = "App\Sample";

    public function computation($data){

        // From PIS
        $basic_pay_status = $data['basic_pay']['status'];
        $basic_pay = $data['basic_pay']['amount'];
        $semi_month = $basic_pay / 2;

        // Compensations
        $compensations['taxable'] = $data['compensations']['taxable'];
        $compensations['non_taxable'] = $data['compensations']['non_taxable'];
        $compensations['total'] = $data['compensations']['total'];
        $compensations['data'] = $data['compensations']['data'];

        if($data['payroll_details']['working_days'] == 5){

            $working_days = 21.75;
        } else if($data['payroll_details']['working_days'] == 6){

            $working_days = 26.083;
        }

        // DEDUCTIONS
        $absences = $data['timekeeping']['absences'];
        $absent_deduction = compute_absence($basic_pay, $working_days, $absences);

        $lates = $data['timekeeping']['lates'];
        $late_deduction = compute_late($basic_pay, $working_days, $lates);

        $under_times = $data['timekeeping']['ut'];
        $under_time_deduction = compute_under_time($basic_pay, $working_days, $under_times);

        $leaves = $data['timekeeping']['leaves'];

        $alu = $absent_deduction + $late_deduction + $under_time_deduction;

        // $deduction = $data['deductions']['total']; // ?

        // Overtime
        $ots = $data['timekeeping']['ot'];
        $sum_overtime = 0;
        foreach($ots as $index => $ot){
            $overtime = $ot['value'];
            $ot_type = $ot['type'];
            $overtime_comp = compute_overtime($basic_pay, $working_days, $overtime, $ot_type);
            $sum_overtime += $overtime_comp;
        }

        // Gross Income Computation
        $gross_income = compute_gross_income($semi_month, $compensations['total'], $sum_overtime);

        // GOVERNMENT DEDUCTION COMPUTATION
        $sss_deduction = find_sss_deduction($gross_income);
        $pagibig_deduction = 100;
        $philhealth_deduction = compute_phic($semi_month);
        $total_government_deductions = compute_government_deductions($sss_deduction, $pagibig_deduction, $philhealth_deduction);

        // WITHHOLDING TAX
        if($basic_pay_status == 1){

            $taxable_income = $semi_month + $compensations['taxable'] + $sum_overtime - $total_government_deductions - $alu;
        } else if($basic_pay_status == 0) {

            // $taxable_income = $compensations['taxable'] + $sum_overtime - $total_government_deductions ;
        }

        // COMPUTE THE WITHHOLDING TAX
        $withholding_tax = find_withholding_tax($taxable_income, 'semi-monthly');


        // TOTAL DEDUCTIONS
        $deductions['other_deductions'] = $data['deductions']['other_deductions'];
        $deductions['government_loans'] = $data['deductions']['government_loans'];
        $deductions['total'] = $data['deductions']['total'];
        $deductions['data'] = $data['deductions']['data'];
        $total_deductions = $alu + $withholding_tax + $deductions['total'] + $total_government_deductions;

        // COMPUTE THE NET PAY (SAHUUUUUUUUUUUUUUUUD)
        $net_pay = $compensations['total'] + $semi_month + $sum_overtime - $total_deductions;

        // Payroll Details
        $payroll_details = [
            'wage_type' => $data['payroll_details']['wage_type'],
            'tax_computation' => $data['payroll_details']['tax_computation'],
            'working_days' => $data['payroll_details']['working_days'],
            'tax_code' => $data['payroll_details']['tax_code'],
            'sss_no' => $data['payroll_details']['sss_no'],
            'tin_no' => $data['payroll_details']['tin_no'],
            'hdmf' => $data['payroll_details']['hdmf'],
            'bank_info' => $data['payroll_details']['bank_info'],
        ];

        $other_info = [
            'date_hired' => $data['payroll_details']['wage_type'],
        ];

        // Basic Informations
        $result['emp_code'] = $data['emp_code'];
        $result['first_name'] = $data['first_name'];
        $result['last_name'] = $data['last_name'];
        $result['email'] = $data['email'];

        $result['basic_pay_type'] = $basic_pay_status;
        $result['basic_pay'] = $basic_pay;

        // Compensations
        $result['taxable_compensation'] = $compensations['taxable'];
        $result['nontaxable_compensation'] = $compensations['non_taxable'];
        $result['total_compensation'] = $compensations['total'];
        $result['compensation_data'] = $compensations['data'];

        // Deductions
        $result['other_deductions'] = $deductions['other_deductions'];
        $result['government_loans'] = $deductions['government_loans'];
        $result['total_deductions'] = $deductions['total'];
        $result['deduction_data'] = $deductions['data'];

        // Government Deductions
        $result['sss_deduction'] = $sss_deduction;
        $result['pagibig_deduction'] = $pagibig_deduction;
        $result['philhealth_deduction'] = $philhealth_deduction;
        $result['total_government_deduction'] = $total_government_deductions;

        // Timekeeping
        $result['lates'] = $late_deduction;
        $result['undertime'] = $under_time_deduction;
        $result['absences'] = $absent_deduction;
        $result['overtime'] = $sum_overtime;
        $result['overtime_data'] = $ots;
        $result['leaves'] = $leaves;

        $result['taxable_income'] = $taxable_income;
        $result['withholding_tax'] = $withholding_tax;

        $result['gross_income'] = $gross_income;
        $result['net_pay'] = $net_pay;

        $result['payroll_details'] = $payroll_details;
        $result['other_info'] = $other_info;

        $result['run_date'] = Carbon::now()->toDateString();
        // return Payroll_Process::all();

        Payroll_Process::create($result);
        return $result;
    }

    public function getGovernmentSSSDeduction(){
        return sss_deduction();
    }

    public function pis_timekeeping(){

        $pis_api = pis_api();

        $tk_api = tk_api();

        $payroll_process = [];

        foreach($pis_api as $index => $pis){

            if ( isset( $tk_api[$index] ) ) {

                if($pis['emp_code'] == $tk_api[$index]['emp_code']){
                    $pis['timekeeping'] = [
                        'ot' => $tk_api[$index]['ot'],
                        'lates' => $tk_api[$index]['lates'],
                        'ut' => $tk_api[$index]['ut'],
                        'absences' => $tk_api[$index]['absences'],
                        'leaves' => $tk_api[$index]['leaves'],
                    ];

                    // return $pis;
                    return $payroll_process[] = $this->computation($pis);
                }

            }
        }
        return $payroll_process[0];
    }
}
