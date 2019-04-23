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
        //return $request->all();
        $user_position = new UserPosition();

        $validator = Validator::make($request->all(),[
            'user_id' => 'required|unique:user_position,user_id',
            'department_id' => 'required',
            'supervisor_id' => 'required',
            'title' => 'required'
            'date_start' => 'required|add_date'
        ]);

        if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

        //if else for checking
        $user_position->create([
            'user_id' => $request['user_id'],
            'department_id' => $request['department_id'],
            'supervisor_id' => $request['supervisor_id'],

            'date_start' => Carbon::parse($request['date_start'])
            //'date_start' => $request['date_start']
        ]);

        return apiReturn($request->all(), 'Success', 'success');
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
        //
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
