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
                            <img class="d-block w-100" style="height: 700px !important" src="{{ asset('media/banner/02.jpg') }}" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                {{-- <h5>Minar khan</h5>
                                <p>.Khalid mia.</p> --}}
                            </div>
                        </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" style="height: 700px !important" src="{{ asset('media/banner/03.jpg') }}" alt="Third slide">
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
            <div class="col-md-12 row">
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        ভ্যাকসিন / টিকা কী?
                                    </h3>
                                </div>
                            </div>
                            <img class="card-img-top" src="{{ asset('media/frontpage/vaccine2.png') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                    ভ্যাকসিন বা টিকা একটি জৈবিক প্রোডাক্ট। নির্দিষ্ট ব্যাকটেরিয়া বা ভাইরাস দ্বারা আক্রান্ত প্রাণীর দেহ হতে উক্ত জীবাণু সংগ্রহ করে বিশেষ পদ্ধতিতে সংরক্ষণ করা হয়। পরে ওই জীবাণুকে নিস্তেজ বা অর্ধমৃত বা মৃত অবস্থায় এনে এক ধরনের জীবাণুজাত ওষুধ তৈরি করা হয় যা নির্দিষ্ট পদ্ধতিতে দেহে প্রবেশ করালে উক্ত ব্যাকটেরিয়া বা ভাইরাস জাতীয় রোগের বিরুদ্ধে রোগ প্রতিরোধ ক্ষমতা তৈরি করে, যাকে ভ্যাকসিন বা টিকা বলে।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                       ভ্যাকসিন বা টিকা ফলপ্রসূ না হওয়ার কারণসমূহ  
                                    </h3>
                                </div>
                            </div>
                            <img class="card-img-top" src="{{ asset('media/frontpage/vaccine.png') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                    যেসব কারণে গবাদিপশুকে ভ্যাকসিন বা টিকা দেয়ার পরও রোগ প্রতিরোধ হয় না তা নীচে বর্ণিত হলো। পশুপাখির যে রোগের বিরুদ্ধে ভ্যাকসিন দেয়া হয়েছে যদি ওই রোগের জীবাণু পূর্বেই পশুপাখির শরীরে সুপ্ত অবস্থায় থাকে তবে ওই ভ্যাকসিন কার্যকর হবে না বরং আরো দ্রুত রোগ দেখা দিবে।। এজন্য কোনো পশুপাখির খামার/ ঝাঁকে রোগের লক্ষণ দেখা দেয়ার পর ওই খামার/ঝাঁকে কোনো সময়ই ওই রোগের বিরুদ্ধে ভ্যাকসিন দেয়া উচিত নয় । 
                                    
                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                      গরুর লাম্পি স্কিন রোগ   
                                    </h3>
                                </div>
                            </div>
                            <img class="card-img-top" src="{{ asset('media/frontpage/lumpy.png') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                   এ ধরনের কীটপতঙ্গ আক্রান্ত গরুকে দংশন করার পর অন্য একটি সুস্থ গরুকে দংশন করলে সেই গরুটিও আক্রান্ত হয়। আবার আক্রান্ত গরুর লালা খাবারে মিশে এবং খামার পরিচর্যাকারী ব্যক্তির কাপড়চোপড়ের মাধ্যমে ছড়াতে পারে। আক্রান্ত গাভির দুধেও এই ভাইরাস বিদ্যমান। তাই আক্রান্ত গাভির দুধ খেয়ে বাছুর আক্রান্ত হতে পারে।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        গাভীর এনাপ্লাজমোসিস রোগ
                                    </h3>
                                </div>
                            </div>
                            <img class="card-img-top" src="{{ asset('media/frontpage/enpazmis.png') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                    এনাপ্লাজমোসিস গরুর একটি মারাত্মক সংক্রামক রোগ। এটি রক্তবাহিত রোগ। এ রোগে রক্তশূন্যতা জন্ডিস ও জ্বরের লক্ষণ দেখা যায়।  অস্ট্রেলিয়া ও দক্ষিণ এশিয়াতেও এ রোগের সংক্রমণ ঘটে থাকে।  এ রোগে আক্রান্ত গরুর মৃত্যুর হার ৫০% পর্যন্ত হয়ে থাকে। তাছাড়া চিকিৎসা খরচও খুব বেশি। বাংলাদেশে প্রতি বছর এ রোগে আক্রান্ত হয়ে লক্ষ লক্ষ টাকা মূল্যের গাভীর মৃত্যু হয়ে থাকে ।
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        বাংলাদেশে ক্ষুরারোগ
                                    </h3>
                                </div>
                            </div>
                            <img class="card-img-top" src="{{ asset('media/frontpage/khurarog.png') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                    এটা ভাইরাস দ্বারা গঠিত রোগ। এ্যাপথা (Apthas) নামক আর এন এ (RNA) ভাইরাস এ রোগ সৃষ্টির জন্য দায়ী। এটি পিকরনাভিরিডি (picornaviridae) গোত্রের একটি উল্লেখ্যযোগ্য ভাইরাস।বাংলাদেশে শীতকালে ও বর্ষাকালে এ রোগ বেশি হলেও প্রায় সব ঋতুতে দেখা যায়। বাংলাদেশের ভৌগলিক অবস্থা ও পরিবেশ গত কারণে এ রোগের প্রকট অনেক বেশি। এ ক্ষুরা রোগের কারণে ডেইরি শিল্পে ব্যাপক ক্ষতি হয় প্রতি বছর। বার্ষিক ক্ষতির পরিমাণ প্রায় ৯৭২ কোটি ১২ লাখ ৫০ হাজার টাকা।
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                      গরুর প্রাণঘাতী রোগ ব্যাবেসিওসিস  
                                    </h3>
                                </div>
                            </div>
                            <img class="card-img-top" src="{{ asset('media/frontpage/babesiosis.png') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                    পরজীবীঘটিত একধরনের রোগ। Boophilus microplus নামের এক ধরনের উকুনের কামড়ে এই পরজীবী গরুর দেহে প্রবেশ করে রক্তের লোহিত কণিকায় আশ্রয় নেয়, সেখানেই বংশ বৃদ্ধি করে। ক্রমেই অন্যান্য লোহিত কণিকায়ও আক্রমণ করে। এতে লোহিত কণিকা ভেঙে হিমোগ্লোবিন রক্তে ছড়িয়ে পড়ে এবং প্রস্রাবের মাধ্যমে বের হয়ে আসে। বেশি লোহিত কণিকা আক্রান্ত হলে গরুর রক্তস্বল্পতা দেখা দেয়।
                                    
                                    
                            </div>
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

                    events: @json($data['case'] ?? '').concat(@json($data['rm_case'] ?? '')).concat(@json($data['writ_case'] ?? '')),
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
