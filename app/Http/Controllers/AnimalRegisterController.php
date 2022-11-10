<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\AnimalRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use LaravelQRCode\Facades\QRCode;


class AnimalRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //============All Case list============//
    public function index()
    {
        $roleID = Auth::user()->role_id;
        $query = DB::table('animal_register')
        ->orderBy('id','DESC')
        ->leftjoin('animal_type', 'animal_register.type_id', '=', 'animal_type.id')
        ->leftjoin('animal_cast_type', 'animal_register.cast_type', '=', 'animal_cast_type.id')
        ->leftjoin('purpose_type', 'animal_register.purpose_type', '=', 'purpose_type.id')
        ->select('animal_register.*', 'animal_type.type_name', 'animal_cast_type.type_name', 'purpose_type.type_name');
        //Add Conditions
        if(!empty($_GET['date_start'])  && !empty($_GET['date_end'])){
            // dd(1);
            $dateFrom = date('Y-m-d', strtotime(str_replace('/', '-', $_GET['date_start'])));
            $dateTo =  date('Y-m-d', strtotime(str_replace('/', '-', $_GET['date_end'])));
            $query->whereBetween('animal_register.entry_date', [$dateFrom, $dateTo]);
        }

        // Check User Role ID
        if($roleID == 2 ){
            $query->where('animal_register.district_id','=', Auth::user()->district_id);

        }

        $data['animals'] = $query->paginate(10)->withQueryString();
        $data['divisions'] = DB::table('division')->select('id', 'division_name_bn')->get();


        // $roleID = Auth::user()->role_id;
        // dd($data['courts']);
        // return $data;
        $data['page_title'] = 'সকল পশুর তালিকা';
        return view('case.index')->with($data);
    }

    //============Running Case list============//

    public function running_case()
    {
        $roleID = Auth::user()->role_id;
        $query = DB::table('animal_register')
        ->orderBy('id','DESC')
        // ->join('court', 'animal_register.court_id', '=', 'court.id')
        ->leftjoin('animal_type', 'animal_register.ct_id', '=', 'animal_type.id')
        ->select('animal_register.*',  'animal_type.type_name');

        //Add Conditions
        if(!empty($_GET['date_start'])  && !empty($_GET['date_end'])){
            // dd(1);
            $dateFrom = date('Y-m-d', strtotime(str_replace('/', '-', $_GET['date_start'])));
            $dateTo =  date('Y-m-d', strtotime(str_replace('/', '-', $_GET['date_end'])));
            $query->whereBetween('animal_register.entry_date', [$dateFrom, $dateTo]);
        }


        // Check User Role ID
        if($roleID == 2){
            $query->where('animal_register.user_id','=', Auth::user()->id);
        }

        $data['animals'] = $query->paginate(10)->withQueryString();
        $data['page_title'] = 'প্রাপ্ত বয়স্ক ষাঁড়ের তালিকা';
        return view('case.index')->with($data);
        // return view('case.index')/*->with($data);*/
        // $cases = CaseRegister::latest()->paginate(5);
        // $page_title = 'মোকদ্দমা এন্ট্রি রেজিষ্টারের তালিকা';

        // ->with('i', (request()->input('page',1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['animal_types'] = DB::table('animal_type')->select('id', 'type_name')->get();
        $data['animal_cast_types'] = DB::table('animal_cast_type')->select('id', 'type_name')->get();
        $data['purpose_types'] = DB::table('purpose_type')->select('id', 'type_name')->get();

        $data['page_title'] = 'নতুন পশুর এন্ট্রি ফরম'; //exit;
        // return view('case.case_add', compact('page_title', 'animal_type'));
        return view('case.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo  QRCode::text('QR Code Generator for Laravel!')->png();
        // return $request;
        if($request->animal_image != NULL){
            $fileName = Auth::user()->id.'_'.time().'.'.$request->animal_image->extension();
            $request->animal_image->move(public_path('uploads/animal_image/'), $fileName);
        }else{
            $fileName = NULL;
        }
        // Convert DB date formate
        $dob = $request->birth_date;
        $dob_format = str_replace('/', '-', $dob);
        // dd($dob_format);
        $regDate = $request->farm_reg_date;
        $regDate_format = str_replace('/', '-', $regDate);

        $anthraxDate = $request->anthrax_date;
        $anthraxDate_format = str_replace('/', '-', $anthraxDate);

        $haemorrahagicDate = $request->haemorrahagic_date;
        $haemorrahagicDate_format = str_replace('/', '-', $haemorrahagicDate);

        $black_quarterDate = $request->black_quarter_date;
        $black_quarterDate_format = str_replace('/', '-', $black_quarterDate);

        $khurarogrDate = $request->khurarog_date;
        $khurarogrDate_format = str_replace('/', '-', $khurarogrDate);

        $rabiesDate = $request->rabies_date;
        $rabiesDate_format = str_replace('/', '-', $rabiesDate);

        $data = [
            'cast_type'      => $request->animal_cast_type,
            'action_user_group_id'   => Auth::user()->role_id,
            'farm_reg_date'   => date("Y-m-d", strtotime($regDate_format)),
            'type_id'   => $request->animal_type,
            'purpose_type'   => $request->purpose_type,
            'birth_date'   => date("Y-m-d", strtotime($dob_format)),
            'weight'   => $request->weight,
            'ownership_type'   => $request->ownership_type,
            'buying_price'   => $request->buying_price,
            'child_amount'   => $request->child_amount,
            'avg_milk_amount'   => $request->avg_milk_amount,
            'anthrax'   => isset($request->anthrax) ? $request->anthrax : 0,
            'anthrax_date'   => date("Y-m-d", strtotime($anthraxDate_format)),
            'haemorrahagic'   => isset($request->haemorrahagic) ? $request->haemorrahagic : 0,
            'haemorrahagic_date'   => date("Y-m-d", strtotime($haemorrahagicDate_format)),
            'black_quarter'   => isset($request->black_quarter) ? $request->black_quarter : 0,
            'black_quarter_date'   => date("Y-m-d", strtotime($black_quarterDate_format)),
            'khurarog'   => isset($request->khurarog) ? $request->khurarog : 0,
            'khurarog_date'   => date("Y-m-d", strtotime($khurarogrDate_format)),
            'rabies'   => isset($request->rabies) ? $request->rabies : 0,
            'rabies_date'   => date("Y-m-d", strtotime($rabiesDate_format)),
            'animal_image'   => $fileName,
            'user_id'   => Auth::user()->id,
            'division_id'   => Auth::user()->division_id,
            'district_id'   => Auth::user()->district_id,
            'upazila_id'   => Auth::user()->upazila_id,
            'upazila_id'   => Auth::user()->upazila_id,
            'created_at'   => date('Y-m-d H:i:s'),
        ];
        $ID = DB::table('animal_register')->insertGetId($data);
    /*$qrcodeName = Auth::user()->id.'_'.time().'.'.$ID;
    $qrcodeValue =  route('animal.details', $ID) ;

    $qrcode = QrCode::size(500)
                ->format('png')
                ->generate($qrcodeValue, public_path('uploads/qr/'.$qrcodeName. '_qrcode.png'));

    if($qrcode){
        $qr_data = [
            'qr_data' => $qrcodeName,
        ];

         DB::table('animal_register')
        ->where('id', $ID)
        ->update($qr_data);
    }    */



        return redirect()->route('animal')
        ->with('success', 'তথ্য সফলভাবে সিষ্টেম সংরক্ষণ করা হয়েছে') ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaseRegister  $caseRegister
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $data['info'] = DB::table('animal_register')
        ->leftjoin('animal_type', 'animal_register.type_id', '=', 'animal_type.id')
        ->leftjoin('animal_cast_type', 'animal_register.cast_type', '=', 'animal_cast_type.id')
        ->leftjoin('purpose_type', 'animal_register.purpose_type', '=', 'purpose_type.id')
        ->select('animal_register.*', 'animal_type.type_name as cast_name', 'animal_cast_type.type_name as cast_name', 'purpose_type.type_name as purpose_name')
        ->where('animal_register.id', '=', $id)
        ->first();

        return $data;
        $data['page_title'] = 'পশুর বিস্তারিত তথ্য'; //exit;
        return view('case.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CaseRegister  $caseRegister
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $userDivision = user_division();
        $userDistrict = user_district();
        // ->where('id',$id)->first();
        $data['info'] = DB::table('animal_register')
        ->join('upazila', 'animal_register.upazila_id', '=', 'upazila.id')
        ->join('mouja', 'animal_register.mouja_id', '=', 'mouja.id')
        // ->join('animal_type', 'animal_register.ct_id', '=', 'animal_type.id')
        ->join('case_status', 'animal_register.cs_id', '=', 'case_status.id')
        ->select('animal_register.*', 'upazila.upazila_name_bn', 'mouja.mouja_name_bn',  'case_status.status_name')
        ->where('animal_register.id', $id)
        ->first();
        // dd($data['info']->id);

        $data['badis_list'] =DB::table('case_badi')
        ->join('animal_register', 'case_badi.case_id', '=', 'animal_register.id')
        ->select('case_badi.*')
        ->where('case_badi.case_id', '=', $id)
        ->get();

        $data['bibadis_list'] =DB::table('case_bibadi')
        ->join('animal_register', 'case_bibadi.case_id', '=', 'animal_register.id')
        ->select('case_bibadi.*')
        ->where('case_bibadi.case_id', '=', $id)
        ->get();

        $data['survey_list'] =DB::table('case_survey')
        ->join('animal_register', 'case_survey.case_id', '=', 'animal_register.id')
        ->join('survey_type', 'case_survey.st_id', '=', 'survey_type.id')
        ->join('land_type', 'case_survey.lt_id', '=', 'land_type.id')
        ->select('case_survey.*','survey_type.st_name','land_type.lt_name')
        ->where('case_survey.case_id', '=', $id)
        ->get();

        // dd($data['surveys'][0]);

        // Dropdown List
        $data['divisions'] = DB::table('division')->select('id', 'division_name_bn')->get();

        $data['districts'] = DB::table('district')->select('id', 'distritype_name_bn')->where('division_id' , $userDivision)->get();
        $data['upazilas'] = DB::table('upazila')->select('id', 'upazila_name_bn')->where('district_id', $userDistrict)->get();
        // dd( $data['upazilas']);
        $data['moujas'] = DB::table('mouja')->select('id', 'mouja_name_bn')->where('upazila_id', $data['info']->upazila_id)->get();
        $data['animal_types'] = DB::table('animal_type')->select('id', 'type_name')->get();
        $data['surveys'] = DB::table('survey_type')->select('id', 'st_name')->get();
        $data['land_types'] = DB::table('land_type')->select('id', 'lt_name')->get();

        $data['page_title'] = ' মোকদ্দমা সংশোধন ফরম'; //exit;

        // return view('case.case_add', compact('page_title', 'animal_type'));
        return view('case.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseRegister  $caseRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id='')
    {
        // return $request;
        // dd($request->all());
        //Auth User Info
        $userDivision = user_division();
        $userDistrict = user_district();

        $case_old_data = CaseRegister::findOrFail($id)->toArray();

        $case_id = DB::table('animal_register')->where('id', $id)->get();

        $request->validate([
            'upazila' => 'required',
            'mouja' => 'required',
            // 'animal_type' => 'required',
            'case_no' => 'required',
            'birth_date' => 'required',
            'show_cause' => 'mimes:pdf|max:10240',
            ],
            [
            'upazila.required' => 'উপজেলা নির্বাচন করুন',
            'mouja.required' => 'মৌজা নির্বাচন করুন',
            // 'animal_type.required' => 'মোকদ্দমার ধরণ নির্বাচন করুন',
            'case_no.required' => 'মোকদ্দমা নং নির্বাচন করুন',
            'case_date.required' => 'মোকদ্দমা রুজুর তারিখ নির্বাচন করুন',
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
        // dd($request->all());

        // File upload
        if($request->has('show_cause')){
            $fileName ='_'.time().'.'.$request->show_cause->extension();
            $request->show_cause->move(public_path('uploads/show_cause/'), $fileName);
        }else{
            $fileName = $case_id[0]->show_cause_file;
        }

        // Convert DB date formate
        $caseDate = $request->case_date;
        $date_format = str_replace('/', '-', $caseDate);

        // Make animal_register table data array
        $data = [
        'case_number'   => $request->case_no,
        'case_date'     => date("Y-m-d", strtotime($date_format)),
        // 'ct_id'         => $request->animal_type,
        'mouja_id'      => $request->mouja,
        'upazila_id'    => $request->upazila,
        'district_id'   => $userDistrict,
        'division_id'   => $userDivision,
        // 'tafsil'        => $request->tafsil,
        'chowhaddi'     => $request->chowhaddi,
        'comments'      => $request->comments,
        'show_cause_file' => $fileName,
        'user_id'       => Auth::id(),
        'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // $badi = $request->input('badi_name');
        // dd($data);

        // Inser to DB
        // CaseRegister::create($data);
        $ID = DB::table('animal_register')
        ->where('id', $id)
        ->update($data);

        // dd($request->input('badi_name'));

        // Badi
        for ($i=0; $i<sizeof($request->input('badi_name')); $i++) {
            // dd($request->all());
            DB::table('case_badi')->updateOrInsert(
                ['id' => $request->input('hide_badi_id')[$i]],
                [
                'case_id'           => $id,
                'badi_name'         => $request->input('badi_name')[$i],
                'badi_spouse_name'  => $request->input('badi_spouse_name')[$i],
                'badi_address'      => $request->input('badi_address')[$i],
                ]
                );
        }


        //===================Bibadi=====================//

        // Bibadi
        for ($i=0; $i<sizeof($request->input('bibadi_name')); $i++) {
            // dd($request->all());
            DB::table('case_bibadi')->updateOrInsert(
                ['id' => $request->input('hide_bibadi_id')[$i]],
                [
                'case_id'       => $id,
                'bibadi_name'     => $request->input('bibadi_name')[$i],
                'bibadi_spouse_name' => $request->input('bibadi_spouse_name')[$i],
                'bibadi_address'   => $request->input('bibadi_address')[$i],
                ]
                );
        }




        //===================Survey=====================//


        // Survey
        for ($i=0; $i<sizeof($request->input('khotian_no')); $i++) {
            // dd($request->all());
                $landSize = bn2en($request->input('land_size')[$i]);
                $landDemand = bn2en($request->input('land_demand')[$i]);
            DB::table('case_survey')->updateOrInsert(
                ['id' => $request->input('hide_survey_id')[$i]],
                [
                'case_id'       => $id,
                'st_id'         => $request->input('st_id')[$i],
                'khotian_no'    => $request->input('khotian_no')[$i],
                'daag_no'       => $request->input('daag_no')[$i],
                'lt_id'         => $request->input('lt_id')[$i],
                'land_size'     => $landSize,
                'land_demand'   => $landDemand,
                ]
            );
        }

        //====================Multiple File =========================//
        foreach($request->file_type as $key => $val)
            {
                if(!empty($val)){
                    $filePath = 'uploads/show_cause/others/';
                    if($request->file_name[$key] != NULL){
                        $otherfileName = $userDivision.'_'.time().'.'.rand().'.'.$request->file_name[$key]->extension();
                        $request->file_name[$key]->move(public_path('uploads/show_cause/others/'), $otherfileName);
                    }/*else{
                        $otherfileName = NULL;
                    }*/
                    $files[] = $otherfileName;
                    // return $files;
                    $othersFile = new CaseOtherFiles();
                    $othersFile->case_id = $id;
                    $othersFile->file_type = $request->file_type[$key];
                    $othersFile->file_name = $filePath.$files[$key];
                    $othersFile->save();
                }
            }


        //========= Case Activity Log -  start ============
        $caseRegister = CaseRegister::findOrFail($id)->toArray();
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
        $cs_activity_data['animal_register_id'] = $id;
        $cs_activity_data['activity_type'] = 'Update';
        $cs_activity_data['message'] = 'রেজিস্ট্রার মোকদ্দমা আপডেট করা হয়েছে';
        $cs_activity_data['old_data'] = json_encode($case_old_data);
        $cs_activity_data['new_data'] = json_encode($caseRegisterData);
        case_activity_logs($cs_activity_data);
        // ========= Case Activity Log  End ==========

        return redirect()->route('case')
        ->with('success', 'মোকদ্দমার তথ্য সফলভাবে সিষ্টেম সংরক্ষণ করা হয়েছে');
    }


    /**************************************************************/
    /********************* Old Running Case Register **********************/
    /**************************************************************/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //============All Case list============//


    public function getDependentDistrict($id)
    {
        $subcategories = DB::table("district")->where("division_id",$id)->pluck("distritype_name_bn","id");
        return json_encode($subcategories);
    }

    public function getDependentUpazila($id)
    {
        $subcategories = DB::table("upazila")->where("district_id",$id)->pluck("upazila_name_bn","id");
        return json_encode($subcategories);
    }

    public function getDependentOffice($id)
    {
        $subcategories = DB::table("office")->where("district_id",$id)->pluck("office_name_bn","id");
        return json_encode($subcategories);
    }

    public function getDependentDistrictOffice($id)
    {
        $subcategories = DB::table("office")->where("district_id",$id)->where("level",4)->pluck("office_name_bn","id");
        return json_encode($subcategories);
    }

    public function getDependentUpazilaOffice($id)
    {
        $subcategories = DB::table("office")->where("upazila_id",$id)->pluck("office_name_bn","id");
        return json_encode($subcategories);
    }

    public function getDependentMouja($id)
    {
        $subcategories = DB::table("mouja")->where("upazila_id",$id)->pluck("mouja_name_bn","id");
        return json_encode($subcategories);
    }

    public function getDependentGp($id)
    {
        $subcategories = DB::table("users")
        ->join('office', 'users.office_id', '=', 'office.id')
        ->leftJoin('district', 'office.district_id', '=', 'district.id')
        ->where("district.id",$id)->where("users.role_id",13)->pluck("users.name","users.id");
        return json_encode($subcategories);
    }

    public function ajaxBadiDelete($id)
    {
        // dd($id);
        // $this->CaseBadi->deleteBadi('id', $id);
        DB::table('case_badi')->where('id',$id)->delete();
        echo 'This information remove from database.';
    }

    public function ajaxBibadiDelete($id)
    {
        // $this->Common_model->delete('pds_education', 'id', $id);
        DB::table('case_bibadi')->where('id',$id)->delete();
        echo 'This information remove from database.';
    }

    public function ajaxSurvayDelete($id)
    {
        // $this->Common_model->delete('pds_education', 'id', $id);
        DB::table('case_survey')->where('id',$id)->delete();
        echo 'This information remove from database.';
    }

}
