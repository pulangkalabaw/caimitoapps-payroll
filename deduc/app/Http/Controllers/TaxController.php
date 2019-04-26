<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxDeduction;

class TaxController extends Controller
{
    public function index(){
        $tax_deduction = TaxDeduction::all();
        $data = $tax_deduction;
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
        $tax_deduction = TaxDeduction::findOrFail($id);
        return apiReturn($tax_deduction, 'Success!', 'success');
    }


    public function edit($id){

    }


    public function update(Request $request, $id){
        $tax_deduction = TaxDeduction::findOrFail($id)
            ->update([
                'wage_type' => $request->wage_type,
                'compensation_range_from' => $request->compensation_range_from,
                'compensation_range_to' => $request->compensation_range_to,
                'prescribed_withholding_tax' => $request->prescribed_withholding_tax,
            ]);
            return apiReturn($request->all(), 'Successful in updating', 'success');
    }

    public function destroy($id){
        $tax_deduction = TaxDeduction::findOrFail($id)->delete();
        return "Data has been deleted";
    }
}
