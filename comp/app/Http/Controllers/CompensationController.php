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
	public function index()
	{
		$compensation = new Compensation();

		$data = [
			'data' => $compensation->paginate(10),
			'total' => $compensation->count()
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
		$compensation = new Compensation();

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'amount' => 'required|numeric'
		]);

		if(!$validator->fails()){

			$compensation_id = str_random(15).rand(1111,9999);

			$compensation_data = Compensation::create([
				'compensation_id' => $compensation_id,
				'name' => $request['name'],
				'amount' => $request['amount'],
				'taxable' => $request['taxable']
			]);

			return apiReturn($compensation_data, 'Successful on update of allowance!', 'success');

		} else {

			return apiReturn(null, 'Failure on update of allowance!', 'failed', $validator->errors());

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

		$compensation_data['data'] = $compensation->where('compensation_id',$id)->first();

		if ($compensation_data) {
            return apiReturn($compensation_data, 'Success', 'success');
        }
		else {
            return apiReturn(null, 'This allowance does not exists!', 'failed');
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
			'amount' => 'required|numeric'
		]);

		if(!$validator->fails()){

			$compensation->where('compensation_id', $id)->update([
				'name' => $request['name'],
				'amount' => $request['amount'],
				'taxable' => $request['taxable']
			]);

			$compensation_data = $compensation->where('compensation_id', $id)->first();

			return apiReturn($compensation_data, 'Update compete!', 'success');

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
