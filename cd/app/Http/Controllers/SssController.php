<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SssDeduction;
use Illuminate\Support\Facades\Input;

class SssController extends Controller
{
     public function index(){
        $sss_deduction =  SssDeduction::all();
        $data = $sss_deduction;
        return apiReturn($data, 'Success','success');
    }

    public function store(Request $request){
        $sss = SssDeduction::where('sss_code', '=', Input::get('sss_code'))->first();
        if($sss === null){
            $sss_deduction = SssDeduction::create([
                'sss_code' => $request->sss_code,
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
        }else{
            return "code is already exist";
        }
        
        return apiReturn($sss_deduction, 'Successfully assigned Deduction!', 'success');
    }

    public function show($id){
       $sss_deduction = SssDeduction::findOrFail($id);
       if($sss_deduction){
            return apiReturn($sss_deduction, 'Success', 'success');
       }else{
            return apiReturn(null,'Sss data does not exist!', 'failed');
       }
    }

    public function edit($id){
        // return   $SssDeduction = SssDeduction::findOrFail($id);
    }

    public function update(Request $request, $id){

        $sss = SssDeduction::where('sss_code', '=', Input::get('sss_code'))->first();
        if($sss === null){
            $sss_deduction = SssDeduction::findOrFail($id)
            ->update([  
                'sss_code' => $request->sss_code,
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
            if($sss_deduction){
                return apiReturn($sss_deduction, 'SSS has been updated Successfully', 'success');
            }else{
                return apiReturn(null, 'Updating failed');
            }
        }else{
            return "sss_code already exist";
        }

    }

     public function destroy($id){
         $sss_deduction = SssDeduction::findOrFail($id)->delete();
         if($sss_deduction){
            return apiReturn($sss_deduction, 'SSS deduction has been deleted successfully', 'success');
         }else{
            return apiReturn(null, 'SSS is not deleted', 'fail');
         }
    }
}
