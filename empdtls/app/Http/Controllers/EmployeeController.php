<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\User;
use App\UserDetails;
use App\UserPayrollDetails;

class EmployeeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
        $User = new User();
        // return response()->json($User->with(['UserDetails'])->get());

        $datareturn = [
            'data' => $User->with(['UserDetails', 'UserPayrollDetails'])->paginate(10),
            'total' => $User->count(),
        ];
        return apiReturn($datareturn, 'Success', 'success');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
        $User = new User();
        $UserDetails = new UserDetails();
        $UserPayrollDetails = new UserPayrollDetails();

        $validator = Validator::make($request->all(), [
            'employee_code' => 'required|unique:users|max:30',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'image' => 'mimes:jpeg,bmp,png,gif',
        ]);

        if(!$validator->fails()){

            // Insertion to user table
            $user_id = str_random(15).rand(1111,999999);
            $filename = null;
            if(!empty($request->file('image'))){
                $extension =  $request->file('image')->getClientOriginalExtension();
                $filename = $user_id.'.'.$extension;
                $path = $request->file('image')->storeAs('avatars',$filename);
            }

            $duplicateEmail = User::where('email', zencrypt($request->post('email')))->first();

            if($duplicateEmail){
                return apiReturn(null, 'Failure on creation of employee! Email already found!', 'failed');
            }

            // Insertion of user data to User table
            $userdata = User::create([
                'user_id' => $user_id,
                'employee_code' => $request->post('employee_code'),
                'lname' => $request->post('lname'),
                'fname' => $request->post('fname'),
                'mname' => $request->post('mname'),
                'email' => $request->post('email'),
                'image' => ($filename == null) ? 'default.png' : $filename,
                'password' => bcrypt($request->post('password')),
            ]);

            if($userdata){
                // Insertion to user_details table only do this if userdata is a success( if is for catching errors)
                $request['user_id'] = $user_id;
                $userdetails = $UserDetails->insert($request->only([
                    'user_id','mobile_number','present_address','province_address','birth_date','birth_place','religion','marital_status','gender','height','weight','department_id','date_hired'
                ]));

                // Insertion to UserPayrollDetails
                $userpayrolldetails = $UserPayrollDetails->insert($request->only([
                    'user_id','basic_salary','allowances','loans','wage_type','bank_details','payout_type','tax_computation','tin_number','sss_number','philhealth_number','hdmf_number'
                ]));
            }

            return apiReturn($userdata, 'Successful on creation of employee!', 'success');
        }else{
            return apiReturn(null, 'Failure on creation of employee!', 'failed', $validator->errors());
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
        //
        $User = new User();

        $userdata = $User->with(['UserDetails', 'UserPayrollDetails'])->where('user_id', $id)->get();

        if($userdata){
            return apiReturn($userdata, 'Success', 'success');
        }else{
            return apiReturn(null, 'Employee not found!', 'failed');
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
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
        //
        $User = new User();
        $UserDetails = new UserDetails();
        $UserPayrollDetails = new UserPayrollDetails();


        $userdata = $UserDetails->where('user_id', $id)->update([
            'mobile_number','present_address','province_address','birth_date','birth_place','religion','marital_status','gender','height','weight','department_id','date_hired'
        ]);

        if(!empty($request->file('image')) && $userdata){
            $extension =  $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('avatars',$id.'.'.$extension);
            $User->where('user_id', $id)->update(['image' => $id.'.'.$extension]);
        }

        if($userdata){
            // Update PayrollDetails
            $userdata = $UserPayrollDetails->where('user_id', $id)->update([
                'basic_salary','allowances','loans','wage_type','bank_details','payout_type','tax_computation','tin_number','sss_number','philhealth_number','hdmf_number'
            ]);

            return apiReturn($userdata, 'Successfull on updating of employee record!', 'success');
        }else{
            return apiReturn(null, 'Failure on updating of employee record!', 'error');

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
        //
    }
}
