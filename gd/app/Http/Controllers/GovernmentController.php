<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sss_deduction;

class GovernmentController extends Controller
{
    public function index(){

    	return sss_deduction::all();
    }

    public function store(Request $request){

    	sss_deduction::create([
    		'from' => $request->from,
    		'to' => $request->to,
    		'monthly_salary_credit' => $request->monthly_salary_credit,
    		'social_security_er' => $request->social_security_er,
    		'social_security_ee' => $request->social_security_ee,
    		'social_security_total' => $request->social_security_total,
    		'ec_er' => $request->ec_er,
    		'total_contribution_er' => $request->total_contribution_er,
    		'total_contribution_ee' => $request->total_contribution_ee,
    		'total_contribution_total' => $request->total_contribution_total,
    	]);

    	return "Successfully inserted";
    }

    public function show($id){
    	return 	$sss_deduction = sss_deduction::findOrFail($id);
    }

    public function edit($id){
    	// return 	$sss_deduction = sss_deduction::findOrFail($id);
    }

    public function update(Request $request, $id){

			$sss_deduction = sss_deduction::findOrFail($id)
				->update([
					'from' => $request->from,
					'to' => $request->to,
					'monthly_salary_credit' => $request->monthly_salary_credit,
					'social_security_er' => $request->social_security_er,
					'social_security_ee' => $request->social_security_ee,
					'social_security_total' => $request->social_security_total,
					'ec_er' => $request->ec_er,
					'total_contribution_er' => $request->total_contribution_er,
					'total_contribution_ee' => $request->total_contribution_ee,
					'total_contribution_total' => $request->total_contribution_total,
				]);
				return "SSS Deduction has been updated successfully";
    }

     public function destroy($id){
     	 $sss_deduction = sss_deduction::findOrFail($id)->delete();
     	 return "Data has been deleted";
    }
}
