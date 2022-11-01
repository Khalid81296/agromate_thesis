@extends('layouts.default')

@section('content')

@php //echo $userManagement->name;
//exit(); @endphp

<!--begin::Card-->
<div class="card card-custom col-7">
   <div class="card-header flex-wrap py-5">
      <div class="card-title">
         <h3 class="card-label"> {{ $page_title }} </h3>
      </div>
      <div class="card-toolbar">
         <a href="{{ url('advocate-management') }}" class="btn btn-sm btn-primary font-weight-bolder">
            <i class="la la-list"></i> তালিকা
         </a>
      </div>
   </div>
   {{-- @foreach($userManagement as $userManagement) --}}
   <div class="card-body">
      <div class="d-flex mb-3">
         <span class="text-dark-100 flex-root font-weight-bold font-size-h6">নামঃ</span>
         <span class="text-dark flex-root font-weight-bolder font-size-h6">{{ $userManagement->name}}</span>
      </div>
      <div class="d-flex mb-3">
         <span class="text-dark-100 flex-root font-weight-bold font-size-h6">বর্তমান ঠিকানা </span>
         <span class="text-dark flex-root font-weight-bolder font-size-h6">{{ $userManagement->present_address}}</span>
      </div>
      <div class="d-flex mb-3">
         <span class="text-dark-100 flex-root font-weight-bold font-size-h6">স্থায়ী ঠিকানা </span>
         <span class="text-dark flex-root font-weight-bolder font-size-h6">{{ $userManagement->permanent_address}}</span>
      </div>
      <div class="d-flex mb-3">
         <span class="text-dark-100 flex-root font-weight-bold font-size-h6">মোবাইল নাম্বারঃ</span>
         <span class="text-dark flex-root font-weight-bolder font-size-h6">{{ $userManagement->mobile_no}}</span>
      </div>
      <div class="d-flex mb-3">
         <span class="text-dark-100 flex-root font-weight-bold font-size-h6">ইমেইল এড্রেসঃ</span>
         <span class="text-dark flex-root font-weight-bolder font-size-h6">{{ $userManagement->email}}</span>
      </div>
     <!--  <div class="d-flex mb-3">
         <span class="text-dark-100 flex-root font-weight-bold font-size-h6">স্ট্যাটাসঃ</span>
         <span class="text-dark flex-root font-weight-bolder font-size-h6"></span>
      </div> -->
   </div>
   {{-- @endforeach --}}
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


