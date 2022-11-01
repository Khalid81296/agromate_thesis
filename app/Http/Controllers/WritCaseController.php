<?php

namespace App\Http\Controllers;

use \Auth;
use App\Models\Advocate;
use App\Models\Writ_CaseRegister;
use App\Models\Writ_CaseBadi;
use App\Models\Writ_CaseBibadi;
use App\Models\Writ_CaseSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WritCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleID = Auth::user()->role_id;
        $officeInfo = user_office_info();
        // dd($officeInfo);
        // Dorpdown
        $upazilas = NULL;
        $courts = DB::table('court')->select('id', 'court_name')->get();
        $divisions = DB::table('division')->select('id', 'division_name_bn')->get();
        $user_role = DB::table('role')->select('id', 'role_name')->get();

        // All user list
        $query = DB::table('writ__case_register')
        ->orderBy('id','DESC')
        ->join('court', 'writ__case_register.court_id', '=', 'court.id')
        ->join('division', 'writ__case_register.division_id', '=', 'division.id')
        ->join('district', 'writ__case_register.district_id', '=', 'district.id')
        ->join('upazila', 'writ__case_register.upazila_id', '=', 'upazila.id')
        ->join('mouja', 'writ__case_register.mouja_id', '=', 'mouja.id')
        ->select('writ__case_register.*', 'court.court_name', 'mouja.mouja_name_bn', 'division.division_name_bn', 'district.district_name_bn', 'upazila.upazila_name_bn');
        // ->where('district_id',38)

        //Add Conditions
        if(!empty($_GET['date_start'])  && !empty($_GET['date_end'])){
            // dd(1);
            $dateFrom = date('Y-m-d', strtotime(str_replace('/', '-', $_GET['date_start'])));
            $dateTo =  date('Y-m-d', strtotime(str_replace('/', '-', $_GET['date_end'])));
            $query->whereBetween('writ__case_register.case_date', [$dateFrom, $dateTo]);
        }
        if(!empty($_GET['role'])) {
            $query->where('writ__case_register.action_user_group_id','=',$_GET['role']);
        }
        if(!empty($_GET['court'])) {
            $query->where('writ__case_register.court_id','=',$_GET['court']);
        }
        if(!empty($_GET['case_no'])) {
            $query->where('writ__case_register.case_number','=',$_GET['case_no']);
        }
        if(!empty($_GET['division'])) {
            $query->where('writ__case_register.division_id','=',$_GET['division']);
        }
        if(!empty($_GET['district'])) {
            $query->where('writ__case_register.district_id','=',$_GET['district']);
        }
        if(!empty($_GET['upazila'])) {
            $query->where('writ__case_register.upazila_id','=',$_GET['upazila']);
        }
        if(!empty($_GET['gp'])) {
            $query->where('writ__case_register.gp_user_id','=',$_GET['gp']);
        }

        // Check User Role ID
        if($roleID == 5 || $roleID == 6 || $roleID == 7 || $roleID == 8 || $roleID == 13 || $roleID == 16){
            $query->where('writ__case_register.district_id','=', $officeInfo->district_id);
        }elseif($roleID == 9 || $roleID == 10 || $roleID == 11){
            $query->where('writ__case_register.upazila_id','=', $officeInfo->upazila_id);
        }elseif($roleID == 12){
            $moujaIDs = $this->get_mouja_by_ulo_office_id(Auth::user()->office_id);
            // dd($moujaIDs);
            // print_r($moujaIDs); exit;
            $query->whereIn('writ__case_register.mouja_id', [$moujaIDs]);
        }

        $cases = $query->paginate(10);


        // Dorpdown
        $upazilas = NULL;
        $courts = DB::table('court')->select('id', 'court_name')->get();
        $divisions = DB::table('division')->select('id', 'division_name_bn')->get();
        $user_role = DB::table('role')->select('id', 'role_name')->get();

        if($roleID == 5 || $roleID == 6 || $roleID == 7 || $roleID == 8 || $roleID == 13 || $roleID == 16){
            $courts = DB::table('court')->select('id', 'court_name')->where('district_id', $officeInfo->district_id)->orWhere('district_id', NULL)->get();
            $upazilas = DB::table('upazila')->select('id', 'upazila_name_bn')->where('district_id', $officeInfo->district_id)->get();

        }elseif($roleID == 9 || $roleID == 10 || $roleID == 11 || $roleID == 12){
            $courts = DB::table('court')->select('id', 'court_name')->where('district_id', $officeInfo->district_id)->orWhere('district_id', NULL)->get();
        }

        $gp_users = DB::table('users')->select('id', 'name')->where('role_id', 13)->get();
        // $roleID = Auth::user()->role_id;
        // dd($cases);

        $page_title = 'রিট মামলা এন্ট্রি রেজিষ্টারের তালিকা';
        return view('write_case.write_case_register.index', compact(['page_title', 'cases', 'divisions', 'upazilas', 'courts', 'gp_users', 'user_role']))
        ->with('i', (request()->input('page',1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Dropdown List
        $data['divisions'] = DB::table('division')->select('id', 'division_name_en')->get();
        $data['advocates'] = DB::table('advocate_details')->select('id', 'name')->get();
        $data['courts'] = DB::table('court')
                ->select('id', 'court_name')
                ->where('ct_id', 2)
                ->get();

        
        $data['old_case_no'] = DB::table('case_register')->select('id', 'case_number')->where('status',3)->get();
        $data['surveys'] = DB::table('survey_type')->select('id', 'st_name')->get();
        $data['land_types'] = DB::table('land_type')->select('id', 'lt_name')->get();

        // dd($data);
        // dd($advocate);
        // $data['subcategories'] = DB::table("mouja")->where("upazila_id",38)->pluck("mouja_name_bn","id");

        $data['page_title'] = 'Writ Case Entry Form'; //exit;
        return view('write_case.write_case_register.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // $name = $request->input('name');
        if(isset($request->ref_case_no)>0){
            $old_case_no = DB::table('case_register')->select('case_number')->where('id',$request->ref_case_no)->first()->case_number;
        }else{
            $old_case_no = NULL;
        }

        //Auth User Info
       /* $userDivision = user_division();
        $userDistrict = user_district();*/

        // Form validation
        $request->validate([
            'court' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'mouja' => 'required',
            'advocate' => 'required',
            'case_no' => 'required',
            'case_date' => 'required',
            'show_cause' => 'required|mimes:pdf|max:10240',
            ],
            [
            'court.required' => 'আদালতের নাম নির্বাচন করুন',
            'division.required' => 'বিভাগ নির্বাচন করুন',
            'district.required' => 'জেলা নির্বাচন করুন',
            'upazila.required' => 'উপজেলা নির্বাচন করুন',
            'mouja.required' => 'মৌজা নির্বাচন করুন',
            // 'advocate.required' => 'মামলার ধরণ নির্বাচন করুন',
            'case_no.required' => 'মামলা নং নির্বাচন করুন',
            'case_date.required' => 'মামলা রুজুর তারিখ নির্বাচন করুন',
            'show_cause.required' => 'কারণ দর্শানোর নোটিশ পিডিএফ ফাইল ফরমেটে নির্বাচন করুন',
            ]);

        // Dynamic form validation
        if($request->input('badi_name')){
            foreach($request->input('badi_name') as $key => $val)
            {
                $request->validate([
                    'badi_name.'.$key => 'required',
                    'badi_spouse_name.'.$key => '',
                    'badi_address.'.$key => '',
                    ]);
            }
        }

        // dd($request->all());
        // $input = $request->all();

        // File upload
        if($request->show_cause != NULL){
            $fileName = $request->court.'_'.time().'.'.$request->show_cause->extension();
            $request->show_cause->move(public_path('uploads/show_cause/'), $fileName);
        }else{
            $fileName = NULL;
        }

        // Convert DB date formate
        $caseDate = $request->case_date;
        $date_format = str_replace('/', '-', $caseDate);

        // Make case_register table data array
        $data = [
        'cs_id'         => 1,
        'court_id'      => $request->court,
        'case_number'   => $request->case_no,
        'ref_case_no'   => $old_case_no,
        'ref_id'   => $request->ref_case_no,
        'case_date'     => date("Y-m-d", strtotime($date_format)),
        'action_user_group_id' => 6,
        'ct_id'         => 44,
        'mouja_id'      => $request->mouja,
        'upazila_id'    => $request->upazila,
        'district_id'   => $request->district,
        'division_id'   => $request->division,
        'tafsil'        => $request->tafsil,
        'chowhaddi'     => $request->chowhaddi,
        'advocate_id'   => $request->advocate,
        'comments'      => $request->comments,
        'show_cause_file' => $fileName,
        'user_id'       => Auth::id(),
        'created_at'    => date('Y-m-d H:i:s'),
        ];

        // $badi = $request->input('badi_name');
        // dd($data);

        // Inser to DB
        // CaseRegister::create($data);
        $ID = DB::table('writ__case_register')->insertGetId($data);

        // Insert Badi Table
        for ($i=0; $i<sizeof($request->input('badi_name')); $i++) {
            $dynamic_data = [
            'case_id'       => $ID,
            'badi_name'     => $_POST['badi_name'][$i],
            'badi_spouse_name' => $_POST['badi_spouse_name'][$i],
            'badi_address'   => $_POST['badi_address'][$i],
            ];
            DB::table('writ__case_badi')->insert($dynamic_data);
        }

        // Insert Bibadi Table
        for ($i=0; $i<sizeof($request->input('bibadi_name')); $i++) {
            $dynamic_data = [
            'case_id'       => $ID,
            'bibadi_name'     => $_POST['bibadi_name'][$i],
            'bibadi_spouse_name' => $_POST['bibadi_spouse_name'][$i],
            'bibadi_address'   => $_POST['bibadi_address'][$i],
            ];
            DB::table('writ__case_bibadi')->insert($dynamic_data);
        }

        // Insert Judge Table
        for ($i=0; $i<sizeof($request->input('justis_name')); $i++) {
            $dynamic_data = [
            'case_id'       => $ID,
            'justis_name'     => $_POST['justis_name'][$i],
            'justis_designation' => $_POST['justis_designation'][$i],
            ];
            DB::table('writ__case_justis')->insert($dynamic_data);
        }

        // Insert Advocate Table
       /* for ($i=0; $i<sizeof($request->input('advocate_name')); $i++) {
            $dynamic_data = [
            'case_id'       => $ID,
            'advocate_name'     => $_POST['advocate_name'][$i],
            'advocate_designation' => $_POST['advocate_designation'][$i],
            ];
            DB::table('writ__case_advocate')->insert($dynamic_data);
        }*/

        // Insert Witness Table
        for ($i=0; $i<sizeof($request->input('witness_name')); $i++) {
            $dynamic_data = [
            'case_id'       => $ID,
            'witness_name'     => $_POST['witness_name'][$i],
            'witness_designation' => $_POST['witness_designation'][$i],
            'witness_address'   => $_POST['witness_address'][$i],
            ];
            DB::table('writ__case_witness')->insert($dynamic_data);
        }

        // Insert Survey Table
        for ($i=0; $i<sizeof($request->input('st_id')); $i++) {
            $dynamic_data = [
            'case_id'       => $ID,
            'st_id'         => $_POST['st_id'][$i],
            'khotian_no'    => $_POST['khotian_no'][$i],
            'daag_no'       => $_POST['daag_no'][$i],
            'lt_id'         => $_POST['lt_id'][$i],
            'land_size'     => $_POST['land_size'][$i],
            'land_demand'   => $_POST['land_demand'][$i],
            ];
            DB::table('writ__case_survey')->insert($dynamic_data);
        }

        // Insert data into case_log table
        $log_data = [
            'case_id'       => $ID,
            'status_id'     => 44,
            'user_id'       => Auth::id(),
            // 'send_user_group_id' => $user->role_id,
            'receive_user_group_id' =>  Auth::user()->role_id,
            'created_at'    => date('Y-m-d H:i:s'),
            ];
        DB::table('writ__case_log')->insert($log_data);
        // dd('ok');

        //========= Case Activity Log -  start ============
        $caseRegister = Writ_CaseRegister::findOrFail($ID)->toArray();
        // dd($caseRegister);
        $caseRegisterData = array_merge( $caseRegister, [
            'show_cause' => 'uploads/show_cause/'.$fileName,
            'badi' => [
                'badi_name'     => $request->badi_name,
                'badi_spouse_name' => $request->badi_spouse_name,
                'badi_address'   => $request->badi_address,
            ],
            'bibadi' => [
                'bibadi_name'     => $request->bibadi_name,
                'bibadi_spouse_name' => $request->bibadi_spouse_name,
                'bibadi_address'   => $request->bibadi_address,
            ],
            'case_survey' => [
                'st_id' => $request->st_id,
                'khotian_no' => $request->khotian_no,
                'daag_no' => $request->daag_no,
                'lt_id'  => $request->lt_id,
                'land_size'   => $request->land_size,
                'land_demand'   => $request->land_demand,
            ],
        ]);
        $cs_activity_data['case_register_id'] = $ID;
        $cs_activity_data['division'] = $request->division;
        $cs_activity_data['district'] = $request->district;
        $cs_activity_data['upazila'] = $request->upazila;
        $cs_activity_data['activity_type'] = 'Create';
        $cs_activity_data['message'] = 'নতুন মামলা রেজিস্ট্রেশন করা হয়েছে';
        $cs_activity_data['old_data'] = null;
        $cs_activity_data['new_data'] = json_encode($caseRegisterData);
        Write_case_activity_logs($cs_activity_data);
        // ========= Case Activity Log  End ==========
        // return redirect('case');
        return redirect()->route('writcase.index')
        ->with('success', 'মামলার তথ্য সফলভাবে সিষ্টেম সংরক্ষণ করা হয়েছে');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $data['info'] = DB::table('writ__case_register')
        ->join('court', 'writ__case_register.court_id', '=', 'court.id')
        ->leftJoin('users', 'writ__case_register.gp_user_id', '=', 'users.id')
        ->join('division', 'writ__case_register.division_id', '=', 'division.id')
        ->join('district', 'writ__case_register.district_id', '=', 'district.id')
        ->join('upazila', 'writ__case_register.upazila_id', '=', 'upazila.id')
        ->join('mouja', 'writ__case_register.mouja_id', '=', 'mouja.id')
        ->join('role', 'writ__case_register.action_user_group_id', '=', 'role.id')
        ->join('case_status', 'writ__case_register.cs_id', '=', 'case_status.id')
        ->join('writ__case_badi', 'writ__case_register.id', '=', 'writ__case_badi.case_id')
        ->join('writ__case_bibadi', 'writ__case_register.id', '=', 'writ__case_bibadi.case_id')
        ->leftjoin('advocate_details', 'writ__case_register.advocate_id', '=', 'advocate_details.id')
        ->select('writ__case_register.*', 'court.court_name','users.name', 'division.division_name_bn', 'district.district_name_bn', 'upazila.upazila_name_bn', 'mouja.mouja_name_bn', 'case_status.status_name', 'role.role_name', 'writ__case_badi.badi_name', 'writ__case_badi.badi_spouse_name', 'writ__case_badi.badi_address', 'writ__case_bibadi.bibadi_name', 'writ__case_bibadi.bibadi_spouse_name', 'writ__case_bibadi.bibadi_address', 'advocate_details.name as advocate_name', 'advocate_details.present_address as advocate_address')
        ->where('writ__case_register.id', '=', $id)
        ->first();

        // dd($data['info']);

        $data['badis'] =DB::table('writ__case_badi')
        ->join('writ__case_register', 'writ__case_badi.case_id', '=', 'writ__case_register.id')
        ->select('writ__case_badi.*')
        ->where('writ__case_badi.case_id', '=', $id)
        ->get();

        $data['bibadis'] =DB::table('writ__case_bibadi')
        ->join('writ__case_register', 'writ__case_bibadi.case_id', '=', 'writ__case_register.id')
        ->select('writ__case_bibadi.*')
        ->where('writ__case_bibadi.case_id', '=', $id)
        ->get();

        $data['justices'] =DB::table('writ__case_justis')
        ->join('writ__case_register', 'writ__case_justis.case_id', '=', 'writ__case_register.id')
        ->select('writ__case_justis.*')
        ->where('writ__case_justis.case_id', '=', $id)
        ->get();

        $data['witnesses'] =DB::table('writ__case_witness')
        ->join('writ__case_register', 'writ__case_witness.case_id', '=', 'writ__case_register.id')
        ->select('writ__case_witness.*')
        ->where('writ__case_witness.case_id', '=', $id)
        ->get();

       /* $data['advocates'] =DB::table('writ__case_advocate')
        ->join('writ__case_register', 'writ__case_advocate.case_id', '=', 'writ__case_register.id')
        ->select('writ__case_advocate.*')
        ->where('writ__case_advocate.case_id', '=', $id)
        ->get();*/

        $data['surveys'] =DB::table('writ__case_survey')
        ->join('writ__case_register', 'writ__case_survey.case_id', '=', 'writ__case_register.id')
        ->join('survey_type', 'writ__case_survey.st_id', '=', 'survey_type.id')
        ->join('land_type', 'writ__case_survey.lt_id', '=', 'land_type.id')
        ->select('writ__case_survey.*','survey_type.st_name','land_type.lt_name')
        ->where('writ__case_survey.case_id', '=', $id)
        ->get();

        $data['sf_logs'] = DB::table('writ__case_sf_log')
        ->select('writ__case_sf_log.*', 'users.name')
        ->join('users', 'users.id', '=', 'writ__case_sf_log.user_id')
        ->where('writ__case_sf_log.case_id', '=', $id)
        ->get();

        // dd($data['info']);

        $data['page_title'] = 'রিট মামলার বিস্তারিত তথ্য'; //exit;
        return view('write_case.write_case_register.show')->with($data);
    }

    public function sflog_details($id)
    {
        $data['sflog'] = DB::table('writ__case_sf_log')->select('writ__case_sf_log.case_id', 'writ__case_sf_log.sf_log_details')->where('writ__case_sf_log.id', '=', $id)->first();
        // dd($data['sflog']->sf_log_details);

        // dd($id);
        $data['info'] = DB::table('writ__case_register')
        ->join('court', 'writ__case_register.court_id', '=', 'court.id')
        ->leftJoin('users', 'writ__case_register.gp_user_id', '=', 'users.id')
        ->join('division', 'writ__case_register.division_id', '=', 'division.id')
        ->join('district', 'writ__case_register.district_id', '=', 'district.id')
        ->join('upazila', 'writ__case_register.upazila_id', '=', 'upazila.id')
        ->join('mouja', 'writ__case_register.mouja_id', '=', 'mouja.id')
        ->join('role', 'writ__case_register.action_user_group_id', '=', 'role.id')
        ->join('case_status', 'writ__case_register.cs_id', '=', 'case_status.id')
        ->join('writ__case_badi', 'writ__case_register.id', '=', 'writ__case_badi.case_id')
        ->join('writ__case_bibadi', 'writ__case_register.id', '=', 'writ__case_bibadi.case_id')
        ->select('writ__case_register.*', 'court.court_name','users.name', 'division.division_name_bn', 'district.district_name_bn', 'upazila.upazila_name_bn', 'mouja.mouja_name_bn', 'case_status.status_name', 'role.role_name', 'writ__case_badi.badi_name', 'writ__case_badi.badi_spouse_name', 'writ__case_badi.badi_address', 'writ__case_bibadi.bibadi_name', 'writ__case_bibadi.bibadi_spouse_name', 'writ__case_bibadi.bibadi_address')
        ->where('writ__case_register.id', '=', $data['sflog']->case_id)
        ->first();


        $data['page_title'] = 'মামলার এস এফ লগের বিস্তারিত তথ্য'; //exit;
        return view('case.sflog_details')->with($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $userDivision = user_division();
        $userDistrict = user_district();
        // ->where('id',$id)->first();
        $data['info'] = DB::table('writ__case_register')
        ->join('court', 'writ__case_register.court_id', '=', 'court.id')
        ->join('upazila', 'writ__case_register.upazila_id', '=', 'upazila.id')
        ->join('mouja', 'writ__case_register.mouja_id', '=', 'mouja.id')
        // ->join('advocate', 'writ__case_register.ct_id', '=', 'advocate.id')
        ->join('case_status', 'writ__case_register.cs_id', '=', 'case_status.id')
        ->select('writ__case_register.*', 'court.court_name', 'upazila.upazila_name_bn', 'mouja.mouja_name_bn',  'case_status.status_name')
        ->where('writ__case_register.id', $id)
        ->first();
        // dd($data['info']->id);

        $data['badis_list'] =DB::table('writ__case_badi')
        ->join('writ__case_register', 'writ__case_badi.case_id', '=', 'writ__case_register.id')
        ->select('writ__case_badi.*')
        ->where('writ__case_badi.case_id', '=', $id)
        ->get();

        $data['bibadis_list'] =DB::table('writ__case_bibadi')
        ->join('writ__case_register', 'writ__case_bibadi.case_id', '=', 'writ__case_register.id')
        ->select('writ__case_bibadi.*')
        ->where('writ__case_bibadi.case_id', '=', $id)
        ->get();

        $data['survey_list'] =DB::table('writ__case_survey')
        ->join('writ__case_register', 'writ__case_survey.case_id', '=', 'writ__case_register.id')
        ->join('survey_type', 'writ__case_survey.st_id', '=', 'survey_type.id')
        ->join('land_type', 'writ__case_survey.lt_id', '=', 'land_type.id')
        ->select('writ__case_survey.*','survey_type.st_name','land_type.lt_name')
        ->where('writ__case_survey.case_id', '=', $id)
        ->get();

        // dd($data['surveys'][0]);

        // Dropdown List
        $data['divisions'] = DB::table('division')->select('id', 'division_name_bn')->get();
        $data['courts'] = DB::table('court')->select('id', 'court_name')
                ->where('district_id', $userDistrict)
                ->get();
        $data['districts'] = DB::table('district')->select('id', 'district_name_bn')->where('division_id' , $userDivision)->get();
        $data['upazilas'] = DB::table('upazila')->select('id', 'upazila_name_bn')->where('district_id', $userDistrict)->get();
        // dd( $data['upazilas']);
        $data['moujas'] = DB::table('mouja')->select('id', 'mouja_name_bn')->where('upazila_id', $data['info']->upazila_id)->get();
        $data['advocates'] = DB::table('advocate')->select('id', 'ct_name')->get();
        $data['surveys'] = DB::table('survey_type')->select('id', 'st_name')->get();
        $data['land_types'] = DB::table('land_type')->select('id', 'lt_name')->get();

        $data['page_title'] = ' মামলা সংশোধন ফরম'; //exit;

        // return view('case.case_add', compact('page_title', 'advocate'));
        return view('write_case.write_case_register.edit')->with($data);
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
    public function getDependentDistrict($id)
    {
        $subcategories = DB::table("district")->where("division_id",$id)->pluck("district_name_en","id");
        return json_encode($subcategories);
    }

    public function getDependentUpazila($id)
    {
        $subcategories = DB::table("upazila")->where("district_id",$id)->pluck("upazila_name_en","id");
        return json_encode($subcategories);
    }
}
