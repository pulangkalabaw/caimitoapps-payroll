<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\Allowance;

class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allowance = new Allowance();

        $data = [
            'allowance' => $allowance->paginate(10),
            'total' => $allowance->count()
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
        $allowance = new Allowance();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        if(!$validator->fails()){

            $allowance_id = str_random(15).rand(1111,9999);

            $allowance_data = Allowance::create([
                'allowance_id' => $allowance_id,
                'name' => $request['name'],
                'amount' => $request['amount'],
                'taxable' => $request['taxable']
            ]);

            return apiReturn($allowance_data, 'Successful on update of allowance!', 'success');

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
        $allowance = new Allowance();

        $allowance_data = $allowance->where('allowance_id',$id)->firstOrFail();

        return apiReturn($allowance_data, 'Success!', 'success');
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
        $allowance = new Allowance();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        if(!$validator->fails()){

            $allowance->where('allowance_id', $id)->update([
                'name' => $request['name'],
                'amount' => $request['amount'],
                'taxable' => $request['taxable']
            ]);

            $allowance_data = $allowance->where('allowance_id', $id)->first();

            return apiReturn($allowance_data, 'Successful on creation of allowance!', 'success');

        } else {

            return apiReturn(null, 'Failure on creation of allowance!', 'failed', $validator->errors());

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
        $allowance = new Allowance();

        $allowance_data = $allowance->where('allowance_id',$id)->first();

        $allowance->where('allowance_id',$id)->delete();

        return apiReturn($allowance_data, 'Successfully Deleted!', 'success');
    }
}
