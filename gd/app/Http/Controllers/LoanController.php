<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loan_deduction;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index(){
        $govt_loan = loan_deduction::all();
        $data = $govt_loan;
        return apireturn($data, 'Success', 'success');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'loan_name' => 'required|string|min:3',
            'amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'loan_term' => 'required|numeric',
            'monthly_amortization' => 'required|numeric',
        ]);

        $govt_loan = loan_deduction::create([
            'loan_name' => $request->loan_name,
            'amount' => $request->amount,
            'interest_rate' => $request->interest_rate,
            'loan_term' => $request->loan_term,
            'monthly_amortization' => $request->monthly_amortization,
        ]);

    	return apiReturn($govt_loan, 'Government loan has been created successfully'. 'success');
    }

    public function show($id){
        $govt_loan = loan_deduction::findOrFail($id);
        return apiReturn($govt_loan, 'Successfully', 'success'); 
    }

    public function edit($id){

    	
    }

    public function update(Request $request, $id){
        $govt_loan = loan_deduction::findOrFail($id)->update([
            'loan_name' => $request->loan_name,
            'amount' => $request->amount,
            'interest_rate' => $request->interest_rate,
            'loan_term' => $request->loan_term,
            'monthly_amortization' => $request->monthly_amortization,
        ]);
    	return apiReturn($govt_loan, 'Loan has been updated successfully', 'success');
    }

    public function destroy($id){
        $govt_loan = loan_deduction::findOrFail($id)->delete();
        return apiReturn($govt_loan, 'Loan has been deleted successfully', 'success');
    }
}
