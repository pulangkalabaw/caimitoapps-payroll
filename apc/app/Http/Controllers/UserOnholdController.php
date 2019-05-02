<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\UserOnhold;

class UserOnholdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $user_onhold = new UserOnhold();

        $validator = Validator::make($request->all(),[
            'user_id' => 'required|string|min:3',
            'status' => 'required|numeric',
        ],[
            'user_id.required' => 'Please select Employee/s'
        ]);

        if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

        // Check if given employee already on hold
        if($user_onhold->where('user_id', $request->post('user_id'))) return apiReturn([],'This user is already onhold','failed');

        if(UserOnhold::create($request->all())){
            return apiReturn($request->all(), 'User on hold', 'success' );
        } else {
            return apiReturn([], 'Something went wrong!', 'failed');
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
