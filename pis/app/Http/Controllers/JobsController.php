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
            'count' => Jobs::where('status',1)->count(),
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
        $validator = Validator::make($request->all(),[
            'job_name' => 'required|unique:jobs',
            'job_description' => 'required',
        ]);

        if(!$validator->fails()){
            $job_id = rand(111111, 999999);
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
		$jobs_data = [
			'data' => Jobs::where('job_id', $id)->first(),
		];

		if($jobs_data){
			return apiReturn($jobs_data, 'Success!', 'success');
		}else{
			return apiReturn(null, 'This Jobs does not exist!', 'failed');
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
            'job_name' => 'required|unique:jobs,job_name,'.$id.',job_id',
            'job_description' => 'required',
        ]);

        if(!$validator->fails()){
            $datatoreturn = Jobs::where('job_id', $id)->update([
                'job_name' => $request->post('job_name'),
                'job_description' => $request->post('job_description'),
            ]);

            return apiReturn($datatoreturn, 'success', 'success');
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
