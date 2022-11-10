@extends('layouts.default')

@section('content')

@php
$pass_year_data = '<option value="">-- নির্বাচন করুন --</option>';
for($i=1995;$i<=date('Y');$i++){
$pass_year_data .= '<option value="'.$i.'">'.$i.'</option>';
}
@endphp



<style type="text/css">
    #badiDiv td{padding: 5px; border-color: #ccc;}
    #badiDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}
    #bibadiDiv td{padding: 5px; border-color: #ccc;}
    #bibadiDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}
    #fileDiv td{padding: 5px; border-color: #ccc;}
    #fileDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}
    #surveyDiv td{padding: 5px; border-color: #ccc;}
    #surveyDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}
    

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
</style>
<!--begin::Row-->
<div class="row">

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title h2 font-weight-bolder">{{ $page_title }}</h3>
                <div class="card-toolbar">
                    
                </div>
            </div>

            <!-- <div class="loadersmall"></div> -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!--begin::Form-->
            <form action="{{ url('animal/save') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <fieldset class="mb-8">
                        <legend>সাধারণ তথ্য</legend>
                        <div class="form-group row">
                            <div class="col-lg-4 mb-5">
                                <label>পশুর ধরণ <span class="text-danger">*</span></label>
                                <select name="animal_type" id="animal_type" class="form-control form-control-sm" required="required">
                                    <option value="">-- নির্বাচন করুন --</option>
                                    @foreach ($animal_types as $value)
                                    <option value="{{ $value->id }}" {{ old('animal_type') == $value->id ? 'selected' : '' }}> {{ $value->type_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>পশুর জাত <span class="text-danger">*</span></label>
                                <select name="animal_cast_type" id="animal_cast_type" class="form-control form-control-sm" required="required">
                                    <option value="">-- নির্বাচন করুন --</option>
                                    @foreach ($animal_cast_types as $value)
                                    <option value="{{ $value->id }}" {{ old('animal_cast_type') == $value->id ? 'selected' : '' }}> {{ $value->type_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>পালনের উদ্দেশ্য <span class="text-danger">*</span></label>
                                <select name="purpose_type" id="purpose_type" class="form-control form-control-sm" required="required">
                                    <option value="">-- নির্বাচন করুন --</option>
                                    @foreach ($purpose_types as $value)
                                    <option value="{{ $value->id }}" {{ old('purpose_type') == $value->id ? 'selected' : '' }}> {{ $value->type_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-lg-4 mb-5">
                                <label>পশুর জন্ম তারিখ <span class="text-danger">*</span></label>
                                <input type="text" name="birth_date" id="birth_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('birth_date')}}" >
                            </div>

                            <div class="col-lg-4 mb-5">
                                <label>খামারে আনার তারিখ <span class="text-danger">*</span></label>
                                <input type="text" name="farm_reg_date" id="farm_reg_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('farm_reg_date')}}" >
                            </div>

                            <div class="col-lg-4 mb-5">
                                <label>পশুর ওজন <span class="text-danger">*</span></label>
                                <input type="text" name="weight" id="weight" class="form-control form-control-sm" placeholder="১২৫ কেজি" autocomplete="off" value="{{old('weight')}}" >
                            </div>

                            <div class="col-lg-3 mb-5">
                                 <label>মালিকানার ধরণ</label>
                                 <div class="radio-inline">
                                    <label class="radio">
                                    <input type="radio" name="ownership_type" value="1" checked="checked" />
                                    <span></span>নিজের খামারে জন্ম</label>
                                    <label class="radio">
                                    <input type="radio" name="ownership_type" value="0" />
                                    <span></span>কেনা পশু</label>
                                </div>
                            </div>

                            <div class="col-lg-4 mb-5">
                                <label>পশুর ক্রয়মূল্য <span class="text-danger">*</span></label>
                                <input type="text" name="buying_price" id="buying_price" class="form-control form-control-sm" placeholder="১২৫ কেজি" autocomplete="off" value="{{old('buying_price')}}" >
                            </div>
                        </div>
                        <div class="form-group row" id="cowDiv" style="display: none;">
                            <div class="col-lg-4 mb-5">
                                <label>সর্বশের বীজ প্রদানের তারিখ <span class="text-danger">*</span></label>
                                <input type="text" name="last_pregnency_date" id="last_pregnency_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('last_pregnency_date')}}" >
                            </div>
                            <div class="col-lg-4 mb-5" id="cowDiv">
                                <label>সর্বশের বাচ্চা প্রসবের তারিখ <span class="text-danger">*</span></label>
                                <input type="text" name="last_childbirth_date" id="last_childbirth_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('last_childbirth_date')}}" >
                            </div>
                            <div class="col-lg-4 mb-5" id="cowDiv">
                                <label>বাচ্চার সংখ্যা <span class="text-danger">*</span></label>
                                <input type="text" name="child_amount" id="child_amount" class="form-control form-control-sm " placeholder="৫" autocomplete="off" value="{{old('child_amount')}}" >
                            </div>
                            <div class="col-lg-4 mb-5" id="cowDiv">
                                <label>প্রতিদিন দুধ প্রদানের পরমাণ (লিটারে) <span class="text-danger">*</span></label>
                                <input type="text" name="avg_milk_amount" id="avg_milk_amount" class="form-control form-control-sm" placeholder="১৫ লিটার" autocomplete="off" value="{{old('avg_milk_amount')}}" >
                            </div>

                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>বিভিন্ন টিকা সমুহ</legend>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check mb-5">
                                  <input class="form-check-input" type="checkbox" value="1" name="anthrax" id="anthrax">
                                  <label class="form-check-label" for="anthrax">
                                    তড়কা রোগের টিকা
                                  </label>
                                </div>
                                <div class="form-check mb-5">
                                  <input class="form-check-input" type="checkbox" value="1" name="haemorrahagic" id="haemorrahagic">
                                  <label class="form-check-label" for="haemorrahagic">
                                    গলাফুলা রেগের টিকা
                                  </label>
                                </div>
                                <div class="form-check mb-5">
                                  <input class="form-check-input" type="checkbox" value="1" name="black_quarter" id="black_quarter">
                                  <label class="form-check-label" for="black_quarter">
                                    বাদলা রোগের টিকা
                                  </label>
                                </div>
                                <div class="form-check mb-5">
                                  <input class="form-check-input" type="checkbox" value="1" name="khurarog" id="khurarog">
                                  <label class="form-check-label" for="khurarog">
                                    ক্ষুরা রোগের টিকা
                                  </label>
                                </div>
                                <div class="form-check mb-5">
                                  <input class="form-check-input" type="checkbox" value="1" name="rabies" id="rabies">
                                  <label class="form-check-label" for="rabies">
                                    জলাতঙ্ক রোগের টিকা
                                  </label>
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <div class="col-lg-4 mb-5" id="anthraxDate" style="display: none;">
                                    <label>তড়কা রোগের টিকা প্রদানের তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="anthrax_date" id="anthrax_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('anthrax_date')}}" >
                                </div>
                                <div class="col-lg-4 mb-5" id="haemorrahagicDate" style="display: none;">
                                    <label>গলাফুলা রেগের টিকা প্রদানের তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="haemorrahagic_date" id="haemorrahagic_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('haemorrahagic_date')}}" >
                                </div>
                                <div class="col-lg-4 mb-5" id="black_quarterDate" style="display: none;">
                                    <label>বাদলা রোগের টিকা প্রদানের তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="black_quarter_date" id="black_quarter_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('black_quarter_date')}}" >
                                </div>
                                <div class="col-lg-4 mb-5" id="khurarogDate" style="display: none;">
                                    <label>ক্ষুরা রোগের টিকা প্রদানের তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="khurarog_date" id="khurarog_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('khurarog_date')}}" >
                                </div>
                                <div class="col-lg-4 mb-5" id="rabiesDate" style="display: none;">
                                    <label>জলাতঙ্ক রোগের টিকা প্রদানের তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="rabies_date" id="rabies_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" value="{{old('rabies_date')}}" >
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- <fieldset class="mb-8">
                        <legend>তফশীল বিবরণ </legend>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label></label>
                                <textarea name="tafsil" class="form-control" id="tafsil" rows="3"  spellcheck="false" value="{{old('tafsil')}}"></textarea>
                            </div>
                        </div>
                    </fieldset> -->

                    
                    <br>
                    <div class="form-group row">
                        <div class="col-lg-6 mb-5">
                            <fieldset>
                                <legend>পশুর ছবি <span class="text-danger">*</span><br><sub class="text-danger">(jpg/png, সাইজ সর্বোচ্চ: 2MB)</sub></legend>
                                <div class="col-lg-12 mb-5">
                                    <div class="form-group">
                                        <label></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file"  name="animal_image" class="custom-file-input" id="animal_image" required="required" />

                                            <label class="custom-file-label" id="show_cause_label" for="customFile"></label>
                                            
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 mb-5">
                            <fieldset>
                                <legend>মন্তব্য </legend>
                                <div class="col-lg-12 mb-5">
                                    <label></label>
                                    <textarea name="comments" class="form-control" id="comments" rows="2" spellcheck="false" value="{{old('comments')}}"></textarea>
                                </div>
                            </fieldset>
                        </div>
                        <input type="hidden" name="user_role_id" value="{{ Auth::user()->role_id }}">
                    </div>
                   

                </div> <!--end::Card-body-->

                <!-- <div class="card-footer text-right bg-gray-100 border-top-0">
                    <button type="reset" class="btn btn-primary">সংরক্ষণ করুন</button>
                </div> -->
            <div class="card-footer">
              <div class="row">
                    <div class="col-lg-12 text-center">
                        
                        <button type="submit" class="btn btn-success mr-2" onclick="return confirm('আপনি কি সংরক্ষণ করতে চান?')">সংরক্ষণ করুন</button>
                    </div>
                </div>
            </div>

            

  </form>
  <!--end::Form-->
</div>
<!--end::Card-->
</div>

</div>
<!--end::Row-->

@endsection

{{-- Includable CSS Related Page --}}
@section('styles')

<!--end::Page Vendors Styles-->
@endsection

{{-- Scripts Section Related Page--}}
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
<script>
        // common datepicker
        $('.common_datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayHighlight: true,
            orientation: "bottom left"
        });
    </script>

    

    

  <script>
    function myFunction() {
      confirm("আপনি কি সংরক্ষণ করতে চান?");
  }

  
</script>
<script type="text/javascript">
   jQuery('select[name="animal_type"]').on('change',function(){
        var dataID = jQuery(this).val();

        // alert(dataID);
        if(dataID == 2)
        {
              $('#cowDiv').show();
          
        }else{
              $('#cowDiv').hide();
          }
    });

    $("#anthrax").change(function() {
        if(this.checked) {
              $('#anthraxDate').show();
        }else {
              $('#anthraxDate').hide();
        }
    });

    $("#haemorrahagic").change(function() {
        if(this.checked) {
              $('#haemorrahagicDate').show();
        }else {
              $('#haemorrahagicDate').hide();
        }
    });

    $("#black_quarter").change(function() {
        if(this.checked) {
              $('#black_quarterDate').show();
        }else {
              $('#black_quarterDate').hide();
        }
    });

    $("#khurarog").change(function() {
        if(this.checked) {
              $('#khurarogDate').show();
        }else {
              $('#khurarogDate').hide();
        }
    });

    $("#rabies").change(function() {
        if(this.checked) {
              $('#rabiesDate').show();
        }else {
              $('#rabiesDate').hide();
        }
    });

    



    function attachmentTitle(id,selectObject) {
        var fileType = document.getElementById('file_type' + id).value ;
        if (fileType != '') {
            //===================For CSS Change of Duynamic File Name =============//
            $('#file_type' + id).css("background-color", "#ccc");
            // alert(fileType);    
            $('#file_type_error' + id).hide();  
            $('#file_type' + id).css("border-color","#ccc");  

            console.log(selectObject.value);
            // var value = $('#customFile' + id).val();
            var value = $('#customFile' + id)[0].files[0];
            // console.log(value['name']);
            $('.custom-input' + id).text(value['name']);

            var filePath = selectObject.value;
            var fileData = selectObject;  
              if (typeof (fileData.files) != "undefined") {
                    $('#file_error' + id).hide();  
                    $('.custom-input' + id).css("border-color","#ccc");  

                  var size = parseFloat(fileData.files[0].size / 1024).toFixed(2);
                  if(size > 2048){
                    document.getElementById('customFile' + id).value = '';    
                    $('.custom-input' + id).html('ফাইল নির্বাচন করুন');  
                    $('.custom-input' + id).css("border-color","#FF0000");  
                    $('#file_error' + id).show();  
                    $('#file_error' + id).html('ফাইলের আকার 2MB এর বেশি');  
                    return false;
                  }
              } else {
                  alert("This browser does not support HTML5.");
              }

              // Allowing file type
              var allowedExtensions = /(\.pdf)$/i;
            
              if (!allowedExtensions.exec(filePath)) {
                    // alert('Invalid file type');
                    document.getElementById('customFile' + id).value = '';
                    $('.custom-input' + id).html('ফাইল নির্বাচন করুন');  
                    $('.custom-input' + id).css("border-color","#FF0000");  
                    $('#file_error' + id).show();  
                    $('#file_error' + id).html("পিডিএফ ফাইল নির্বাচন করুন");  
                    return false;
              }
        }else{
            document.getElementById('customFile' + id).value = '';    
            $('#file_type' + id).css("border-color","#FF0000");  
            $('#file_type_error' + id).show();  
            $('#file_type_error' + id).html('ফাইলের নাম লিখুন');
        }

    }
    function numeicCheckLandSize(id,argument) {
        // body...
        // alert(argument);
        var inputVal = argument.value;
        var re = /^[0-9০-৯]+(?:\.[0-9০-৯]+)?$/;
        var found = inputVal.match( re );
        if(found != null){
            $('#land_size_error' + id).hide();  
            $('#land_size' + id).css("border-color","#ccc");
            // alert(found);
        }else{
            document.getElementById('land_size' + id).value = '';
            $('#land_size' + id).css("border-color","#FF0000");  
            $('#land_size_error' + id).show();  
            $('#land_size_error' + id).html("শুধুমাত্র সংখ্যাসূচক ইনপুট");
            // alert('error');
        }
    }
    function numeicCheckLandDemand(id,argument) {
        // body...
        // alert(argument);
        var inputVal = argument.value;
        var re = /^[0-9০-৯]+(?:\.[0-9০-৯]+)?$/;
        var found = inputVal.match( re );
        if(found != null){
            $('#land_demand_error' + id).hide();  
            $('#land_demand' + id).css("border-color","#ccc");
            // alert(found);
        }else{
            document.getElementById('land_demand' + id).value = '';
            $('#land_demand' + id).css("border-color","#FF0000");  
            $('#land_demand_error' + id).show();  
            $('#land_demand_error' + id).html("শুধুমাত্র সংখ্যাসূচক ইনপুট");
            // alert('error');
        }
    }
</script>
<!--end::Page Scripts-->
@endsection







