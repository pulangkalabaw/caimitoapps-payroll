<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tax_deduction;

class TaxController extends Controller
{
    public function index(){
    	$tax_deduction = tax_deduction::all();
    	$data = $tax_deduction;
    	return apiReturn($data, 'Success','success');
    }


    public function store(Request $request){
    	tax_deduction::create([
	    	'wage_type' => $request->wage_type,
	    	'compensation_range_from' => $request->compensation_range_from,
	    	'compensation_range_to' => $request->compensation_range_to,
	    	'prescribed_withholding_tax' => $request->prescribed_withholding_tax,
    	]);

    	return "Tax has been inserted successfully";
    }


    public function show($id){
    	return $tax_deduction = tax_deduction::findOrFail($id);
    }


    public function edit($id){

    }


    public function update(Request $request, $id){
    	$tax_deduction = tax_deduction::findOrFail($id)
    	    ->update([
    	    	'wage_type' => $request->wage_type,
    	    	'compensation_range_from' => $request->compensation_range_from,
    	    	'compensation_range_to' => $request->compensation_range_to,
    	    	'prescribed_withholding_tax' => $request->prescribed_withholding_tax,
    		]);
    		return "Data has been updated successfully";
    }

    public function destroy($id){
    	$tax_deduction = tax_deduction::findOrFail($id)->delete();
     	return "Data has been deleted";
    }
}
