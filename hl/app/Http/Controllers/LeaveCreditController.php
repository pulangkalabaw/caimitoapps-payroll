<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\LibLeave;
use App\LeaveCredits;

class LeaveCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $leave_credits = LeaveCredits::paginate(10);

        return apiReturn($leave_credits, 'Success!', 'success');
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
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,user_id',
            'leave_id' => 'required|exists:lib_leave,leave_id',
            'credits' => 'required|numeric|between:0,9999.99',
        ]);

        if(!$validator->fails()){
            // Check of if this user is has already this type of leave
            $exists = LeaveCredits::where(['user_id'=> $request->post('user_id'), 'leave_id' => $request->post('leave_id')])->first();
            if(!$exists){
                // Insertion of credit
                $leave_credit = LeaveCredits::create($request->all());
                if($leave_credit){
                    return apiReturn($leave_credit, 'Assigning of leave credit successful!', 'success');
                }else{
                    return apiReturn(null, 'Failed on leave credit insertion', 'success');
                }
            }else{
                return apiReturn($exists, 'This user have already this type of leave.', 'failed', $validator->errors());
            }
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
