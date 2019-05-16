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
        $taxdata = TaxDeduction::create([
            'wage_type' => $request->wage_type,
            'compensation_range_from' => $request->compensation_range_from,
            'compensation_range_to' => $request->compensation_range_to,
            'prescribed_withholding_tax' => $request->prescribed_withholding_tax,
        ]);
        return apiReturn($taxdata, 'User tax has been inserted successfuly', 'success');
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
        if($tax_deduction){
            return apiReturn($tax_deduction, 'Items has been deleted successfully', 'success');
        }else{
            return apiReturn(null, 'Items not delete', 'failed');
        }
    }
}
