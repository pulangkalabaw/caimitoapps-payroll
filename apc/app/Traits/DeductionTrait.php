<?php
namespace App\Traits;

// models
use App\Deduction;
use App\UserDeduction;

/*
*
* This trait handles all the Deduction of Employees
*
*/

trait DeductionTrait
{
    //
    public function userDeduction($user_id) {

        $user_deduction = new UserDeduction();

        $data = [
            "other_deductions" => $user_deduction->where('user_id', $user_id)->where('type',0)->sum('amount'),
            "government_loans" => $user_deduction->where('user_id', $user_id)->where('type',1)->sum('amount'),
            "total" => $user_deduction->where('user_id', $user_id)->sum('amount'),
        ];

        return $data;
    }

    //
    public function userDeductionData($user_id) {

    }
}
