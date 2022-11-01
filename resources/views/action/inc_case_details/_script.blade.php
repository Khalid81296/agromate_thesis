<script type="text/javascript">


    $(document).ready(function() {
        var SITEURL = "{{ URL('/') }}";

        addSfFileRowFunc();

        /*$("#status_id").click(function(){
            case_status_dd();
        });*/
        // By Default Load Case Status checked User Role Foward ID
        case_status_dd();

        // On Change Load Case Status checked User Role Foward ID
        jQuery('input[type=radio][name=group]').on('change',function(){
            case_status_dd();
        });


        // Case Hearing Data and File Progress Bar
        $('#ajax-hearing-file-upload').submit(function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: "{{ url('action/file_store_hearing') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSubmit: function() {
                    
                    $(".progress-bar").width('0%');
                    $("#uploadStatus").html('Uploading FILE');
                },
                success: (data) => {
                    this.reset();
                    
                    $('#hearingAddSuccess').show();
                    // window.location.href = SITEURL +"/action/details/"+"10";
                    console.log(data);
                    console.log(data.html);
                    $('.ajax').remove();
                    $('#caseHearingList').empty();
                    $('#caseHearingList').append('<label class="ajax" style="display:block !important;">' + data.html + '</label>')
                },
                
                error: function(data) {
                    // $("#uploadStatus").html('<p>File upload fail! Please try again</p>');
                    console.log(data);
                }
            });
        });

        // Case Hearing Result Update & File Progress Bar
        $('body').on('submit','#hearing_result_upload', function(e) {
        // $('#hearing_result_upload').submit(function(e) {
            e.preventDefault();
            $("#subLoader").addClass('spinner spinner-white spinner-right disabled');

            var formData = new FormData(this);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: "{{ url('action/hearing_result_upload') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSubmit: function() {
                    $(".progress-bar").width('0%');
                    $("#uploadStatus").html('Uploading FILE');
                },
                success: (data) => {
                     this.reset();
                      // $(this).modal('show'); 
                    
                    $('#hearingAddSuccess').show();
                    // window.location.href = SITEURL +"/action/details/"+"10";
                    console.log(data);
                    console.log(data.html);
                    $('.ajax').remove();
                    $(".modal-backdrop").remove();
                    $('#caseHearingList').empty();
                    $('#caseHearingList').append('<label class="ajax" style="display:block !important;">' + data.html + '</label>')
                },
                error: function(data) {
                    // setTimeout(function (){
                    // $("#uploadStatus").html('<p>File upload fail! Please try again</p>');
                    console.log(data);
                    // $('.alert-danger').html('');
                    $.each(data.responseJSON.errors, function(key, value) {
                        console.log(value);
                        toastr.error(value, "Error");
                    });
                    $("#subLoader").removeClass('spinner spinner-white spinner-right disabled');
                    // }, 5000);

                }
            });
        });

        // Case Taken Action After Result Update & Progress Bar
        $('body').on('submit','#action_taken_after_result', function(e) {
        // $('#hearing_result_upload').submit(function(e) {
            e.preventDefault();
            $("#subLoader").addClass('spinner spinner-white spinner-right disabled');

            var formData = new FormData(this);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: "{{ url('action/action_taken_after_result') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSubmit: function() {
                    $(".progress-bar").width('0%');
                    $("#uploadStatus").html('Uploading FILE');
                },
                success: (data) => {
                     this.reset();
                      // $(this).modal('show'); 
                    
                    $('#hearingAddSuccess').show();
                    // window.location.href = SITEURL +"/action/details/"+"10";
                    console.log(data);
                    console.log(data.html);
                    $('.ajax').remove();
                    $(".modal-backdrop").remove();
                    $('#resultActionSuccess').show();
                    $('#resultUpdateSuccess').show();
                    $('#caseResultUpdate').empty();
                    $('#caseResultUpdate').append(data.html);
                    // location.reload();
                },
                error: function(data) {
                    // setTimeout(function (){
                    // $("#uploadStatus").html('<p>File upload fail! Please try again</p>');
                    console.log(data);
                    // $('.alert-danger').html('');
                    $.each(data.responseJSON.errors, function(key, value) {
                        console.log(value);
                        toastr.error(value, "Error");
                    });
                    $("#subLoader").removeClass('spinner spinner-white spinner-right disabled');
                    // }, 5000);

                }
            });
        });

        // Case SF Report Progress Bar
        $('#ajax-file-upload').submit(function(e) {
            e.preventDefault();
            // var bar = $('#bar');
            // var percent = $('#percent');
            var formData = new FormData(this);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: "{{ url('action/file_store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSubmit: function() {
                    // document.getElementById("progress_div").style.display="block";
                    // var percentVal = '0%';
                    // bar.width(percentVal);
                    // percent.html(percentVal);
                    $(".progress-bar").width('0%');
                    $("#uploadStatus").html('Uploading FILE');
                },
                /*uploadProgress: function(event, position, total, percentComplete) {
                   var percentVal = percentComplete + '%';
                   bar.width(percentVal);
                   percent.html(percentVal);
                },*/
                success: (data) => {
                    console.log(data);
                    this.reset();
                    // alert('File has been uploaded successfully');
                    // var percentVal = '100%';
                    // bar.width(percentVal);
                    // percent.html(percentVal);
                    $('#sfReportUploadSuccess').show();
                    $('.ajax').remove();
                    $('#hide_old_finalSF').remove();
                    $('.hide_old_finalSF').remove();
                    $('#sfInstantView').empty();
                    $('#customFile').val(null);
                    $('#sfInstantView').empty();
                    $('#sfInstantView').append( '<label class=".ajax" style="display:block !important;">' + data.html + '</label>');
                    // window.location.href = SITEURL +"/action/details/"+"10";
                    console.log(data);
                    console.log(data.html);

                },
                /*complete: function(xhr) {
                   alert('File Has Been Uploaded Successfully');
                   // window.location.href = SITEURL +"/"+"ajax-file-upload-progress-bar";
                   // if(xhr.responseText){
                   //   document.getElementById("output_image").innerHTML=xhr.responseText;
                   // }
                },*/
                error: function(data) {
                    $("#uploadStatus").html('<p>File upload fail! Please try again</p>');
                    console.log(data);
                }
            });
        });


        // Case result file upload Progress Bar
        $("#resultUpSuccess").hide();
        $('#ajax-caseResult-upload').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: "{{ url('/action/result_update') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSubmit: function() {
                    // document.getElementById("progress_div").style.display="block";
                    // var percentVal = '0%';
                    // bar.width(percentVal);
                    // percent.html(percentVal);
                    $(".progress-bar").width('0%');
                    $("#uploadStatus").html('Uploading FILE');
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        // result.sfdata
                        $('.alert-danger').hide();
                        $('#result_update_content').hide();
                        $('#haventResult').hide();
                        $('#resultUpSuccess').show();
                        $('#resultUpdateSuccess').show();
                        $('#caseResultUpdate').empty();
                        $('#caseResultUpdate').append(result.html);
                        location.reload();
                        console.log(result.html)
                        // $('#sf_docs').hide(1000);
                    }
                }
            });
        });
        //============High Court JS=================//

        $("#highCourtDiv").hide();
        $("#yes").click(function() {
            $("#highCourtDiv").show();
        });

        $("#no").click(function() {
            $("#highCourtDiv").hide();
        });

        /* $("#solicitorDiv").hide();
          $(document).ready(function(){
             $("#court_name").change(function(){
                var court_id = document.getElementById("court_name").value;
                if(court_id == 1 || court_id == 2)
                   $("#solicitorDiv").show();
                else
                   $("#solicitorDiv").hide();
               // alert("The text has been changed.");
             });
          });*/

        //============//High Court JS=================//

        //============Lost Reason=================//

        $("#lostReason").hide();
        $("#lost").click(function() {
            $("#lostReason").show();
        });

        $("#win").click(function() {
            $("#lostReason").hide();
        });

        //============//Lost Reason=================//
        // Case SF Report Progress Bar
        /*var bar = $('.bar');
        var percent = $('.percent');
        $('form').ajaxForm({
           beforeSend: function() {
              var percentVal = '0%';
              bar.width(percentVal)
              percent.html(percentVal);
           },
           uploadProgress: function(event, position, total, percentComplete) {
              var percentVal = percentComplete + '%';
              bar.width(percentVal)
              percent.html(percentVal);
           },
           complete: function(xhr) {
              alert('File Has Been Uploaded Successfully');
              // window.location.href = SITEURL +"/"+"ajax-file-upload-progress-bar";
           }
        });*/

        // Case forwared to other by popup modal
        $('#formSubmit').click(function(e) {
            var radioValue = $("input[name='group']:checked").val();
            // alert(radioValue);
            e.preventDefault();

            $.ajax({
                url: "{{ url('/action/forward') }}",
                method: 'post',
                data: {
                    case_id: $('#hide_case_id').val(),
                    group: radioValue,
                    status_id: $('#status_id').val(),
                    comment: $('#comment').val()
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('#caseForwardModal').modal('hide');
                        $('#forwardSuccess').show();
                        $('#forwardButton').hide();
                    }
                }
            });
        });

        // Create for new sf document hide create button
        $('#sf_create').click(function() {
            $('#sf_content').show();
            // $('#sf_notice').hide(1000);
            $('#sf_create_button').hide(1000);
        });

        // Close for new sf document hide create button
        $('#Closesf_create').click(function() {
            $('#sf_content').hide(1000);
            // $('#sf_notice').hide(1000);
            $('#sf_create_button').show(1000);
        });

        // Submit SF answer by ULAO
        $(document).off('submit', '#sfCreateForm');
        $(document).on('submit', '#sfCreateForm', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ url('/action/createsf') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                   
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        // result.sfdata
                        $('.alert-danger').hide();
                        $('#sf_content').hide();
                        $('#sfCreateSuccess').show();
                        $('#noSfCreate').hide();
                        $('#returnSfdetail').append(result.html);

                        console.log(result.html);
                    }
                }
            });
        });

        // Click edit button hide sf document and show edit form
        $('#sf_edit_button').click(function() {
            $('#sf_edit_content').show();
            $('#sf_docs').hide(1000);
            // $('#sf_edit_button').hide(1000);
        });

        // Click close edit button hide sf document and show edit form
        $('#closesf_edit_button').click(function() {
            $('#sf_edit_content').hide(1000);
            $('#sf_docs').show(1000);
            // $('#sf_edit_button').hide(1000);
        });

        // Edit Submit SF answer by AC (Land), ULAO, Kanango, Survayer
        /*$('#sfUpdateSubmit').click(function(e) {
            // var radioValue = $("input[name='group']:checked").val();
            // alert($('#hide_case_id').val());
            // var id = $('#hide_case_id').val();
            e.preventDefault();

            $.ajax({
                url: "{{ url('/action/editsf') }}",
                method: 'post',
                data: {
                    case_id: $('#hide_case_id').val(),
                    sf_id: $('#hide_sf_id').val(),
                    sf_details: $('#sf_details').val()
                },*/

        $(document).off('submit', '#sfUpdateForm');
        $(document).on('submit', '#sfUpdateForm', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ url('/action/editsf') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                success: function(result) {
                    console.log(result);
                    if (result.errors) {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        // result.sfdata
                        $('location').reload();
                        $('.alert-danger').hide();
                        $('#sf_edit_content').hide();
                        $('#sfEditSuccess').show();
                        $('#sf_docs').hide(1000);
                        $('.ajax').remove();
                        $('#returnSfdetail').append( '<label class="ajax" style="display: block !important;">' + result.html + '</label>');

                    }
                }
            });
        });

        //============//Hearing add=================//
        // Click hearing add button hide alert box
        $('#hearing_add_button').click(function() {
            $('#hearing_add_content').show();
            $('#hearing_content').hide(1000);
            $('#hearing_add_button').hide(1000);
        });
        $('#hearing_add_button_close').click(function() {
            $('#hearing_add_button').show();
            $('#hearing_content').show(1000);
            $('#hearing_add_content').hide(1000);
            // $('#hearing_add_button_close').hide(1000);
        });

        // Hearing Upload
        // $('#hearingSubmit').click(function(e) {
        $('#hearingSubmit').submit(function(e) {
            e.preventDefault();
            // alert('ok');

            // var form_Data = new FormData();
            var formData = new FormData(this);
            // alert(formData);

            $.ajax({
                url: "{{ url('/action/hearingadd') }}",
                method: 'POST',
                data: formData,
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        // result.sfdata
                        $('.alert-danger').hide();
                        $('#hearing_add_content').hide();
                        $('#hearingAddSuccess').show();
                        // $('#sf_docs').hide(1000);
                    }
                },

            });
        });

        <?php
     if($info->is_win != 0){
        ?>
        $('#result_update_content').hide();
        <?php
     }
     ?>


        // Update Case Result by GP
        $('#resultSubmit').click(function(e) {
            var radioValueIsWin = $("input[name='is_win']:checked").val();
            var radioValueLosrAppeal = $("input[name='is_lost_appeal']:checked").val();
            var radioValueInGovtFav = $("input[name='in_favour_govt']:checked").val();

            // var id = $('#hide_case_id').val();
            e.preventDefault();

            $.ajax({
                method: 'post',
                url: "{{ url('/action/result_update') }}",
                data: {
                    case_id: $('#hide_case_id').val(),
                    lost_reason: $('#lost_reason').val(),
                    court_name: $('#court_name').val(),
                    condition_name: $('#condition_name').val(),
                    is_win: radioValueIsWin,
                    is_lost_appeal: radioValueLosrAppeal,
                    in_favour_govt: radioValueInGovtFav
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        // result.sfdata
                        $('.alert-danger').hide();
                        $('#result_update_content').hide();
                        $('#resultUpdateSuccess').show();
                        // $('#sf_docs').hide(1000);
                    }
                }
            });
        });




        /*
        // Case Status Forwared 
        $('input[type=radio][name=group]').change(function(e) {

            e.preventDefault();
            var roleID =this.value;
             $.ajax({

                url: '{{ url("/")}}/action/getDependentCaseStatus/' + roleID,
                type : "GET",
                dataType : "json", 
                  success: function(result) {
                    if (result.errors) {
                        console.log(result.errors);
                    } else {
                        console.log(result.success);
                        console.log(result.case_status);
                        $('#status_id').empty();

                        jQuery.each(result.case_status, function(key,value){
                            $('#status_id').append('<option value="'+ value.id +'">'+ value.status_name +'</option>');
                        });

                    }
                }
            });

        });
        */

         $('select[name="status_id"]').change(function(e) {

            e.preventDefault();
            var roleID =$('input[type=radio][name=group]:checked').val();
             $.ajax({

                url: '{{ url("/")}}/action/getDependentCaseStatusCivilsuit/' + roleID,
                type : "GET",
                dataType : "json", 
                  success: function(result) {
                    if (result.errors) {
                        console.log(result.errors);
                        /*$('.alert-danger').html('');
*/
                        /*$.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });*/
                    
                    } else {
                        console.log(result.success);
                        console.log(result.case_status);
                        // $('#status_id').empty();

                        jQuery.each(result.case_status, function(key,value){
                            // $('select[name="status_id"]').val();
                            var status_id = $('select[name="status_id"]').val();
                            if(status_id == value.id){
                                console.log(value.id);
                                $('#changeRemarks').empty();
                                $('#changeRemarks').append('<label class="text-primary font-size-h4">মন্তব্য প্রদান করুন <span class="text-danger">*</span> </label> <textarea name="comment" id="comment" class="form-control form-control-solid" rows="7" style="border: 1px solid #ccc;">'+value.status_templete+'</textarea>');
                            }
                        });

                      
                    }
                }
            });
            
        });

    });

    // common datepicker
    $('.common_datepicker').datepicker({
        format: "dd/mm/yyyy",
        todayHighlight: true,
        orientation: "bottom left"
    });


    function case_status_dd(){
    // alert(1);
    // =========== Case Status ================//
    // jQuery('input[type=radio][name=group]').on('change',function(){
        var roleID = jQuery('input[type=radio][name=group]:checked').val();
        // var roleID = jQuery(this).val();
        // alert(roleID);

        jQuery("#status_id").after('<div class="loadersmall"></div>');

        if(roleID)
        {
          jQuery.ajax({
            url: '{{ url("/")}}/action/getDependentCaseStatusCivilsuit/' + roleID,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                jQuery('select[name="status_id"]').html('<div class="loadersmall"></div>');
                //console.log(data);
                // jQuery('#mouja_id').removeAttr('disabled');
                // jQuery('#mouja_id option').remove();

                jQuery('select[name="status_id"]').html('<option value="">-- নির্বাচন করুন --</option>');
                jQuery.each(data.case_status, function(key,value){
                    jQuery('select[name="status_id"]').append('<option value="'+ value.id +'">'+ value.status_name +'</option>');
                });
                jQuery('.loadersmall').remove();
                // $('select[name="mouja"] .overlay').remove();
                // $("#loading").hide();
            }
        });
      }
      else
      {
          $('select[name="status_id"]').empty();
      }
    // });
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
            items+= '<td><input type="text" name="file_type[]" id="file_type[]" class="form-control form-control-sm" placeholder=""></td>';
            items+= '<td><div class="custom-file"><input type="file" name="sf_file_name[]"  onChange="attachmentTitle('+count+')" class="custom-file-input" id="customFile'+count+'" /><label class="custom-file-label custom-input'+count+'" for="customFile'+count+'">ফাইল নির্বাচন করুন</label></div></td>';
           
            items+= '<td><a href="javascript:void();" class="btn btn-sm btn-danger font-weight-bolder pr-2" onclick="removeFileRow(this)"> <i class="fas fa-minus-circle"></i></a></td>';
            items+= '</tr>';

            $('#sfFileDiv tr:last').after(items);
            //scout_id_select2_dd();

        }

        //remove row function
        function removeFileRow(id){
            $(id).closest("tr").remove();
        }


    /*
    // Class definition
    var KTCkeditor = function () {
        // Private functions
        var demos = function () {
           ClassicEditor
           .create( document.querySelector( '.kt-ckeditor-1' ) )
           .then( editor => {
            console.log( editor );
         } )
           .catch( error => {
            console.error( error );
         } );
        }

        return {
            // public functions
            init: function() {
             demos();
          }
       };
    }();*/

    // Initialization
    jQuery(document).ready(function() {
        //KTCkeditor.init();
    });
</script>
<script type="text/javascript">
    function attachmentTitle(id) {
        // var value = $('#customFile' + id).val();
        var value = $('#customFile' + id)[0].files[0];
        // console.log(value['name']);
        $('.custom-input' + id).text(value['name']);
    }
</script>
