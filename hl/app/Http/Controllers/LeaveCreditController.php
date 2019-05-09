<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\LibLeave;
use App\LeaveCredits;
use App\Users;

// Controllers
use App\Http\Controllers\LeaveCreditAuditController;


class LeaveCreditController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Should get employees with their leave
        $users = Users::with(['LeaveCredits'])->paginate(10);

        $datatoreturn = [
            'data' => $users,
            'total' => $users->where('status',1)->count()
        ];
        return apiReturn($datatoreturn, 'Success on getting employees with leave credit', 'success');


        // OLD CODE****************
        // $leave_credits = LeaveCredits::paginate(10);

        // return apiReturn($leave_credits, 'Success!', 'success');
        // OLD CODE****************

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request->user_id;
        $validator = Validator::make($request->all(),[
            // 'user_id.*' => 'required|exists:users,user_id',
            'user_id' => 'required|exists:users,user_id',
            'employee_code' => 'required|exists:users,employee_code',
            'leave_id' => 'required|exists:lib_leave,leave_id',
            'credits' => 'required|numeric|between:0,9999.99',
            'update_type' => 'required',
            'reason' => 'required',
        ]);

        if(!$validator->fails()){
            // ******DO NOT DELETE CODE FOR NEW INSERT**************************
            // Check if this user has already this type of leave
            $exists = LeaveCredits::where(['user_id'=> $request->post('user_id'), 'leave_id' => $request->post('leave_id')])->first();

            if(!$exists){
                // insert data with calculated credit and insert the datas send to the credit changes table
                $datatotinsert = [
                    'user_id' => $request->post('user_id'),
                    'employee_code' => $request->post('employee_code'),
                    'leave_id' => $request->post('leave_id'),
                    'reason' => $request->post('reason'),
                    'credits' => $request->post('credits'),
                ];
                $leave_credit = LeaveCredits::create($datatotinsert);
                if($leave_credit){
                    $leave_audit = new LeaveCreditAuditController();
                    $leave_audit->store($request);
                    return apiReturn($leave_credit, 'Assigning of leave credit successful!', 'success');
                }else{
                    return apiReturn(null, 'Failed on leave credit insertion', 'success');
                }
            }else{
                // if there is already this kind of leave just substract or add the credit inputed and insert the datas send to the credit changes table
                if($request->update_type == 'add'){
                    $totalcredit = $exists->credits + $request->post('credits');
                }else{
                    $totalcredit = $exists->credits - $request->post('credits');
                    ($totalcredit <= 0 ) ? ($totalcredit = 0) : ($totalcredit);
                }
                $leave_audit = new LeaveCreditAuditController();
                $leave_audit->store($request);
                $leave_credit = LeaveCredits::where([
                    'user_id' => $request->post('user_id'),
                    'employee_code' => $request->post('employee_code'),
                    'leave_id' => $request->post('leave_id')
                ])->update(['credits'=>$totalcredit]);
                return apiReturn($exists, 'This user just updated their leave credit', 'success');
            }
            // ******DO NOT DELETE CODE FOR NEW INSERT**************************

            // ******DO NOT DELETE CODE FOR SINGLE INSERT**************************
            // Check of if this user is has already this type of leave
            // $exists = LeaveCredits::where(['user_id'=> $request->post('user_id'), 'leave_id' => $request->post('leave_id')])->first();
            // if(!$exists){
            //     // Insertion of credit
            //     $leave_credit = LeaveCredits::create($request->all());
            //     if($leave_credit){
            //         return apiReturn($leave_credit, 'Assigning of leave credit successful!', 'success');
            //     }else{
            //         return apiReturn(null, 'Failed on leave credit insertion', 'success');
            //     }
            // }else{
            //     return apiReturn($exists, 'This user have already this type of leave.', 'failed', $validator->errors());
            // }
            // ******DO NOT DELETE CODE FOR SINGLE INSERT**************************

            // ******DO NOT DELETE CODE FOR MULTIPLE INSERT**************************
            // foreach($request->user_id as $emp){
            //
            //     $exists = LeaveCredits::where(['user_id'=> $emp, 'leave_id' => $request->post('leave_id')])->first();
            //     if(!$exists){
            //         // Insertion of credit
            //         $leave_credit = LeaveCredits::create($request->all());
            //         if($leave_credit){
            //             return apiReturn($leave_credit, 'Assigning of leave credit successful!', 'success');
            //         }else{
            //             return apiReturn(null, 'Failed on leave credit insertion', 'success');
            //         }
            //     }else{
            //         return apiReturn($exists, 'This user have already this type of leave.', 'failed', $validator->errors());
            //     }
            //
            // }
            // ******DO NOT DELETE CODE FOR MULTIPLE INSERT**************************


        }else{
            return apiReturn(null, 'Failure on assignment of leave', 'failed', $validator->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show only this specific user leave credits (There sould also be show of specific user_id and leave_id)
        $leave_credit = LeaveCredits::where('user_id', $id)->get();
        if($leave_credit){
            return apiReturn($leave_credit, 'Success!', 'success');
        }else{
            return apiReturn(null, 'failed', 'failed');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,user_id',
            'leave_id' => 'required|exists:lib_leave,leave_id',
            'credits' => 'required|numeric|between:0,9999.99',
        ]);

        if(!$validator->fails()){

            $leave_credit = LeaveCredits::where(['user_id' => $request->post('user_id'), 'leave_id' => $request->post('leave_id')])->update($request->only('credits'));

            return apiReturn($leave_credit, 'Successfully udpated leave credit!', 'success');
        }else{
            return apiReturn(null, 'Failure on assignment of leave', 'failed', $validator->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
