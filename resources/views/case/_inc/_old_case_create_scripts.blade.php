@extends('layouts.default')




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
        }
    </script>
   

  

<!--end::Page Scripts-->
@endsection







