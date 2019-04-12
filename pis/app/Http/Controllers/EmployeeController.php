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
    public function index(Request $request)
    {
        //
        $User = new User();

        $rows = $request->get('show') ? $request->get('show') : 10;


        if($request->has('filter')){
            if($request->get('filter') == 'all'){
                $users = User::with(['UserDetails', 'UserPayrollDetails'])->get();
            }else if($request->get('filter') == 'active'){
                $users = User::with(['UserDetails', 'UserPayrollDetails'])->where('status',1)->get();
            }else{
                $users = User::with(['UserDetails', 'UserPayrollDetails'])->where('status',1)->get();
            }
        }else{
            $users = $User->with(['UserDetails', 'UserPayrollDetails'])->paginate($rows);
        }

        $datareturn = [
            'data' => $users,
            'total' => $User->where('status',1)->count(),
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
                    'user_id','mobile_number','present_address','province_address','birth_date','birth_place','religion','marital_status','gender','height','weight','department_id','employment_type','employemnt_status','date_hired'
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

        $userdata['data'] = $User->with(['UserDetails.Department', 'UserPayrollDetails', 'UserCompensation', 'UserCompensation.getCompensation'])->where('user_id', $id)->first();

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
        // return $request->all();
        $User = new User();
        $UserDetails = new UserDetails();
        $UserPayrollDetails = new UserPayrollDetails();
        $request->merge([ 'email' => zencrypt($request->get('email'))]);
        $validator = Validator::make($request->all(), [
            'employee_code' => 'required|max:30|unique:users,employee_code,'.$id.',user_id',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'email' => 'required|unique:users,email,'.$id.',user_id',
            'password' => 'nullable|confirmed|min:6',
            // 'image' => 'nullable|mimes:jpeg,bmp,png,gif',
        ]);

        if(!$validator->fails()){
            // if success on valdiation

            // Update of user table
            $user_only = collect($request->except(['user_details', 'user_payroll_details']))->except(['_method','password_confirmation','at','id','user_id','created_at','updated_at'])->toArray();
            // $user_only['email'] = zencrypt($user_only['email']);
            if(isset($user_only['password'])){
                $user_only['password'] = bcrypt($user_only['password']);
            }
            $userdata = $User->where('user_id', $id)->update($user_only);


            // Update of user_details table
            $user_details_only = collect($request->only('user_details')['user_details'])->except(['id','user_id','department','created_at','updated_at'])->toArray();
            $cont_proc = ($user_details_only == null) ? null : $user_details_only;
            if($cont_proc){
                 $userdata = $UserDetails->where('user_id', $id)->update($user_details_only);
            }

            if(!empty($request->file('image')) && $userdata){
                $extension =  $request->file('image')->getClientOriginalExtension();
                $path = $request->file('image')->storeAs('avatars',$id.'.'.$extension);
                $User->where('user_id', $id)->update(['image' => $id.'.'.$extension]);
            }

            if($userdata){
                // Update user_payroll_details table
                $user_payroll_only = collect($request->only('user_payroll_details')['user_payroll_details'])->except(['id','user_id','created_at','updated_at'])->toArray();
                $cont_proc = ($user_payroll_only == null) ? null :$user_payroll_only;
                if($cont_proc){
                    $userdata = $UserPayrollDetails->where('user_id', $id)->update($user_payroll_only);
                }

                return apiReturn($userdata, 'Successfull on updating of employee record!', 'success');
            }else{
                return apiReturn(null, 'Failure on updating of employee record!', 'failed');
            }
        }else{
            // Is not success on valdiation
            return apiReturn(null, 'Failure on updating of employee record!', 'failed', $validator->errors());
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
        $users = User::where('user_id',$id)->update(['status'=>0]);

        if($users){
            return apiReturn($users, 'Successful resignation of employee!', 'success');
        }else{
            return apiReturn(null, 'Failure at resignation of employee!', 'failed');
        }
    }
}
