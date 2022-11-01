@extends('layouts.app')
@section('styles')
    <link href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/brand/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/aside/light.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}"/>
    <style>
        .carousel-item img {
            max-height: auto !important;
        }

         @font-face {
            font-family: 'Kalpurush';
            src: url('../fonts/Kalpurush.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
         }
         @font-face {
            font-family: 'Nikosh';
            src: url('../fonts/Nikosh.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
         }
         body, html {
            font-family: 'Kalpurush', Poppins, Helvetica, sans-serif;
         }
    </style>
    <style type="text/css">
       .tg {border-collapse:collapse;border-spacing:0;width: 100%;}
       .tg td{border-color:black;border-style:solid;border-width:1px;font-size:14px;overflow:hidden;padding:6px 5px;word-break:normal;}
       .tg th{border-color:black;border-style:solid;border-width:1px;font-size:14px;font-weight:normal;overflow:hidden;padding:6px 5px;word-break:normal;}
       .tg .tg-nluh{background-color:#dae8fc;border-color:#cbcefb;text-align:left;vertical-align:top}
       .tg .tg-19u4{background-color:#ecf4ff;border-color:#cbcefb;font-weight:bold;text-align:right;vertical-align:top}
    </style>
@endsection
@section('content')
<div class="container" style="background-color:rgba(192,192,192,0.3);">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('media/banner/01.jpg') }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            {{-- <h5>Minar khan</h5>
                            <p>.Khalid mia.</p> --}}
                        </div>
                    </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('media/banner/02.jpg') }}" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">
                            {{-- <h5>Minar khan</h5>
                            <p>.Khalid mia.</p> --}}
                        </div>
                    </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('media/banner/03.jpg') }}" alt="Third slide">
                        <div class="carousel-caption d-none d-md-block">
                            {{-- <h5>Minar khan</h5>
                            <p>.Khalid mia.</p> --}}
                        </div>
                    </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-1">
              <p class="btn btn-secondary" type="text">নোটিশ:</p>
            </div>
            <div class="col-md-11">
                <marquee style="font-size: 18px" direction="left" scrollamount="3" onmouseover="this.stop()" onmouseout="this.start()">ভূমি রাজস্ব মামলা ম্যানেজমেন্ট সিষ্টেমে আপনাকে স্বাগতম। ভূমি সংক্রান্ত অন্যান্য তথ্য নিতে <a href="https://land.gov.bd/" target="_blank">land.gov.bd</a> লিংকে ক্লিক করুন।
                </marquee>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-8">
            <div class="card">
               <div class="card card-custom">

                   <div class="card-body">
                      @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                         {{ $message }}
                      </div>
                      @endif

                      <div class="row">
                         <div class="col-md-6">
                            <h4 class="font-weight-bolder">সাধারণ তথ্য</h4>
                            <table class="tg">
                               <thead>
                                  <tr>
                                     <th class="tg-19u4" width="130">বিভাগ</th>
                                     <td class="tg-nluh">{{ $info->division->division_name_bn ?? ''}}</td>
                                  </tr>
                                  <tr>
                                     <th class="tg-19u4">জেলা</th>
                                     <td class="tg-nluh">{{ $info->district->district_name_bn ?? ''}}</td>
                                  </tr>
                                  <tr>
                                     <th class="tg-19u4">মামলা নং</th>
                                     <td class="tg-nluh">{{ $info->case_no ?? ''}}</td>
                                  </tr>
                                  <tr>
                                     <th class="tg-19u4">মামলা রুজুর তারিখ</th>
                                     <td class="tg-nluh">{{ en2bn($info->case_date) ?? ''}}</td>
                                  </tr>


                                  <tr>
                                     <th class="tg-19u4">ফলাফল</th>
                                        <td class="tg-nluh">
                                            {{ $info->case_result ?? 'চলমান' }}
                                            {{-- @if($info->case_result == '1')
                                            জয়!
                                            @elseif($info->case_result == '0')
                                            পরাজয়!
                                            @else
                                            চলমান
                                            @endif --}}
                                        </td>
                                     {{-- @dd($info->case_result) --}}
                                  </tr>
                                  @if (!empty($info->lost_reason))
                                  <tr>
                                     <th class="tg-19u4">পরাজয়ের কারণ</th>
                                     <td class="tg-nluh">{{ $info->lost_reason ?? ''}}</td>
                                  </tr>
                                  @endif
                                  <tr>
                                     <th class="tg-19u4">মামলায় হেরে গিয়ে কি আপিল করা হয়েছে</th>
                                     <td class="tg-nluh">@if ($info->is_lost_appeal == 1)
                                                              হ্যা!
                                                          @else
                                                              না!
                                                          @endif
                                     </td>
                                  </tr>
                                  @if(!empty( $info->rm_case_ref_id))
                                  <tr>
                                     <th class="tg-19u4">পূর্বের মামলা নং</th>
                                     <td class="tg-nluh"><a href="{{ route('rmcase.show', $info->rm_case_ref_id) }}" target="_blank">{{ $info->ref_rm_case_no }}</a> </td>
                                  </tr>
                                  @endif
                                  @if(!empty( $info->status))
                                  <tr>
                                     <th class="tg-19u4">মামলার বর্তমান অবস্থান</th>
                                     <td class="tg-nluh">{{ $info->case_status->status_name }}</td>
                                  </tr>
                                  @endif
                                  <tr>
                                     <th class="tg-19u4">মন্তব্য</th>
                                     <td class="tg-nluh">{{ $info->comments }}</td>
                                  </tr>
                                  <tr>
                                     <th class="tg-19u4">বর্তমান ষ্ট্যাটাস</th>
                                     <td class="tg-nluh"> @if ($info->status == 1)
                                                              নতুন চলমান!
                                                          @elseif ($info->status == 2)
                                                              আপিল করা হয়েছে!
                                                          @elseif ($info->status == 3)
                                                              সম্পাদিত !
                                                          @endif

                                     </td>
                                  </tr>
                               </thead>
                            </table>
                             <br>


                      </div>
                      <div class="col-md-6">
                            <h4 class="font-weight-bolder">বাদীর বিবরণ</h4>
                            <table class="tg">
                               <thead>
                                  <tr>
                                     <th class="tg-19u4" width="10">ক্রম</th>
                                     <th class="tg-19u4 text-center" width="200">নাম</th>
                                     <th class="tg-19u4 text-center">পিতা/স্বামীর নাম</th>
                                     <th class="tg-19u4 text-center">ঠিকানা</th>
                                  </tr>
                               </thead>
                               <tbody>
                              @php $k = 1; @endphp
                         @foreach ($badis as $badi)
                            <tr>
                               <td class="tg-nluh">{{en2bn($k)}}.</td>
                               <td class="tg-nluh">{{ $badi->name }}</td>
                               <td class="tg-nluh">{{ $badi->spouse_name }}</td>
                               <td class="tg-nluh">{{ $badi->address }}</td>
                            </tr>
                         @php $k++; @endphp
                         @endforeach
                               </tbody>
                            </table>


                            <br>
                            <h4 class="font-weight-bolder">বিবাদীর বিবরণ</h4>
                            <table class="tg">
                               <thead>
                                  <tr>
                                     <th class="tg-19u4" width="10">ক্রম</th>
                                     <th class="tg-19u4 text-center" width="200">নাম</th>
                                     <th class="tg-19u4 text-center">পিতা/স্বামীর নাম</th>
                                     <th class="tg-19u4 text-center">ঠিকানা</th>
                                  </tr>
                               </thead>
                               <tbody>
                            @php $k = 1; @endphp
                            @foreach ($bibadis as $bibadi)

                                  <tr>
                                     <td class="tg-nluh">{{ en2bn($k) }}.</td>
                                     <td class="tg-nluh">{{ $bibadi->name }}</td>
                                     <td class="tg-nluh">{{ $bibadi->spouse_name }}</td>
                                     <td class="tg-nluh">{{ $bibadi->address }}</td>
                                  </tr>
                             @php $k++; @endphp
                            @endforeach
                               </tbody>
                            </table>


                      </div>
                   </div>
                    @php
                        $hearings = App\Models\RM_CaseHearing::orderby('id', 'DESC')->where('rm_case_id', $info->id)->get();
                    @endphp
                    @if (count($hearings) != 0)
                    <div class="row">
                        <div class="col-md-12">
                           <h4 class="font-weight-bolder">শুনানির নোটিশ </h4>
                           <table class="tg">
                           <thead>
                              <tr>
                                 <th class="tg-19u4" width="10">ক্রম</th>
                                 <th class="tg-19u4 text-center">শুনানির তারিখ</th>
                                 <th class="tg-19u4 text-center">সংযুক্তি</th>
                                 <th class="tg-19u4 text-center">মন্তব্য</th>
                                 <th class="tg-19u4 text-center">শুনানির ফলাফলের সংযুক্তি</th>
                                 <th class="tg-19u4 text-center">ফলাফলের মন্তব্য</th>
                              </tr>
                           </thead>
                              <tbody class="text-center">
                                @forelse ($hearings as $key=> $row)
                                <tr>
                                   <td class="tg-nluh text-center" scope="row">{{ en2bn($key+1) }}.</td>
                                   <td class="tg-nluh text-center">{{ en2bn($row->hearing_date) }}</td>
                                   <td class="tg-nluh text-center">
                                        <a target="_black" href="{{ asset($row->hearing_file) }}" class="btn btn-primary btn-sm">সংযুক্তি</a>
                                    </td>
                                   <td class="tg-nluh text-center" class="tg-nluh">{{ $row->comment }}</td>
                                   <td class="tg-nluh text-center">
                                        <a target="_black" href="{{ asset($row->hearing_result_file) }}" class="btn btn-primary btn-sm">সংযুক্তি</a>
                                    </td>
                                   <td class="tg-nluh text-center" class="tg-nluh">{{ $row->hearing_result_comments }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="tg-nluh text-center" colspan="4">
                                        <h3>
                                            শুনানির কোন নোটিশ পাওয়া যাইনি
                                        </h3>
                                    </td>
                                </tr>
                                @endforelse
                              </tbody>
                           </table>
                        </div>
                    </div>
                   <br>
                   @endif
                   <br>
                   <br>
                   <br>
                   <br>

                   <div class="row">
                      <div class="col-md-5">
                         @if($info->order_date != NULL)
                          <h4 class="font-weight-bolder">আদেশের তারিখ সমুহ</h4>
                            <table class="tg">
                               <tr>
                                  <th class="tg-19u4 text-left" width="150">আদেশের তারিখ</th>
                                  <td class="tg-nluh font-size-lg font-weight-bold">{{ en2bn($info->order_date) }}</td>
                               </tr>
                               @endif
                               @if($info->next_assign_date != NULL)
                               <tr>
                                  <th class="tg-19u4 text-left" width="150">পরবর্তী ধার্য তারিখ</th>
                                  <td class="tg-nluh font-size-lg font-weight-bold">{{ en2bn($info->next_assign_date) }}</td>
                               </tr>
                               @endif
                               @if($info->past_order_date != NULL)
                               <tr>
                                  <th class="tg-19u4 text-left" width="150">বিগত তারিখের আদেশ</th>
                                  <td class="tg-nluh font-size-lg font-weight-bold">{{ en2bn($info->past_order_date) }}</td>
                               </tr>
                               @endif
                            </table>
                      </div>
                   </div>
                   <br>




                   <div class="row">
                      <div class="col-md-4">
                         <h4 class="font-weight-bolder">কারণ দর্শাইবার স্ক্যান কপি</h4>
                         <a href="#" class="btn btn-success btn-shadow font-weight-bold font-size-h4" data-toggle="modal" data-target="#showCauseModal">
                            <i class="fa fas fa-file-pdf icon-md"></i> কারণ দর্শাইবার স্ক্যান কপি
                         </a>

                         <!-- Modal-->
                         <div class="modal fade" id="showCauseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                               <div class="modal-content">
                                  <div class="modal-header">
                                     <h5 class="modal-title font-weight-bolder font-size-h3" id="exampleModalLabel">কারণ দর্শাইবার স্ক্যান কপি</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                     </button>
                                  </div>
                                  <div class="modal-body">

                                     <embed src="{{ asset($info->arji_file) }}" type="application/pdf" width="100%" height="400px" />

                                     </div>
                                     <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold font-size-h5" data-dismiss="modal">বন্ধ করুন</button>
                                     </div>
                                  </div>
                               </div>
                            </div> <!-- /modal -->
                      </div>
                      @if (count($files) != 0)
                         @foreach ($files as $file)
                            <div class="col-md-4">
                               <h4 class="font-weight-bolder">{{ $file->file_type }}</h4>
                               <a href="#" class="btn btn-success btn-shadow font-weight-bold font-size-h4" data-toggle="modal" data-target="#showFileModal">
                                  <i class="fa fas fa-file-pdf icon-md"></i> {{ $file->file_type }}
                               </a>

                               <!-- Modal-->
                               <div class="modal fade" id="showFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-xl" role="document">
                                     <div class="modal-content">
                                        <div class="modal-header">
                                           <h5 class="modal-title font-weight-bolder font-size-h3" id="exampleModalLabel">{{ $file->file_type }}</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <i aria-hidden="true" class="ki ki-close"></i>
                                           </button>
                                        </div>
                                        <div class="modal-body">

                                           <embed src="{{ asset($file->file_name) }}" type="application/pdf" width="100%" height="400px" />

                                           </div>
                                           <div class="modal-footer">
                                              <button type="button" class="btn btn-light-primary font-weight-bold font-size-h5" data-dismiss="modal">বন্ধ করুন</button>
                                           </div>
                                        </div>
                                     </div>
                                  </div> <!-- /modal -->
                            </div>
                         @endforeach
                      @endif

                   </div>
                   <br>
                   <div class="row">
                    @if($info->sf_report != NULL)
                         <div class="col-md-4">
                            <h4 class="font-weight-bolder">এস এফ এর চূড়ান্ত প্রতিবেদন</h4>
                            <a href="#" class="btn btn-success btn-shadow font-weight-bold font-size-h4" data-toggle="modal" data-target="#sfFinalFile">
                               <i class="fa fas fa-file-pdf icon-md"></i> এস এফ এর চূড়ান্ত প্রতিবেদন
                            </a>

                            <!-- Modal-->
                            <div class="modal fade" id="sfFinalFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-xl" role="document">
                                  <div class="modal-content">
                                     <div class="modal-header">
                                        <h5 class="modal-title font-weight-bolder font-size-h3" id="exampleModalLabel">এস এফ এর চূড়ান্ত প্রতিবেদন</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                     </div>
                                     <div class="modal-body">

                                        <embed src="{{ asset('uploads/sf_report/'.$info->sf_report) }}" type="application/pdf" width="100%" height="400px" />

                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-light-primary font-weight-bold font-size-h5" data-dismiss="modal">বন্ধ করুন</button>
                                        </div>
                                     </div>
                                  </div>
                               </div> <!-- /modal -->
                         </div>
                         @endif
                         @if($info->order_file != NULL)

                         <div class="col-md-4">
                            <h4 class="font-weight-bolder">আদেশের ফাইল</h4>
                            <a href="#" class="btn btn-success btn-shadow font-weight-bold font-size-h4" data-toggle="modal" data-target="#orderFile">
                               <i class="fa fas fa-file-pdf icon-md"></i> আদেশের ফাইল
                            </a>

                            <!-- Modal-->
                            <div class="modal fade" id="orderFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-xl" role="document">
                                  <div class="modal-content">
                                     <div class="modal-header">
                                        <h5 class="modal-title font-weight-bolder font-size-h3" id="exampleModalLabel">আদেশের ফাইল</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                     </div>
                                     <div class="modal-body">

                                        <embed src="{{ asset('uploads/order/'.$info->order_file) }}" type="application/pdf" width="100%" height="400px" />

                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-light-primary font-weight-bold font-size-h5" data-dismiss="modal">বন্ধ করুন</button>
                                        </div>
                                     </div>
                                  </div>
                               </div> <!-- /modal -->
                         </div>
                    @endif
                   </div>


                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('front.public_home_right_sideber')
        </div>
    </div>
</div>
{{-- <script>
    // console.log('Minar');
    // var js_json_obt = [@json($data ?? '')];
    // console.log(js_json_obt);

    "use strict";

    var KTCalendarBasic = function() {
        // var mk =
        //     $.ajax({
        // 	url: "https://reqres.in/api/products",
        // 	success: function(data){
        // 	    // $('#data').text(data);
        //         return data;
        //         // console.log(data.data);
        // 	},
        // 	error: function(){
        // 		alert("There was an error.");
        // 	}
        // });
        const mk = null;
        async function getUserAsync(name) {
            try {
                let response = await fetch(`https://reqres.in/api/products`);
                return await response.json();
            } catch (err) {
                console.error(err);
                // Handle errors here
            }
        }

        const minar = getUserAsync('yourUsernameHere').then(data => {
            // console.log(data.data);
            // const mk = data.data;
            return data;

            // Object.keys(minar).map((key) => {
            //     console.log(minar[key]);
            //     return {
            //         // title:  key,
            //         // start: YM + '-14T13:30:00',
            //         // description:  key,
            //         // end: YM + '-14',
            //         // className: "fc-event-success"

            //         // name: key,
            //         // data: minar[key],
            //         title: 'All Day Event',
            //         start: YM + '-01',
            //         description: 'Toto lorem ipsum dolor sit incid idunt ut',
            //         className: "fc-event-danger fc-event-solid-warning"
            //     }
            // })

        });
        // console.log(minar.data);



        // console.log(mk);
        return {
            //main function to initiate the module
            init: function() {
                var todayDate = moment().startOf('day');
                var YM = todayDate.format('YYYY-MM');
                var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                var TODAY = todayDate.format('YYYY-MM-DD');
                var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                var calendarEl = document.getElementById('kt_calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
                    themeSystem: 'bootstrap',

                    isRTL: KTUtil.isRTL(),

                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },

                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

                    nowIndicator: true,
                    now: TODAY + 'T09:25:00', // just for demo

                    views: {
                        dayGridMonth: {
                            buttonText: 'month'
                        },
                        timeGridWeek: {
                            buttonText: 'week'
                        },
                        timeGridDay: {
                            buttonText: 'day'
                        }
                    },

                    defaultView: 'dayGridMonth',
                    defaultDate: TODAY,

                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    navLinks: true,

                    events: @json($data['case'] ?? '').concat(@json($data['rm_case'] ?? '')),


                    eventRender: function(info) {
                        var element = $(info.el);

                        if (info.event.extendedProps && info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('<div class="fc-description">' +
                                    info.event.extendedProps.description + '</div>');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append(
                                    '<div class="fc-description">' + info.event.extendedProps
                                    .description + '</div>');
                            }
                        }
                    }
                });

                console.log(calendar.state.eventSources[0].meta);
                calendar.render();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTCalendarBasic.init();
    });
</script> --}}

@endsection
@section('scripts')
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

<script src="{{ asset('js/pages/features/miscellaneous/toastr.js') }}"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    @if (Session::has('success'))
        toastr.success("{{ session('success') }}", "Success");
    @endif
    @if (Session::has('error'))
        toastr.error("{{ session('error') }}", "Error");
    @endif
    @if (Session::has('info'))
        toastr.info("{{ session('info') }}", "Info");
    @endif
    @if (Session::has('warning'))
        toastr.warning("{{ session('warning') }}", "Warning");
    @endif
</script>
<script>
    "use strict";
    var KTCalendarBasic = function() {
        const mk = null;
        async function getUserAsync(name) {
            try {
                let response = await fetch(`https://reqres.in/api/products`);
                return await response.json();
            } catch (err) {
                console.error(err);
            }
        }

        const minar = getUserAsync('yourUsernameHere').then(data => {
            return data;
        });



        return {
            //main function to initiate the module
            init: function() {
                var todayDate = moment().startOf('day');
                var YM = todayDate.format('YYYY-MM');
                var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                var TODAY = todayDate.format('YYYY-MM-DD');
                var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                var calendarEl = document.getElementById('kt_calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
                    themeSystem: 'bootstrap',

                    isRTL: KTUtil.isRTL(),

                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },

                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

                    nowIndicator: true,
                    now: TODAY + 'T09:25:00', // just for demo

                    views: {
                        dayGridMonth: {
                            buttonText: 'Month'
                        },
                        timeGridWeek: {
                            buttonText: 'Week'
                        },
                        timeGridDay: {
                            buttonText: 'Day'
                        }
                    },
                    defaultView: 'dayGridMonth',
                    defaultDate: TODAY,

                    // editable: true,
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    navLinks: true,

                    events: @json($data['case'] ?? '').concat(@json($data['rm_case'] ?? '')),
                    eventRender: function(info) {
                        var element = $(info.el);

                        if (info.event.extendedProps && info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('<div class="fc-description">' +
                                    info.event.extendedProps.description + '</div>');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append(
                                    '<div class="fc-description">' + info.event.extendedProps
                                    .description + '</div>');
                            }
                        }
                    }
                });

                console.log(calendar.state.eventSources[0].meta);
                calendar.render();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTCalendarBasic.init();
    });
</script>
@endsection
