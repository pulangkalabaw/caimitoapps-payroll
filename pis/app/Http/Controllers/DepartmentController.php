<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

// Models
use App\Department;

class DepartmentController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		//
		$dept = new Department();
		$rows = $request->get('show') ? $request->get('show') : 10;


		if($request->has('filter')){

			if($request->get('filter') == 'all'){
				$dept = Department::with('department_head_info')->get();
			}
			else if($request->get('filter') == 'active') {
				$dept = Department::with('department_head_info')->where('status',1)->get();
			}
			else{
				$dept = Department::with('department_head_info')->where('status',1)->get();
			}
		}
		else{
			$dept = $dept->with('department_head_info')->paginate($rows);
		}

		$datareturn = [
			'data' => $dept,
			'total' => $dept->where('status',1)->count(),
		];

		return apiReturn($datareturn, 'Success', 'success');
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
		$validator = Validator::make($request->all(), [
			'department_name' => 'required|unique:departments',
		]);

		if(!$validator->fails()){

			$departmentdata = Department::create([
				'department_id' => rand(111111, 999999),
				'department_name' => $request->post('department_name'),
				'department_head' => $request->post('department_head'),
				'description' => $request->post('description'),
			]);

			return apiReturn($departmentdata, 'Success on adding of department', 'success');
		}else{
			return apiReturn(null, 'Failure on adding of department', 'failed', $validator->errors());
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
		$departmentdata = [
			'data' => Department::with('department_head_info')->where('department_id', $id)->first(),
		];

		if($departmentdata){
			return apiReturn($departmentdata, 'Success!', 'success');
		}else{
			return apiReturn(null, 'Deprtment does not exist!', 'failed');
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
		//
		$validator = Validator::make($request->all(), [
			'department_name' => 'required|unique:departments,department_name,'.$id.',department_id',
		]);

		if(!$validator->fails()){

			$departmentdata = Department::where('department_id', $id)->update([
				'department_name' => $request->post('department_name'),
				'department_head' => $request->post('department_head'),
				'description' => $request->post('description'),
			]);

			return apiReturn($departmentdata, 'Success on adding of department', 'success');
		}else{
			return apiReturn(null, 'Failure on adding of department', 'failed', $validator->errors());
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
		$departmentdata = Department::where('department_id',$id)->update(['status'=>0]);

		if($departmentdata){
			return apiReturn($departmentdata, 'Successful deletion of deparment!', 'success');
		}else{
			return apiReturn(null, 'Failure at deletion of deparment!', 'failed');
		}

	}
}
