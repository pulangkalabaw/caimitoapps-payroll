<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\User;
use App\UserDetails;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $User = new User();
        // return response()->json($User->with(['UserDetails'])->get());

        return apiReturn($User->with(['UserDetails'])->get(), 'Success', 'success');
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
        //
        $User = new User();

        $validator = Validator::make($request->all(), [
            'employee_code' => 'required|unique:users|max:30',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if(!$validator->fails()){

          $User = new User();

          // Insertion to user table
          $userdata = $User->insert([
            'user_id' => str_random(15).mt_rand(100000, 999999),
            'employee_code' => $request->post('employee_code'),
            'lname' => $request->post('lname'),
            'fname' => $request->post('fname'),
            'mname' => $request->post('mname'),
            'email' => $request->post('email'),
            'password' => $request->post('password'),
          ]);

          // Insertion to user_details table
          

          return apiReturn($userdata, 'Successful on creation of employee!', 'success');
        }else{
          return apiReturn('heheh', 'Failure on creation of employee!', 'failed', $validator->errors());
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
