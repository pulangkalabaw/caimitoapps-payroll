<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\LibLeave;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $leaves = LibLeave::get();

        return apiReturn($leaves, 'Success!', 'success');
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
        $leave_id = rand(100000,999999);

        $validator = Validator::make($request->all(),[
            'leave_code' => 'required|unique:lib_leave,leave_code,'.$leave_id.',leave_id,deleted_at,NULL',
            'leave_name' => 'required',
            'leave_description' => 'nullable',
        ]);

        if(!$validator->fails()){

            $request['leave_id'] = $leave_id;
            $leave = LibLeave::create($request->except('at'));

            if($leave){
                return apiReturn($leave, 'Success!', 'success');
            }else{
                return apiReturn(null, 'Failed on insertion to database!', 'failed');
            }
        }else{
            return apiReturn(null, 'Invalid inputs!', 'failed', $validator->errors());
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
        //
        $leave = LibLeave::where('leave_id', $id)->first();
        if($leave){
            return apiReturn($leave, 'Success!', 'success');
        }else{
            return apiReturn(null, 'Failed!', 'failed');
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
        $validator = Validator::make($request->except('at'),[
            'leave_code' => 'required|unique:lib_leave,leave_code,'.$id.',leave_id,deleted_at,NULL',
            'leave_name' => 'required',
            'leave_description' => 'nullable',
        ]);

        if(!$validator->fails()){
            $leave = LibLeave::where('leave_id', $id)->update($request->except(['_method','at']));

            return apiReturn($leave, 'Success!', 'success', $validator->errors());
        }else{
            return apiReturn(null, 'failed!', 'failed', $validator->errors());
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
        $leave = LibLeave::where('leave_id',$id)->delete();

        if($leave){
            return apiReturn($leave, 'Success!', 'success');
        }else{
            return apiReturn(null, 'Failed!', 'failed');
        }
    }
}
