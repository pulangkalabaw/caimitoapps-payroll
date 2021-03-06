<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\User;
use App\Compensation;
use App\UserCompensation;
use App\UserCompensationHistory;

// Traits
use App\Traits\CompensationHistoryTrait;

class UserCompensationController extends Controller
{

	// Trait usage
	use CompensationHistoryTrait;

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		$user_compensation = new UserCompensation();

		$user_compensation_data = $user_compensation->with(['getUser','getCompensation'])->paginate(10);

		if($request->has('filter')){
			if($request->get('filter') == 'all') {
				$user_compensation_data = $user_compensation->withTrashed()->paginate(10);
			} else if($request->get('filter') == 'active') {
				$user_compensation_data = $user_compensation->paginate(10);
			} else if ($request->get('filter') == 'inactive') {
				$user_compensation_data = $user_compensation->onlyTrashed()->paginate(10);
			}
		}

		$data = [
			'data' => $user_compensation_data,
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
			'user_id' => 'required|array',
			'user_id.*' => 'required|string|distinct',
			'date_start' => 'required|date|date_format:Y-m-d',
		]);

		if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

		$compensation = new Compensation();
		$user_compensation = new UserCompensation();

		// get the selected comepensation of the user
		$compensation = $compensation->where('compensation_id', $request->post('compensation_id'))->first();

		// this will check if the given compensation is fixed or variable
		if($compensation['type'] == 'fixed'){
			// if the type is fixed copy the compensation amount
			$compensation_amount = $compensation['amount'];
		} else if($compensation['type'] == 'variable') {
			// else if the type is variable get the request amount
			if($request->post('amount') == null) return apiReturn([], 'Error please input amount!', 'error');
			$compensation_amount = $request->post('amount');
		} else {
			// else show error that compensation type was not set
			return apiReturn([], 'Error compensation type not set!', 'error');
		}

		foreach($request->post('user_id') as $user_id){

			$data[] = [
				'user_id' => $user_id,
				'compensation_id' => $request->post('compensation_id'),
				'user_compensation_id' => $user_id.'u'.rand(111,999),
				'amount' => $compensation_amount,
				'taxable' => $request->post('taxable'),
				'type' => $compensation['type'],
				'date_start' => $request->post('date_start')
			];
		}

		// Check if this setup is already exist
		$check_user_compensation = UserCompensation::whereIn('user_id', $request['user_id'])->where('compensation_id', $request->post('compensation_id'))->get();

		if(count($check_user_compensation)){
			return apiReturn([], 'This context already exist!', 'failed');
		}

		// Add to CompensationHistory of employee
		foreach($request->post('user_id') as $user_id){
			$this->storeMultiHistory($user_id);
		}

		if ($user_compensation->insert($data)) {
			return apiReturn($data, 'Successfully assigned!', 'success');
		}
		else {
			return apiReturn([], 'Failed to assign', 'failed');
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
	public function update(Request $request, $user_compensation_id)
	{
		// Note: before updating the compensation assign to user log it first to user_compensation_history table
		// give the user_compensation_id for update a specific user
		$user_compensation = new UserCompensation();
		$compensation = new Compensation();

		$validator = Validator::make($request->all(), [
			'compensation_id' => 'required',
			'date_start' => 'required|date|date_format:Y-m-d'
		],[
			'compensation_id.required' => 'Please select a compensation!'
		]);

		if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

		$compensation = $compensation->where('compensation_id',$request['compensation_id'])->first();

		// this will check if the given compensation is fixed or variable
		if($compensation['type'] == 'fixed'){
			// if the type is fixed copy the compensation amount
			$compensation_amount = $compensation['amount'];
		} else if($compensation['type'] == 'variable') {
			// else if the type is variable get the request amount
			$compensation_amount = $request['amount'];
		} else {
			// else show error that compensation type was not set
			return apiReturn([], 'Error compensation type not set!', 'error');
		}

		$user_compensation = $user_compensation->where('user_id',$id)->update([
			'compensation_id' => $request['compensation_id'],
			'amount' => $compensation_amount,
			'taxable' => $request['type'],
			'date_start' => $request['date_start']
		]);

		if($user_compensation){
			return apiReturn($request->all(), 'Successfully assigned!', 'success');
		} else {
			return apiReturn([], 'Failed updating compensation to user!', 'failed', $validator->errors());
		}
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Request $request, $id)
	{
		$user_compensation = new UserCompensation();

		// Take note
		// Before you delete the user compensation
		// copy that row to user compensation history

		if($user_compensation->where('id', $request['uc_id'])->delete()){
			return apiReturn([], 'Remove Successful' ,'success');
		} else {
			return apiReturn([], 'Failed to remove' ,'failed');
		}
	}
}
