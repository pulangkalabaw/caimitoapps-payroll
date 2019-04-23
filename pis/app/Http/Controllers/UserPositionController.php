<?php

namespace App\Http\Controllers;

// Models
use App\UserPosition;
use App\UserPositionHistory;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_position = new UserPosition();

        $data = $user_position->get();

        return apiReturn($data, 'Success', 'success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_position = new UserPosition();

        $validator = Validator::make($request->all(),[
            'user_id' => 'required|unique:user_position,user_id',
            'department_id' => 'required',
            'supervisor_id' => 'required',
            'title' => 'required',
            'date_start' => 'required|date|date_format:Y-m-d'
        ]);

        if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

        if($user_position->create($request->all())){
            return apiReturn($request->all(), 'Success', 'success');
        } else {
            return apiReturn([], 'Failed to assign position to employee!', 'error');
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
        $user_position = new UserPosition();

        $userdata['data'] = $user_position->with([
            'getUser',
            'getDepartment',
            'getSupervisor'
        ])
        ->where('user_id',$id)
        ->first();

        if($userdata){
            return apiReturn($userdata, 'Success', 'success');
        } else {
            return apiReturn(null, 'Employee not found!', 'failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user_position = new UserPosition();

        $validator = Validator::make($request->all(),[
            'department_id' => 'required',
            'supervisor_id' => 'required',
            'title' => 'required',
            'date_start' => 'required|date|date_format:Y-m-d'
        ]);

        if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

        if($user_position->where('user_id',$id)->update($request->except(['_method']))){
            return apiReturn($request->all(),'Successfully updated user!', 'success');
        } else {
            return apiReturn([],'Failed to update user', 'failed');
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
