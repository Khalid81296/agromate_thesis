<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\CaseRegister;
use App\Models\CaseBadi;
use App\Models\CaseBibadi;
use App\Models\CaseSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabinetController extends Controller
{
    //
     public function create()
    {
        //Auth User Info
        $userDivision = user_division();
        $userDistrict = user_district();
        // dd($officeInfo);
        // Dropdown List
        $data['courts'] = DB::table('court')
                ->select('id', 'court_name')
                ->where('district_id', $userDistrict)
                ->get();
        // $data['divisions'] = DB::table('division')->select('id', 'division_name_bn')->get();

        $data['upazilas'] = DB::table('upazila')
                ->select('id', 'upazila_name_bn')
                ->where('district_id', $userDistrict)
                ->get();
        $data['case_types'] = DB::table('case_type')->select('id', 'ct_name')->get();
        $data['surveys'] = DB::table('survey_type')->select('id', 'st_name')->get();
        $data['land_types'] = DB::table('land_type')->select('id', 'lt_name')->get();

        // dd($data);
        // dd($case_type);
        // $data['subcategories'] = DB::table("mouja")->where("upazila_id",38)->pluck("mouja_name_bn","id");

        $data['page_title'] = 'নতুন মামলা রেজিষ্টার এন্ট্রি ফরম'; //exit;
        // return view('case.case_add', compact('page_title', 'case_type'));
        return view('cabinet.create')->with($data);
    }
}
