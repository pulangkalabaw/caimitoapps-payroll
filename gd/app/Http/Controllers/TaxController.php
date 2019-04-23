<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tax_table;

class taxController extends Controller
{
     public function index(){
        $tax_table = tax_table::all();
        $data = $tax_table;
        return apiReturn($data, 'Success','success');
    }


    public function store(Request $request){
        tax_table::create([
            'wage_type' => $request->wage_type,
            'compensation_range_from' => $request->compensation_range_from,
            'compensation_range_to' => $request->compensation_range_to,
            'prescribed_withholding_tax' => $request->prescribed_withholding_tax,
        ]);

        return "Tax has been inserted successfully";
    }


    public function show($id){
        return $tax_table = tax_table::findOrFail($id);
    }


    public function edit($id){

    }


    public function update(Request $request, $id){
        $tax_table = tax_table::findOrFail($id)
            ->update([
                'wage_type' => $request->wage_type,
                'compensation_range_from' => $request->compensation_range_from,
                'compensation_range_to' => $request->compensation_range_to,
                'prescribed_withholding_tax' => $request->prescribed_withholding_tax,
            ]);
            return "Data has been updated successfully";
    }

    public function destroy($id){
        $tax_table = tax_table::findOrFail($id)->delete();
        return "Data has been deleted";
    }
}
