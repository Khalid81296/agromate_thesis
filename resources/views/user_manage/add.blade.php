@extends('layouts.default')

@section('content')
<style type="text/css">
    #appRowDiv td{padding: 5px; border-color: #ccc;}
    #appRowDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}
</style> 
<br>
<!-- <a href="" style="float: right;"> <button  class="btn btn-success">Back</button></a> -->
<div class="row">
	<div class="col-lg-12">
		<div class="card card-custom gutter-b example example-compact">
			<form method="POST" action="{{route('user-management.store')}}">	
				@csrf
				<div class="card">
				        <div class="card-header">
				        	<h3 class="card-title h2 font-weight-bolder">{{ $page_title }}</h3>
				        </div>
				    <div class="card-body card-block row">
				        <div class="col-4">
				            <div class="form-group">
				                <label for="name" class=" form-control-label">পুরো নাম <span class="text-danger">*</span></label>
				                <input type="text" id="name" name="name" placeholder="পুরো নাম লিখুন" class="form-control form-control-sm">
				                <span style="color: red">
	                				{{ $errors->first('name') }}
	                			</span>
				            </div>
				        </div>
				        <div class="col-4">
				            <div class="form-group">
				                <label for="username" class=" form-control-label">ইউজারনেম <span class="text-danger">*</span></label>
				                <input type="text" id="username" name="username" placeholder="ব্যবহারকারীর নাম লিখুন" class="form-control form-control-sm">
				                <span style="color: red">
	                				{{ $errors->first('username') }}
	                			</span>
				            </div>
				        </div>
			            <div class="col-4">
			               	<div class="form-group">
			                    <label for="mobile_no" class=" form-control-label">মোবাইল নাম্বার </label>
			                    <input type="text" name="mobile_no" id="mobile_no" placeholder="মোবাইল নাম্বার লিখুন" class="form-control form-control-sm">
			                </div>
			            </div>
			             <div class="col-4">
				            <div class="form-group">
				                <label for="email" class=" form-control-label">ইমেল</label>
				                <input type="email" id="email" name="email" placeholder="ইমেল লিখুন" class="form-control form-control-sm">
				            </div>
				        </div>
				        <div class="col-4">
				            <div class="form-group">
				                <label for="role_id" class=" form-control-label">ইউজার রোল <span class="text-danger">*</span></label>
				               <select name="role_id" id="role_id" class="form-control-sm form-control">
				               	<option value="">-- নির্বাচন করুন --</option>
		                                @foreach ($roles as $value)
		                                    <option value="{{ $value->id }}"> {{ $value->role_name }} </option>
		                                @endforeach
				               </select>
				               <span style="color: red">
	                				{{ $errors->first('role_id') }}
	                			</span>
				            </div>
				        </div>
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)    
                        <div class="col-lg-4">
                            <div class="form-group mb-2">
                              <label>বিভাগ<span class="text-danger">*</span></label>
                               <select name="division" class="form-control w-100">
                                  <option value="">-বিভাগ নির্বাচন করুন-</option>
                                  @foreach ($division as $value)
                                  <option value="{{ $value->id }}"> {{ $value->division_name_bn }} </option>
                                  @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-2">
                                <label>জেলা<span class="text-danger">*</span></label>
                               <select name="district" id="district_id" class="form-control w-100">
                                  <option value="">-জেলা নির্বাচন করুন-</option>
                               </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label>উপজেলা</label>
                            <select name="upazila" id="upazila_id" class="form-control w-100">
                               <option value="">-উপজেলা নির্বাচন করুন-</option>
                            </select>
                        </div>
			            <div class="col-4">
			               	<div class="form-group">
			                    <label for="office_id" class=" form-control-label">অফিস <span class="text-danger">*</span></label>
			                    <select name="office" id="office_id" class="form-control-sm form-control">
			                    	<option value="">-- নির্বাচন করুন --</option>
		                               
			                    </select>
			                    <span style="color: red">
	                				{{ $errors->first('office_id') }}
	                			</span>
			                </div>
			            </div>
			            @else
			            <div class="col-4">
			               	<div class="form-group">
			                    <label for="office_id" class=" form-control-label">অফিস <span class="text-danger">*</span></label>
			                    <select name="office_id" id="office_id" class="form-control-sm form-control">
			                    	<option value="">-- নির্বাচন করুন --</option>
		                                @foreach ($offices as $value)
		                                    <option value="{{ $value->id }}"> {{ $value->office_name_bn }}, {{ $value->upazila_name_bn }} {{ $value->district_name_bn }} </option>
		                                @endforeach
			                    </select>
			                    <span style="color: red">
	                				{{ $errors->first('office_id') }}
	                			</span>
			                </div>
			            </div>
			            @endif
			                <div class="col-6">
			                    <div class="form-group">
			                        <label for="password" class=" form-control-label">পাসওয়ার্ড <span class="text-danger">*</span></label>
			                        <input type="text" name="password" id="password" placeholder="পাসওয়ার্ড লিখুন" class="form-control">
			                        <span style="color: red">
	                				{{ $errors->first('password') }}
	                			</span>
			                    </div>
			                </div> 
			                <!-- <div class="col-6">
			                    <div class="form-group">
			                        <label for="price" class=" form-control-label">কন্ফার্ম পাসওয়ার্ড</label>
			                        <input type="text" name="price" id="price" placeholder="Enter product price" class="form-control">
			                    </div>
			                </div> -->
			        
			            
			            
				    </div>
			    </div>
				<div class="card-footer">
		            <div class="row">
		                <div class="col-lg-4"></div>
		               	<div class="col-lg-4">
		               		<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary mr-3" id="preview">প্রিভিউ</button>
		                    <button type="submit" class="btn btn-success mr-2"onclick="return confirm('আপনি কি সংরক্ষণ করতে চান?')">সংরক্ষণ করুন</button>
		                </div>
		            </div>
		        </div>
	         	<div class="modal fade" id="myModal">
			    	<div class="modal-dialog">
				      <div class="modal-content">
				      
				        <!-- Modal Header -->
				        <div class="modal-header">
				          <h4 class="modal-title">নতুন ইউজার তথ্য</h4>
				          <button type="button" class="close" data-dismiss="modal">×</button>
				        </div>
				        
				        <!-- Modal body -->
				        <div class="modal-body">
				           <table class="tg">
				                    <tr>
				                        <th class="tg-19u4 text-center">পুরো নাম </th>
				                        <td class="tg-nluh" id="previewName"></td>
				                    </tr>
				                    <tr>
				                        <th class="tg-19u4 text-center">ইউজারনেম</th>
				                        <td class="tg-nluh" id="previewUsername"></td>
				                    </tr>
				                    <tr>
				                        <th class="tg-19u4 text-center">মোবাইল নাম্বার </th>
				                        <td class="tg-nluh" id="previewMobile_no"></td>
				                    </tr>
				                    <tr>
				                        <th class="tg-19u4 text-center">ইমেল</th>
				                        <td class="tg-nluh" id="previewEmail"></td>
				                    </tr>
				                    <tr>
				                        <th class="tg-19u4 text-center">ভূমিকা </th>
				                        <td class="tg-nluh" id="previewRole_id"></td>
				                    </tr>
				                    <tr>
				                        <th class="tg-19u4 text-center">অফিস</th>
				                        <td class="tg-nluh" id="previewOffice_id"></td>
				                    </tr>
				                </table>
				        </div>
				        
				        <!-- Modal footer -->
				        <div class="modal-footer">
				          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				        </div>
				        
				      </div>
			    	</div>
			  	</div>
			   
			</form>
		</div>
	</div>	
</div>

@endsection
@section('scripts')
<script>
function myFunction() {
  confirm("আপনি কি সংরক্ষণ করতে চান?");
}

$('document').ready(function(){
	$('#preview').on('click',function(){
		var name = $('#name').val();
		var username = $('#username').val();
		var email = $('#email').val();
		var mobile_no = $('#mobile_no').val();
		var role_id = $('#role_id option:selected').text();
		var office_id = $('#office_id option:selected').text();
		$('#previewName').html(name);
		$('#previewUsername').html(username);
		$('#previewEmail').html(email);
		$('#previewMobile_no').html(mobile_no);
		$('#previewRole_id').html(role_id);
		$('#previewOffice_id').html(office_id);
	});
});


</script><script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        @if( request()->get('district') )
           <script>
           var disID = {{ request()->get('district') }};
         </script>
         @else
         <script>
            var disID = 0;
          </script>
        @endif
        @if( request()->get('upazila') )
          <script>var upID = {{  request()->get('upazila')}};</script>
        @else
          <script>
              var upID = 0;
          </script>
        @endif
        @if( request()->get('office') )
          <script>var officeID = {{  request()->get('office')}};</script>
        @else
          <script>
              var officeID = 0;
          </script>
        @endif


        <script type="text/javascript">
            jQuery(document).ready(function() {
                

                jQuery('select[name="division"]').on('change', function() {

                    var dataID = jQuery(this).val();

                    jQuery("#district_id").after('<div class="loadersmall"></div>');

                    if (dataID) {
                        jQuery.ajax({
                            url: '{{ url('/') }}/case/dropdownlist/getdependentdistrict/' +
                                dataID,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                jQuery('select[name="district"]').html(
                                    '<div class="loadersmall"></div>');

                                jQuery('select[name="district"]').html(
                                    '<option value="">-- জেলা নির্বাচন করুন --</option>');
                                jQuery.each(data, function(key, value) {
                                    jQuery('select[name="district"]').append(
                                        '<option value="' + key +
                                        '">' + value + '</option>');
                                });
                                jQuery('.loadersmall').remove();
                            }
                        });
                    } else {
                        $('select[name="district"]').empty();
                    }
                });



                // Dependable Upazila List
                jQuery('select[name="district"]').on('change', function() {
                    var dataID = jQuery(this).val();

                    jQuery("#upazila_id").after('<div class="loadersmall"></div>');

                    if (dataID) {
                        jQuery.ajax({
                            url: '{{ url('/') }}/case/dropdownlist/getdependentupazila/' +
                                dataID,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                jQuery('select[name="upazila"]').html(
                                    '<div class="loadersmall"></div>');

                                jQuery('select[name="upazila"]').html(
                                    '<option value="">--উপজেলা নির্বাচন করুন --</option>');
                                jQuery.each(data, function(key, value) {
                                    jQuery('select[name="upazila"]').append(
                                        '<option value="' + key +
                                        '">' + value + '</option>');
                                });
                                jQuery('.loadersmall').remove();
                            }
                        });
                    } else {
                        $('select[name="upazila"]').empty();
                    }
                });



                // District wise Dependable Office List
                jQuery('select[name="district"]').on('change', function() {
                    var dataID = jQuery(this).val();

                    jQuery("#office_id").after('<div class="loadersmall"></div>');

                    if (dataID) {
                        jQuery.ajax({
                            url: '{{ url('/') }}/case/dropdownlist/getdependentdistrictoffice/' +
                                dataID,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                jQuery('select[name="office"]').html(
                                    '<div class="loadersmall"></div>');

                                jQuery('select[name="office"]').html(
                                    '<option value="">--উপজেলা নির্বাচন করুন --</option>');
                                jQuery.each(data, function(key, value) {
                                    jQuery('select[name="office"]').append(
                                        '<option value="' + key +
                                        '">' + value + '</option>');
                                });
                                jQuery('.loadersmall').remove();
                            }
                        });
                    } else {
                        $('select[name="office"]').empty();
                    }
                });



                // Upazila wise Dependable Office List
                jQuery('select[name="upazila"]').on('change', function() {
                    var dataID = jQuery(this).val();

                    jQuery("#office_id").after('<div class="loadersmall"></div>');

                    if (dataID) {
                        jQuery.ajax({
                            url: '{{ url('/') }}/case/dropdownlist/getdependentupazilaoffice/' +
                                dataID,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                jQuery('select[name="office"]').html(
                                    '<div class="loadersmall"></div>');

                                jQuery('select[name="office"]').html(
                                    '<option value="">--অফিস নির্বাচন করুন --</option>');
                                jQuery.each(data, function(key, value) {
                                    jQuery('select[name="office"]').append(
                                        '<option value="' + key +
                                        '">' + value + '</option>');
                                });
                                jQuery('.loadersmall').remove();
                            }
                        });
                    } else {
                        $('select[name="office"]').empty();
                    }
                });
                // //Upazila wise Dependable Office List// //


                var divID = $('#division_id').find(":selected").val();
                
                
                  // alert(divID);
                

                // jQuery("#district_id").after('<div class="loadersmall"></div>');

                if (divID !== "undefined") {
                    jQuery.ajax({
                        url: '{{ url('/') }}/case/dropdownlist/getdependentdistrict/' +
                            divID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('select[name="district"]').html('<div class="loadersmall"></div>');

                            jQuery('select[name="district"]').html(
                                '<option value="">-- জেলা নির্বাচন করুন --</option>');
                            jQuery.each(data, function(key, value) {
                                if (disID == key) {
                                    var selected = 'selected';
                                } else {
                                    var selected = '';
                                }
                                jQuery('select[name="district"]').append(
                                    '<option value="' + key +
                                    '"' + selected + '>' + value + '</option>');
                            });
                            jQuery('.loadersmall').remove();
                        }
                    });
                } else {
                    $('select[name="district"]').empty();
                }



                if (typeof disID !== "undefined") {
                    jQuery.ajax({
                        url: '{{ url('/') }}/case/dropdownlist/getdependentupazila/' +
                        disID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('select[name="upazila"]').html(
                                '<div class="loadersmall"></div>');

                            jQuery('select[name="upazila"]').html(
                                '<option value="">--উপজেলা নির্বাচন করুন --</option>');
                            jQuery.each(data, function(key, value) {
                                if (upID == key) {
                                    var selected = 'selected';
                                } else {
                                    var selected = ' ';
                                }
                                jQuery('select[name="upazila"]').append(
                                    '<option value="' + key +
                                    '"' + selected + '>' + value + '</option>');
                            });
                            jQuery('.loadersmall').remove();
                        }
                    });

                } else {
                    $('select[name="upazila"]').empty();
                }



                if (typeof disID !== "undefined") {
                  // alert(disID);
                    jQuery.ajax({
                        url: '{{ url('/') }}/case/dropdownlist/getdependentoffice/' +
                        disID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('select[name="office"]').html(
                                '<div class="loadersmall"></div>');

                            jQuery('select[name="office"]').html(
                                '<option value="">--অফিস নির্বাচন করুন --</option>');
                            jQuery.each(data, function(key, value) {
                                if (officeID == key) {
                                    var selected = 'selected';
                                } else {
                                    var selected = ' ';
                                }
                                jQuery('select[name="office"]').append(
                                    '<option value="' + key +
                                    '"' + selected + '>' + value + '</option>');
                            });
                            jQuery('.loadersmall').remove();
                        }
                    });

                } else {
                    $('select[name="office"]').empty();
                }



            })
        </script>
@endsection
