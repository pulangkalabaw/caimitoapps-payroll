<?php

namespace App\Http\Controllers;

// models
use App\User;

// traits
use App\Traits\CompensationTrait;
use App\Traits\PayrollDetailsTrait;
use App\Traits\DeductionTrait;

use Illuminate\Http\Request;

class EmployeeInfoController extends Controller
{
    // Traits usage
    use CompensationTrait;
    use PayrollDetailsTrait;
    use DeductionTrait;

    public function index(){

        // Try other ways to make the request faster

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
                'deductions' => $this->userDeduction($user['user_id']),

            ];
        }

        return $data;
    }

}
