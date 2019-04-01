<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


// Models
use App\Jobs;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $jobs = Jobs::where('status',1)->paginate(10);

        if($request->has('show')){
            if($request->get('show') == 'all'){
                    $jobs = Jobs::where('status',1)->get();
            }else{
                    $jobs = Jobs::where('status',1)->paginate($request->get('show'));
            }
        }

        $datatoreturn = [
            'data' => $jobs,
            'total' => Jobs::where('status',1)->count(),
        ];

        return apiReturn($datatoreturn, 'Success', 'success');

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
        $job_id = rand(111111, 999999);
        $validator = Validator::make($request->all(),[
            'job_name' => 'required|unique:jobs,job_name,'.$job_id.',job_id,status,1',
            'job_description' => 'required',
        ]);

        if(!$validator->fails()){
            $datatoreturn = Jobs::create([
                'job_id' => $job_id,
                'job_name' => $request->post('job_name'),
                'job_description' => $request->post('job_description'),
            ]);

            return apiReturn($datatoreturn, 'success', 'success');
        }else{
            return apiReturn(null, 'failed', 'failed', $validator->errors());
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
        $jobdata = [
            'data' => Jobs::where('job_id', $id)->where('status',1)->first(),
        ];

        if($jobdata['data']){
            return apiReturn($jobdata, 'Success!', 'success');
        }else{
            return apiReturn(null, 'Job does not exist!', 'failed');
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
        $validator = Validator::make($request->all(),[
            'job_name' => 'required|unique:jobs,job_name,'.$id.',job_id,status,1',
            'job_description' => 'required',
        ]);

        if(!$validator->fails()){
            $datatoreturn = Jobs::where('job_id', $id)->update([
                'job_name' => $request->post('job_name'),
                'job_description' => $request->post('job_description'),
            ]);

            if($datatoreturn){
                return apiReturn($datatoreturn, 'Update Successful!', 'success');
            }else{
                return apiReturn(null, 'Failure on insertion to db', 'failed');
            }
        }else{
            return apiReturn(null, 'failed', 'failed', $validator->errors());
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
        $datatoreturn = Jobs::where('job_id', $id)->update(['status' => 0]);

        if($datatoreturn){
            return apiReturn($datatoreturn, 'Successfull deletion of job', 'success');
        }else{
            return apiReturn(null, 'Failure on deletion of job', 'failed');
        }

    }
}
