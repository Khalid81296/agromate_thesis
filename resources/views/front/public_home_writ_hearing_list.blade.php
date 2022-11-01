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
                <marquee style="font-size: 18px" direction="left" scrollamount="3" onmouseover="this.stop()" onmouseout="this.start()">
                    ভূমি রাজস্ব মামলা ম্যানেজমেন্ট সিষ্টেমে আপনাকে স্বাগতম। ভূমি সংক্রান্ত অন্যান্য তথ্য নিতে <a href="https://land.gov.bd/" target="_blank">land.gov.bd</a> লিংকে ক্লিক করুন।
                </marquee>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-8">
            <div class="card">
                <div class="card card-custom">
                   <div class="card-header flex-wrap py-5">
                      <div class="card-title">
                         <h3 class="card-title h2  ">{{ $page_title }}</h3>
                      </div>
                   </div>
                   <div class="card-body">
                      @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                         {{ $message }}
                      </div>
                      @endif
                        <table class="table table-hover mb-6  font-size-h4">
                            <thead class="thead-light">
                                <tr>
                                   <th scope="col" width="30">#</th>
                                   <th scope="col">আদালতের নাম</th>
                                   <th scope="col">মামলা নং</th>
                                   <th scope="col">মন্তব্য</th>
                                   <th scope="col" width="150">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; ?>
                                @foreach ($hearing as $row)
                                <?php
                                   $caseStatus = '';
                                   if($row->status == 1){
                                      // $caseStatus = '<span class="label label-inline label-light-primary font-weight-bold">নতুন মামলা</span>';
                                   }
                                ?>
                                <tr>
                                   <td scope="row">{{ ++$i }}.</td>
                                   <td>{{ $row->court_name }}</td>
                                   <td>{{ $row->case_number }}</td>
                                   <td>{{ $row->hearing_comment }}</td>
                                   <td>
                                      <a href="{{ route('dateWaysWritCaseDetails', $row->id) }}" class="btn btn-success btn-shadow btn-sm font-weight-bold pt-1 pb-1">বিস্তারিত </a>
                                      <!-- <a href="#" class="btn btn-success btn-shadow btn-sm font-weight-bold pt-1 pb-1">সংশোধন</a> -->
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                      </table>

                      <div class="d-flex justify-content-center">
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
