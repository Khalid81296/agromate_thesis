@extends('layouts.default')

@section('content')

@php
$pass_year_data = '<option value="">-- নির্বাচন করুন --</option>';
for($i=1995;$i<=date('Y');$i++){
$pass_year_data .= '<option value="'.$i.'">'.$i.'</option>';
}
@endphp

<?php
// print_r($surveys); exit;
$survey_data = '<option value="">-- নির্বাচন করুন --</option>';
for($i=0;$i<sizeof($surveys);$i++){
    $survey_data .= '<option value="'.$surveys[$i]->id.'">'.$surveys[$i]->st_name.'</option>';
}

$land_type_data = '<option value="">-- নির্বাচন করুন --</option>';
for($i=0;$i<sizeof($land_types);$i++){
    $land_type_data .= '<option value="'.$land_types[$i]->id.'">'.$land_types[$i]->lt_name.'</option>';
}
?>

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
                    <!-- <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div> -->
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
            <form action="{{ url('case/old/running/save') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <fieldset class="mb-8">
                        <legend>সাধারণ তথ্য</legend>
                        <div class="form-group row">
                            <div class="col-lg-4 mb-5">
                                <label>মামলার ধরণ <span class="text-danger">*</span></label>
                                <!-- <input type="text" name="case_type" id="case_type" class="form-control form-control-sm" placeholder="মামলার ধরণ" autocomplete="off"> -->
                                <select name="case_type" id="case_type" class="form-control form-control-sm" required="required">
                                    <option value="">-- নির্বাচন করুন --</option>
                                    @foreach ($case_types as $value)
                                    <option value="{{ $value->id }}" {{ old('case_type') == $value->id ? 'selected' : '' }}> {{ $value->ct_name }} </option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-lg-4 mb-5">
                                <label>আদালতের নাম <span class="text-danger">*</span></label>
                                <select name="court" id="court" class="form-control form-control-sm" required="required">
                                    <option value=""> -- নির্বাচন করুন --</option>
                                    
                                </select>
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>উপজেলা <span class="text-danger">*</span></label>
                                <select name="upazila" id="upazila_id" class="form-control form-control-sm" required="required">
                                    <option value="">-- নির্বাচন করুন --</option>
                                     @foreach ($upazilas as $value)
                                    <option value="{{ $value->id }}" {{ old('upazila') == $value->id ? 'selected' : '' }}> {{ $value->upazila_name_bn }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>মৌজা <span class="text-danger">*</span></label>
                                <select name="mouja" id="mouja_id" class="form-control form-control-sm" required="required">
                                    <!-- <span id="loading"></span> -->
                                    <option value="">-- নির্বাচন করুন --</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>মামলা নং <span class="text-danger">*</span></label>
                                <input type="text" name="case_no" id="case_no" class="form-control form-control-sm" placeholder="মামলা নং " required="required">
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>মামলা রুজুর তারিখ <span class="text-danger">*</span></label>
                                <input type="text" name="case_date" id="case_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" required="required">
                            </div> 
                            
                        </div>
                    </fieldset>
                    <fieldset class="mb-8">
                        <legend>পূর্বের মামলার তথ্য</legend>
                        <div class="form-group row">
                            <div class="col-lg-4 mb-5">
                                <label>পূর্বের মামলার ধরণ </label>
                                <!-- <input type="text" name="case_type" id="case_type" class="form-control form-control-sm" placeholder="মামলার ধরণ" autocomplete="off"> -->
                                <select name="old_case_type" id="old_case_type" class="form-control form-control-sm">
                                    <option value="">-- নির্বাচন করুন --</option>
                                    @foreach ($case_types as $value)
                                    <option value="{{ $value->id }}" {{ old('case_type') == $value->id ? 'selected' : '' }}> {{ $value->ct_name }} </option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-lg-4 mb-5">
                                <label>পূর্বের মামলার আদালতের নাম </label>
                                <select name="old_case_court" id="old_case_court" class="form-control form-control-sm">
                                    <option value=""> -- নির্বাচন করুন --</option>
                                    
                                </select>
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>পূর্বের মামলা নং </label>
                                <select class="form-control form-control-sm" id="ref_case_no" name="ref_case_no">
                                  <option value=""> -- নির্বাচন করুন --</option>
                                    
                                  
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <div class="col-lg-6 mb-5">
                            <fieldset>
                                <legend>বাদীর বিবরণ</legend>
                                <table width="100%" border="1" id="badiDiv" style="border:1px solid #dcd8d8;">
                                    <tr>
                                        <th>বাদীর নাম <span class="text-danger">*</span></th>
                                        <th>পিতা/স্বামীর নাম</th>
                                        <th>ঠিকানা</th>
                                        <th width="50">
                                            <a href="javascript:void();" id="addBadiRow" class="btn btn-sm btn-primary font-weight-bolder pr-2"><i class="fas fa-plus-circle"></i></a>
                                        </th>
                                    </tr>
                                    <tr></tr>
                                </table>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 mb-5">
                            <fieldset>
                                <legend>বিবাদীর বিবরণ</legend>
                                <table width="100%" border="1" id="bibadiDiv" style="border:1px solid #dcd8d8;">
                                    <tr>
                                        <th>বিবাদীর নাম <span class="text-danger">*</span></th>
                                        <th>পিতা/স্বামীর নাম</th>
                                        <th>ঠিকানা</th>
                                        <th width="50">
                                            <a href="javascript:void();" id="addBibadiRow" class="btn btn-sm btn-primary font-weight-bolder pr-2"><i class="fas fa-plus-circle"></i></a>
                                        </th>
                                    </tr>
                                    <tr></tr>
                                </table>
                            </fieldset>
                        </div>
                    </div>

                    <!-- <fieldset class="mb-8">
                        <legend>তফশীল বিবরণ </legend>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label></label>
                                <textarea name="tafsil" class="form-control" id="tafsil" rows="3"  spellcheck="false"></textarea>
                            </div>
                        </div>
                    </fieldset> -->

                    <div class="form-group row">
                        <div class="col-lg-12 mb-5">
                            <fieldset>
                                <legend>জরিপের বিবরণ</legend>
                                <table width="100%" border="1" id="surveyDiv" style="border:1px solid #dcd8d8;">
                                    <tr>
                                        <th>জরিপের ধরণ <span class="text-danger">*</span></th>
                                        <th>খতিয়ান নং</th>
                                        <th>দাগ নং</th>
                                        <th>জমির শ্রেণী</th>
                                        <th>জমির পরিমাণ (শতক)</th>
                                        <th>নালিশী জমির পরিমাণ (শতক)</th>
                                        <th width="50">
                                            <a href="javascript:void();" id="addSurveyRow" class="btn btn-sm btn-primary font-weight-bolder pr-2"><i class="fas fa-plus-circle"></i></a>
                                        </th>
                                    </tr>
                                    <tr></tr>
                                </table>
                                    <input type="hidden" id="survey_count" value="1">
                            </fieldset>
                        </div>
                    </div>


                    <fieldset>
                        <legend>চৌহদ্দীর বিবরণ </legend>
                        <div class="col-lg-12 mb-5">
                            <label></label>
                            <textarea name="chowhaddi" class="form-control" id="chowhaddi" rows="3" spellcheck="false"></textarea>
                        </div>
                    </fieldset>
                    <br>
                    <div class="form-group row">
                        <div class="col-lg-12 mb-5">
                            <fieldset>
                                <legend>আবশ্যক সংযুক্তি <span class="text-danger">*</span><br><sub class="text-danger">(PDF, সাইজ সর্বোচ্চ: 2MB)</sub></legend>
                                <div class="col-lg-12 mb-5">
                                    <div class="form-group">
                                        <label></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <select name="mandatoryFileTitle" id="mandatoryFileTitle" class="form-control form-control-sm" required="required">
                                                <!-- <span id="loading"></span> -->
                                                <option value="">-- নির্বাচন করুন --</option>
                                                <option value="1"{{ old('mandatoryFileTitle') == 1 ? 'selected' : '' }}>কারণ দর্শাইবার স্ক্যান কপি</option>
                                                <option value="2"{{ old('mandatoryFileTitle') == 2 ? 'selected' : '' }}>সমন জারির স্ক্যান কপি</option>
                                                <option value="3"{{ old('mandatoryFileTitle') == 3 ? 'selected' : '' }}>আর্জির স্ক্যান কপি</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12 mb-5">
                                    <div class="form-group">
                                        <label></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" accept="application/pdf" name="show_cause" class="custom-file-input" id="show_cause" required="required" />

                                            <label class="custom-file-label" id="show_cause_label" for="customFile"  style="display:none;"></label>
                                            
                                        </div>
                                        <span id="file_error_show_cause" class="text-danger font-weight-bolder " style="margin: 0 auto;display: table;margin-top: 10px;"></span>
                                        
                                    </div>
                                    
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>অন্যান্য সংযুক্তির <span class="text-danger"></span><sub class="text-danger">(PDF,Size Max: 2MB)</sub></legend>
                                <div class="col-lg-12 mb-5">    
                                    <table width="100%" border="1" id="fileDiv" style="border:1px solid #dcd8d8;">
                                        <tr>
                                            <th>সংযুক্তির নাম <span class="text-danger"></span></th>
                                            <th>ফাইল নাম</th>
                                            <th width="50">
                                                <a href="javascript:void();" id="addFileRow" class="btn btn-sm btn-primary font-weight-bolder pr-2"><i class="fas fa-plus-circle"></i></a>
                                            </th>
                                        </tr>
                                        <tr></tr>
                                    </table>
                                    <input type="hidden" id="other_attachment_count" value="1">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 mb-5">
                            <fieldset>
                                <legend>এস এফ এর স্ক্যান কপি সংযুক্তি <span class="text-danger">*</span><sub class="text-danger">(PDF,Size Max: 2MB)</sub></legend>
                                <div class="col-lg-12 mb-5">
                                    <div class="form-group">
                                        <label></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" accept="application/pdf" name="sf_file" class="custom-file-input" id="sf_file" required="required" />
                                            <label class="custom-file-label" id="sf_file_label"for="sf_file">ফাইল নির্বাচন করুন</label>
                                        </div>
                                        <span id="file_error_sf" class="text-danger font-weight-bolder mt-2 mb-2"style="margin: 0 auto;display: table;margin-top: 10px;"></span>
                                    </div>
                                    <label>এস এফ এর অন্যান্য সংযুক্তির </label>    
                                    <table width="100%" border="1" id="sfFileDiv" style="border:1px solid #dcd8d8;">
                                        <tr>
                                            <th>সংযুক্তির নাম <span class="text-danger">*</span></th>
                                            <th>ফাইল নাম</th>
                                            <th width="50">
                                                <a href="javascript:void();" id="addSfFileRow" class="btn btn-sm btn-primary font-weight-bolder pr-2"><i class="fas fa-plus-circle"></i></a>
                                            </th>
                                        </tr>
                                        <tr></tr>
                                    </table>
                                    <input type="hidden" id="sf_attachment_count" value="1">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <fieldset>
                                <legend>মন্তব্য </legend>
                                <div class="col-lg-12 mb-5">
                                    <label></label>
                                    <textarea name="comments" class="form-control" id="comments" rows="2" spellcheck="false"></textarea>
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
                    <div class="col-lg-4"></div>
                    <div class="col-lg-7">
                        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary mr-3" id="preview">প্রিভিউ</button>
                        <button type="submit" class="btn btn-success mr-2" onclick="return confirm('আপনি কি সংরক্ষণ করতে চান?')">সংরক্ষণ করুন</button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModal">

                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h3 class="modal-title">নতুন মামলার তথ্য</h3>
                          <button type="button" class="close" data-dismiss="modal">×</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                       <div class="row">

                         <label><h4>সাধারণ তথ্য</h4></label>
                         <table class="tg">
                            <thead>
                                <tr>
                                    <th class="tg-19u4 text-center">আদালতের নাম </th>
                                    <!-- <th class="tg-19u4 text-center">বিভাগ </th>
                                    <th class="tg-19u4 text-center">জেলা </th> -->
                                    <th class="tg-19u4 text-center">উপজেলা </th>
                                    <th class="tg-19u4 text-center">মৌজা </th>
                                </tr>
                                <tr>
                                    <td class="tg-nluh" id="previewCourt"></td>
                                   <!--  <td class="tg-nluh" id="previewDivision"></td>
                                    <td class="tg-nluh" id="previewDistrict"></td> -->
                                    <td class="tg-nluh" id="previewUpazila"></td>
                                    <td class="tg-nluh" id="previewMouja_id"></td>

                                </tr>
                                <tr>
                                   <!--  <th class="tg-19u4 text-center">মামলার ধরণ</th> -->
                                    <th class="tg-19u4 text-center">মামলা নং </th>
                                    <th class="tg-19u4 text-center">মামলা রুজুর তারিখ</th>
                                </tr>
                                <tr>
                                    <!-- <td class="tg-nluh" id="previewCase_type"></td> -->
                                    <td class="tg-nluh" id="previewCase_no"></td>
                                    <td class="tg-nluh" id="previewCase_date"></td>

                                </tr>
                            </thead>
                        </table>
                        <br>
                        <br>
                        <table class="tg">
                            <label><h4>বাদীর তথ্য</h4></label>
                            <thead>
                                <tr>
                                    <th class="tg-19u4 text-center">বাদীর নাম</th>
                                    <th class="tg-19u4 text-center">পিতা/স্বামীর নাম</th>
                                    <th class="tg-19u4 text-center">ঠিকানা</th>
                                </tr>
                                <tr>
                                    <td class="tg-nluh" id="previewBadi_name"></td>
                                    <td class="tg-nluh" id="previewBadi_spouse_name"></td>
                                    <td class="tg-nluh" id="previewBadi_address"></td>

                                </tr>
                            </thead>
                        </table>
                        <br>
                        <br>
                        <table class="tg">
                            <label><h4>বিবাদীর তথ্য</h4></label>
                            <thead>
                                <tr>
                                    <th class="tg-19u4 text-center">বিবাদীর নাম </th>
                                    <th class="tg-19u4 text-center">পিতা/স্বামীর নাম</th>
                                    <th class="tg-19u4 text-center">ঠিকানা</th>
                                </tr>
                                <tr>
                                    <td class="tg-nluh" id="previewBibadi_name"></td>
                                    <td class="tg-nluh" id="previewBibadi_spouse_name"></td>
                                    <td class="tg-nluh" id="previewBibadi_address"></td>
                                </tr>

                            </thead>
                        </table>
                        <br>
                        <br>
                        <table class="tg">
                            <label><h4>জরিপের বিবরণ</h4></label>
                            <thead>
                                <tr>
                                    <th class="tg-19u4 text-center">জরিপের ধরণ </th>
                                    <th class="tg-19u4 text-center">খতিয়ান নং</th>
                                    <th class="tg-19u4 text-center">দাগ নং</th>
                                </tr>
                                <tr>
                                    <td class="tg-nluh" id="previewSt_id"></td>
                                    <td class="tg-nluh" id="previewKhotian_no"></td>
                                    <td class="tg-nluh" id="previewDaag_no"></td>
                                </tr>

                                <tr>
                                    <th class="tg-19u4 text-center">জমির শ্রেণী</th>
                                    <th class="tg-19u4 text-center">নালিশী জমির পরিমাণ (শতক)</th>
                                    <th class="tg-19u4 text-center">জমির পরিমাণ (শতক)</th>
                                </tr>
                                <tr>
                                    <td class="tg-nluh" id="previewLt_id"></td>
                                    <td class="tg-nluh" id="previewLand_size"></td>
                                    <td class="tg-nluh" id="previewLand_demand"></td>

                                </tr>
                            </thead>
                        </table>
                        <div class="col-lg-6 mb-5"></div>
                        <table class="tg">
                            <thead>
                                <tr>
                                    <th class="tg-19u4 text-center">তফশীল বিবরণ</th>
                                    <th class="tg-19u4 text-center">চৌহদ্দীর বিবরণ</th>
                                    <th class="tg-19u4 text-center">মন্তব্য</th>

                                </tr>
                                <tr>
                                    <td class="tg-nluh" id="previewTafsil"></td>
                                    <td class="tg-nluh" id="previewChowhaddi"></td>
                                    <td class="tg-nluh" id="previewComments"></td>
                                </tr>
                            </thead>
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

    <script type="text/javascript">
        jQuery(document).ready(function ()
        {

            //==============Mandatory File ===============//
            $('#mandatoryFileTitle').on('change', function() {
            // alert($('#show_cause').val());
               if($('#mandatoryFileTitle').val()==1){
                    $('#show_cause').val('');
                    document.getElementById('show_cause_label').style.display = "block";
                    $("#show_cause_label").html("কারণ দর্শাইবার ফাইল নির্বাচন");
               } else if($('#mandatoryFileTitle').val()==2){
                // alert($('#mandatoryFileTitle').val());
                    $('#show_cause').val('');
                    document.getElementById('show_cause_label').style.display = "block";
                    $("#show_cause_label").html("সমন জারির ফাইল নির্বাচন করুন");
               } else if($('#mandatoryFileTitle').val()==3){
                // alert($('#mandatoryFileTitle').val());
                    $('#show_cause').val('');
                    document.getElementById('show_cause_label').style.display = "block";
                    $("#show_cause_label").html("আর্জির ফাইল নির্বাচন করুন");
               }else{
                    $('#show_cause').val('');
                    document.getElementById('show_cause_label').style.display = "none";
               }
            }); 
            //Load First row
            addBadiRowFunc();
            addBibadiRowFunc();
            addSurveyRowFunc();
            addFileRowFunc();
            addSfFileRowFunc();

            //=============Show Cause file size=================//
            $('#show_cause').on('change', function() {
                var ext = $("#show_cause").val().split('.').pop();
                // alert(ext);
                $("#file_error_show_cause").html("");
                $("#file_error_show_cause").hide();
                $("#show_cause_label").css("border-color","#F0F0F0");
                var file_size = $('#show_cause')[0].files[0].size;
                var fileSizeKB = parseFloat(file_size / 1024).toFixed(2);
              // alert(fileSizeKB);
                if(fileSizeKB>2048) {
                    $("#file_error_show_cause").show();
                    $("#file_error_show_cause").html("অনুগ্রহ করে 2MB এর কম ফাইল নির্বাচন করুন");
                    $("#show_cause_label").css("border-color","#FF0000");
                    $("#show_cause_label").html("ফাইল নির্বাচন করুন");
                    return false;
                } 
                // return true;
                 var allowedExtensions = /(\.pdf)$/i;
        
                if (!allowedExtensions.exec($("#show_cause").val())) {
                    // alert('Invalid file type');
                    // document.getElementById('customFile' + id).value = '';
                    $("#show_cause").val('');
                    $("#show_cause_label").html('ফাইল নির্বাচন করুন');  
                    $("#show_cause_label").css("border-color","#FF0000");  
                    $("#file_error_show_cause").show();  
                    $("#file_error_show_cause").html("পিডিএফ ফাইল নির্বাচন করুন");  
                    return false;
                } 
              //this.files[0].size gets the size of your file.
            });

            //=============SF file size=================//
            $('#sf_file').on('change', function() {
              // alert('hi'); 
                $("#file_error_sf").html("");
                $("#file_error_sf").hide();
                $("#sf_file_label").css("border-color","#F0F0F0");
                var file_size = $('#sf_file')[0].files[0].size;
                var fileSizeKB = parseFloat(file_size / 1024).toFixed(2);
              // alert(fileSizeKB);
                if(fileSizeKB>2048) {
                    $("#file_error_sf").show();
                    $("#file_error_sf").html("অনুগ্রহ করে 2MB এর কম ফাইল নির্বাচন করুন");
                    $("#sf_file_label").css("border-color","#FF0000");
                    $("#sf_file_label").html("ফাইল নির্বাচন করুন");
                    return false;
                } 
                // return true;
                var allowedExtensions = /(\.pdf)$/i;
        
                if (!allowedExtensions.exec($("#sf_file").val())) {
                    // alert('Invalid file type');
                    // document.getElementById('customFile' + id).value = '';
                    $("#sf_file").val('');
                    $("#sf_file_label").html('ফাইল নির্বাচন করুন');  
                    $("#sf_file_label").css("border-color","#FF0000");  
                    $("#file_error_sf").show();  
                    $("#file_error_sf").html("পিডিএফ ফাইল নির্বাচন করুন");  
                    return false;
                } 
              //this.files[0].size gets the size of your file.
            });

            // Dynamic Dropdown
            var load_url = "{{ asset('media/custom/preload.gif') }}";


                            //===========District================//


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
                    url : '{{url("/")}}/case/dropdownlist/getdependentdistrict/' +dataID,
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

                //===========Upazila================//


            jQuery('select[name="district"]').on('change',function(){
                var dataID = jQuery(this).val();

                // var category_id = jQuery('#category_id option:selected').val();
                jQuery("#upazila_id").after('<div class="loadersmall"></div>');
                

                if(dataID)
                {
                  jQuery.ajax({
                    url : '{{url("/")}}/case/dropdownlist/getdependentupazila/' +dataID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        jQuery('select[name="upazila"]').html('<div class="loadersmall"></div>');
                        
                        jQuery('select[name="upazila"]').html('<option value="">-- নির্বাচন করুন --</option>');
                        jQuery.each(data, function(key,value){
                            jQuery('select[name="upazila"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        jQuery('.loadersmall').remove();
                    }
                });
              }
              else
              {
                  $('select[name="upazila"]').empty();
              }
            });


                //===========Mouja================//


            jQuery('select[name="upazila"]').on('change',function(){
                var dataID = jQuery(this).val();

                // var category_id = jQuery('#category_id option:selected').val();
                jQuery("#mouja_id").after('<div class="loadersmall"></div>');

                if(dataID)
                {
                  jQuery.ajax({
                    url : '{{url("/")}}/case/dropdownlist/getdependentmouja/' +dataID,
                    // url : 'https://dev.case.gov.bd/case/dropdownlist/getdependentmouja/' +dataID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        jQuery('select[name="mouja"]').html('<div class="loadersmall"></div>');

                        jQuery('select[name="mouja"]').html('<option value="">-- নির্বাচন করুন --</option>');
                        jQuery.each(data, function(key,value){
                            jQuery('select[name="mouja"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        jQuery('.loadersmall').remove();
                    }
                });
              }
              else
              {
                  $('select[name="mouja"]').empty();
              }
            });

            //===========Depndable Appeal Court================//


            jQuery('select[name="case_type"]').on('change',function(){
                var dataID = jQuery(this).val();
                jQuery("#court").after('<div class="loadersmall"></div>');
                if(dataID)
                {
                  jQuery.ajax({
                    url : '{{url("/")}}/case/dropdownlist/getdependentappealcourt/' +dataID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        jQuery('select[name="court"]').html('<div class="loadersmall"></div>');
                        jQuery('select[name="court"]').html('<option value="">-- নির্বাচন করুন --</option>');
                        jQuery.each(data, function(key,value){
                            jQuery('select[name="court"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        jQuery('.loadersmall').remove();
                    }
                });
              }
              else
              {
                  $('select[name="court"]').empty();
              }
            });


                //===========Old Case Court================//


            jQuery('select[name="old_case_type"]').on('change',function(){
                var dataID = jQuery(this).val();

                // var category_id = jQuery('#category_id option:selected').val();
                jQuery("#old_case_court").after('<div class="loadersmall"></div>');

                if(dataID)
                {
                  jQuery.ajax({
                    url : '{{url("/")}}/case/dropdownlist/getdependentoldcasecourt/' +dataID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        jQuery('select[name="old_case_court"]').html('<div class="loadersmall"></div>');

                        jQuery('select[name="old_case_court"]').html('<option value="">-- নির্বাচন করুন --</option>');
                        jQuery.each(data, function(key,value){
                            jQuery('select[name="old_case_court"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        jQuery('.loadersmall').remove();
                    }
                });
              }
              else
              {
                  $('select[name="old_case_court"]').empty();
              }
            });



                //===========Old Case No================//


            jQuery('select[name="old_case_court"]').on('change',function(){
                var dataID = jQuery(this).val();

                // var category_id = jQuery('#category_id option:selected').val();
                jQuery("#ref_case_no").after('<div class="loadersmall"></div>');

                if(dataID)
                {
                  jQuery.ajax({
                    url : '{{url("/")}}/case/dropdownlist/getdependentoldcaseno/' +dataID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        jQuery('select[name="ref_case_no"]').html('<div class="loadersmall"></div>');

                        jQuery('select[name="ref_case_no"]').html('<option value="">-- নির্বাচন করুন --</option>');
                        jQuery.each(data, function(key,value){
                            jQuery('select[name="ref_case_no"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        jQuery('.loadersmall').remove();
                    }
                });
              }
              else
              {
                  $('select[name="ref_case_no"]').empty();
              }
            });

          //*************add SELECT2*********************//
            $('#ref_case_no').select2();
            $('#case_type').select2();
            $('#court').select2();
            $('#upazila_id').select2();
            $('#mouja_id').select2();
            


        });

        /*********************** Add multiple badi *************************/
        $("#addBadiRow").click(function(e) {
            addBadiRowFunc();
        });

        //add row function
        function addBadiRowFunc(){


            var items = '';
            items+= '<tr>';
            items+= '<td><input type="text" name="badi_name[]" class="form-control form-control-sm" placeholder="" required></td>';
            items+= '<td><input type="text" name="badi_spouse_name[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><input type="text" name="badi_address[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeBadiRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items+= '</tr>';

            $('#badiDiv tr:last').after(items);


            //scout_id_select2_dd();
        }

        //remove row
        function removeBadiRow(id){
            $(id).closest("tr").remove();
        }

        /************************ Add multiple bibadi *************************/
        $("#addBibadiRow").click(function(e) {
            addBibadiRowFunc();
        });

        //add row function
        function addBibadiRowFunc(){
            var items = '';
            items+= '<tr>';
            items+= '<td><input type="text" name="bibadi_name[]" class="form-control form-control-sm" placeholder="" required></td>';
            items+= '<td><input type="text" name="bibadi_spouse_name[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><input type="text" name="bibadi_address[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeBibadiRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items+= '</tr>';

            $('#bibadiDiv tr:last').after(items);
            //scout_id_select2_dd();
        }

        //remove row function
        function removeBibadiRow(id){
            $(id).closest("tr").remove();
        }

        

        /************************ Add multiple file *************************/
        $("#addFileRow").click(function(e) {
            addFileRowFunc();
        });

        //add row function
        function addFileRowFunc(){
            var count = parseInt($('#other_attachment_count').val());
            $('#other_attachment_count').val(count+1);
            var items = '';
            items+= '<tr>';
            items+= '<td><input type="text" name="file_type[]" id="file_type'+count+'" class="form-control form-control-sm" placeholder=""><label id="file_type_error'+count+'" class="text-danger font-weight-bolder mt-2 mb-2" style="display:none;"></label></td>';
            items+= '<td><div class="custom-file"><input type="file" name="file_name[]" onChange="attachmentTitle('+count+',this)" class="custom-file-input" id="customFile'+count+'" /><label id="file_error'+count+'" class="text-danger font-weight-bolder mt-2 mb-2"></label><label class="custom-file-label custom-input'+count+'" for="customFile'+count+'">ফাইল নির্বাচন করুন</label></div></td>';
           
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeFileRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items+= '</tr>';

            $('#fileDiv tr:last').after(items);
            //scout_id_select2_dd();

        }

        //remove row function
        function removeFileRow(id){
            $(id).closest("tr").remove();
        }


        /************************ Add multiple survey *************************/
        $("#addSurveyRow").click(function(e) {
            addSurveyRowFunc();
        });

        //add row function
        function addSurveyRowFunc(){

            var count = parseInt($('#survey_count').val());
            $('#survey_count').val(count+1);
            var items = '';
            items+= '<tr>';
            items+= '<td><select name="st_id[]" class="form-control form-control-sm" required><?php echo $survey_data;?></select></td>';
            items+= '<td><input type="text" name="khotian_no[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><input type="text" name="daag_no[]" class="form-control form-control-sm" placeholder="" required></td>';
            items+= '<td><select name="lt_id[]" class="form-control form-control-sm"><?php echo $land_type_data;?></select></td>';
            items+= '<td><input type="text" name="land_size[]" id="land_size'+count+'" step="0.01" class="form-control form-control-sm" placeholder="0.00" onChange="numeicCheckLandSize('+count+',this)"><label id="land_size_error'+count+'" class="text-danger font-weight-bolder mt-2 mb-2" style="display:none"></label></td>';
            items+= '<td><input type="text" name="land_demand[]" id="land_demand'+count+'" step="0.01" class="form-control form-control-sm" placeholder="0.00" onChange="numeicCheckLandDemand('+count+',this)"><label id="land_demand_error'+count+'" class="text-danger font-weight-bolder mt-2 mb-2" style="display:none"></label></td>';
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeSurveyRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items+= '</tr>';

            $('#surveyDiv tr:last').after(items);
            //scout_id_select2_dd();
        }

        //remove row function
        function removeSurveyRow(id){
            $(id).closest("tr").remove();
        }

        
        /************************ Add multiple file *************************/
        $("#addSfFileRow").click(function(e) {
            addSfFileRowFunc();
        });

        //add row function
        function addSfFileRowFunc(){
            var count = parseInt($('#sf_attachment_count').val());
            $('#sf_attachment_count').val(count+1);
            var items = '';
            items+= '<tr>';
            items+= '<td><input type="text" name="sf_file_type[]" id="sf_file_type'+count+'" class="form-control form-control-sm" placeholder=""><label id="sf_file_type_error'+count+'" class="text-danger font-weight-bolder mt-2 mb-2" style="display:none;"></label></td>';
            items+= '<td><div class="custom-file"><input type="file" name="sf_file_name[]" accept="application/pdf"  onChange="sfAttachmentTitle('+count+',this)" class="custom-file-input" id="customSfFile'+count+'" /><label id="sf_file_error'+count+'" class="text-danger font-weight-bolder mt-2 mb-2"></label><label class="custom-file-label custom-sf-input'+count+'" for="customSfFile'+count+'">ফাইল নির্বাচন করুন</label></div></td>';
           
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeFileRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items+= '</tr>';

            $('#sfFileDiv tr:last').after(items);
            //scout_id_select2_dd();

        }

        //remove row function
        function removeFileRow(id){
            $(id).closest("tr").remove();
        }
    </script>

    

  <script>
    function myFunction() {
      confirm("আপনি কি সংরক্ষণ করতে চান?");
  }

  $('document').ready(function(){
    $('#preview').on('click',function(){
        var court = $('#court option:selected').text();
        var division = $('#division_id option:selected').text();
        var district_n = $('#district_id option:selected').text();
        var upazila = $('#upazila_id option:selected').text();
        var mouja_id = $('#mouja_id option:selected').text();
        var case_type = $('#case_type option:selected').text();
        var case_no = $('#case_no').val();
        var case_date = $('#case_date').val();
        var tafsil = $('#tafsil').val();
        var chowhaddi = $('#chowhaddi').val();
        var comments = $('#comments').val();
        var count=0;
        var badi_name = $("form input[name='badi_name[]']").map(function()
           {count++; return (count+'. '+$(this).val()+'<br>')}).get();
        var badi_spouse_name = $("form input[name='badi_spouse_name[]']").map(function()
          {return ($(this).val()+'<br>')}).get();
        var badi_address = $("form input[name='badi_address[]']").map(function()
          {return ($(this).val()+'<br>')}).get();
        var count=0;
        var bibadi_name = $("form input[name='bibadi_name[]']").map(function()
          {count++; return (count+'. '+$(this).val()+'<br>')}).get();
        var bibadi_spouse_name = $("form input[name='bibadi_spouse_name[]']").map(function()
          {return ($(this).val()+'<br>')}).get();
        var bibadi_address = $("form input[name='bibadi_address[]']").map(function()
          {return ($(this).val()+'<br>')}).get();
        var count=0;
        var st_id = $("form select[name='st_id[]']").map(function()
           {return ($(this).find("option:selected").text())+'   '}).get();
        var count=0;
        var khotian_no = $("form input[name='khotian_no[]']").map(function()
          {count++; return (count+'. '+$(this).val()+'<br>')}).get();
        var count=0;
        var daag_no = $("form input[name='daag_no[]']").map(function()
          {count++; return (count+'. '+$(this).val()+'<br>')}).get();
        var count=0;
        var lt_id = $("form select[name='lt_id[]']").map(function()
           {return ($(this).find("option:selected").text())+'   '}).get();
        var count=0;
        var land_size = $("form input[name='land_size[]']").map(function()
          {count++; return (count+'. '+$(this).val()+'<br>')}).get();
        var count=0;
        var land_demand = $("form input[name='land_demand[]']").map(function()
          {count++; return (count+'. '+$(this).val()+'<br>')}).get();
        var count=0;

               /* var role_id = $('#role_id option:selected').text();
               var office_id = $('#office_id option:selected').text();*/
               $('#previewCourt').html(court);
               $('#previewDivision').html(division);
               $('#previewDistrict').html(district_n);
               $('#previewUpazila').html(upazila);
               $('#previewMouja_id').html(mouja_id);
               $('#previewCase_type').html(case_type);
               $('#previewCase_no').html(case_no);
               $('#previewCase_date').html(case_date);
               $('#previewTafsil').html(tafsil);
               $('#previewChowhaddi').html(chowhaddi);
               $('#previewComments').html(comments);
               $('#previewBadi_name').html(badi_name);
               $('#previewBadi_spouse_name').html(badi_spouse_name);
               $('#previewBadi_address').html(badi_address);
               $('#previewBibadi_name').html(bibadi_name);
               $('#previewBibadi_spouse_name').html(bibadi_spouse_name);
               $('#previewBibadi_address').html(bibadi_address);
               $('#previewSt_id').html(st_id);
               $('#previewKhotian_no').html(khotian_no);
               $('#previewDaag_no').html(daag_no);
               $('#previewLt_id').html(lt_id);
               $('#previewLand_size').html(land_size);
               $('#previewLand_demand').html(land_demand);

           });
});
</script>
<script type="text/javascript">
    /*function attachmentTitle(id){
        var value=$('#customFile'+id).val();
        $('.custom-input'+id).text(value['name']);
    }*/
    
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
    
    function sfAttachmentTitle(id,selectObject) {
        var fileType = document.getElementById('sf_file_type' + id).value ;
        if (fileType != '') {
            //===================For CSS Change of Duynamic File Name =============//
            $('#sf_file_type' + id).css("background-color", "#ccc");
            // alert(fileType);    
            $('#sf_file_type_error' + id).hide();  
            $('#sf_file_type' + id).css("border-color","#ccc");
            console.log(selectObject.value);
            // var value = $('#customFile' + id).val();
            var value = $('#customSfFile' + id)[0].files[0];
            // console.log(value['name']);
            $('.custom-sf-input' + id).text(value['name']);

            var filePath = selectObject.value;
            var fileData = selectObject;  
              if (typeof (fileData.files) != "undefined") {
                    $('#sf_file_error' + id).hide();  
                    $('.custom-sf-input' + id).css("border-color","#ccc");  

                  var size = parseFloat(fileData.files[0].size / 1024).toFixed(2);
                  if(size > 2048){
                    document.getElementById('customSfFile' + id).value = '';    
                    $('.custom-sf-input' + id).html('ফাইল নির্বাচন করুন');  
                    $('.custom-sf-input' + id).css("border-color","#FF0000");  
                    $('#sf_file_error' + id).show();  
                    $('#sf_file_error' + id).html('ফাইলের আকার 2MB এর বেশি');  
                    return false;
                  }
              } else {
                  alert("This browser does not support HTML5.");
              }

              // Allowing file type
              var allowedExtensions = /(\.pdf)$/i;
            
              if (!allowedExtensions.exec(filePath)) {
                    // alert('Invalid file type');
                    document.getElementById('customSfFile' + id).value = '';
                    $('.custom-sf-input' + id).html('ফাইল নির্বাচন করুন');  
                    $('.custom-sf-input' + id).css("border-color","#FF0000");  
                    $('#sf_file_error' + id).show();  
                    $('#sf_file_error' + id).html("পিডিএফ ফাইল নির্বাচন করুন");  
                    return false;
              } 
        }else{
            document.getElementById('customSfFile' + id).value = '';    
            $('#sf_file_type' + id).css("border-color","#FF0000");  
            $('#sf_file_type_error' + id).show();  
            $('#sf_file_type_error' + id).html('ফাইলের নাম লিখুন');
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







