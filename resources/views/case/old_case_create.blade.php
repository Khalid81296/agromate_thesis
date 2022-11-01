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
            <form action="{{ url('case/saved') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <fieldset class="mb-8">
                        <legend>সাধারণ তথ্য</legend>
                        <div class="form-group row">
                            <div class="col-lg-3 mb-5">
                                <label>আদালতের নাম <span class="text-danger">*</span></label>
                                <select name="court" id="court" class="form-control form-control-sm" required="required">
                                    <option value=""> -- নির্বাচন করুন --</option>
                                    @foreach ($courts as $value)
                                    <option value="{{ $value->id }}" {{ old('court') == $value->id ? 'selected' : '' }}> {{ $value->court_name }} </option>
                                    @endforeach
                                </select>
                            </div><!--  -->
                            <div class="col-lg-3 mb-5">
                                <label>উপজেলা <span class="text-danger">*</span></label>
                                <select name="upazila" id="upazila_id" class="form-control form-control-sm"  required="required">
                                    <option value="">-- নির্বাচন করুন --</option>
                                    @foreach ($upazilas as $value)
                                    <option value="{{ $value->id }}" {{ old('upazila') == $value->id ? 'selected' : '' }}> {{ $value->upazila_name_bn }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 mb-5">
                                <label>মৌজা <span class="text-danger">*</span></label>
                                <select name="mouja" id="mouja_id" class="form-control form-control-sm" required="required">
                                    <!-- <span id="loading"></span> -->
                                    <option value="">-- নির্বাচন করুন --</option>
                                </select>
                            </div>
                            <?php /*
                            <div class="col-lg-3 mb-5">
                                <label>জিপি <span class="text-danger">*</span></label>
                                <select name="gp_user_id" id="gp_user_id" class="form-control form-control-sm">
                                    <!-- <span id="loading"></span> -->
                                    <option value="">-- নির্বাচন করুন --</option>
                                </select>
                            </div>
                            */ ?>
                            
                            <div class="col-lg-3 mb-5">
                                <label>মামলার ধরণ <span class="text-danger">*</span></label>
                                <select name="case_type" id="case_type" class="form-control form-control-sm" required="required">
                                    <option value="">-- নির্বাচন করুন --</option>
                                    @foreach ($case_types as $value)
                                    <option value="{{ $value->id }}" {{ old('case_type') == $value->id ? 'selected' : '' }}> {{ $value->ct_name }} </option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-lg-3 mb-5">
                                <label>মামলা নং <span class="text-danger">*</span></label>
                                <input type="text" name="case_no" id="case_no" class="form-control form-control-sm" placeholder="মামলা নং " required="required">
                            </div>
                           <!--  <div class="col-lg-3 mb-5">
                                <label>পূর্বের মামলা নং </label>
                                <input type="text" name="ref_case_no" id="ref_case_no" class="form-control form-control-sm" placeholder="পূর্বের মামলা নং ">
                            </div> -->
                            <div class="col-lg-3 mb-5">
                                <label>মামলা রুজুর তারিখ <span class="text-danger">*</span></label>
                                <input type="text" name="case_date" id="case_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" required="required">
                            </div>
                            <div class="col-lg-3 mb-5">
                                 <label>ফলাফল</label>
                                 <div class="radio-inline">
                                    <label class="radio">
                                    <input type="radio" name="case_result" value="1" checked="checked" />
                                    <span></span>সরকারের পক্ষে</label>
                                    <label class="radio">
                                    <input type="radio" name="case_result" value="0" />
                                    <span></span>সরকারের বিপক্ষে</label>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-5">
                                 <label>মামলায় হেরে গিয়ে কি আপিল করা হয়েছে?</label>
                                <div class="radio-inline">
                                    <label class="radio">
                                    <input type="radio" name="is_lost_appeal" value="1" checked="checke" />
                                    <span></span>হ্যা</label>
                                    <label class="radio">
                                    <input type="radio" name="is_lost_appeal" value="0" />
                                    <span></span>না</label>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-5" id="lost_reason_div" style="display: none;">
                                <label>সরকারের বিপক্ষে যাইবার কারণ</label>
                                <textarea name="lost_reason" class="form-control" id="lost_reason" rows="2" spellcheck="false"></textarea>
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
                    <fieldset class="mb-8">
                        <legend> চৌহদ্দি / প্রাথিত প্রতিকারের বিবরণ / মন্তব্য </legend>
                        <div class="row">
                            <!-- <div class="col-lg-4">
                                <div class="form-group">
                                    <label>তফসিল</label>
                                    <textarea name="tafsil" class="form-control" id="tafsil" rows="3"  spellcheck="false"></textarea>
                                </div>
                            </div> -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>চৌহদ্দি</label>
                                    <textarea name="chowhaddi" class="form-control" id="chowhaddi" rows="3" spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>প্রাথিত প্রতিকার</label>
                                    <textarea name="traditional_remedies" class="form-control" id="traditional_remedies" rows="3" spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>মন্তব্য</label>
                                    <textarea name="comments" class="form-control" id="comments" rows="2" spellcheck="false"></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

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



                    <br>
                    <div class="form-group row">
                        <div class="col-lg-6 mb-5">
                            <fieldset>
                                <legend>ফাইল আপলোড </legend>
                                <div class="col-lg-12 mb-5">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>কারণ দর্শাইবার নোটিশ প্রাপ্তির তারিখ <span class="text-danger">*</span></label>
                                            <input type="text" name="sc_receiving_date" id="sc_receiving_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" required="required">
                                        </div>
                                        <label>কারণ দর্শাইবার স্ক্যান কপি সংযুক্তি <sub class="text-danger">(PDF,Size Max: 2MB)</sub></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" accept="application/pdf" name="show_cause" class="custom-file-input" id="show_cause"  />
                                            <label class="custom-file-label" id="show_cause_label" for="customFile">ফাইল নির্বাচন করুন</label>
                                        </div>
                                        <span id="file_error_show_cause" class="text-danger font-weight-bolder " style="margin: 0 auto;display: table;margin-top: 10px;"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-5">
                                      <label>পাওয়ার অফ অ্যাটর্নি ফাইল সংযুক্তি <sub class="text-danger">(PDF,Size Max: 2MB)</sub></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" accept="application/pdf" name="power_attorney_file" class="custom-file-input" id="power_attorney_file" />
                                            <label class="custom-file-label" id="power_attorney_file_label" for="customFile">ফাইল নির্বাচন করুন</label>
                                        </div>
                                        <span id="file_error_power_attorney_file" class="text-danger font-weight-bolder " style="margin: 0 auto;display: table;margin-top: 10px;"></span>
                                </div>
                                <div class="form-group">
                                    <label>কারণ দর্শাইবার আপিল নোটিশ প্রাপ্তির তারিখ</label>
                                        <div></div>
                                    <div class="form-group">
                                        <input type="text" name="send_date_rm_ac" id="send_date_rm_ac" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">


                                    <label>কারণ দর্শাইবার আপিল নোটিশ পিডিএফ ফাইল <sub class="text-danger">(PDF,Size Max: 2MB)</sub></label>
                                    <div></div>
                                    <div class="custom-file">
                                        <input type="file" accept="application/pdf" name="appeal_sc_file" class="custom-file-input" id="appeal_sc_file" />
                                        <label class="custom-file-label" id="appeal_sc_file_label" for="customFile">ফাইল নির্বাচন করুন</label>
                                    </div>
                                    <span id="file_error_appeal_sc_file" class="text-danger font-weight-bolder " style="margin: 0 auto;display: table;margin-top: 10px;"></span>
                                </div>
                                <div class="form-group">
                                    <label>এস এফ এর চূড়ান্ত প্রতিবেদন <sub class="text-danger">(PDF,Size Max: 2MB)</sub></label>
                                    <div></div>
                                    <div class="custom-file">
                                        <input type="file" accept="application/pdf" name="sf_report" class="custom-file-input" id="sf_report" />
                                        <label class="custom-file-label" id="sf_report_label" for="customFile">ফাইল নির্বাচন করুন</label>
                                    </div>
                                    <span id="file_error_sf_report" class="text-danger font-weight-bolder " style="margin: 0 auto;display: table;margin-top: 10px;"></span>
                                </div>

                        </div>
                            </fieldset>

                        <div class="col-lg-6 mb-5">
                            <fieldset>
                                <legend>ফাইল প্রেরণের তারিখ সমুহ</legend>
                                <div class="form-group">
                                    <label>এস এফ তৈরির জন্য আর এম অফিস থেকে লেটার এসি ল্যান্ড অফিসে প্রেরণের তারিখ</label>
                                    <input type="text" name="send_date_rm_ac" id="send_date_rm_ac" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>এস এফ তৈরির জন্য এসি ল্যান্ড থেকে লেটার ইউ এল ও অফিসে প্রেরণের তারিখ</label>
                                    <input type="text" name="send_date_ac_ulo" id="send_date_ac_ulo" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>এস এফ ফাইল ইউ এল ও অফিস থেকে এসি ল্যান্ড অফিসে প্রেরণের তারিখ</label>
                                    <input type="text" name="send_date_sf_ulo_ac" id="send_date_sf_ulo_ac" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>এস এফ এর জবাব প্রাপ্তির তারিখ</label>
                                    <input type="text" name="send_date_ans_ac_rm" id="send_date_ans_ac_rm" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>এফ এফ প্রতিবেদন চূড়ান্ত করার তারিখ</label>
                                    <input type="text" name="send_date_sf_rm_adc" id="send_date_sf_rm_adc" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-lg-6 mb-5">
                            <fieldset>
                                <legend>আদেশ</legend>
                                <div class="form-group">
                                    <label>আদেশের তারিখ</label>
                                    <input type="text" name="order_date" id="order_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                </div>
                               <!--  <div class="form-group">
                                    <label>পরবর্তী ধার্য তারিখ</label>
                                    <input type="text" name="next_assign_date" id="next_assign_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                </div> -->
                                <div class="form-group">
                                    <label>বিগত তারিখের আদেশ</label>
                                    <input type="text" name="past_order_date" id="past_order_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                </div>
                                <div class="col-lg-12 mb-5">
                                    <div class="form-group">
                                        <label>আদেশের ফাইল <sub class="text-danger">(PDF,Size Max: 2MB)</sub></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" accept="application/pdf" name="order_file" class="custom-file-input" id="order_file" />
                                            <label class="custom-file-label" id="order_file_label" for="customFile">ফাইল নির্বাচন করুন</label>
                                        </div>
                                        <span id="file_error_order_file" class="text-danger font-weight-bolder " style="margin: 0 auto;display: table;margin-top: 10px;"></span>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <fieldset>
                                <legend>অন্যান্য সংযুক্তির </legend>
                                <div class="col-lg-12 mb-5">    
                                    <table width="100%" border="1" id="fileDiv" style="border:1px solid #dcd8d8;">
                                        <tr>
                                            <th>সংযুক্তির নাম <span class="text-danger">*</span></th>
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



                </div> <!--end::Card-body-->

                <!-- <div class="card-footer text-right bg-gray-100 border-top-0">
                    <button type="reset" class="btn btn-primary">সংরক্ষণ করুন</button>
                </div> -->
                <div class="card-footer">
                  <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-7">
                            <!-- <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary mr-3" id="preview">প্রিভিউ</button> -->
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
                                            <th class="tg-19u4 text-center">বিভাগ </th>
                                            <th class="tg-19u4 text-center">জেলা </th>
                                            <th class="tg-19u4 text-center">উপজেলা </th>
                                            <th class="tg-19u4 text-center">মৌজা </th>
                                            <th class="tg-19u4 text-center">জিপি </th>
                                            <th class="tg-19u4 text-center">ফলাফল </th>
                                        </tr>
                                        <tr>
                                            <td class="tg-nluh" id="previewCourt"></td>
                                            <td class="tg-nluh" id="previewDivision"></td>
                                            <td class="tg-nluh" id="previewDistrict"></td>
                                            <td class="tg-nluh" id="previewUpazila"></td>
                                            <td class="tg-nluh" id="previewMouja_id"></td>
                                            <td class="tg-nluh" id="previewGP_id"></td>
                                            <td class="tg-nluh" id="previewReault"></td>
                                        </tr>
                                        <tr>
                                            <th class="tg-19u4 text-center">মামলার ধরণ</th>
                                            <th class="tg-19u4 text-center">মামলা নং </th>
                                            <th class="tg-19u4 text-center">মামলা রুজুর তারিখ</th>
                                        </tr>
                                        <tr>
                                            <td class="tg-nluh" id="previewCase_type"></td>
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
                                                <th class="tg-19u4 text-center">দাগ নং</th>
                                                <th class="tg-19u4 text-center">খতিয়ান নং</th>
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
        $(document).ready(function() {
            $("input[name$='case_result']").click(function() {
                var test = $(this).val();
                // alert(test);
                if(test == 0){
                    $("#lost_reason_div").show();
                }else{
                    $("#lost_reason_div").hide();
                }
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {

          //*************add SELECT2*********************//
            $('#ref_case_no').select2();
            $('#case_type').select2();
            $('#court').select2();
            $('#upazila_id').select2();
            $('#mouja_id').select2();


            //Load First row
            addBadiRowFunc();
            addBibadiRowFunc();
            addSurveyRowFunc();
            addFileRowFunc();


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
            //=============power of attorney file size=================//
            $('#power_attorney_file').on('change', function() {
                var ext = $("#power_attorney_file").val().split('.').pop();
                // alert(ext);
                $("#file_error_power_attorney_file").html("");
                $("#file_error_power_attorney_file").hide();
                $("#power_attorney_file_label").css("border-color","#F0F0F0");
                var file_size = $('#power_attorney_file')[0].files[0].size;
                var fileSizeKB = parseFloat(file_size / 1024).toFixed(2);
              // alert(fileSizeKB);
                if(fileSizeKB>2048) {
                    $("#file_error_power_attorney_file").show();
                    $("#file_error_power_attorney_file").html("অনুগ্রহ করে 2MB এর কম ফাইল নির্বাচন করুন");
                    $("#power_attorney_file_label").css("border-color","#FF0000");
                    $("#power_attorney_file_label").html("ফাইল নির্বাচন করুন");
                    return false;
                } 
                // return true;
                 var allowedExtensions = /(\.pdf)$/i;
        
                if (!allowedExtensions.exec($("#power_attorney_file").val())) {
                    // alert('Invalid file type');
                    // document.getElementById('customFile' + id).value = '';
                    $("#power_attorney_file").val('');
                    $("#power_attorney_file_label").html('ফাইল নির্বাচন করুন');  
                    $("#power_attorney_file_label").css("border-color","#FF0000");  
                    $("#file_error_power_attorney_file").show();  
                    $("#file_error_power_attorney_file").html("পিডিএফ ফাইল নির্বাচন করুন");  
                    return false;
                } 
              //this.files[0].size gets the size of your file.
            });
            //=============Appeal Show Cause file size=================//
            $('#appeal_sc_file').on('change', function() {
                var ext = $("#appeal_sc_file").val().split('.').pop();
                // alert(ext);
                $("#file_error_appeal_sc_file").html("");
                $("#file_error_appeal_sc_file").hide();
                $("#appeal_sc_file_label").css("border-color","#F0F0F0");
                var file_size = $('#appeal_sc_file')[0].files[0].size;
                var fileSizeKB = parseFloat(file_size / 1024).toFixed(2);
              // alert(fileSizeKB);
                if(fileSizeKB>2048) {
                    $("#file_error_appeal_sc_file").show();
                    $("#file_error_appeal_sc_file").html("অনুগ্রহ করে 2MB এর কম ফাইল নির্বাচন করুন");
                    $("#appeal_sc_file_label").css("border-color","#FF0000");
                    $("#appeal_sc_file_label").html("ফাইল নির্বাচন করুন");
                    return false;
                } 
                // return true;
                 var allowedExtensions = /(\.pdf)$/i;
        
                if (!allowedExtensions.exec($("#appeal_sc_file").val())) {
                    // alert('Invalid file type');
                    // document.getElementById('customFile' + id).value = '';
                    $("#appeal_sc_file").val('');
                    $("#appeal_sc_file_label").html('ফাইল নির্বাচন করুন');  
                    $("#appeal_sc_file_label").css("border-color","#FF0000");  
                    $("#file_error_appeal_sc_file").show();  
                    $("#file_error_appeal_sc_file").html("পিডিএফ ফাইল নির্বাচন করুন");  
                    return false;
                } 
              //this.files[0].size gets the size of your file.
            });
            //=============SF Report file size=================//
            $('#sf_report').on('change', function() {
                var ext = $("#sf_report").val().split('.').pop();
                // alert(ext);
                $("#file_error_sf_report").html("");
                $("#file_error_sf_report").hide();
                $("#sf_report_label").css("border-color","#F0F0F0");
                var file_size = $('#sf_report')[0].files[0].size;
                var fileSizeKB = parseFloat(file_size / 1024).toFixed(2);
              // alert(fileSizeKB);
                if(fileSizeKB>2048) {
                    $("#file_error_sf_report").show();
                    $("#file_error_sf_report").html("অনুগ্রহ করে 2MB এর কম ফাইল নির্বাচন করুন");
                    $("#sf_report_label").css("border-color","#FF0000");
                    $("#sf_report_label").html("ফাইল নির্বাচন করুন");
                    return false;
                } 
                // return true;
                 var allowedExtensions = /(\.pdf)$/i;
        
                if (!allowedExtensions.exec($("#sf_report").val())) {
                    // alert('Invalid file type');
                    // document.getElementById('customFile' + id).value = '';
                    $("#sf_report").val('');
                    $("#sf_report_label").html('ফাইল নির্বাচন করুন');  
                    $("#sf_report_label").css("border-color","#FF0000");  
                    $("#file_error_sf_report").show();  
                    $("#file_error_sf_report").html("পিডিএফ ফাইল নির্বাচন করুন");  
                    return false;
                } 
              //this.files[0].size gets the size of your file.
            });
            //=============Order file size=================//
            $('#order_file').on('change', function() {
                var ext = $("#order_file").val().split('.').pop();
                // alert(ext);
                $("#file_error_order_file").html("");
                $("#file_error_order_file").hide();
                $("#order_file_label").css("border-color","#F0F0F0");
                var file_size = $('#order_file')[0].files[0].size;
                var fileSizeKB = parseFloat(file_size / 1024).toFixed(2);
              // alert(fileSizeKB);
                if(fileSizeKB>2048) {
                    $("#file_error_order_file").show();
                    $("#file_error_order_file").html("অনুগ্রহ করে 2MB এর কম ফাইল নির্বাচন করুন");
                    $("#order_file_label").css("border-color","#FF0000");
                    $("#order_file_label").html("ফাইল নির্বাচন করুন");
                    return false;
                } 
                // return true;
                 var allowedExtensions = /(\.pdf)$/i;
        
                if (!allowedExtensions.exec($("#order_file").val())) {
                    // alert('Invalid file type');
                    // document.getElementById('customFile' + id).value = '';
                    $("#order_file").val('');
                    $("#order_file_label").html('ফাইল নির্বাচন করুন');  
                    $("#order_file_label").css("border-color","#FF0000");  
                    $("#file_error_order_file").show();  
                    $("#file_error_order_file").html("পিডিএফ ফাইল নির্বাচন করুন");  
                    return false;
                } 
              //this.files[0].size gets the size of your file.
            });

            // Dynamic Dropdown
            var load_url = "{{ asset('media/custom/preload.gif') }}";
                //===========GP================//
            jQuery('select[name="district"]').on('change',function(){
                var dataID = jQuery(this).val();

                // var category_id = jQuery('#category_id option:selected').val();
                jQuery("#gp_user_id").after('<div class="loadersmall"></div>');
                // $("#loading").html("<img src='{{ asset('media/preload.gif') }}' />");
                // jQuery('select[name="mouja"]').html('<option><div class="loadersmall"></div></option');
                // jQuery('select[name="mouja"]').attr('disabled', 'disabled');
                // jQuery('.loadersmall').remove();

                if(dataID)
                {
                  jQuery.ajax({
                    url : '{{url("/")}}/case/dropdownlist/getdependentgp/' +dataID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        jQuery('select[name="gp_user_id"]').html('<div class="loadersmall"></div>');
                        //console.log(data);
                        // jQuery('#mouja_id').removeAttr('disabled');
                        // jQuery('#mouja_id option').remove();

                        jQuery('select[name="gp_user_id"]').html('<option value="">-- নির্বাচন করুন --</option>');
                        jQuery.each(data, function(key,value){
                            jQuery('select[name="gp_user_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        jQuery('.loadersmall').remove();
                        // $('select[name="mouja"] .overlay').remove();
                        // $("#loading").hide();
                    }
                });
              }
              else
              {
                  $('select[name="gp_user_id"]').empty();
              }
          });

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
                // $("#loading").html("<img src='{{ asset('media/preload.gif') }}' />");
                // jQuery('select[name="mouja"]').html('<option><div class="loadersmall"></div></option');
                // jQuery('select[name="mouja"]').attr('disabled', 'disabled');
                // jQuery('.loadersmall').remove();

                if(dataID)
                {
                  jQuery.ajax({
                    url : '{{url("/")}}/case/dropdownlist/getdependentupazila/' +dataID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        jQuery('select[name="upazila"]').html('<div class="loadersmall"></div>');
                        //console.log(data);
                        // jQuery('#mouja_id').removeAttr('disabled');
                        // jQuery('#mouja_id option').remove();

                        jQuery('select[name="upazila"]').html('<option value="">-- নির্বাচন করুন --</option>');
                        jQuery.each(data, function(key,value){
                            jQuery('select[name="upazila"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        jQuery('.loadersmall').remove();
                        // $('select[name="mouja"] .overlay').remove();
                        // $("#loading").hide();
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
                // $("#loading").html("<img src='{{ asset('media/preload.gif') }}' />");
                // jQuery('select[name="mouja"]').html('<option><div class="loadersmall"></div></option');
                // jQuery('select[name="mouja"]').attr('disabled', 'disabled');
                // jQuery('.loadersmall').remove();

                if(dataID)
                {
                  jQuery.ajax({
                    url : '{{url("/")}}/case/dropdownlist/getdependentmouja/' +dataID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        jQuery('select[name="mouja"]').html('<div class="loadersmall"></div>');
                        //console.log(data);
                        // jQuery('#mouja_id').removeAttr('disabled');
                        // jQuery('#mouja_id option').remove();

                        jQuery('select[name="mouja"]').html('<option value="">-- নির্বাচন করুন --</option>');
                        jQuery.each(data, function(key,value){
                            jQuery('select[name="mouja"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        jQuery('.loadersmall').remove();
                        // $('select[name="mouja"] .overlay').remove();
                        // $("#loading").hide();
                    }
                });
              }
              else
              {
                  $('select[name="mouja"]').empty();
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
                    url : '{{url("/")}}/case/dropdownlist/getdependentoldpreviouscaseno/' +dataID,
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
            items+= '<td><input type="text" name="daag_no[]" class="form-control form-control-sm" placeholder=""></td>';
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
            items+= '<td><div class="custom-file"><input type="file" accept="application/pdf" name="file_name[]" onChange="attachmentTitle('+count+',this)" class="custom-file-input" id="customFile'+count+'" /><label id="file_error'+count+'" class="text-danger font-weight-bolder mt-2 mb-2"></label> <label class="custom-file-label custom-input'+count+'" for="customFile'+count+'">ফাইল নির্বাচন করুন</label></div></td>';
           
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeFileRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items+= '</tr>';

            $('#fileDiv tr:last').after(items);
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
        //var gp_user_id = $('#gp_user_id option:selected').text();
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
               //$('#previewGP_id').html(gp_user_id);
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
    
    function attachmentTitle(id,selectObject) {
        var fileType = document.getElementById('file_type' + id).value ;
        if (fileType != '') {
            //===================For CSS Change of Duynamic File Name =============//
            $('#file_type' + id).css("background-color", "FFFFFF");
            // alert(fileType);    
            $('#file_type_error' + id).hide();  
            $('#file_type' + id).css("border-color","#FFFFFF");  

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







