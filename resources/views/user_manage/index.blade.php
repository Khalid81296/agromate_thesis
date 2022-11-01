@extends('layouts.default')

@section('content')
 

<!--begin::Card-->
<div class="card card-custom p-5">
   <div class="card-header flex-wrap py-5">
      <div class="card-title">
         <h2 > ইউজার ম্যানেজমেন্ট </h2>
      </div>
      <div class="card-toolbar">        
         <a href="{{ route('user-management.create') }}" class="btn btn-sm btn-primary font-weight-bolder">
            <i class="la la-plus"></i>নতুন ইউজার এন্ট্রি
         </a>                
      </div>
   </div>
   <div class="card-body">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
         <p>{{ $message }}</p>
      </div>
      @endif
      @include('user_manage.search')

      <table class="table table-hover mb-6 font-size-h6 text-center">
         <thead class="thead-light ">
            <tr>
               <th scope="col" width="10">#</th>
               <th scope="col">নাম</th>
               <!-- <th scope="col">ইউজারনেম</th> -->
               <th scope="col">ইউজার রোল</th>
               <th scope="col">অফিসের নাম</th>
               <th scope="col" width="100">ইমেইল এড্রেস</th>
              <!--  <th scope="col">স্ট্যাটাস</th> -->
               <th scope="col" width="250">অ্যাকশন</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($users as $key=>$row)
            <tr>
               <th scope="row" class="tg-bn">{{ en2bn($key + $users->firstItem()) }}.</th>
               <td>{{ $row->name }}</td>
               <!-- <td>{{ $row->username }}</td> -->
               <td>{{ $row->role_name }}</td>
               <td>{{ $row->office_name_bn }}, {{ $row->upazila_name_bn }} {{ $row->district_name_bn }}</td>
               <td>{{ $row->email }}</td>
               <!-- <td>
                  <span class="label label-inline label-light-primary font-weight-bold">Pending</span>
               </td> -->
               <td>
                  <a href="{{ route('user-management.show', $row->id) }}" class="btn btn-info btn-shadow btn-sm font-weight-bold pt-1 pb-1">বিস্তারিত</a>
                  <a href="{{ route('user-management.edit', $row->id) }}" class="btn btn-success btn-shadow btn-sm font-weight-bold pt-1 pb-1">সংশোধন</a>
                  @if(Auth::user()->role_id == 1 )
                  <br>
                    <form method="post" action="{{ route('user-management.destroy', $row->id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-shadow btn-sm font-weight-bold pt-1 pb-1">মুছে ফেলুন</button>
                    </form>
                  @endif
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>      
      {!! $users->links() !!}  
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

    <script>
        $(document).ready(function() {



            var myTable = $('#example').DataTable({
              /*  ordering: true,
                searching: true,
                dom: '<"top"i>rt<"bottom"flp><"clear">',*/

            });

        });
    </script>
<!--end::Page Scripts-->
@endsection


