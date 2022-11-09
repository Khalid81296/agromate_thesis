<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['divisions'] = DB::table('division')->select('id', 'division_name_bn')->get();
        $data['page_title'] = "নিবন্ধন ফর্ম";
        return view('auth.register')->with($data);

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
        //
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users|max:100',
            'email' => 'required|unique:users',
            'mobile_no' => 'required|unique:users',
            'password' => 'required',
            ],
            [
            'name.required' => 'পুরো নাম লিখুন',
            'username.required' => 'ইউজার নাম লিখুন',
            'password.required' => 'পাসওয়ার্ড লিখুন',
            ]);

        DB::table('users')->insert([
            'name'=>$request->name,
            'username' =>$request->username,
            'mobile_no' =>$request->mobile_no,
            'own_address' =>$request->present_add,
            'farm_address' =>$request->permanent_add,
            'dob' =>$request->dob,
            'email' =>$request->email,
            'division_id' =>$request->division,
            'district_id' =>$request->district,
            'upazila_id' =>$request->upazila,
            'mouja_id' =>$request->mouja,
            'role_id' => 2,
            'password' =>Hash::make($request->password)

       ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard') ->with('success', 'Successfully logged in!');
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
        $subcategories = DB::table("district")->where("division_id",$id)->pluck("district_name_bn","id");
        return json_encode($subcategories);
    }

    public function getDependentUpazila($id)
    {
        $subcategories = DB::table("upazila")->where("district_id",$id)->pluck("upazila_name_bn","id");
        return json_encode($subcategories);
    }

    public function getDependentMouja($id)
    {
        $subcategories = DB::table("mouja")->where("upazila_id",$id)->pluck("mouja_name_bn","id");
        return json_encode($subcategories);
    }
}
