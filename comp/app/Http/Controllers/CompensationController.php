<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\Compensation;

class CompensationController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		$compensation_model = new Compensation();
		$rows = $request->get('show') ? $request->get('show') : 10;

		if($request->has('filter')) {

			if($request->get('filter') == 'all') {
				$compensation = Compensation::get();
			}

			else if($request->get('filter') == 'active') {
				$compensation = Compensation::get();
			}

			else {
				$compensation = Compensation::get();
			}
		}
		else {
			$compensation = Compensation::paginate($rows);
		}

		$datareturn = [
			'data' => $compensation,
			'total' => $compensation_model->count(),
		];

		return apiReturn($datareturn, 'Success', 'success');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$compensation = new Compensation();

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'amount' => 'numeric',
			'type' => 'required|max:50',
			'code' => 'required'
		]);

		if($validator->fails()) return apiReturn([], 'Validation Failed', $validator->errors());

		$compensation_id = str_random(15).rand(1111,9999);

		$compensation_data = Compensation::create([
			'compensation_id' => $compensation_id,
			'name' => $request->post('name'),
			'amount' => $request->post('amount'),
			'taxable' => $request->post('taxable'),
			'type' => $request->post('type'),
			'code' => $request->post('code')
		]);

		if($compensation_data){
			return apiReturn($compensation_data, 'Added Successful', 'success');
		} else {
			return apiReturn([], 'Failure to create compensation!', 'failed', 'error');
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
		$compensation = new Compensation();

		$compensation_data = $compensation->where('compensation_id',$id)->first();

		if ($compensation_data) {
			return apiReturn($compensation_data, 'Success', 'success');
		}
		else {
			return apiReturn([], 'This allowance does not exists!', 'failed');
		}



		return apiReturn($compensation_data, 'Success!', 'success');
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
		// Note: this function will update the user compensation insatanlly
		// if need be you can change the code to exclude an employee from updating their compensation
		$compensation = new Compensation();

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'amount' => 'required|numeric',
			'type' => 'required|max:50'
		]);

		if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

		$compensation = $compensation->where('compensation_id', $id)->update([
			'name' => $request['name'],
			'amount' => $request['amount'],
			'taxable' => $request['taxable'],
			'type' => $request['type'],
			'code' => $request['code']
		]);

		if($compensation){
			return apiReturn($request->all(), 'Update compete!', 'success');
		} else {
			return apiReturn(null, 'Failed to update!', 'failed', $validator->errors());
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
		$compensation = new Compensation();

		$compensation_data = $compensation->where('compensation_id',$id)->first();

		$compensation->where('compensation_id',$id)->delete();

		return apiReturn($compensation_data, 'Successfully Deleted!', 'success');
	}
}
