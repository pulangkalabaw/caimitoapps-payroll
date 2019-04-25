<?php

namespace App\Http\Controllers;

// models
use App\User;
use App\UserCompensation;
use App\UserDeduction;
use App\UserPayrollDetails;

use Illuminate\Http\Request;

class EmployeeInfoController extends Controller
{
    public function index(){

        $user = new User();

        // $employee_info = $user->get(['user_id','employee_code','fname','mname','lname','email'])->map(function ($r) {
        //     // models
        //     $user_compensation = new UserCompensation();
        //     $user_deduction = new UserDeduction();
        //     $user_payroll_details = new UserPayrollDetails();
        //
        //     $r['allowances'] = $user_compensation->where('user_id', $r['user_id'])->get(['compensation_id','amount']);
        //     $r['deductions'] = $user_deduction->where('user_id', $r['user_id'])->get(['deduction_id','amount']);
        //     $r['basic_salary'] = $user_payroll_details->where('user_id', $r['user_id'])->value('basic_salary');
        //     $r['wage_type'] = $user_payroll_details->where('user_id', $r['user_id'])->value('wage_type');
        //     $r['payout_type'] = $user_payroll_details->where('user_id', $r['user_id'])->value('payout_type');
        //     $r['bank_details'] = $user_payroll_details->where('user_id', $r['user_id'])->value('bank_details');
        //     return $r;
        // });

        // Structure Example:
        // [
        //   {
        //       employee_code: string,
        //       fullname: string,
        //       email: string,
        //       allowance: [
        //           { 'allowance_id': int, 'amount': float },
        //       ],
        //       deductions: [ // late? absences?
        //           { 'deduction_id': int , 'amount': float },
        //       ],
        //       basic_salary: float,
        //       wage_type: daily | semi-monthly | monthly,
        //       payout_type: cash | cheque | bank
        //       bank_details: nullable | string,
        //       leave_credit: >= 1 | .5
        //   }
        // ]

        $user_compensation = new UserCompensation();
        $user_deduction = new UserDeduction();
        $user_payroll_details = new UserPayrollDetails();

        foreach(User::get() as $user){
            $data[] = [
                'employee_code' => $user['employee_code'],
                'fullname' => $user['fname'] . ' ' . $user['lname'],
                'email' => $user['email'],
                // Compensation and allowances
                'allowance' => $user_compensation->where('user_id',$user['user_id'])->get(['compensation_id','amount','taxable']),
                'allowance_non-taxable_total' => $user_compensation->where(['user_id' => $user['user_id'], 'taxable' => 0])->sum('amount'),
                'allowance_taxable_total' => $user_compensation->where(['user_id' => $user['user_id'], 'taxable' => 1])->sum('amount'),
                'allowance_total' => $user_compensation->where('user_id', $user['user_id'])->sum('amount'),
                // Deduction and Goverment

            ];
        }

        return apiReturn($data, 'Success', 'success');
    }

}
