@extends('layouts.default')

@section('content')

@php
$pass_year_data = '<option value="">-- নির্বাচন করুন --</option>';
for($i=1995;$i<=date('Y');$i++){
$pass_year_data .= '<option value="'.$i.'">'.$i.'</option>';
}


$roleID = Auth::user()->role_id;
$officeInfo = user_office_info();
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
            <div class="card-body">
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!--begin::Form-->
            <form action="{{ route('rmcase.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <fieldset class="mb-8">
                        <legend>সাধারণ তথ্য</legend>
                        <div class="form-group row">
                            @if($roleID == 24)
                                

                                     <div class="col-lg-4 mb-5">
                                         <label>বিভাগ <span class="text-danger">*</span></label>
                                           <select name="division" class="form-control form-control-sm" required="required">
                                              <option value="">-বিভাগ নির্বাচন করুন-</option>
                                              @foreach ($divisions as $value)
                                              <option value="{{ $value->id }}"> {{ $value->division_name_bn }} </option>
                                              @endforeach
                                           </select>
                                     </div>
                                     <div class="col-lg-4 mb-5">
                                            <label>জেলা <span class="text-danger">*</span></label>
                                           <select name="district" id="district_id" class="form-control form-control-sm" required="required">
                                              <option value="">-জেলা নির্বাচন করুন-</option>

                                           </select>
                                     </div>
                                     <div class="col-lg-4 mb-5">
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="upazila" id="upazila_id" class="form-control form-control-sm" required="required">
                                           <option value="">-উপজেলা নির্বাচন করুন-</option>
                                        </select>
                                     </div>
                                 
                            @elseif($roleID == 22)
                                 
                                        <div class="col-lg-4 mb-5">
                                            <label>জেলা <span class="text-danger">*</span></label>
                                           <select name="district" id="district_id" class="form-control form-control-sm" required="required">
                                              <option value="">-জেলা নির্বাচন করুন-</option>
                                              @foreach ($districts as $value)
                                              <option value="{{ $value->id }}"> {{ $value->district_name_bn }} </option>
                                              @endforeach
                                           </select>
                                        </div>
                                        <div class="col-lg-4 mb-5 ">
                                            <label>উপজেলা <span class="text-danger">*</span></label>
                                            <select name="upazila" id="upazila_id" class="form-control form-control-sm" required="required">
                                               <option value="">-উপজেলা নির্বাচন করুন-</option>
                                            </select>
                                     </div>
                                 
                            @elseif($roleID == 5)
                                <div class="col-lg-4 mb-5">
                                    <label>উপজেলা <span class="text-danger">*</span></label>
                                    <select name="upazila" id="upazila_id" class="form-control form-control-sm"  required="required">
                                        <option value="">-- নির্বাচন করুন --</option>
                                        @foreach ($upazilas as $value)
                                        <option value="{{ $value->id }}" {{ old('upazila') == $value->id ? 'selected' : '' }}> {{ $value->upazila_name_bn }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-lg-4 mb-5">
                                <label>মামলার ধরণ <span class="text-danger">*</span></label>
                                <select name="case_type" id="case_type" class="form-control form-control-sm" required="required">
                                    <option value="">-- নির্বাচন করুন --</option>
                                    @foreach ($case_types as $value)
                                    <option value="{{ $value->id }}" {{ old('case_type') == $value->id ? 'selected' : '' }}> {{ $value->type_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>মামলা নং <span class="text-danger">*</span></label>
                                <input type="text" name="case_no" id="case_no" class="form-control form-control-sm" placeholder="মামলা নং " required="required">
                            </div> 
                            <div class="col-lg-4 mb-5">
                                <label>পূর্বের মামলা নং </label>
                                <select class="form-control form-control-sm" id="ref_case_no" name="ref_case_no">
                                  <option value=""> -- নির্বাচন করুন --</option>
                                    @foreach ($old_case_no as $value)
                                        <option value="{{$value->id}}" {{ old('id') == $value->id ? 'selected' : '' }}> {{ $value->case_no }} </option>
                                    @endforeach
                                  
                                </select>
                            </div>
                            <div class="col-lg-4 mb-5">
                                <label>মামলা রুজুর তারিখ <span class="text-danger">*</span></label>
                                <input type="text" name="case_date" id="case_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off" required="required">
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

                    <br>
                    <div class="form-group row">
                        
                        <div class="col-lg-7 mb-5">
                            <fieldset>
                                <legend>সংযুক্তি</legend>
                                <div class="form-group">
                                        <label>আরজি  <span class="text-danger">*</span></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" name="show_cause" class="custom-file-input" id="customFile" / required="required">
                                            <label class="custom-file-label" for="customFile">ফাইল নির্বাচন করুন</label>
                                        </div>
                                </div>
                                <label>অন্যান্য সংযুক্তির </label>    
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
                            </fieldset>
                        </div>
                        <div class="col-lg-5 mb-5">
                            <fieldset>
                                <legend>মন্তব্য </legend>
                                <div class="col-lg-12 mb-5">
                                    <label></label>
                                    <textarea name="comments" class="form-control" id="comments" rows="6" spellcheck="false"></textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                </div> <!--end::Card-body-->

        
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
                                    <th class="tg-19u4 text-center">মৌজা </th>
                                </tr>
                                <tr>
                                    <td class="tg-nluh" id="previewMouja_id"></td>
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
                        <div class="col-lg-6 mb-5"></div>
                        <table class="tg">
                            <thead>
                                <tr>
                                    <th class="tg-19u4 text-center">মন্তব্য</th>
                                </tr>
                                <tr>
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
            //Load First row
            addBadiRowFunc();
            addBibadiRowFunc();
            addFileRowFunc();
            addSurveyRowFunc();

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
        });

        /*********************** Add multiple badi *************************/
        $("#addBadiRow").click(function(e) {
            addBadiRowFunc();
        });

        //add row function
        function addBadiRowFunc(){


            var items = '';
            items+= '<tr>';
            items+= '<td><input type="text" name="badi_name[]" class="form-control form-control-sm" placeholder="" required="required"></td>';
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
            items+= '<td><input type="text" name="bibadi_name[]" class="form-control form-control-sm" placeholder="" required="required"></td>';
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
            items+= '<td><input type="text" name="file_type[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><div class="custom-file"><input type="file" name="file_name[]" onChange="attachmentTitle('+count+')" class="custom-file-input" id="customFile'+count+'" /><label class="custom-file-label custom-input'+count+'" for="customFile'+count+'">ফাইল নির্বাচন করুন</label></div></td>';
           
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeBibadiRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
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
            var items = '';
            items+= '<tr>';
            items+= '<td><select name="st_id[]" class="form-control form-control-sm"><?php echo $survey_data;?></select></td>';
            items+= '<td><input type="text" name="khotian_no[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><input type="text" name="daag_no[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><select name="lt_id[]" class="form-control form-control-sm"><?php echo $land_type_data;?></select></td>';
            items+= '<td><input type="number" name="land_size[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><input type="number" name="land_demand[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeSurveyRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items+= '</tr>';

            $('#surveyDiv tr:last').after(items);
            //scout_id_select2_dd();
        }

        //remove row function
        function removeSurveyRow(id){
            $(id).closest("tr").remove();
        }
    </script>

    <script>

        var numbers = { 0: '০', 1 :'১', 2 :'২', 3 :'৩', 4 :'৪', 5 :'৫', 6 :'৬', 7 :'৭', 8 :'৮',9 :'৯'  };

        function replaceNumbers(input) {
            var output = [];
            for (var i = 0; i < input.length; ++i) {
                if (numbers.hasOwnProperty(input[i])) {
                  output.push(numbers[input[i]]);
              } else {
                  output.push(input[i]);
              }
          }
          return output.join('');
      }

      document.getElementById('r').textContent = replaceNumbers('count');
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
    function attachmentTitle(id){
        var value=$('#customFile'+id).val();
        $('.custom-input'+id).text(value);
    }
</script>
<!--end::Page Scripts-->
@endsection







