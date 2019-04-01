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
        $departments = Department::with(['DepartmentHead'])->where('status',1)->paginate(10);

        if($request->has('show')){

            if($request->get('show') == 'all'){
                $departments = Department::with(['DepartmentHead'])->where('status',1)->get();
            }

            else {
                $departments = Department::with(['DepartmentHead'])->where('status',1)->paginate($request->get('show'));
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
        $department_id = rand(111111, 999999);
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|unique:departments,department_name,'.$department_id.',department_id,status,1',
            'department_head' => 'nullable',
            'description' => 'nullable',
            'created_by' => 'nullable',
        ]);

        if(!$validator->fails()){

            $departmentdata = Department::create([
                'department_id' => $department_id,
                'department_name' => $request->post('department_name'),
                'department_head' => (!empty($request->post('department_head'))) ? $request->post('department_head') : null,
                'description' => (!empty($request->post('description'))) ? $request->post('description') : null ,
                'created_by' => (!empty($request->post('created_by'))) ? $request->post('created_by') : null,
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
            'data' => Department::with(['DepartmentHead'])->where('department_id', $id)->where('status',1)->first(),
        ];

        if($departmentdata['data']){
            return apiReturn($departmentdata, 'Success!', 'success');
        }else{
            return apiReturn(null, 'Department does not exist!', 'failed');
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
            'department_name' => 'required|unique:departments,department_name,'.$id.',department_id,status,1',
            'department_head' => 'nullable',
            'description' => 'nullable',
        ]);

        if(!$validator->fails()){

            $departmentdata = Department::where('department_id', $id)->update([
                'department_name' => $request->post('department_name'),
                'department_head' => $request->post('department_head'),
                'description' => $request->post('description'),
            ]);

            return apiReturn($departmentdata, 'Success on update of department', 'success');
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
    public function destroy(Request $request,$id)
    {
        //



        $departmentdata = Department::where('department_id',$id)->update(['status'=>0]);

        if($departmentdata){
            return apiReturn($departmentdata, 'Successful deletion of deparment!', 'success');
        }else{
            return apiReturn(null, 'Failure at deletion of deparment!', 'failed');
        }



    }

    // For restoration of department
    public function restore(Request $request, $id){
        $department_name = Department::where('department_id',$id)->first()->department_name;

        if(!empty($department_name)){
            $request['department_name'] = $department_name;
            $validator = Validator::make($request->all(), [
                'department_name' => 'required|unique:departments,department_name,'.$id.',department_id,status,1',
            ]);

            if(!$validator->fails()){
                $departmentdata = Department::where('department_id',$id)->update(['status'=>0]);

                if($departmentdata){
                    return apiReturn($departmentdata, 'Successful deletion of deparment!', 'success');
                }else{
                    return apiReturn(null, 'Failure at deletion of deparment!', 'failed');
                }
            }else{
                return apiReturn(null, 'Failure at deletion of deparment!', 'failed', $validator->errors());
            }
        }
    }
}
