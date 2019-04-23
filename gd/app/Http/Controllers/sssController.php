<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sss_table;

class sssController extends Controller
{
     public function index(){
         $sss_table =  sss_table::all();
         $data = $sss_table;
         return apiReturn($data, 'Success','success');
    }

    public function store(Request $request){

        $sss_table = sss_table::create([
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
        $data = $sss_table;
        return apiReturn($data, 'Successfully assigned Deduction!', 'success');
    }

    public function show($id){
        return  $sss_table = sss_table::findOrFail($id);
    }

    public function edit($id){
        // return   $sss_table = sss_table::findOrFail($id);
    }

    public function update(Request $request, $id){

        $sss_table = sss_table::findOrFail($id)
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
         $sss_table = sss_table::findOrFail($id)->delete();
         return "Data has been deleted";
    }
}
