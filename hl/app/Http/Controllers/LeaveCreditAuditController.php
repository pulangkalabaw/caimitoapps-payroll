<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// Model
use App\LeaveCreditAudit;

class LeaveCreditAuditController extends Controller
{
    //
    public function index(){
        return LeaveCreditAudit::where(['user_id' => $request->user])->get();
        return 'index';
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'user_id' => "required|exists:users,user_id",
            'employee_code' => "required|exists:users,employee_code",
            'leave_id' => "required|exists:lib_leave,leave_id",
            'credits' => "required|numeric|between:0,9999.99",
            'credits_before' => "required|numeric|between:0,9999.99",
            'update_type' => "required",
            'reason' => "required",
        ]);

        if(!$validator->fails()){

            // dd($request->all());
            $leave_credit_audit = LeaveCreditAudit::create($request->except('at'));
            if($leave_credit_audit){
                return 'this does not fail';
            }else{
                return 'this fails';
            }
        }else{
            return apireturn(null, 'failed', 'failed', $validator->errors());
        }
    }

    public function show($user_id){
        if($user_id){
            $leave_credits = LeaveCreditAudit::where(['user_id' => $user_id])->with('Leave')->orderBy('created_at', 'DESC')->paginate(10);
            return apiReturn($leave_credits, 'Success on getting leave credit history', 'success');
        }else{
            // $leave_credits = LeaveCreditAudit::where(['user_id' => $request->user_id])->get();
            return 'no data is here';
        }

    }
}
