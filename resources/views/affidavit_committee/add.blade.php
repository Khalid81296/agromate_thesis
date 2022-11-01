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
			<form method="POST" action="{{route('affidavit-committtee.store')}}">	
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
				                <label for="designation" class=" form-control-label">পদবী <span class="text-danger">*</span></label>
				                <input type="text" id="designation" name="designation" placeholder="ব্যবহারকারীর নাম লিখুন" class="form-control form-control-sm">
				                <span style="color: red">
	                				{{ $errors->first('designation') }}
	                			</span>
				            </div>
				        </div>
			            <div class="col-4">
			               	<div class="form-group">
			                    <label for="mobile_no" class=" form-control-label">মোবাইল নাম্বার </label>
			                    <input type="text" name="mobile_no" id="mobile_no" placeholder="মোবাইল নাম্বার লিখুন" class="form-control form-control-sm">
				                <span style="color: red">
	                				{{ $errors->first('mobile_no') }}
	                			</span>
			                </div>
			            </div>
			             <div class="col-4">
				            <div class="form-group">
				                <label for="email" class=" form-control-label">ইমেল</label>
				                <input type="text" id="email" name="email" placeholder="ইমেল লিখুন" class="form-control form-control-sm">
				                <span style="color: red">
	                				{{ $errors->first('email') }}
	                			</span>
				            </div>
				        </div>
			            
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
				                        <th class="tg-19u4 text-center">পদবী</th>
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
		var username = $('#designation').val();
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


</script>
@endsection
