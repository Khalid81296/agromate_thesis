<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends BaseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // echo 'Hello'; exit;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            // dd($user);

            // role name //
            $roleName = DB::table('role')->select('role_name')->where('id', $user->role_id)
                                        ->first()->role_name;
             // Office name //
            $officeInfo = DB::table('office')->select('office_name_bn', 'division_id', 'district_id', 'upazila_id')->where('id', $user->office_id)
                                        ->first();


            // Results
            $success['user_id']  =  $user->id;
            $success['name']     =  $user->name;
            $success['email']    =  $user->email;
            $success['profile_pic']  =  $user->profile_pic;
            $success['role_id']  =  $user->role_id;
            $success['role_name']  =  $roleName;
            $success['office_id']=  $user->office_id;
            $success['office_name']  =  $officeInfo->office_name_bn;
            $success['division_id']  =  $officeInfo->division_id;
            $success['district_id']  =  $officeInfo->district_id;
            $success['upazila_id']  =  $officeInfo->upazila_id;
            $success['token']    =  $user->createToken('Login')->accessToken;

            return $this->sendResponse($success, 'User login successfully.');
        } else {

            return $this->sendError('Unauthorised.', ['error'=>'User login failed.'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }
    */
}
