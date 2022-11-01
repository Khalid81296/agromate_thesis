<?php
$roleID = Auth::user()->role_id;
$officeInfo = user_office_info();
?>

@php 
if(isset($_GET['division']))
{
    $selected_division=$_GET['division'];
}
else {
    $selected_division=' ';
}
if(isset($_GET['role']))
{
    $selected_role=$_GET['role'];
}
else {
    $selected_role=' ';
}

@endphp
@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 )
  <form class="form-inline" method="GET">
     <div class="container">
        <div class="row">
           <div class="col-lg-4">
              <div class="form-group mb-2">
                 <select name="division" id="division_id"class="form-control w-100">
                    <option value="">-বিভাগ নির্বাচন করুন-</option>
                    @foreach ($divisions as $value)
                    <option value="{{ $value->id }}" {{ $value->id == (isset($_GET['division'])?$_GET['division']:'') ? "selected" : ''}}> {{ $value->division_name_bn }} </option>
                    @endforeach
                 </select>
              </div>
           </div>
           <div class="col-lg-4">
              <div class="form-group mb-2">
                 <select name="district" id="district_id" class="form-control w-100">
                    <option value="">-জেলা নির্বাচন করুন-</option>
                 </select>
              </div>
           </div>
           <div class="col-lg-4 mb-2">
              <select name="upazila" id="upazila_id" class="form-control w-100">
                 <option value="">-উপজেলা নির্বাচন করুন-</option>
              </select>
           </div>
        </div>
        <div class="row">
           <div class="col-lg-4 mb-2">
              <select name="office" id="office_id" class="form-control form-control w-100">
                 <option value=''>-অফিস নির্বাচন করুন-</option>
                 
              </select>
           </div>
           <div class="col-lg-4">
              <div class="form-group mb-2">
                 <select name="role" class="form-control w-100">
                    <option value=''>-ইউজার রোল নির্বাচন করুন-</option>
                    @foreach ($user_role as $value)
                    <option value="{{ $value->id }}" {{ $value->id == (isset($_GET['role'])?$_GET['role']:'') ? "selected" : ''}}> {{ $value->role_name }} </option>
                    @endforeach
                 </select>
              </div>
           </div>
           <div class="col-lg-4">
              <div class="form-group mb-2">
                 <button type="submit" class="btn btn-success font-weight-bolder mb-2 ml-2" >অনুসন্ধান করুন</button>
              </div>
           </div>
        </div>
        </div>
     </div>
  </form>
@else
  <form class="form-inline" method="GET">
     <div class="container">
           
        <div class="row">
           <div class="col-lg-4 mb-2">
              <select name="office" class="form-control form-control w-100">
                 <option value=''>-অফিস নির্বাচন করুন-</option>
                    @foreach ($user_office as $value)
                      <option value="{{ $value->id }}" > {{ $value->office_name_bn }} </option>
                    @endforeach
              </select>
           </div>
           <div class="col-lg-4">
              <div class="form-group mb-2">
                 <select name="role" class="form-control w-100">
                    <option value=''>-ইউজার রোল নির্বাচন করুন-</option>
                    @foreach ($user_role as $value)
                    <option value="{{ $value->id }}" {{ $value->id == (isset($_GET['role'])?$_GET['role']:'') ? "selected" : ''}}> {{ $value->role_name }} </option>
                    @endforeach
                 </select>
              </div>
           </div>
           <div class="col-lg-4">
              <div class="form-group mb-2">
                 <button type="submit" class="btn btn-success font-weight-bolder mb-2 ml-2" >অনুসন্ধান করুন</button>
              </div>
           </div>
        </div>
        </div>
     </div>
  </form>
@endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
  integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer">
    
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
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



               



                if (typeof upID !== "undefined") {
                  // alert(upID);
                    jQuery.ajax({
                        url: '{{ url('/') }}/case/dropdownlist/getdependentupazilaoffice/' +
                        upID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                          jQuery('select[name="office"]').empty();
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

                }else if(typeof disID !== "undefined") {
                  
                    jQuery.ajax({
                        url: '{{ url('/') }}/case/dropdownlist/getdependentdistrictoffice/' +
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

                }else {
                    $('select[name="office"]').empty();
                }



            })
        </script>
    @endif
@endsection
