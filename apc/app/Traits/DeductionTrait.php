<?php
namespace App\Traits;

// models
use App\Deductions;
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
            "other_deductions" => $user_deduction->with(['getDeduction'])->where('user_id', $user_id)->whereHas('getDeduction', function ($query) {
                $query->where('type', 0);
            })->sum('amount'),

            "government_loans" => $user_deduction->with(['getDeduction'])->where('user_id', $user_id)->whereHas('getDeduction', function ($query) {
                $query->where('type', 1);
            })->sum('amount'),

            "total" => $user_deduction->where('user_id', $user_id)->sum('amount'),

            "data" => $this->userDeductionData($user_id),
        ];

        return $data;
    }

    //
    public function userDeductionData($user_id) {
        $user_deduction = new UserDeduction();
        $data = $user_deduction
        ->where('user_id', $user_id)
        ->get(['deduction_id as status','amount','name'])
        ->map(function ($query){

            $deduction = new Deductions();
            //
            $query['status'] = $deduction->where('deduction_id',$query['status'])->value('type');
            return $query;
        });

        return $data;
    }
}
