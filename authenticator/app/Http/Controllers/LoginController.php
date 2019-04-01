<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller{

    public function __construct()
    {
        //
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(!$validator->fails()){
            $user = new User();

            $email = base64_encode($request->post('email'));

            $user = $user->where('email',$email)->first();

            if($user){
                if (Hash::check($request->post('password'), $user->password)) {
                    return apiReturn($user, 'Login Successfully!', 'success');
                }else{
                    return apiReturn(null, 'Invalid email or password!', 'failed');
                }
            }else{
                return apiReturn(null, 'Account does not exist!', 'failed');
            }

        }else{
            return apiReturn(null, 'Failed on login', 'failed', $validator->errors());
        }
    }

}
