<?php

namespace App\Http\Controllers;

// use Auth;
use App\Models\Dashboard;
use App\Models\CaseRegister;
use App\Models\RM_CaseHearing;
use App\Models\Writ_CaseHearing;
use App\Models\AtCaseRegister;
use App\Models\CaseHearing;
use App\Models\RM_CaseRgister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RM_CaseBadi;
use App\Models\RM_CaseBibadi;
use App\Models\RM_OtherFiles;
use App\Models\RM_CaseType;
use App\Models\RM_CaseLog;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use App\Http\Controllers\CommonController;

class FrontHomeController extends Controller
{
    public function public_home(){
    //    if(Auth::check()){
    //         // dd('checked');
    //      return redirect('dashboard');
    //   }else{
        // return $cases = CaseHearing::orderby('id', 'DESC')->get();

       

        $data = '';

        // return $data;
        // return $data =  array_merge($data['case'], $data['rm_case']);
        return view('front.public_home', compact('data'));
        //  return redirect('login');
    //   }
   }
   public function dateWaysCase(Request $request)
    {
        if(!$request->date_start){
            return response(view('errors.404'), 404);
        }
       $d = $request->date_start;
       $data['hearing'] = DB::table('case_hearing')
       ->join('case_register', 'case_hearing.case_id', '=', 'case_register.id')
       ->join('court', 'case_register.court_id', '=', 'court.id')
       ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
       ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
       ->select('case_hearing.*', 'case_register.id', 'case_register.court_id', 'case_register.case_number', 'case_register.status', 'court.court_name')
       ->where('case_hearing.hearing_date', '=', $d)
       ->get();

        // dd($data['hearing']);

       $data['page_title'] = 'শুনানীর তারিখ: ' . en2bn(date('d-m-Y', strtotime($d))) . 'ইং';
       return view('front.public_home_hearing_list')->with($data);
    }
   public function dateWaysWritCase(Request $request)
    {
        if(!$request->date_start){
            return response(view('errors.404'), 404);
        }
       $d = $request->date_start;
       $data['hearing'] = DB::table('writ__case_hearing')
       ->join('writ__case_register', 'writ__case_hearing.case_id', '=', 'writ__case_register.id')
       ->join('court', 'writ__case_register.court_id', '=', 'court.id')
       ->join('upazila', 'writ__case_register.upazila_id', '=', 'upazila.id')
       ->join('mouja', 'writ__case_register.mouja_id', '=', 'mouja.id')
       ->select('writ__case_hearing.*', 'writ__case_register.id', 'writ__case_register.court_id', 'writ__case_register.case_number', 'writ__case_register.status', 'court.court_name')
       ->where('writ__case_hearing.hearing_date', '=', $d)
       ->get();

        // dd($data['hearing']);

       $data['page_title'] = 'শুনানীর তারিখ: ' . en2bn(date('d-m-Y', strtotime($d))) . 'ইং';
       return view('front.public_home_writ_hearing_list')->with($data);
    }
   public function dateWaysRMCase(Request $request)
    {
        if(!$request->date_start){
            return response(view('errors.404'), 404);
        }
       $d = $request->date_start;
       $data['hearing'] = RM_CaseHearing::where('hearing_date', $d)->get();
    //    $data['hearing'] = DB::table('r_m__case_hearings')
    //    ->join('case_register', 'case_hearing.case_id', '=', 'case_register.id')
    //    ->join('court', 'case_register.court_id', '=', 'court.id')
    //    ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
    //    ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
    //    ->select('case_hearing.*', 'case_register.id', 'case_register.court_id', 'case_register.case_number', 'case_register.status', 'court.court_name')
    //    ->where('case_hearing.hearing_date', '=', $d)
    //    ->get();

        // dd($data['hearing']);

       $data['page_title'] = 'শুনানীর তারিখ: ' . en2bn(date('d-m-Y', strtotime($d))) . 'ইং';
       return view('front.public_home_rm_hearing_list')->with($data);
    }
    public function rm_show($id)
    {
        /*$data['info'] =  AtCaseRegister::where('at_case_register.id',$id)->join('court', 'at_case_register.court_id', '=', 'court.id')
                                        ->join('district', 'at_case_register.district_id', '=', 'district.id')
                                        ->join('division', 'at_case_register.division_id', '=', 'division.id');*/
        $data['info'] = RM_CaseRgister::where('id',$id)->first();
        $data['badis'] = RM_CaseBadi::where('rm_case_id',$id)->get();
        $data['bibadis'] = RM_CaseBibadi::where('rm_case_id',$id)->get();
        $data['files'] = RM_OtherFiles::where('rm_case_id',$id)->get();
        // $data['judges'] = JudgePanel::where('at_case_id',$id)->get();
        // dd($data['badis']) ;
        $data['page_title'] =   'রাজস্ব মামলার বিস্তারিত তথ্য';
        // return $atcases;
        return view('front.public_home_rm_hearing_details')->with($data);
    }

    public function hearing_case_details($id)
   {
     $data['info'] = DB::table('case_register')
     ->join('court', 'case_register.court_id', '=', 'court.id')
     ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
     ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
     // ->join('case_type', 'case_register.ct_id', '=', 'case_type.id')
     ->join('case_status', 'case_register.cs_id', '=', 'case_status.id')
     // ->join('case_badi', 'case_register.id', '=', 'case_badi.case_id')
     // ->join('case_bibadi', 'case_register.id', '=', 'case_bibadi.case_id')
     ->select('case_register.*', 'court.court_name', 'upazila.upazila_name_bn', 'mouja.mouja_name_bn',  'case_status.status_name')
     ->where('case_register.id', '=', $id)
     ->first();
        // dd($data['info']);
        // dd($data['info']);

     $data['badis'] = DB::table('case_badi')
     ->join('case_register', 'case_badi.case_id', '=', 'case_register.id')
     ->select('case_badi.*')
     ->where('case_badi.case_id', '=', $id)
     ->get();

     $data['bibadis'] = DB::table('case_bibadi')
     ->join('case_register', 'case_bibadi.case_id', '=', 'case_register.id')
     ->select('case_bibadi.*')
     ->where('case_bibadi.case_id', '=', $id)
     ->get();

     $data['surveys'] = DB::table('case_survey')
     ->join('case_register', 'case_survey.case_id', '=', 'case_register.id')
     ->join('survey_type', 'case_survey.st_id', '=', 'survey_type.id')
     ->join('land_type', 'case_survey.lt_id', '=', 'land_type.id')
     ->select('case_survey.*','survey_type.st_name','land_type.lt_name')
     ->where('case_survey.case_id', '=', $id)
     ->get();

        // Get SF Details
     $data['sf'] = DB::table('case_sf')
     ->select('case_sf.*')
     ->where('case_sf.case_id', '=', $id)
     ->first();
        // dd($data['sf']);

        // Get SF Details
     $data['logs'] = DB::table('case_log')
     ->select('case_log.comment', 'case_log.created_at', 'case_status.status_name', 'role.role_name', 'users.name')
     ->join('case_status', 'case_status.id', '=', 'case_log.status_id')
     ->leftJoin('role', 'case_log.send_user_group_id', '=', 'role.id')
     ->join('users', 'case_log.user_id', '=', 'users.id')
     ->where('case_log.case_id', '=', $id)
     ->orderBy('case_log.id', 'desc')
     ->get();
        // dd($data['sf']);

        // Get SF Details
     $data['hearings'] = DB::table('case_hearing')
     ->select('case_hearing.*')
     ->where('case_hearing.case_id', '=', $id)
     ->orderBy('case_hearing.id', 'desc')
     ->get();

        // Dropdown
     $data['roles'] = DB::table('role')
     ->select('id', 'role_name')
     ->where('in_action', '=', 1)
     ->orderBy('sort_order', 'asc')
     ->get();

      // dd($data['bibadis']);

     $data['page_title'] = 'শুনানী মামলার বিস্তারিত তথ্য';
     return view('front.public_home_hearing_details')->with($data);
   }

    public function writ_case_hearing_details($id)
   {
     $data['info'] = DB::table('writ__case_register')
     ->join('court', 'writ__case_register.court_id', '=', 'court.id')
     ->join('upazila', 'writ__case_register.upazila_id', '=', 'upazila.id')
     ->join('mouja', 'writ__case_register.mouja_id', '=', 'mouja.id')
     // ->join('case_type', 'writ__case_register.ct_id', '=', 'case_type.id')
     ->join('case_status', 'writ__case_register.cs_id', '=', 'case_status.id')
     // ->join('case_badi', 'writ__case_register.id', '=', 'case_badi.case_id')
     // ->join('case_bibadi', 'writ__case_register.id', '=', 'case_bibadi.case_id')
     ->select('writ__case_register.*', 'court.court_name', 'upazila.upazila_name_bn', 'mouja.mouja_name_bn',  'case_status.status_name')
     ->where('writ__case_register.id', '=', $id)
     ->first();
        // dd($data['info']);
        // dd($data['info']);

     $data['badis'] = DB::table('writ__case_badi')
     ->join('writ__case_register', 'writ__case_badi.case_id', '=', 'writ__case_register.id')
     ->select('writ__case_badi.*')
     ->where('writ__case_badi.case_id', '=', $id)
     ->get();

     $data['bibadis'] = DB::table('writ__case_bibadi')
     ->join('writ__case_register', 'writ__case_bibadi.case_id', '=', 'writ__case_register.id')
     ->select('writ__case_bibadi.*')
     ->where('writ__case_bibadi.case_id', '=', $id)
     ->get();

     $data['surveys'] = DB::table('writ__case_survey')
     ->join('writ__case_register', 'writ__case_survey.case_id', '=', 'writ__case_register.id')
     ->join('survey_type', 'writ__case_survey.st_id', '=', 'survey_type.id')
     ->join('land_type', 'writ__case_survey.lt_id', '=', 'land_type.id')
     ->select('writ__case_survey.*','survey_type.st_name','land_type.lt_name')
     ->where('writ__case_survey.case_id', '=', $id)
     ->get();

    // Case Condition
    if($data['info']->is_affidavit_committee_added == 1){
        $data['selected_committee_members'] = DB::table('writ__case_affidavit_committee')
            ->join('affidavit_committee', 'writ__case_affidavit_committee.member_id', '=', 'affidavit_committee.id')        
            ->select('affidavit_committee.name','affidavit_committee.designation','affidavit_committee.mobile_no')
            ->where('writ__case_affidavit_committee.case_id', '=', $id)
            ->get();

    }else{
        $data['selected_committee_members'] = '';
    }

        // Get SF Details
     $data['sf'] = DB::table('writ__case_sf')
     ->select('writ__case_sf.*')
     ->where('writ__case_sf.case_id', '=', $id)
     ->first();
        // dd($data['sf']);

        // Get SF Details
     $data['logs'] = DB::table('writ__case_log')
     ->select('writ__case_log.comment', 'writ__case_log.created_at', 'case_status.status_name', 'role.role_name', 'users.name')
     ->join('case_status', 'case_status.id', '=', 'writ__case_log.status_id')
     ->leftJoin('role', 'writ__case_log.send_user_group_id', '=', 'role.id')
     ->join('users', 'writ__case_log.user_id', '=', 'users.id')
     ->where('writ__case_log.case_id', '=', $id)
     ->orderBy('writ__case_log.id', 'desc')
     ->get();
        // dd($data['sf']);

        // Get SF Details
     $data['hearings'] = DB::table('writ__case_hearing')
     ->select('writ__case_hearing.*')
     ->where('writ__case_hearing.case_id', '=', $id)
     ->orderBy('writ__case_hearing.id', 'desc')
     ->get();

        // Dropdown
     $data['roles'] = DB::table('role')
     ->select('id', 'role_name')
     ->where('in_action', '=', 1)
     ->orderBy('sort_order', 'asc')
     ->get();

      // dd($data['bibadis']);

     $data['page_title'] = 'শুনানী মামলার বিস্তারিত তথ্য';
     return view('front.public_home_writ_hearing_details')->with($data);
   }

}
