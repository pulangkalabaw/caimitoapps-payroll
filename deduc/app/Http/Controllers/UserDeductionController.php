<?php

namespace App\Http\Controllers;

// Models
use App\Deductions;
use App\UserDeduction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_deduction = new UserDeduction();

        $data = [
            'data' => $user_deduction->with(['getUser','getDeduction'])->paginate(10),
            'total' => $user_deduction->count()
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
        $validator = Validator::make($request->all(),[
            'deduction_id' => 'required',
            'user_id' => 'required|array',
            'user_id.*' => 'required|string|distinct'
        ],[
            'user_id.required' => 'Please select one or more employee',
            'deduction_id.required' => 'Please select a deduction'
        ]);

        if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

        $deduction = new Deductions();
        $user_deduction = new UserDeduction();

        $deduction = $deduction->where('deduction_id', $request['deduction_id'])->first();

        foreach($request['user_id'] as $user_id){
            $data[] = [
                'user_id' => $user_id,
                'deduction_id' => $request->post('deduction_id'),
                'name' => $deduction['name'],
                'amount' => $deduction['amount'],
                'type' => $request->post('type'),
                // 'date_start' => Carbon::parse($request->post('date_start'))->format('d/m/Y'),
                // 'date_end' => Carbon::parse($request->post('date_end'))->format('d/m/Y'),
                // 'interest' => $deduction['interest'],
                // 'deduction' => $deduction['deduction'],
                // 'tax_type' => $request->post('tax_type'),
                // 'remarks' => $request->post('remarks'),
            ];
        }

		// Check if this setup is already exist
		if (UserDeduction::where(['user_id' => $request->post('user_id'), 'deduction_id' => $request->post('deduction_id')])->first()) {
			return apiReturn([], 'This context is already exist!', 'failed');
		}

        if($user_deduction->insert($data)){
            return apiReturn($data, 'Successfully assigned Deduction!', 'success');
        } else {
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
        // does this need to be filtered?
        // this will only show
        $user_deduction = new UserDeduction();

        $data['data'] = $user_deduction
        ->where('deduction_id',$id)
        ->with(['getUser','getDeduction'])
        ->get();

        return apiReturn($data, 'Success', 'success');
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
        // not in use yet
        $user_deduction = new UserDeduction();
        $deduction = new Deduction();

        $validator = Validator::make($request->all(),[
            'deduction_id' => 'required',
            'user_id' => 'required|array',
            'user_id.*' => 'required|string|distinct'
        ],[
            'user_id.required' => 'Please select one or more employee',
            'deduction_id.required' => 'Please select a deduction'
        ]);

        if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

        $deduction_deduction->where('user_id',$id)->update([
            'deduction_id' => $request->post('deduction_id')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
		$user_deduc = new UserDeduction();

		// Take note
		// Before you delete the user compensation
		// copy that row to user compensation history

		if($user_deduc->where('id', $request['ud_id'])->delete()){
			return apiReturn([], 'Remove Successful' ,'success');
		} else {
			return apiReturn([], 'Failed to remove' ,'failed');
		}
    }
}
