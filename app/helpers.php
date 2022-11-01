<?php

// namespace App\Http\Controllers;
// use Illuminate\Support\Str;

use App\Models\CaseActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\CommonController;
use App\Models\User;
use App\Models\RM_CaseActivityLog;
use App\Models\Writ_CaseActivityLog;


if (!function_exists('user_office_info')) {
	function user_office_info() {
		$user = Auth::user();
		return DB::table('users')->select('users.id AS user_id','division.id AS division_id', 'division.division_name_bn', 'district.id  AS district_id', 'district.district_name_bn', 'upazila.id  AS upazila_id', 'upazila.upazila_name_bn', 'office.office_name_bn')
		->leftJoin('office', 'users.office_id', '=', 'office.id')
		->leftJoin('division', 'office.division_id', '=', 'division.id')
		->leftJoin('district', 'office.district_id', '=', 'district.id')
		->leftJoin('upazila', 'office.upazila_id', '=', 'upazila.id')
		->where('users.id', $user->id)
		->first();
	}
}

if (!function_exists('user_division')) {
	function user_division() {
		$user = Auth::user();
		return DB::table('users')->select('division.id', 'division.division_name_bn')
		->leftJoin('office', 'users.office_id', '=', 'office.id')
		->join('division', 'office.division_id', '=', 'division.id')
		->where('users.id', $user->id)
		->first()->id;
	}
}

if (!function_exists('user_district')) {
	function user_district() {
		$user = Auth::user();
		return $district =  DB::table('office')->select('district_id')
		->join('district', 'office.district_id', '=', 'district.id')
		->where('office.id',$user->office_id)
		->first()->district_id;
	}
}

if (!function_exists('user_upazila')) {
	function user_upazila() {
		$user = Auth::user();
		return $upazila =  DB::table('office')->select('upazila_id')
		->join('upazila', 'office.upazila_id', '=', 'upazila.id')
		->where('office.id',$user->office_id)
		->first()->upazila_id;
	}
}

if (!function_exists('user_email')) {
	function user_email() {
		$user = Auth::user();
		return $user->email;
	}
}

if (!function_exists('en2bn')) {
	function en2bn($item) {
		return App\Http\Controllers\CommonController::en2bn($item);
		// echo $item;
	}
}

if (!function_exists('bn2en')) {
	function bn2en($item) {
		return App\Http\Controllers\CommonController::bn2en($item);
		// echo $item;
	}
}

if (!function_exists('case_status')) {
	function case_status($item) {
		if($item == 1){
			$result = "<span class='label label-success'>Enable</span>";
		}else{
			$result = "<span class='label label-warning'>Disable</span>";
		}
		return $result;
	}
}

// if (!function_exists('english2bangli')) {
//    function english2bangli($item) {
//       // return CommonController::en2bn($item);
//       return 'A';
//    }
// }


if (!function_exists('case_activity_logs')) {
	function case_activity_logs($data) {

        $user = Auth::user();
        $userDivision = user_division();
        $userDistrict = user_district();
        $userOffice = user_office_info();



        $log = new CaseActivityLog;
        $log->user_id = $user->id;
        $log->case_register_id = $data['case_register_id'];
        $log->user_roll_id = $user->role_id;
        $log->activity_type = $data['activity_type'];
        $log->message = $data['message'];
        $log->office_id = $user->office_id;
        $log->division_id = $userDivision == null ? null : $userDivision;
        $log->district_id = $userDistrict == null ? null : $userDistrict;
        $log->upazila_id = $userOffice->upazila_id == null ? null : $userOffice->upazila_id;
        $log->old_data = $data['old_data'];
        $log->new_data = $data['new_data'];
        $log->ip_address = request()->ip();
        $log->user_agent = request()->userAgent();
        $log->save();
        return $log;
	}
}


if (!function_exists('Write_case_activity_logs')) {
	function Write_case_activity_logs($data) {
        $user = Auth::user();
        if(Auth::user()->role_id != 15 && Auth::user()->role_id != 26){
	        $userDivision = user_division();
	        $userDistrict = user_district();
	    }
        $userOffice = user_office_info();



        $log = new Writ_CaseActivityLog;
        $log->user_id = $user->id;
        $log->case_register_id = $data['case_register_id'];
        $log->user_roll_id = $user->role_id;
        $log->activity_type = $data['activity_type'];
        $log->message = $data['message'];
        $log->office_id = $user->office_id;
        if(Auth::user()->role_id == 15 || Auth::user()->role_id == 26){
	        $log->division_id = $data['division'];
	        $log->district_id = $data['district'];
        	$log->upazila_id = $data['upazila'];
	    }else{
	    	$log->division_id = $userDivision == null ? null : $userDivision;
	        $log->district_id = $userDistrict == null ? null : $userDistrict;
        	$log->upazila_id = $userOffice->upazila_id == null ? null : $userOffice->upazila_id;
	    }
        $log->old_data = $data['old_data'];
        $log->new_data = $data['new_data'];
        $log->ip_address = request()->ip();
        $log->user_agent = request()->userAgent();
        $log->save();
        return $log;
	}
}

if (!function_exists('RM_case_activity_logs')) {
	function RM_case_activity_logs($data) {

        $user_id = Auth::user()->id;
        $user_info = User::where('id', $user_id)->with('office', 'role')->get()->toArray();
        $user_info = array_merge( $user_info, [
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        $log = new RM_CaseActivityLog;
        $log->user_info = json_encode($user_info);
        $log->rm_case_id = $data['rm_case_id'];
        $log->activity_type = $data['activity_type'];
        $log->massage = $data['message'];
        $log->old_data = $data['old_data'];
        $log->new_data = $data['new_data'];
        $log->save();
        return $log;
	}
}
