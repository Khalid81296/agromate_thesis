@php
   $roleID = Auth::user()->role_id;
   $officeInfo = user_office_info();
@endphp

@extends('layouts.default')

@section('content')
 

<!--begin::Card-->
<div class="card card-custom">
   <div class="card-header flex-wrap py-5">
      <div class="card-title">
         <h3 class="card-title h2 font-weight-bolder">{{ $page_title }} </h3>
      </div>
      <div class="card-toolbar">        
         <!-- <a href="{{ route('court.create') }}" class="btn btn-sm btn-primary font-weight-bolder">
            <i class="la la-plus"></i>নতুন আদালত এন্ট্রি
         </a>  -->         
         <a href="#" class="btn btn-sm btn-primary font-weight-bolder" data-toggle="modal" data-target="#contact-modal">
            <i class="la la-plus"></i>নতুন আদালত এন্ট্রি
         </a>   
         @include('court.inc._addmodal')
      </div>
   </div>
   <div class="card-body row">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
         <p>{{ $message }}</p>
      </div>
      @endif
      @if ($errors->any())
                    
             @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
             @endforeach
            
      @endif
      @if($roleID == 1 || $roleID == 2 || $roleID == 3 || $roleID == 4)
         @include('court.search')
      @endif
     
      <table class="table table-hover mb-6 font-size-h6">
         <thead class="thead-light">
            <tr>
               <th scope="col" width="30">#</th>
               <th scope="col">আদালতের নাম</th>
               <th scope="col">বিভাগের নাম</th>
               <th scope="col">জেলার নাম</th>
               <th scope="col">আদালতের ধরণ</th>
               <th scope="col">স্ট্যাটাস</th>
               <th scope="col">অ্যাকশন</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($courts as $row)
            <?php
              if($row->status == 1){
                  $courtStatus = '<span class="label label-inline label-light-primary font-weight-bold">এনাবল</span>';
               }else{
                  $courtStatus = '<span class="label label-inline label-light-primary font-weight-bold">ডিসএবল</span>';
               }
            ?>
            <tr>
               <th scope="row" class="tg-bn">{{ en2bn(++$i) }}</th>
               <td>{{ $row->court_name }}</td>
               <td>{{ $row->division_name_bn }}</td>
               <td>{{ $row->district_name_bn }}</td>            
               <td>{{ $row->court_type_name }}</td>            
               <td><?=$courtStatus?></td>
               <td>
                  <a href="{{ route('court.edit', $row->id) }}" class="btn btn-success btn-shadow btn-sm font-weight-bold pt-1 pb-1">সংশোধন</a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>      
      {!! $courts->links() !!}  
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

<script type="text/javascript">
      jQuery(document).ready(function ()
      {
         // District Dropdown
         jQuery('select[name="division"]').on('change',function(){
            var dataID = jQuery(this).val(); 
            // var category_id = jQuery('#category_id option:selected').val();
            jQuery("#district_id").after('<div class="loadersmall"></div>');
            // $("#loading").html("<img src='{{ asset('media/preload.gif') }}' />");
            // jQuery('select[name="mouja"]').html('<option><div class="loadersmall"></div></option');
            // jQuery('select[name="mouja"]').attr('disabled', 'disabled');
            // jQuery('.loadersmall').remove();
            if(dataID)
            {
               jQuery.ajax({
                  url : '/court-setting/dropdownlist/getdependentdistrict/' +dataID,
                  type : "GET",
                  dataType : "json",
                  success:function(data)
                  {
                     jQuery('select[name="district"]').html('<div class="loadersmall"></div>');
                     //console.log(data);
                     // jQuery('#mouja_id').removeAttr('disabled');
                     // jQuery('#mouja_id option').remove();
                     
                     jQuery('select[name="district"]').html('<option value="">-- নির্বাচন করুন --</option>');
                     jQuery.each(data, function(key,value){
                        jQuery('select[name="district"]').append('<option value="'+ key +'">'+ value +'</option>');
                     });
                     jQuery('.loadersmall').remove();
                     // $('select[name="mouja"] .overlay').remove();
                     // $("#loading").hide();
                  }
               });
            }
            else
            {
               $('select[name="district"]').empty();
            }
         });



         /*$("#courtEntry").submit(function(event){
            submitForm();
            return false;
         });*/

      });
      /*function submitForm(){
          $.ajax({
            type: "POST",
            url: "{{ url('court/save') }}",
            cache:false,
            data: $('form#courtEntry').serialize(),
            success: function(response){
               $("#contact").html(response)
               $("#contact-modal").modal('hide');
            },
            error: function(){
               alert("Error");
            }
         });
      }*/

</script>         
<!--end::Page Scripts-->
@endsection


