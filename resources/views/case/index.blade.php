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
               <th scope="col">জন্ম তারিখ</th>
               <th scope="col"> ধরণ</th>
               <th scope="col">প্রজাতি</th>
               <th scope="col">পালনের উদ্দেশ্য</th>
               <th scope="col" width="70">অ্যাকশন</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($animals as $row)
            
            <tr>
               <td>{{ $row->id }}</td>
               <td>{{ en2bn($row->birth_date) }}</td>
               <td>{{ isset($row->type_id) ? $row->type_name : '-'}}</td>
               <td>{{ isset($row->cast_type) ? $row->type_name : '-'}}</td>
               <td>{{ isset($row->purpose_type) ? $row->type_name : '-'}}</td>

               <td>
                  <div class="btn-group float-right">
                     <button class="btn btn-primary font-weight-bold btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">অ্যাকশন</button>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('animal.details', $row->id) }}">বিস্তারিত তথ্য</a>
                           <!-- Edit Link -->
                        
                  </div>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>

      <div class="d-flex justify-content-center">
         {!! $animals->links() !!}
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


