@extends('layouts.default')

@section('content')

<!--begin::Card-->
<div class="card card-custom">
   <div class="card-header flex-wrap py-5">
      <div class="card-title">
         <h3 class="card-title h2 font-weight-bolder">{{ $page_title }}</h3>
      </div>
      @if(Auth::user()->role_id == 5 || Auth::user()->role_id == 21 || Auth::user()->role_id == 22 || Auth::user()->role_id == 24 || Auth::user()->role_id == 26)
      <div class="card-toolbar">
         <a href="{{ route('writcase.create') }}" class="btn btn-sm btn-primary font-weight-bolder">
            <i class="la la-plus"></i>নতুন মামলা এন্ট্রি
         </a>
      </div>
      @endif
   </div>
   <div class="card-body">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
         {{ $message }}
      </div>
      @endif

    @include('write_case.write_case_register.search')

      <table class="table table-hover mb-6 font-size-h5">
         <thead class="thead-light font-size-h6">
            <tr>
               <th scope="col" width="30">#</th>
               <th scope="col">মামলা নং</th>
               <th scope="col">মামলার তারিখ</th>
               <!-- <th scope="col">মামলার ধরণ</th> -->
               <th scope="col">বিভাগ</th>
               <th scope="col">জেলা</th>
               <th scope="col">উপজেলা</th>
               <th scope="col">মৌজা</th>
               <th scope="col" width="70">অ্যাকশন</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($cases as $key => $row)
            <?php
               // if($row->status == 1){
               //    $caseStatus = '<span class="label label-inline label-light-primary font-weight-bold">নতুন মামলা</span>';
               // }
            ?>
            <tr>
               <td scope="row" class="tg-bn">{{ en2bn($key + $cases->firstItem()) }}.</td>
               <td>{{ $row->case_number }}</td>
               <td>{{ en2bn($row->case_date) }}</td>
               <!-- <td>{{ $row->case_type->type_name ?? ''}}</td> -->
               <td>{{ $row->division_name_bn ?? '' }}</td>
               <td>{{ $row->district_name_bn ?? '' }}</td>
               <td>{{ $row->upazila_name_bn ?? '' }}</td>
               <td>{{ $row->mouja_name_bn ?? '' }}</td>
               <td>
                  <div class="btn-group float-right">
                     <button class="btn btn-primary font-weight-bold btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">অ্যাকশন</button>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('writcase.show', $row->id) }}">বিস্তারিত তথ্য</a>

                        @if (Auth::user()->role_id == 5 || Auth::user()->role_id == 21 || Auth::user()->role_id == 22 || Auth::user()->role_id == 24)
                           @if($row->action_user_role_id == Auth::user()->role_id )
                              @if($row->status == 1)
                              <a class="dropdown-item" href="{{ route('rmcase.edit', $row->id) }}">সংশোধন করুন</a>
                              @endif
                           @endif
                        @endif

                           @if(Auth::user()->id != $row->user_id && Auth::user()->role_id != 9 && Auth::user()->role_id != 21 && Auth::user()->role_id != 2 && Auth::user()->role_id != 3 && Auth::user()->role_id != 4)
                             @if($row->status != 1)
                                 <div class="dropdown-divider"></div>
                                    @if($row->status == 2)
                                     <a class="dropdown-item alert alert-success" href="javascript:void(0)">আপিল করা হয়েছে</a>
                                    @else
                                    <a class="dropdown-item" href="{{ route('rmcase.create_appeal', $row->id) }}">মামলা আপিল করুন</a>
                                    @endif
                                 </div>
                              @endif
                           @endif
                         
                  </div>
                 
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


