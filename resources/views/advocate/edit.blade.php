@extends('layouts.default')

@section('content')

<!--begin::Card-->
<div class="row">
   <div class="card card-custom col-12">
      <div class="card-header flex-wrap py-5">
         <div class="card-title">
            <h3 class="card-title h2 font-weight-bolder">{{ $page_title }}</h3>
         </div>
         @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 27 || Auth::user()->role_id == 6)
         <div class="card-toolbar">        
            <a href="{{ url('advocate-management') }}" class="btn btn-sm btn-primary font-weight-bolder">
               <i class="la la-list"></i> তালিকা
            </a>                
         </div>
         @endif
         @if ($errors->any())
         <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
      </div>

      <form action="{{ route('advocate-management.update', $userManagement->id) }}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="card-body">
            <fieldset>
               <legend>ব্যাবহারকারীর তথ্য</legend> 
               <div class=" col-12 row">
                  <div class="col-4">
                     <div class="form-group">
                         <label for="name" class=" form-control-label">পুরো নাম <span class="text-danger">*</span></label>
                         <input type="text" id="name" name="name" placeholder="পুরো নাম লিখুন" class="form-control form-control-sm"value="{{ $userManagement->name}}">
                         <span style="color: red">
                           {{ $errors->first('name') }}
                        </span>
                     </div>
                  </div>   
                  <div class="col-4">
                     <div class="form-group">
                         <label for="present_address" class=" form-control-label">বর্তমান ঠিকানা  <span class="text-danger">*</span></label>
                         <input type="text" id="present_address" name="present_address" placeholder="ব্যবহারকারীর নাম লিখুন" class="form-control form-control-sm" value="{{ $userManagement->present_address}}">
                         <span style="color: red">
                           {{ $errors->first('present_address') }}
                        </span>
                     </div>
                  </div>   
                  <div class="col-4">
                     <div class="form-group">
                         <label for="permanent_address" class=" form-control-label">স্থায়ী ঠিকানা <span class="text-danger">*</span></label>
                         <input type="text" id="permanent_address" name="permanent_address" placeholder="ব্যবহারকারীর নাম লিখুন" class="form-control form-control-sm" value="{{ $userManagement->permanent_address}}">
                         <span style="color: red">
                           {{ $errors->first('permanent_address') }}
                        </span>
                     </div>
                  </div>
               
                     <div class="col-4">
                           <div class="form-group">
                             <label for="mobile_no" class=" form-control-label">মোবাইল নাম্বার </label>
                             <input type="text" name="mobile_no" id="mobile_no" placeholder="মোবাইল নাম্বার লিখুন" class="form-control form-control-sm" value="{{ $userManagement->mobile_no}}" >
                         </div>
                     </div>
                  <div class="col-4">
                      <div class="form-group">
                            <label>ইমেইল এড্রেসঃ</label>
                            <input type="text" name="email" class="form-control form-control-sm" placeholder="" value="{{ $userManagement->email}}" />
                      </div>
                  </div>
               </div>
            </fieldset>
         <div class="card-footer">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <button type="submit" class="btn btn-primary font-weight-bold mr-2">সংরক্ষণ করুন</button>
               </div>
            </div>
         </div>

      </form>
   </div>
</div>
<!--end::Card-->

@endsection

{{-- Includable CSS Related Page --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
@endsection     

{{-- Scripts Section Related Page--}}
@section('scripts')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('js/pages/crud/datatables/advanced/multiple-controls.js') }}"></script>
<!--end::Page Scripts-->
@endsection


