<?php

namespace App\Http\Controllers;

// use Auth;
use App\Models\Dashboard;
use App\Models\CaseRegister;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CaseHearing;
use App\Http\Resources\calendar\CaseHearingCollection;

// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use App\Http\Controllers\CommonController;

class DashboardController extends Controller
{

   // use AuthenticatesUsers;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
   {
      // $num = CommonController::en2bn(55);
      // $conv = new CommonController;
      // dd($conv->en2bn(56));
      // dd($num);
      // Retrieve the currently authenticated user...
      $officeInfo = user_office_info();
      // dd($officeInfo);
      $user = Auth::user();
      $roleID = Auth::user()->role_id;
      $districtID = Auth::user()->district_id;
      $upazilaID = Auth::user()->upazila_id;/*
      $moujaID = DB::table('office')
                     ->select('upazila_id')->where('id',$user->office_id)
                     ->first()->upazila_id;*/
      // dd($upazilaID);
      // Retrieve the currently authenticated user's ID...
      // $id = Auth::id();
      // Determining If The Current User Is Authenticated
      /*if (Auth::check()) {
         // The user is logged in...
         dd('logged in!');
      }*/
      // dd($user->role_id);

      // $data['user'] = DB::table('users')
      //     ->join('role', 'users.role_id', '=', 'role.id')
      //     ->select('users.id', 'users.name', 'users.username', 'role.role_name')
      //     ->where('users.id', '=', $id)
      //     ->first();
      // dd($data['user']);

      // $user = auth()->user();
      // echo $role = $user->role->role_name; exit; // Name of relation function in user model and gather all role data
      // echo $user = auth()->user()->role->role_name; exit;
      // echo $user = auth()->user()->office->office_name_bn; exit;
      $data = [];
      $data['rm_case_status'] = [];


      if($roleID == 1){
         // Superadmi dashboard

         // Counter
         $data['total_case'] = DB::table('case_register')->count();
         $data['running_case'] = DB::table('case_register')->where('status', 1)->count();
         $data['old_complete_case'] = DB::table('case_register')->where('status', 1)->where('is_old',1)->count();
         $data['appeal_case'] = DB::table('case_register')->where('status', 2)->count();
         $data['completed_case'] = DB::table('case_register')->where('status', 3)->count();

         $data['total_office'] = DB::table('office')->whereNotIn('id', [1,2,7])->count();
         $data['total_user'] = DB::table('users')->count();
         $data['total_mouja'] = DB::table('mouja')->count();
         $data['total_ct'] = DB::table('case_type')->count();
         $data['total_sf_count'] = CaseRegister::orderby('id', 'desc')->where('is_sf', 1)->where('status', 1)->get()->count();

         $data['cases'] = DB::table('case_register')->select('case_register.*')->get();

            // Get case status by group
         $data['case_status'] = DB::table('case_register')
         ->select('case_register.cs_id', 'case_status.status_name', DB::raw('COUNT(case_register.id) as total_case'))
         ->leftJoin('case_status', 'case_register.cs_id', '=', 'case_status.id')
         ->groupBy('case_register.cs_id')
         ->where('case_register.action_user_group_id', $roleID)
         ->get();

         $data['cases'] = DB::table('case_register')
         ->select('case_register.*')
         ->get();

         // Drildown Statistics
         $division_list = DB::table('division')
         ->select('division.id', 'division.division_name_bn', 'division.division_name_en')
         ->get();

         $divisiondata=array();
         $districtdata=array();
         // $dis_data=array();
         $upazilatdata=array();

         // Division List
         foreach ($division_list as $division) {
            // $data_arr[$item->id] = $this->get_drildown_case_count($item->id);
            // Division Data
            $data['divisiondata'][] = array('name' => $division->division_name_bn, 'y' => $this->get_drildown_case_count($division->id), 'drilldown' => $division->id);

            // District List
            $district_list = DB::table('district')->select('district.id', 'district.district_name_bn')->where('division_id', $division->id)->get();
            foreach ($district_list as $district) {
               // $dis_count = $this->Employee_model->get_count_employees('', '', '', $district->id);
               // $number2 = (int) $dis_count['count']; //exit;

               $dis_data[$division->id][] = array('name' => $district->district_name_bn, 'y' => $this->get_drildown_case_count('', $district->id), 'drilldown' => $district->id);

               // Upazila Data
               // $upazila_list = $this->Common_model->get_data_where('upazilas', 'district_id', $district->id);
               $upazila_list = DB::table('upazila')->select('upazila.id', 'upazila.upazila_name_bn')->where('district_id', $district->id)->get();
               foreach ($upazila_list as $upazila) {
                  // $upa_count = $this->Employee_model->get_count_employees('', '', '', '', $upazila->id);
                  // $number3 = (int) $upa_count['count']; //exit;

                  $upa_data[$district->id][] = array($upazila->upazila_name_bn, $this->get_drildown_case_count('', '', $upazila->id));
               }

               $upadata = $upa_data[$district->id];
               $upazilatdata[] = array('name' => $district->district_name_bn, 'id' => $district->id, 'data' => $upadata);
            }

            $disdata = $dis_data[$division->id];
            $districtdata[] = array('name' => $division->division_name_bn, 'id' => $division->id, 'data' => $disdata);

            $data['dis_upa_data'] = array_merge($upazilatdata, $districtdata); //$districtdata;  $upazilatdata;

         }
         // dd($result);
         // $data['divisiondata'] = $divisiondata;
         // dd($data['division_arr']);



         // View
         $data['page_title'] = 'সুপার অ্যাডমিন ড্যাশবোর্ড';
         return view('dashboard.superadmin')->with($data);

      }elseif($roleID == 2){
         // Superadmin dashboard

         // Counter
         $data['total_case'] = DB::table('case_register')->count();
         $data['old_complete_case'] = DB::table('case_register')->where('status', 3)->where('is_old',1)->count();
         $data['running_case'] = DB::table('case_register')->where('status', 1)->where('is_old',0)->count();
         $data['appeal_case'] = DB::table('case_register')->where('status', 2)->count();
         $data['completed_case'] = DB::table('case_register')->where('status', 3)->where('is_old',0)->count();

         $data['total_office'] = DB::table('office')->whereNotIn('id', [1,2,7])->count();
         $data['total_user'] = DB::table('users')->count();
         $data['total_mouja'] = DB::table('mouja')->count();
         $data['total_ct'] = DB::table('case_type')->count();
         $data['total_sf_count'] = CaseRegister::orderby('id', 'desc')->where('is_sf', 1)->where('status', 1)->get()->count();

         $data['cases'] = DB::table('case_register')
         ->select('case_register.*')
         ->get();

         // Drildown Statistics
         $division_list = DB::table('division')
         ->select('division.id', 'division.division_name_bn', 'division.division_name_en')
         ->get();

         
         // View
         $data['page_title'] = 'ব্যাবহারকারির ড্যাশবোর্ড';
         return view('dashboard.ac_land')->with($data);

      }
   }

    /*public function receive($statusID)
    {
        $data['cases'] = DB::table('case_register')
        ->join('court', 'case_register.court_id', '=', 'court.id')
        ->join('district', 'case_register.district_id', '=', 'district.id')
        ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
        ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
        ->select('case_register.*', 'court.court_name', 'mouja.mouja_name_bn', 'district.district_name_bn', 'upazila.upazila_name_bn')

        ->where('case_register.cs_id', '=', $statusID)
        ->get();

        // dd($data['cases']);

        // return view('dashboard.receive', compact('page_title', 'cases'))
        // ->with('i', (request()->input('page',1) - 1) * 5);

        // All user list
        // $cases = CaseRegister::latest()->paginate(5);
        // $data['page_title'] = 'নতুন মামলা রেজিষ্টার এন্ট্রি ফরম'; //exit;

        $data['page_title'] = 'মামলার তালিকা';
        return view('dashboard.receive')->with($data);
     }   */


     public function hearing_date_today()
     {
       $data['hearing'] = DB::table('case_hearing')
       ->join('case_register', 'case_hearing.case_id', '=', 'case_register.id')
       ->join('court', 'case_register.court_id', '=', 'court.id')
       ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
       ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
       ->select('case_hearing.*', 'case_register.id', 'case_register.court_id', 'case_register.case_number', 'case_register.status', 'court.court_name')
       ->where('case_hearing.hearing_date', '=', date('Y-m-d'))
       ->get();

        // dd($data['hearing']);

       $data['page_title'] = 'আজকের দিনে শুনানী/মামলার তারিখ';
       return view('dashboard.hearing_date')->with($data);
    }


    public function hearing_date_tomorrow()
    {
       $d = date('Y-m-d',strtotime('+1 day')) ;
       $data['hearing'] = DB::table('case_hearing')
       ->join('case_register', 'case_hearing.case_id', '=', 'case_register.id')
       ->join('court', 'case_register.court_id', '=', 'court.id')
       ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
       ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
       ->select('case_hearing.*', 'case_register.id', 'case_register.court_id', 'case_register.case_number', 'case_register.status', 'court.court_name')
       ->where('case_hearing.hearing_date', '=', $d)
       ->get();

        // dd($data['hearing']);

       $data['page_title'] = 'আগামী দিনে শুনানী/মামলার তারিখ';
       return view('dashboard.hearing_date')->with($data);
    }


    public function hearing_date_nextWeek()
    {

       $d = date('Y-m-d',strtotime('+7 day')) ;
       $data['hearing'] = DB::table('case_hearing')
       ->join('case_register', 'case_hearing.case_id', '=', 'case_register.id')
       ->join('court', 'case_register.court_id', '=', 'court.id')
       ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
       ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
       ->select('case_hearing.*', 'case_register.id', 'case_register.court_id', 'case_register.case_number', 'case_register.status', 'court.court_name')
       ->where('case_hearing.hearing_date', '>=', date('Y-m-d'))
       ->where('case_hearing.hearing_date', '<=', $d)
       ->get();

        // dd($data['hearing']);

       $data['page_title'] = 'আগামী সপ্তাহের শুনানী/মামলার তারিখ';
       return view('dashboard.hearing_date')->with($data);
    }


    public function hearing_date_nextMonth()
    {
       $d = date('Y-m-d',strtotime('+1 month')) ;
       /* $m = date('m',strtotime($d));
       dd($d);*/
       $data['hearing'] = DB::table('case_hearing')
       ->join('case_register', 'case_hearing.case_id', '=', 'case_register.id')
       ->join('court', 'case_register.court_id', '=', 'court.id')
       ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
       ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
       ->select('case_hearing.*', 'case_register.id', 'case_register.court_id', 'case_register.case_number', 'case_register.status', 'court.court_name')
       ->where('case_hearing.hearing_date', '>=', date('Y-m-d'))
       ->where('case_hearing.hearing_date', '<=', $d)
       ->get();

        // dd($data['hearing']);

       $data['page_title'] = 'আগামী মাসের শুনানী/মামলার তারিখ';
       return view('dashboard.hearing_date')->with($data);
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
     return view('dashboard.hearing_case_details')->with($data);
  }

  public function get_drildown_case_count($division=NULL, $district=NULL, $upazila=NULL, $status=NULL) {
     $query = DB::table('case_register');

     if($division != NULL){
       $query->where('division_id', $division);
    }
    if($district != NULL){
       $query->where('district_id', $district);
    }
    if($upazila != NULL){
       $query->where('upazila_id', $upazila);
    }

    return $query->count();
 }

    public function get_mouja_by_ulo_office_id($officeID){
        return DB::table('mouja_ulo')->where('ulo_office_id', $officeID)->pluck('mouja_id');
        // return DB::table('mouja_ulo')->select('mouja_id')->where('ulo_office_id', $officeID)->get();
        // return DB::table('division')->select('id', 'division_name_bn')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaseRegister  $caseRegister
     * @return \Illuminate\Http\Response
     */
    /*public function case_details($id)
    {
        $data['info'] = DB::table('case_register')
        ->join('court', 'case_register.court_id', '=', 'court.id')
        ->join('upazila', 'case_register.upazila_id', '=', 'upazila.id')
        ->join('mouja', 'case_register.mouja_id', '=', 'mouja.id')
        ->join('case_type', 'case_register.ct_id', '=', 'case_type.id')
        ->join('case_status', 'case_register.cs_id', '=', 'case_status.id')
        ->join('case_badi', 'case_register.id', '=', 'case_badi.case_id')
        ->join('case_bibadi', 'case_register.id', '=', 'case_bibadi.case_id')
        ->select('case_register.*', 'court.court_name', 'upazila.upazila_name_bn', 'mouja.mouja_name_bn', 'case_type.ct_name', 'case_status.status_name', 'case_badi.badi_name', 'case_badi.badi_spouse_name', 'case_badi.badi_address', 'case_bibadi.bibadi_name', 'case_bibadi.bibadi_spouse_name', 'case_bibadi.bibadi_address')
        ->where('case_register.id', '=', $id)
        ->first();

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

        $data['page_title'] = 'মামলার বিস্তারিত তথ্য'; //exit;
        return view('dashboard.case_details')->with($data);
     }*/



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
        /*$validator = \Validator::make($request->all(), [
            'group' => 'required',
            'comment' => 'required',
            ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        // User Info
        $user = Auth::user();

        // Inputs
        $roleGroup = $request->group;
        $caseID = $request->case_id;
        $input = $request->all();

        // Roles
        if($roleGroup == 1){
            // Superadmin
            $caseStatus = '';
        }elseif($roleGroup == 5){
            // DC Assistant
            $caseStatus = '';
        }elseif($roleGroup == 6){
            // DC
            $caseStatus = 2;
        }elseif($roleGroup == 7){
            // ADC (Revenue)
            $caseStatus = 3;
        }elseif($roleGroup == 8){
            // AC (RM)
            $caseStatus = 4;
        }elseif($roleGroup == 9){
            // AC (Land)
            $caseStatus = 5;
        }elseif($roleGroup == 10){
            // Survyor
            $caseStatus = 6;
        }elseif($roleGroup == 11){
            // Kanongo
            $caseStatus = 7;
        }elseif($roleGroup == 12){
            // ULAO
            $caseStatus = 8;
        }elseif($roleGroup == 13){
            // GP
            $caseStatus = 9;
        }elseif($roleGroup == 14){
            // ULAO
            $caseStatus = 10;
        }


        // Get Case Data
        $case = DB::table('case_register')
        ->select('id', 'cs_id', 'court_id', 'case_number', 'case_date', 'ct_id', 'mouja_id', 'upazila_id', 'district_id', 'tafsil', 'chowhaddi', 'show_cause_file', 'created_at')
        ->where('id', $caseID)
        ->first();
        // dd($case);

        // Insert data into case_log table
        $log_data = [
        'case_id'       => $caseID,
        'status_id'     => $caseStatus,
        'user_id'       => $user->id,
        'send_user_group_id' => $user->role_id,
        'receive_user_group_id' => $roleGroup,
        'comment'      => $request->comment,
        'created_at'    => date('Y-m-d H:i:s'),
        ];
        DB::table('case_log')->insert($log_data);
        // Book::create($input);
        // dd($data_case_log);

        // Update Case Register (cs_id, action_user_group_id, status(2), updated_at) table
        $case_data = [
        'cs_id'     => $caseStatus,
        'action_user_group_id' => $roleGroup,
        'status'       => 2,
        'updated_at'    => date('Y-m-d H:i:s'),
        ];
        DB::table('case_register')->where('id', $caseID)->update($case_data);

        return response()->json(['success'=>'Data is successfully added']);*/
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function create_sf(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'sf_details' => 'required',
            ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        // User Info
        $user = Auth::user();

        // Inputs
        $caseID = $request->case_id;
        $sfDetails = $request->sf_details;
        // $input = $request->all();
        // dd($input);

        // Insert data into case_sf table
        $sf_data = [
        'case_id'       => $caseID,
        'sf_details'    => $sfDetails,
        'user_id'       => $user->id,
        'created_at'    => date('Y-m-d H:i:s'),
        ];
        DB::table('case_sf')->insert($sf_data);
        // dd($sf_data);

        // Update Case Register (is_sf(1), status(2), updated_at) table
        $case_data = [
        'is_sf'     => 1,
        //'status'       => 2,
        //'updated_at'    => date('Y-m-d H:i:s'),
        ];
        DB::table('case_register')->where('id', $caseID)->update($case_data);

        return response()->json(['success'=>'Data is successfully added','sfdata'=>'Data is successfully added']);
     } */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    /*public function edit_sf(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'sf_details' => 'required',
            ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        // Inputs
        $caseID = $request->case_id;
        $sfID = $request->sf_id;
        $sfDetails = $request->sf_details;
        // $input = $request->all();
        // dd($input);

        // Update Case SF table
        $sf_data = [
        'sf_details'  => $sfDetails,
        'updated_at'  => date('Y-m-d H:i:s'),
        ];
        DB::table('case_sf')->where('id', $sfID)->update($sf_data);

        return response()->json(['success'=>'Data is successfully updated','sfdata'=> 'SF Details']);
     }*/

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }

    public function logincheck(){
       if(Auth::check()){
            // dd('checked');
         return redirect('dashboard');
      }else{
         return redirect('login');
      }
   }
    public function public_home(){
       if(Auth::check()){
            // dd('checked');
         return redirect('dashboard');
      }else{
         return view('public_home');
        //  return redirect('login');
      }
   }
}
