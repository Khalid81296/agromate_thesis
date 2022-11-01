@extends('layouts.default')

@section('content')
 

<!--begin::Card-->
<div class="card card-custom">
   <div class="card-header flex-wrap py-5">
      <div class="card-title">
         <h2 > {{ $page_title }} </h2>
      </div>
      <div class="card-toolbar">        
         <a href="{{ route('advocate-management.create') }}" class="btn btn-sm btn-primary font-weight-bolder">
            <i class="la la-plus"></i>নতুন মেম্বর এন্ট্রি
         </a>                
      </div>
   </div>
   <div class="card-body">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
         <p>{{ $message }}</p>
      </div>
      @endif
      <table class="table table-hover mb-6 font-size-h6">
         <thead class="thead-light ">
            <tr>
               <th scope="col" width="30">#</th>
               <th scope="col">নাম</th>
               <th scope="col">বর্তমান ঠিকানা </th>
               <th scope="col">স্থায়ী ঠিকানা </th>
               <th scope="col">মোবাইল নং</th>
               <th scope="col">ইমেইল এড্রেস</th>
               <!-- <th scope="col">স্ট্যাটাস</th> -->
               <th scope="col" width="150">অ্যাকশন</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($info as $key => $row)
            <tr>
               <th scope="row" class="tg-bn">{{ en2bn($key+1) }}</th>
               <td>{{ $row->name }}</td>
               <td>{{ $row->present_address }}</td>
               <td>{{ $row->permanent_address }}</td>
               <td>{{ $row->mobile_no }}</td>
               <td>{{ $row->email }}</td>
               <!-- <td>
                  <span class="label label-inline label-light-primary font-weight-bold">Pending</span>
               </td> -->
               <td>
                  <a href="{{ route('advocate-management.show', $row->id) }}" class="btn btn-success btn-shadow btn-sm font-weight-bold pt-1 pb-1">বিস্তারিত</a>
                  <a href="{{ route('advocate-management.edit', $row->id) }}" class="btn btn-success btn-shadow btn-sm font-weight-bold pt-1 pb-1">সংশোধন</a>
               </td>
            </tr>
            @empty
            <tr>
               <td colspan="6" class="text-danger">কোনো তথ্য খুঁজে পাওয়া যায়নি </td>
            </tr>
            @endforelse
         </tbody>
      </table>      
      {!! $info->links() !!}  
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


