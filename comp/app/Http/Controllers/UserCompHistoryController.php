<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\UserCompensationHistory;

class UserCompHistoryController extends Controller
{
    public function show($id){

        $user_compensation_history = new UserCompensationHistory();

        $data = $user_compensation_history
        ->where('user_id', $id)
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
