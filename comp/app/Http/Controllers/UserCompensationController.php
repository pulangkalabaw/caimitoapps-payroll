<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\Compensation;
use App\UserCompensation;

class UserCompensationController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$user_compensation = new UserCompensation();

		$data = [
			'data' => $user_compensation->with(['getUser','getCompensation'])->paginate(10),
			'total' => $user_compensation->count()
		];

		return apiReturn($data, 'Success', 'success');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'compensation_id' => 'required',
			'taxable' => 'required',
			'user_id' => 'required|array',
			'user_id.*' => 'required|string|distinct',
		], [
			'user_id.required' => 'Please select one or more employee'
		]);

		if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

		$compensation = new Compensation();
		$user_compensation = new UserCompensation();

		// get the selected comepensation of the user
		$compensation = $compensation->where('compensation_id', $request['compensation_id'])->first();

		foreach($request['user_id'] as $user_id){
			$data[] = [
				'user_id' => $user_id,
				'compensation_id' => $request['compensation_id'],
				'amount' => $compensation['amount'],
				'taxable' => $request['taxable']
			];
		}

		if ($user_compensation->insert($data)) {
			return apiReturn($request->all(), 'Successfully assigned!', 'success');
		}
		else {
			return apiReturn([], 'Failed to assign', 'success');
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
		// give the compensation id
		$user_compensation = new UserCompensation();

		if(count($user_compensation) != 0) {
			$data['data'] = $user_compensation
			->where('compensation_id',$id)
			->with(['getUser','getCompensation'])
			->firstOrFail();
			$message = 'Success!';
			$status = 'success';
		} else {
			$user_compensation = null;
			$message = 'Failed no assign compensation!';
			$status = 'failed';
		}

		return apiReturn($data, $message, $status);
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
		// not tested yet
		$user_compensation = new UserCompensation();
		$compensation = new Compensation();

		$validator = Validatior::make($request->all(), [
			'compensation_id' => 'required'
		],[
			'compensation_id.required' => 'Please select a compensation!'
		]);

		if(!$validator->fails()){
			$compensation = $compensation->where('compensation_id',$request['compensation_id'])->firstOrFail();

			$user_compensation->where('user_id',$id)->update([
				'compensation_id' => $request['compensation_id']
			]);
		} else {
			return apiReturn(null, 'Failed updating compensation to user!', 'failed', $validator->errors());
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
		// create this after deduction
	}
}
