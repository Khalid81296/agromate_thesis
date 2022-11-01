@extends('layouts.default')

@section('content')

<!--begin::Card-->
<div class="card card-custom">
   <div class="card-header flex-wrap py-5">
      <div class="card-title">
         <h3 class="card-title h2 font-weight-bolder">{{ $page_title }}</h3>
      </div>
         

      @if(Auth::user()->role_id == 5 || Auth::user()->role_id == 8 || Auth::user()->role_id == 29)
         @if(Request::path() != "case/complete_case")
            <div class="card-toolbar">
               <a href="{{ url('case/add') }}" class="btn btn-sm btn-primary font-weight-bolder">
                  <i class="la la-plus"></i>নতুন মোকদ্দমা এন্ট্রি
               </a>
            </div>
         @endif
      @endif
   </div>
   <div class="card-body">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
         {{ $message }}
      </div>
      @endif

      @include('case.search')

      <table class="table table-hover mb-6 font-size-h5">
         <thead class="thead-light font-size-h6">
            <tr>
               <th scope="col" width="30">#</th>
               <th scope="col">মোকদ্দমা নং</th>
               <th scope="col">মোকদ্দমার তারিখ</th>
               <th scope="col">মোকদ্দমার ধরণ</th>
               <th scope="col">আদালতের নাম</th>
               <th scope="col">উপজেলা</th>
               <th scope="col">মৌজা</th>
               <!-- <th scope="col">অফিস হতে প্রেরণের তারিখ</th>
               <th scope="col">জবাব পাওয়ার তারিখ</th>
               <th scope="col">বিজ্ঞ জি.পি নিকট প্রেরণ</th> -->
               <!-- <th scope="col" width="100">স্ট্যাটাস</th> -->
               <th scope="col" width="70">অ্যাকশন</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($cases as $row)
            
            <tr>
               <td scope="row" class="tg-bn">{{ en2bn(++$i) }}.</td>
               <td>{{ $row->case_number }}</td>
               <td>{{ en2bn($row->case_date) }}</td>
               <td>{{ isset($row->ct_id) ? $row->ct_name : '-'}}</td>
               <td>{{ $row->court_name }}</td>
               <td>{{ $row->upazila_name_bn }}</td>
               <td>{{ $row->mouja_name_bn }}</td>

               <td>
                  <div class="btn-group float-right">
                     <button class="btn btn-primary font-weight-bold btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">অ্যাকশন</button>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('case.details', $row->id) }}">বিস্তারিত তথ্য</a>
                           <!-- Edit Link -->
                        @if (Auth::user()->role_id == 5 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8 || Auth::user()->role_id == 9)
                           @if($row->status != 3)
                           <a class="dropdown-item" href="{{ route('case.edit', $row->id) }}">সংশোধন করুন</a>
                           @endif
                        @endif
                           <!-- //Edit Link -->
                           <!-- Sending Action -->
                        @if($row->is_old == 0)
                           @if(Auth::user()->role_id == $row->action_user_group_id)
                              @if($row->status != 3)
                                 <a class="dropdown-item" href="{{ route('action.details', $row->id) }}">প্রেরণ করুন</a>
                              @endif
                           @endif
                        @endif
                           <!-- //Sending Action -->

                        @if(Auth::user()->role_id == 5)
                           @if($row->is_lost_appeal == 0)
                              <div class="dropdown-divider"></div>
                                 @if($row->status == 2)
                                  <a class="dropdown-item alert alert-success" href="javascript:void(0)">আপিল করা হয়েছে</a>
                                 @elseif($row->status == 3)
                                 <a class="dropdown-item" href="{{ route('case.create_appeal', $row->id) }}">মোকদ্দমা আপিল করুন</a>
                                 @endif
                              </div>
                           @endif
                        @endif
                  </div>
                  <!-- <a href="{{ route('case.details', $row->id) }}" class="btn btn-success btn-shadow btn-sm font-weight-bold pt-1 pb-1">বিস্তারিত </a>
                  <a href="{{ route('case.edit', $row->id) }}" class="btn btn-success btn-shadow btn-sm font-weight-bold pt-1 pb-1">সংশোধন</a> -->
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>

      <div class="d-flex justify-content-center">
         {!! $cases->links() !!}
      </div>
   </div>
   <!--end::Card-->

   @endsection

   {{-- Includable CSS Related Page --}}
   @section('styles')
   <!-- <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> -->
   <!--end::Page Vendors Styles-->
   @endsection

   {{-- Scripts Section Related Page--}}
   @section('scripts')
   <!-- <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
   <script src="{{ asset('js/pages/crud/datatables/advanced/multiple-controls.js') }}"></script>
 -->


<!--end::Page Scripts-->
@endsection


