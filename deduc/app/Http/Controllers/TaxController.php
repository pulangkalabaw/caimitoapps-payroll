<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxDeduction;

class TaxController extends Controller
{
    public function index(){
        $TaxDeduction = TaxDeduction::all();
        $data = $TaxDeduction;
        return apiReturn($data, 'Success','success');
    }


    public function store(Request $request){
        TaxDeduction::create([
            'wage_type' => $request->wage_type,
            'compensation_range_from' => $request->compensation_range_from,
            'compensation_range_to' => $request->compensation_range_to,
            'prescribed_withholding_tax' => $request->prescribed_withholding_tax,
        ]);

        return "Tax has been inserted successfully";
    }


    public function show($id){
        return $TaxDeduction = TaxDeduction::findOrFail($id);
    }


    public function edit($id){

    }


    public function update(Request $request, $id){
        $TaxDeduction = TaxDeduction::findOrFail($id)
            ->update([
                'wage_type' => $request->wage_type,
                'compensation_range_from' => $request->compensation_range_from,
                'compensation_range_to' => $request->compensation_range_to,
                'prescribed_withholding_tax' => $request->prescribed_withholding_tax,
            ]);
            return "Data has been updated successfully";
    }

    public function destroy($id){
        $TaxDeduction = TaxDeduction::findOrFail($id)->delete();
        return "Data has been deleted";
    }
}
