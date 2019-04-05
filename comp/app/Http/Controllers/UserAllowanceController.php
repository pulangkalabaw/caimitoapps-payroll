<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//Models
use App\Allowance;
use App\UserAllowance;

class UserAllowanceController extends Controller
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
        //return $request->all();
        $userallowance = new UserAllowance();

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'allowance_id' => 'required',
            'amount' => 'required|numeric'
        ],[
            'user_id.required' => 'Select a user!',
            'allowance_id.required' => 'Select a compensation!'
        ]);

        if(!$validator->fails()){
            $user_allowance = UserAllowance::create([
                'user_id' => $request['user_id'],
                'allowance_id' => $request['allowance_id'],
                'amount' => $request['amount'],
                'taxable' => $request['taxable']
            ]);

            return apiReturn($user_allowance, 'Added allowance to user!', 'success');

        } else {

            return apiReturn(null, 'Failed adding allowance to user!', 'failed', $validator->errors());

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
