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

        $compensations['taxable'] = $data['compensations']['taxable'];
        $compensations['non_taxable'] = $data['compensations']['non_taxable'];
        $compensations['total'] = $data['compensations']['total'];

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

        $alu = $absent_deduction + $late_deduction + $under_time_deduction;

        // $deduction = $data['deductions']['total']; // ?

        // COMPENSATIONS
        $total_compensations = $data['compensations']['total'];
        $ots = $data['timekeeping']['ot'];
        $sum_overtime = 0;
        foreach($ots as $index => $ot){
            $overtime = $ot['value'];
            $ot_type = $ot['type'];
            $overtime_comp = compute_overtime($basic_pay, $working_days, $overtime, $ot_type);
            $sum_overtime += $overtime_comp;
        }

        // GROSS INCOME COMPUTATIONS
        $gross_income = compute_gross_income($semi_month, $total_compensations, $sum_overtime);

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
        $gov_other_deduction = $data['deductions']['total'];
        // return $withholding_tax;
        $total_deductions = $alu + $withholding_tax + $gov_other_deduction + $total_government_deductions;

        // COMPUTE THE NET PAY (SAHUUUUUUUUUUUUUUUUD)
        // return $semi_month;
        $net_pay = $compensations['total'] + $semi_month + $sum_overtime - $total_deductions;

        // Net Income

        $total = $taxable_income + $withholding_tax;
        $result['emp_code'] = $data['emp_code'];
        $result['basic_salary'] = $basic_pay;
        $result['gross_income'] = $gross_income;
        $result['compensation'] = $compensations;
        $result['deductions'] = $deductions;
        $result['sss_deduction'] = $sss_deduction;
        $result['pagibig_deduction'] = $pagibig_deduction;
        $result['philhealth_deduction'] = $philhealth_deduction;
        $result['government_loan'] = $data['deductions']['government_loans'];
        $result['total_government_deduction'] = $total_government_deductions;
        $result['lates'] = $late_deduction;
        $result['undertime'] = $under_time_deduction;
        $result['absences'] = $absent_deduction;
        $result['overtime'] = $sum_overtime;
        $result['taxable'] = $taxable_income;
        // $result['non_taxable'] = $withholding_tax;
        $result['tax'] = $withholding_tax;
        $result['total'] = $gross_income;
        $result['run_date'] = Carbon::now()->toDateString();
        // return Payroll_Process::all();
        return $result;
        Payroll_Process::create($data);
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
