@extends('layouts.default')

@section('content')

    @php
    $pass_year_data = '<option value="">-- নির্বাচন করুন --</option>';
    for ($i = 1995; $i <= date('Y'); $i++) {
        $pass_year_data .= '<option value="' . $i . '">' . $i . '</option>';
    }

    $roleID = Auth::user()->role_id;
    $officeInfo = user_office_info();
    @endphp



    <style type="text/css">
        #badiDiv td {
            padding: 5px;
            border-color: #ccc;
        }

        #badiDiv th {
            padding: 5px;
            text-align: center;
            border-color: #ccc;
            color: black;
        }

        #bibadiDiv td {
            padding: 5px;
            border-color: #ccc;
        }

        #bibadiDiv th {
            padding: 5px;
            text-align: center;
            border-color: #ccc;
            color: black;
        }

        #surveyDiv td {
            padding: 5px;
            border-color: #ccc;
        }

        #surveyDiv th {
            padding: 5px;
            text-align: center;
            border-color: #ccc;
            color: black;
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
                <form action="{{ url('rmcase/update/' . $info->id) }}" class="form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="card-body">
                        <fieldset class=" mb-8">
                            <legend>সাধারণ তথ্য</legend>

                            <div class="form-group row">
                                @if ($roleID == 22 || $roleID == 24)
                                    <div class="col-lg-4 mb-5">
                                         <label>বিভাগ <span class="text-danger">*</span></label>
                                           <select name="division" class="form-control form-control-sm">
                                              <option value="">-বিভাগ নির্বাচন করুন-</option>
                                              @foreach ($divisions as $value)
                                              <option value="{{ $value->id }}" {{ $value->id == $info->division_id ? 'selected' : '' }}> {{ $value->division_name_bn }} </option>
                                              @endforeach
                                           </select>
                                     </div>

                                    <div class="col-lg-4 mb-5">
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <div class="form-group mb-2">
                                            <select name="district" id="district_id" class="form-control form-control-sm">
                                                <option value="">-জেলা নির্বাচন করুন-</option>
                                                @foreach ($districts as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ $value->id == $info->district_id ? 'selected' : '' }}>
                                                        {{ $value->district_name_bn }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mb-5">
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="upazila" id="upazila_id" class="form-control form-control-sm">
                                            <option value="">-- নির্বাচন করুন --</option>
                                            @foreach ($upazilas as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $info->upazila_id ? 'selected' : '' }}>
                                                    {{ $value->upazila_name_bn }} </option>
                                            @endforeach
                                        </select>
                                    </div>


                                @elseif($roleID == 5)
                                    <div class="col-lg-4 mb-5">
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="upazila" id="upazila_id" class="form-control form-control-sm">
                                            <option value="">-- নির্বাচন করুন --</option>
                                            @foreach ($upazilas as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $info->upazila_id ? 'selected' : '' }}>
                                                    {{ $value->upazila_name_bn }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <div class="col-lg-4 mb-5">
                                        <label>মৌজা <span class="text-danger">*</span></label>
                                        <select name="mouja" id="mouja_id" class="form-control form-control-sm">
                                            <option value="">-- নির্বাচন করুন --</option>
                                            @foreach ($moujas as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $info->mouja_id ? 'selected' : '' }}>
                                                    {{ $value->mouja_name_bn }} </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                 @else
                                    {{-- <div class="col-lg-4 mb-5">
                                        <label>মৌজা <span class="text-danger">*</span></label>
                                        <select name="mouja" id="mouja_id" class="form-control form-control-sm">
                                            <option value="">-- নির্বাচন করুন --</option>
                                            @foreach ($moujas as $value)
                                            <option value="{{ $value->id }}"{{ $value->id == $info->mouja_id ? 'selected' : '' }}> {{ $value->mouja_name_bn }} </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                @endif
                                <div class="col-lg-4 mb-5">
                                    <label>মামলার ধরণ <span class="text-danger">*</span></label>

                                    <!-- <div class="spinner spinner-primary spinner-left"> -->
                                    <select name="case_type" class="form-control form-control-sm">
                                        <option value="">-- নির্বাচন করুন --</option>
                                        @foreach ($case_types as $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == $info->case_type_id ? 'selected' : '' }}>
                                                {{ $value->type_name }} </option>
                                        @endforeach
                                    </select>
                                    <!-- </div> -->
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <label>মামলা নং <span class="text-danger">*</span></label>
                                    <input type="text" name="case_no" class="form-control form-control-sm"
                                        placeholder="মামলা নং " value="{{ $info->case_no }}">
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <label>পূর্বের মামলা নং </label>
                                    <select class="form-control form-control-sm" id="ref_case_no" name="ref_case_no">
                                      <option value=""> -- নির্বাচন করুন --</option>
                                        @foreach ($old_case_no as $value)
                                            <option value="{{$value->id}}" 
                                                {{ $value->id == $info->rm_case_ref_id ? 'selected' : '' }}> {{ $value->case_no }} </option>
                                        @endforeach
                                      
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <label>মামলা রুজুর তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="case_date"
                                        class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ"
                                        autocomplete="off" value="{{ $info->case_date }}">
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-group row">
                            <div class="col-lg-6 mb-5">
                                <fieldset>
                                    <legend>বাদীর বিবরণ</legend>
                                    <div id="msgBadi"> </div>
                                    <table width="100%" border="1" id="badiDiv" style="border:1px solid #dcd8d8;">
                                        <tr>
                                            <th>বাদীর নাম <span class="text-danger">*</span></th>
                                            <th>পিতা/স্বামীর নাম</th>
                                            <th>ঠিকানা</th>
                                            <th width="50">
                                                <a href="javascript:void();" id="addBadiRow"
                                                    class="btn btn-sm btn-primary font-weight-bolder pr-2"><i
                                                        class="fas fa-plus-circle"></i></a>
                                            </th>
                                        </tr>
                                        @foreach ($badis as $value)
                                            <tr>
                                                <td><input type="text" name="badi_name[]"
                                                        class="form-control form-control-sm" value="{{ $value->name }}"
                                                        placeholder=""></td>
                                                <td><input type="text" name="badi_spouse_name[]"
                                                        class="form-control form-control-sm"
                                                        value="{{ $value->spouse_name }}" placeholder=""></td>
                                                <td><input type="text" name="badi_address[]"
                                                        class="form-control form-control-sm"
                                                        value="{{ $value->address }}" placeholder=""></td>
                                                <td><a href="javascript:void();"
                                                        class="btn btn-sm btn-danger font-weight-bolder pr-2"
                                                        data-id="{{ $value->id }}" onclick="removeRowBadiFunc(this)"> <i
                                                            class="fas fa-minus-circle"></i></a></td>
                                                <input type="hidden" name="hide_badi_id[]" value="{{ $value->id }}">
                                            </tr>
                                        @endforeach
                                    </table>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 mb-5">
                                <fieldset>
                                    <legend>বিবাদীর বিবরণ</legend>
                                    <div id="msgBibadi"> </div>
                                    <table width="100%" border="1" id="bibadiDiv" style="border:1px solid #dcd8d8;">
                                        <tr>
                                            <th>বিবাদীর নাম <span class="text-danger">*</span></th>
                                            <th>পিতা/স্বামীর নাম</th>
                                            <th>ঠিকানা</th>
                                            <th width="50">
                                                <a href="javascript:void();" id="addBibadiRow" class="btn btn-sm btn-primary font-weight-bolder pr-2"><i class="fas fa-plus-circle"></i></a>
                                            </th>
                                        </tr>
                                        @foreach ($bibadis as $value)
                                            <tr>
                                                <td><input type="text" name="bibadi_name[]" value="{{ $value->name }}"
                                                        class="form-control form-control-sm" placeholder=""></td>
                                                <td><input type="text" name="bibadi_spouse_name[]"
                                                        value="{{ $value->spouse_name }}"
                                                        class="form-control form-control-sm" placeholder=""></td>
                                                <td><input type="text" name="bibadi_address[]"
                                                        value="{{ $value->address }}"
                                                        class="form-control form-control-sm" placeholder=""></td>
                                                <td><a href="javascript:void();"
                                                        class="btn btn-sm btn-danger font-weight-bolder pr-2"
                                                        data-id="{{ $value->id }}" onclick="removeRowBibadiFunc(this)">
                                                        <i class="fas fa-minus-circle"></i></a></td>
                                                <input type="hidden" name="hide_bibadi_id[]" value="{{ $value->id }}">
                                            </tr>
                                        @endforeach
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
                                        <label>আরজি </label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" name="show_cause" class="custom-file-input" id="customFile" />
                                            <label class="custom-file-label" for="customFile">ফাইল নির্বাচন করুন</label>
                                        </div>
                                </div>
                                <label>অন্যান্য সংযুক্তির </label>
                                <div id="msgFile"> </div>
                                <table width="100%" border="1" id="fileDiv" style="border:1px solid #dcd8d8;">
                                    <tr>
                                        <th>সংযুক্তির নাম <span class="text-danger">*</span></th>
                                        <th>ফাইল নাম</th>
                                        <th width="50">
                                            <a href="javascript:void();" id="addFileRow" class="btn btn-sm btn-primary font-weight-bolder pr-2"><i class="fas fa-plus-circle"></i></a>
                                        </th>
                                    </tr>
                                    <tr>
                                        @foreach ($files as $value)
                                            <tr>
                                                <td>
                                                    <input type="text" name="file_type[]" value="{{ $value->file_type }}" class="form-control form-control-sm" placeholder="" disabled>
                                                </td>
                                                <td>
                                                    <input type="text" name="file_name[]" value="{{ $value->file_name }}" class="form-control form-control-sm" placeholder=""disabled>
                                                </td>
                                                <td>
                                                    <a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" data-id="{{ $value->id }}" onclick="removeRowFileFunc(this)">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </a>
                                                </td>
                                                <input type="hidden" name="hide_file_id[]" value="{{ $value->id }}">
                                            </tr>
                                        @endforeach
                                    </tr>
                                </table>
                                <input type="hidden" id="other_attachment_count" value="1">
                            </fieldset>
                        </div>
                            <div class="col-lg-5 mb-5">
                                <fieldset>
                                    <legend>মন্তব্য </legend>
                                    <div class="col-lg-12 mb-5">
                                        <label></label>
                                        <textarea name="comments" class="form-control" id="comments" rows="3"
                                            spellcheck="false"
                                            value="{{ $info->comments }}">{{ $info->comments }}</textarea>
                                    </div>
                                </fieldset>
                            </div>
                        </div>


                        <!--  <fieldset class="col-lg-6 mb-6">
                        <legend>কারণ দর্শাইবার স্ক্যান কপি সংযুক্তি</legend>
                        <div class="col-lg-6 mb-5">
                            <div class="form-group">
                                <label></label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" name="show_cause" class="custom-file-input" id="customFile" />
                                    <label class="custom-file-label" for="customFile">ফাইল নির্বাচন করুন</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
     -->
                    </div>
                    <!--end::Card-body-->

                    <!-- <div class="card-footer text-right bg-gray-100 border-top-0">
                        <button type="reset" class="btn btn-primary">সংরক্ষণ করুন</button>
                    </div> -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-primary mr-2">সংরক্ষণ করুন</button>
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

{{-- Scripts Section Related Page --}}
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
        var hostname = window.location.host;
        console.log(hostname);
        jQuery(document).ready(function() {

            addFileRowFunc();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Load First row
            // addBadiRowFunc();
            // addBibadiRowFunc();
            // addSurveyRowFunc();

            // Dynamic Dropdown
            var load_url = "{{ asset('media/custom/preload.gif') }}";

            jQuery('select[name="division"]').on('change', function() {
                var dataID = jQuery(this).val();

                // var category_id = jQuery('#category_id option:selected').val();
                jQuery("#district_id").after('<div class="loadersmall"></div>');
                // $("#loading").html("<img src='{{ asset('media/preload.gif') }}' />");
                // jQuery('select[name="mouja"]').html('<option><div class="loadersmall"></div></option');
                // jQuery('select[name="mouja"]').attr('disabled', 'disabled');
                // jQuery('.loadersmall').remove();

                if (dataID) {
                    jQuery.ajax({
                        url: '{{ url('/') }}/case/dropdownlist/getdependentdistrict/' +
                            dataID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('select[name="district"]').html(
                                '<div class="loadersmall"></div>');
                            //console.log(data);
                            // jQuery('#mouja_id').removeAttr('disabled');
                            // jQuery('#mouja_id option').remove();

                            jQuery('select[name="district"]').html(
                                '<option value="">-- নির্বাচন করুন --</option>');
                            jQuery.each(data, function(key, value) {
                                jQuery('select[name="district"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            jQuery('.loadersmall').remove();
                            // $('select[name="mouja"] .overlay').remove();
                            // $("#loading").hide();
                        }
                    });
                } else {
                    $('select[name="district"]').empty();
                }
            });
            jQuery('select[name="district"]').on('change', function() {
                var dataID = jQuery(this).val();

                // var category_id = jQuery('#category_id option:selected').val();
                jQuery("#upazila_id").after('<div class="loadersmall"></div>');
                // $("#loading").html("<img src='{{ asset('media/preload.gif') }}' />");
                // jQuery('select[name="mouja"]').html('<option><div class="loadersmall"></div></option');
                // jQuery('select[name="mouja"]').attr('disabled', 'disabled');
                // jQuery('.loadersmall').remove();

                if (dataID) {
                    jQuery.ajax({
                        url: '{{ url('/') }}/case/dropdownlist/getdependentupazila/' + dataID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('select[name="upazila"]').html(
                                '<div class="loadersmall"></div>');
                            //console.log(data);
                            // jQuery('#mouja_id').removeAttr('disabled');
                            // jQuery('#mouja_id option').remove();

                            jQuery('select[name="upazila"]').html(
                                '<option value="">-- নির্বাচন করুন --</option>');
                            jQuery.each(data, function(key, value) {
                                jQuery('select[name="upazila"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            jQuery('.loadersmall').remove();
                            // $('select[name="mouja"] .overlay').remove();
                            // $("#loading").hide();
                        }
                    });
                } else {
                    $('select[name="upazila"]').empty();
                }
            });

            jQuery('select[name="upazila"]').on('change', function() {
                var dataID = jQuery(this).val();

                // var category_id = jQuery('#category_id option:selected').val();
                jQuery("#mouja_id").after('<div class="loadersmall"></div>');
                // $("#loading").html("<img src='{{ asset('media/preload.gif') }}' />");
                // jQuery('select[name="mouja"]').html('<option><div class="loadersmall"></div></option');
                // jQuery('select[name="mouja"]').attr('disabled', 'disabled');
                // jQuery('.loadersmall').remove();

                if (dataID) {
                    jQuery.ajax({
                        url: '{{ url('/') }}/case/dropdownlist/getdependentmouja/' + dataID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('select[name="mouja"]').html(
                                '<div class="loadersmall"></div>');
                            //console.log(data);
                            // jQuery('#mouja_id').removeAttr('disabled');
                            // jQuery('#mouja_id option').remove();

                            jQuery('select[name="mouja"]').html(
                                '<option value="">-- নির্বাচন করুন --</option>');
                            jQuery.each(data, function(key, value) {
                                jQuery('select[name="mouja"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            jQuery('.loadersmall').remove();
                            // $('select[name="mouja"] .overlay').remove();
                            // $("#loading").hide();
                        }
                    });
                } else {
                    $('select[name="mouja"]').empty();
                }
            });
        });

        /*********************** Add multiple badi *************************/
        $("#addBadiRow").click(function(e) {
            addBadiRowFunc();
        });

        //add row function
        function addBadiRowFunc() {
            var items = '';
            items += '<tr>';
            items += '<td><input type="text" name="badi_name[]" class="form-control form-control-sm" placeholder=""></td>';
            items +=
                '<td><input type="text" name="badi_spouse_name[]" class="form-control form-control-sm" placeholder=""></td>';
            items +=
                '<td><input type="text" name="badi_address[]" class="form-control form-control-sm" placeholder=""></td>';
            items +=
                '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeBadiRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items += '<input type="hidden" name="hide_badi_id[]">';
            items += '</tr>';

            $('#badiDiv tr:last').after(items);
            //scout_id_select2_dd();
        }

        //remove row
        function removeBadiRow(id) {
            $(id).closest("tr").remove();
        }

        function removeRowBadiFunc(id) {
            var dataId = $(id).attr("data-id");
            // dd($id);
            // alert(dataId);

            if (confirm("Are you sure you want to delete this information from database?") == true) {
                $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/rmcase/ajax_badi_del/" + dataId,
                    success: function(response) {
                        $("#msgBadi").addClass('alert alert-success').html(response);
                        $(id).closest("tr").remove();
                    }
                });
            }
        }


        /************************ Add multiple bibadi *************************/
        $("#addBibadiRow").click(function(e) {
            addBibadiRowFunc();
        });

        //add row function
        function addBibadiRowFunc() {
            var items = '';
            items += '<tr>';
            items +=
            '<td><input type="text" name="bibadi_name[]" class="form-control form-control-sm" placeholder=""></td>';
            items +=
                '<td><input type="text" name="bibadi_spouse_name[]" class="form-control form-control-sm" placeholder=""></td>';
            items +=
                '<td><input type="text" name="bibadi_address[]" class="form-control form-control-sm" placeholder=""></td>';
            items +=
                '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeBibadiRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items += '<input type="hidden" name="hide_bibadi_id[]">';
            items += '</tr>';

            $('#bibadiDiv tr:last').after(items);
            //scout_id_select2_dd();
        }

        //remove row function
        function removeBibadiRow(id) {
            $(id).closest("tr").remove();
        }

        function removeRowBibadiFunc(id) {
            var dataId = $(id).attr("data-id");
            // alert(dataId);

            if (confirm("Are you sure you want to delete this information from database?") == true) {
                $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/rmcase/ajax_bibadi_del/" + dataId,
                    success: function(response) {
                        $("#msgBibadi").addClass('alert alert-success').html(response);
                        $(id).closest("tr").remove();
                    }
                });
            }
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
            items += '<input type="hidden" name="hide_file_id[]">';
            items+= '</tr>';

            $('#fileDiv tr:last').after(items);
            //scout_id_select2_dd();

        }

        //remove row function
        function removeFileRow(id){
            $(id).closest("tr").remove();
        }

        function removeRowFileFunc(id) {
            var dataId = $(id).attr("data-id");
            // alert(dataId);

            if (confirm("Are you sure you want to delete this information from database?") == true) {
                $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/rmcase/ajax_file_del/" + dataId,
                    success: function(response) {
                        $("#msgFile").addClass('alert alert-success').html(response);
                        $(id).closest("tr").remove();
                    }
                });
            }
        }



        /************************ Add multiple Survey *************************/
        $("#addSurveyRow").click(function(e) {
            addSurveyRowFunc();
        });

        //add row function
        /**/

        //remove row function
        function removeSurveyRow(id) {
            $(id).closest("tr").remove();
        }

        function removeRowSurveyFunc(id) {
            var dataId = $(id).attr("data-id");
            // alert(dataId);

            if (confirm("Are you sure you want to delete this information from database?") == true) {
                $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/case/ajax_survey_del/" + dataId,
                    success: function(response) {
                        $("#msgSurvey").addClass('alert alert-success').html(response);
                        $(id).closest("tr").remove();
                    }
                });
            }
        }
    </script>
    <script type="text/javascript">
        function attachmentTitle(id){
            var value=$('#customFile'+id).val();
            $('.custom-input'+id).text(value);
        }
    </script>

    <!--end::Page Scripts-->
@endsection
