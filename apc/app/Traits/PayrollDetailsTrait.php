<?php
namespace App\Traits;

// models
use App\UserPayrollDetails;

/*
*
* This trait handles the PayrollDetails of employee
*
*/

trait PayrollDetailsTrait
{
    // shows the Employee Payroll Details
    public function userPayrollDetails($user_id) {

        // Instance
        $user_payroll_details = new UserPayrollDetails();

        $data = $user_payroll_details->where('user_id', $user_id)
        ->get([
            'wage_type',
            'tax_computation',
            'working_days',
            'payout_type',
            'tax_code',
            'bank_name',
            'account_number',
            'sss_number as sss_no',
            'tin_number as tin_no',
            'hdmf_number as hdmf',
            'bank_details as bank_info'
        ]);

        return $data;
    }
}
