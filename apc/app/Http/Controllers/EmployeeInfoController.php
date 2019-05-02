<?php

namespace App\Http\Controllers;

// models
use App\User;
use App\Compensation;
use App\UserCompensation;
use App\UserDeduction;
use App\UserPayrollDetails;

use Illuminate\Http\Request;

class EmployeeInfoController extends Controller
{
    public function index(){

        // $test = User::get()->chunk(2);
        // dd($test);

        foreach(User::get() as $user){
            $data[] = [
                'employee_code' => $user['employee_code'],
                'first_name' => $user['fname'],
                'last_name' => $user['lname'],
                'email' => $user['email'],

                // Basic Pay
                'basic_pay' => $this->userBasicPay($user['user_id']),

                // Payroll Details
                'payroll_details' => $this->userPayrollDetails($user['user_id']),

                // Compensation and allowances
                'compensations' => $this->userCompensation($user['user_id']),

                // Deduction and Goverment

            ];
        }

        return $data;
    }

    // computes the basic pay of the employee
    public function userBasicPay($user_id) {

        // Instance
        $user_payroll_details = new UserPayrollDetails();
        $user_compensation = new UserCompensation();

        // Variable
        $taxable = 0;

        // Calculation
        $working_days = $user_payroll_details->where('user_id',$user_id)->value('working_days');
        $work_day_multi = ($working_days == 5) ? 21.75 : 26.083;
        $min_wage = 537 * $work_day_multi;
        $basic_pay = $user_compensation->where('user_id',$user_id)->value('amount');

        // Check if the basic pay is taxable or not
        if($basic_pay > $min_wage) $taxable = 1;

        $data = [
            'status' => $taxable,
            'amount' => $basic_pay
        ];

        return $data;

    }

    // shows the Employee Payroll Details
    public function userPayrollDetails($user_id) {

        // Instance
        $user_payroll_details = new UserPayrollDetails();

        $data = $user_payroll_details->where('user_id', $user_id)
        ->get([
            'wage_type',
            'tax_computation',
            'working_days',
            'tax_code',
            'sss_number as sss_no',
            'tin_number as tin_no',
            'hdmf_number as hdmf',
            'bank_details as bank_info'
        ]);

        return $data[0];
    }

    // show the computation of employees allowances
    public function userCompensation($user_id) {

        $user_compensation = new UserCompensation();

        $data = [
            'taxable' => $user_compensation->where('user_id',$user_id)->where('compensation_id', '!=', 'BS098765')->where('taxable',1)->sum('amount'),
            'non_taxable' => $user_compensation->where('user_id',$user_id)->where('compensation_id', '!=', 'BS098765')->where('taxable',0)->sum('amount'),
            'total' => $user_compensation->where('user_id',$user_id)->where('compensation_id', '!=', 'BS098765')->sum('amount'),
            'data' => $this->userCompensationData($user_id)
        ];
        return $data;
    }

    // shows the Allowances of the employee
    // function will be called by userCompensation for getting the other compensation of employee
    public function userCompensationData($user_id) {

        $user_compensation = new UserCompensation();

        $data = $user_compensation
        ->where('user_id', $user_id)
        ->where('compensation_id','!=' ,'BS098765')
        ->get(['taxable','amount','compensation_id as name'])
        ->map(function ($r) {

            $compensation = new Compensation();

            $r['name'] = $compensation->where('compensation_id',$r['name'])->value('name');
            return $r;
        });

        return $data;
    }

}
