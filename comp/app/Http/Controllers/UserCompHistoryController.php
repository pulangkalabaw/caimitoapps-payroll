<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\UserCompensationHistory;

class UserCompHistoryController extends Controller
{
    public function show(Request $request, $id){

        // this function will be updated
        // for now wait for the new reconstruction of both deduction and compesation database

        $user_compensation_history = new UserCompensationHistory();

        $data = $user_compensation_history
        ->where(['user_id' => $id, 'batch_id' => $request->post('batch_id')])
        ->with(['getUser','getCompensation'])
        ->get();

        if(count($data) != 0){
            $message = 'Success!';
            $status = 'success';
        } else {
            $data = null;
            $message = 'History Compensation is empty!';
            $status = 'failed';
        }

        return apiReturn($data, $message, $status);
    }
}
