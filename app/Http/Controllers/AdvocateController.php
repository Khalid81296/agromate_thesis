<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advocate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdvocateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['info'] = Advocate::where('status',1)->orderby('id','DESC')->paginate(5);
        $data['page_title'] = 'এডভোকেটের তালিকা';

        return view('advocate.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['page_title'] = 'এডভোকেট এন্ট্রি ফর্ম';

        return view('advocate.add')->with($data);
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
            'present_address' => 'required',
            'permanent_address' => 'required',
            'mobile_no' => 'required', 'unique:affidavit_committee',
            'email' => 'required','unique:affidavit_committee',
            ],
            [
            'name.required' => 'সম্পূর্ণ নাম লিখুন',
            'present_address.required' => 'বর্তমান ঠিকানা লিখুন ',
            'permanent_address.required' => 'স্থায়ী ঠিকানা লিখুন ',
            'mobile_no.required' => 'সঠিক মোবাইল নম্বর প্রদান করুন',
            'email.required' => 'সঠিক ইমেইল প্রদান করুন',
            ]);

        $advocate = new Advocate();
        $advocate->name =  $request->name;
        $advocate->present_address = $request->present_address;
        $advocate->permanent_address = $request->permanent_address;
        $advocate->mobile_no = $request->mobile_no;
        $advocate->email = $request->email;
        $advocate->status = 1;
        $advocate->created_by = Auth::user()->name;
        $advocate->save();

        return redirect()->route('advocate-management.index')->with('success','সাফল্যের সাথে সংযুক্তি সম্পন্ন হয়েছে');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['userManagement'] = Advocate::where('id',$id)->orderby('id','DESC')->first();
        $data['page_title'] = 'এডভোকেটের বিস্তারিত';
        return view('advocate.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['userManagement'] = Advocate::where('id',$id)->orderby('id','DESC')->first();
        $data['page_title'] = 'এডভোকেটের তথ্য সংশোধন ফরম';
        return view('advocate.edit')->with($data);
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
            'present_address' => 'required',
            'permanent_address' => 'required',
            'mobile_no' => 'required', 'unique:affidavit_committee',
            'email' => 'required','unique:affidavit_committee',
            ],
            [
            'name.required' => 'সম্পূর্ণ নাম লিখুন',
            'present_address.required' => 'বর্তমান ঠিকানা লিখুন ',
            'permanent_address.required' => 'স্থায়ী ঠিকানা লিখুন ',
            'mobile_no.required' => 'সঠিক মোবাইল নম্বর প্রদান করুন',
            'email.required' => 'সঠিক ইমেইল প্রদান করুন',
            ]);

        $advocate = Advocate::where('id', $id)->first();
        if (is_null($advocate)) {
            return redirect()->route('advocate-management.index')->with('error','তথ্য খুঁজে পাওয়া যায় নি');
        }else{
            $advocate->name =  $request->name;
            $advocate->present_address = $request->present_address;
            $advocate->permanent_address = $request->permanent_address;
            $advocate->mobile_no = $request->mobile_no;
            $advocate->email = $request->email;
            $advocate->status = 1;
            $advocate->created_by = Auth::user()->name;
            $advocate->update();

        return redirect()->route('advocate-management.index')->with('success','সাফল্যের সাথে সংযুক্তি সম্পন্ন হয়েছে');
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
