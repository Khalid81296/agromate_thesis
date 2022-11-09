@extends('layouts.default')

@section('content')

@php
$new=$running=$finished=$applied=0;

foreach ($cases as $val)
{
   if($val->status == 1){
   $new++;
}
if($val->status == 2){
$running++;
}
if($val->status == 3){
$applied++;
}
if($val->status == 4){
$finished++;
}
}

@endphp

<!--begin::Dashboard-->

<div class="row mb-5">
   <div class="col-md-3">
      <div class="card-counter primary">
         <a href="{{ route('case') }}"><i class="fa fas fa-layer-group text-white"></i></a>
         <span class="count-numbers"><a href="{{ route('case') }}"><?=en2bn($total_case)?></a></span>
         <span class="count-name"><a href="{{ route('case') }}">মোট পশুর তালিকা</a></span>
      </div>
   </div>

   <div class="col-md-3">
      <div class="card-counter danger">
         <a href="{{ route('case.running') }}"><i class="fa fas fa-layer-group text-white"></i></a>
         <span class="count-numbers"><a href="{{ route('case.running') }}"><?=en2bn($running_case)?></a></span>
         <span class="count-name"><a href="{{ route('case.running') }}">প্রাপ্ত বয়স্ক ষাঁড়ের তালিকা</a></span>
      </div>
   </div>


   <div class="col-md-3">
      <div class="card-counter success">
         <a href="{{ route('case.complete') }}"><i class="fa fas fa-layer-group text-white"></i></a>
         <span class="count-numbers"><a href="{{ route('case.complete') }}"><?=en2bn($completed_case)?></a></span>
         <span class="count-name"><a href="{{ route('case.complete') }}">প্রাপ্ত বয়স্ক গাভীর তালিকা</a></span>
      </div>
   </div>

   <div class="col-md-3">
      <div class="card-counter info">
         <a href="{{ route('case.appeal') }}"><i class="fa fas fa-layer-group text-white"></i></a>
         <span class="count-numbers"><a href="{{ route('case.appeal') }}"><?=en2bn($appeal_case)?></a></span>
         <span class="count-name"><a href="{{ route('case.appeal') }}">এঁড়ে বাছুরের তালিকা</a></span>
      </div>
   </div>
</div>
<div class="row mb-5">
   <div class="col-md-3">
      <div class="card-counter violet">
         <a href="{{ route('case.appeal') }}"><i class="fa fas fa-layer-group text-white"></i></a>
         <span class="count-numbers"><a href="{{ route('case.appeal') }}"><?=en2bn($appeal_case)?></a></span>
         <span class="count-name"><a href="{{ route('case.appeal') }}">এঁবকনা বাছুরের তালিকা</a></span>
      </div>
   </div>
</div>

<!--begin::Row-->
<div class="row">
   <div class="col-md-8">
      <div class="card card-custom">
         <div class="card-header flex-wrap bg-danger py-5">
            <div class="card-title">
               <h3 class="card-label h3 font-weight-bolder"> পদক্ষেপ নিতে হবে পশুর শুর তালিকাসমূহ</h3>
            </div>
         </div>
         <div class="card-body p-0">
            <ul class="navi navi-border navi-hover navi-active">
               <li class="navi-item">
                 <a class="navi-link" href="#">
                     <span class="navi-icon"><i class="fas fa-folder-open icon-lg text-danger mr-3"></i></span>
                     <div class="navi-text">
                        <span class="d-block font-weight-bold h4 pt-2">টিকা প্রদানের তারিখ হয়েছে এমন পশুর তালিকা</span>
                     </div>
                     <span class="navi-label">
                        <span class="label label-xl label-danger h5">১০</span>
                     </span>
                  </a>
               </li>        
               <li class="navi-item">
                 <a class="navi-link" href="#">
                     <span class="navi-icon"><i class="fas fa-folder-open icon-lg text-danger mr-3"></i></span>
                     <div class="navi-text">
                        <span class="d-block font-weight-bold h4 pt-2">পুনোরায় বীজ প্রদানের তারিখ হয়েছে এমন গাভীর তালিকা</span>
                     </div>
                     <span class="navi-label">
                        <span class="label label-xl label-danger h5">৪</span>
                     </span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!--end::Row-->

<!--end::Dashboard-->
@endsection

{{-- Includable CSS Related Page --}}
@section('styles')
<link href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
@endsection

{{-- Scripts Section Related Page--}}
@section('scripts')

<script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<!--end::Page Vendors-->
<script src="{{ asset('js/pages/widgets.js') }}"></script>
<!--end::Page Scripts-->
@endsection
