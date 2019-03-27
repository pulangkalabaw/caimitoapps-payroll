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
        $departments = Department::paginate(10);

        if($request->has('show')){

            if($request->get('show') == 'all'){
                $departments = Department::get();
            }

            else {
                $departments = Department::paginate($request->get('show'));
            }

        }

        $datareturn = [
            'data' => $departments,
            'total' => Department::count(),
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
            'department_name' => 'required',
            'description' => 'required',
        ]);

        if(!$validator->fails()){

            $departmentdata = Department::create([
                'department_id' => rand(111111, 999999),
                'department_name' => $request->post('department_name'),
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
        $departmentdata = Department::where('department_id', $id)->first();

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
