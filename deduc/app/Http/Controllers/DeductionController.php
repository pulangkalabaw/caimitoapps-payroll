<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

// Models
use App\Deductions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $deduction = new Deductions();

        $deduction_data = $deduction->paginate(10);
        
        if($request->has('filter')){
            if($request->get('filter') == 'all'){
                $deduction_data = $deduction->withTrashed()->paginate(10);
            } else if($request->get('filter') == 'active') {
                $deduction_data = $deduction->paginate(10);
            } else if ($request->get('filter') == 'inactive'){
                $deduction_data = $deduction->onlyTrashed()->paginate(10);
            }
        }

        $data = [
            'data' => $deduction_data,
            'total' => $deduction->count()
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
        // Deduction table
        // * deduction_id
        // * name
        // * amount
        // * timeframe
        // * interest
        // * deduction
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:3',
            'amount' => 'required|numeric',
        ]);

        if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

        $deduction_id = str_random(15).rand(1111,9999);

        $deduction_data = Deductions::create([
            'deduction_id' => $deduction_id,
            'name' => $request['name'],
            'amount' => $request['amount'],
            'interest' => $request['interest'],
            'deduction' => $request['deduction']
        ]);

        return apiReturn($deduction_data, 'Successful in creating deduction', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deduction = new Deductions();

        $deduction_data['data'] = $deduction->where('deduction_id',$id)->first();

        return apiReturn($deduction_data, 'Success!', 'success');
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
        $deduction = new Deductions();

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:3',
            'amount' => 'required|numeric',
            'timeframe' => 'required|string'
        ]);

        if($validator->fails()) return apiReturn([], 'Validation Failed', 'failed', $validator->errors());

        $deduction->where('deduction_id', $id)->update([
            'name' => $request['name'],
            'amount' => $request['amount'],
            'timeframe' => Carbon::parse($request['timeframe'])->format('Y-m-d'),
            'interest' => $request['interest'],
            'deduction' => $request['deduction']
        ]);

        return apiReturn($request->all(), 'Successful in updating', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deduction = new Deductions();

        $deduction_data = $deduction->where('deduction_id',$id)->first();
        $deduction->where('deduction_id',$id)->delete();

        return apiReturn($deduction_data, 'Successful in Deleting', 'success');
    }
}
