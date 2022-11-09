@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $page_title }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <div class="col-md-12 pb-5" data-wizard-type="step-content" data-wizard-state="current">
                            <!--begin::Title-->
                            <div class="row mb-5">
                            <div class="col-md-12 text-center">
                                <h3 class="font-weight-bolder text-dark display5">ব্যাবহারকারি নিবন্ধন করুন</h3>
                                <div class="text-muted font-weight-bold font-size-h4"><sub>ইতিমধ্যে নিবন্ধিত আছে ?
                                <a href="javascript:;" data-toggle="modal" data-target="#exampleModalLong" id="kt_quick_user_toggle" class="text-primary font-weight-bolder">লগইন করুন</a></sub></div>
                            </div>
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form Group-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">পুরো নাম </label>&nbsp; <span class="text-danger">*</span>
                                        <input type="text" class="form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6" id="name" name="name" placeholder="পুরো নাম লিখুন"   required="required" />
                                         <span style="color: red">
                                            {{ $errors->first('name') }}
                                        </span>
                                    </div>
                                </div>
                                    <!--end::Form Group-->
                                    <!--begin::Form Group-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">ইউজারনেম </label>&nbsp; <span class="text-danger">*</span>
                                        <input type="text" class="form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6" id="username" name="username"placeholder="ইউজারনেম নাম লিখুন"    required="required" />
                                        <span style="color: red">
                                            {{ $errors->first('username') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">জন্ম তারিখ </label>&nbsp; <span class="text-danger">*</span>

                                        <input type="date" class="form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6 common_datepicker" id="dob" name="dob" placeholder="DD/MM/YYY"   required="required" />
                                         <span style="color: red">
                                            {{ $errors->first('dob') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender"class="font-size-h6 font-weight-bolder text-dark">নারী / পুরুষ</label>
                                            <select style="width: 100%;"class="selectDropdown form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6" name="gender" id="gender"  required="required">
                                                <option value="">বাছাই করুন</option>
                                                <option value="MALE">পুরুষ</option>
                                                <option value="FEMALE">নারী</option>
                                            </select>
                                         <span style="color: red">
                                            {{ $errors->first('gender') }}
                                        </span>
                                    </div>
                                </div>
                               
                                    <!--end::Form Group-->
                                <div class="col-md-6">
                                    <!--begin::Form Group-->
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">মোবাইল নাম্বার</label>&nbsp; <span class="text-danger">*</span>
                                        <input type="text" class="form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6" name="mobile_no" id="mobile_no" placeholder="মোবাইল নাম্বার লিখুন"  required="required"/>
                                        <span style="color: red">
                                            {{ $errors->first('mobile_no') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">ইমেল</label>&nbsp; <span class="text-danger">*</span>
                                        <input type="text" class="form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6" id="email" name="email" placeholder="ইমেল লিখুন"  required="required"/>
                                        <span style="color: red">
                                            {{ $errors->first('email') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">পাসওয়ার্ড</label>&nbsp; <span class="text-danger">*</span>
                                        <input type="text" class="form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6" name="password" id="password" placeholder="পাসওয়ার্ড লিখুন"  required="required"/>
                                        <span style="color: red">
                                            {{ $errors->first('password') }}
                                        </span>
                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Form Group-->

                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group mb-2">
                                       <select name="division" class="selectDropdown form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6"   required="required">
                                          <option value="">-বিভাগ নির্বাচন করুন-</option>
                                          @foreach ($divisions as $value)
                                          <option value="{{ $value->id }}"> {{ $value->division_name_bn }} </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group mb-2">
                                       <select name="district" id="district_id" class="selectDropdown form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6"   required="required">
                                          <option value="">-জেলা নির্বাচন করুন-</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <select name="upazila" id="upazila_id" class="selectDropdown form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6"   required="required">
                                           <option value="">-উপজেলা নির্বাচন করুন-</option>
                                        </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6 mb-2">
                                    <div class="form-group mb-2">                                    
                                        <select name="mouja" id="mouja_id" class="selectDropdown form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6"  required="required">
                                            <!-- <span id="loading"></span> -->
                                            <option value="">--মৌজা নির্বাচন করুন --</option>
                                        </select>
                                    </div>
                                 </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">নিজের ঠিকানা </label>
                                        <textarea type="text" class="form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6" name="present_add" id="present_add" placeholder="বর্তমান ঠিকানা লিখুন"/></textarea>
                                        <span style="color: red">
                                            {{ $errors->first('present_add') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">খামারের ঠিকানা </label>
                                        <textarea type="text" class="form-control h-auto py-3 px-3 border-1 rounded-md font-size-h6" name="permanent_add" id="permanent_add" placeholder="স্থায়ী ঠিকানা লিখুন"/></textarea>
                                        <span style="color: red">
                                            {{ $errors->first('permanent_add') }}
                                        </span>
                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-12  text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('নিবন্ধন করুন') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
