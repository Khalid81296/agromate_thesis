<?php

namespace App\Http\Controllers;

// use \Auth;
use Illuminate\Http\Request;
use App\Models\AffidavitCommittee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AffidavitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['info'] = AffidavitCommittee::where('status',1)->orderby('id','DESC')->paginate(5);
        $data['page_title'] = 'এফিডেভিট কমিটি তালিকা';

        return view('affidavit_committee.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['page_title'] = 'এফিডেভিট কমিটি মেম্বার এন্ট্রি ফর্ম';

        return view('affidavit_committee.add')->with($data);
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
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'mobile_no' => 'required', 'unique:affidavit_committee',
            'email' => 'required','unique:affidavit_committee',
            ],
            [
            'name.required' => 'সম্পূর্ণ নাম লিখুন',
            'designation.required' => 'পদবী লিখুন ',
            'mobile_no.required' => 'সঠিক মোবাইল নম্বর প্রদান করুন',
            'email.required' => 'সঠিক ইমেইল প্রদান করুন',
            ]);

        $affiDavit = new AffidavitCommittee();
        $affiDavit->name =  $request->name;
        $affiDavit->designation = $request->designation;
        $affiDavit->mobile_no = $request->mobile_no;
        $affiDavit->email = $request->email;
        $affiDavit->status = 1;
        $affiDavit->created_by = Auth::user()->name;
        $affiDavit->save();

        return redirect()->route('affidavit-committtee.index')->with('success','সাফল্যের সাথে সংযুক্তি সম্পন্ন হয়েছে');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['userManagement'] = AffidavitCommittee::where('id',$id)->orderby('id','DESC')->first();
        $data['page_title'] = 'এফিডেভিট কমিটি মেম্বরের বিস্তারিত';
        return view('affidavit_committee.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['userManagement'] = AffidavitCommittee::where('id',$id)->orderby('id','DESC')->first();
        $data['page_title'] = 'এফিডেভিট কমিটি মেম্বরের তথ্য সংশোধন ফরম';
        return view('affidavit_committee.edit')->with($data);
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
        
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'mobile_no' => 'required', 'unique:affidavit_committee',
            'email' => 'required','unique:affidavit_committee',
            ],
            [
            'name.required' => 'সম্পূর্ণ নাম লিখুন',
            'designation.required' => 'পদবী লিখুন ',
            'mobile_no.required' => 'সঠিক মোবাইল নম্বর প্রদান করুন',
            'email.required' => 'সঠিক ইমেইল প্রদান করুন',
            ]);

        $affiDavit = AffidavitCommittee::where('id', $id)->first();
        if (is_null($affiDavit)) {
            return redirect()->route('affidavit-committtee.index')->with('error','তথ্য খুঁজে পাওয়া যায় নি');
        }else{
            $affiDavit->name =  $request->name;
            $affiDavit->designation = $request->designation;
            $affiDavit->mobile_no = $request->mobile_no;
            $affiDavit->email = $request->email;
            $affiDavit->status = 1;
            $affiDavit->created_by = Auth::user()->name;
            $affiDavit->update();

        return redirect()->route('affidavit-committtee.index')->with('success','সাফল্যের সাথে সংযুক্তি সম্পন্ন হয়েছে');
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
