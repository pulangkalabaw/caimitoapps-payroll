<?php
namespace App\Traits;

// models
use App\Compensation;
use App\UserCompensation;
use App\UserPayrollDetails;

/*
*
* This Trait handles all the Compensation of Employees
*
*/

trait CompensationTrait
{
    // Global Variables
    // this variable can be change that will depend on the law
    // Future Suggestion: we can create a table management for this
    private $FINAL_5_DAYS = 5;
    private $FINAL_6_DAYS = 6;
    private $FINAL_FIVE_WORKING_DAYS = 21.75;
    private $FINAL_SIX_WORKING_DAYS = 26.083;
    private $FINAL_WAGE = 537;

    // computes the basic pay of the employee
    public function userBasicPay($user_id) {

        // Instance
        $user_payroll_details = new UserPayrollDetails();
        $user_compensation = new UserCompensation();

        // Variable
        $taxable = 0;

        // Calculation
        $working_days = $user_payroll_details->where('user_id',$user_id)->value('working_days');
        $work_day_multi = ($working_days == $this->FINAL_5_DAYS) ? $this->FINAL_FIVE_WORKING_DAYS : $this->FINAL_SIX_WORKING_DAYS;
        $min_wage = $this->FINAL_WAGE * $work_day_multi;
        $basic_pay = $user_compensation->where('user_id',$user_id)->value('amount');
        // dd($min_wage);

        // Check if the basic pay is taxable or not
        if($basic_pay > $min_wage) $taxable = 1;

        $data = [
            'status' => $taxable,
            'amount' => $basic_pay
        ];

        return $data;

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
            // Get the name of the compensation base on the id
            $r['name'] = $compensation->where('compensation_id',$r['name'])->value('name');
            return $r;
        });

        return $data;
    }
}
