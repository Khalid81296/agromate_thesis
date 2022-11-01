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
                  <div class="card-body px-0">
            <div class="tab-content pt-5">
               <!--begin::Tab Content-->
               <div class="tab-pane active" id="tab_case_details" role="tabpanel">
                  <div class="container">
                     {{-- $info->is_sf --}}
                     <div class="row">
                        <div class="col-md-6">
                           <h4 class="font-weight-bolder">সাধারণ তথ্য</h4>
                           <table class="tg">
                              <tr>
                                 <th class="tg-19u4" width="130">আদালতের নাম</th>
                                 <td class="tg-nluh">{{ $info->court_name }}</td>
                              </tr>
                              <tr>
                                 <th class="tg-19u4">উপজেলা</th>
                                 <td class="tg-nluh">{{ $info->upazila_name_bn }}</td>
                              </tr>
                              <tr>
                                 <th class="tg-19u4">মৌজা</th>
                                 <td class="tg-nluh">{{ $info->mouja_name_bn }}</td>
                              </tr>
                              <tr>
                                 <th class="tg-19u4">মামলা নং</th>
                                 <td class="tg-nluh">{{ $info->case_number }}</td>
                              </tr>
                              <tr>
                                 <th class="tg-19u4">মামলা রুজুর তারিখ</th>
                                 <td class="tg-nluh">{{ $info->case_date }}</td>
                              </tr>
                              <tr>
                                 <th class="tg-19u4">মামলার বর্তমান অবস্থান</th>
                                 <td class="tg-nluh">{{ $info->status_name }}</td>
                              </tr>
                              <tr>
                                 <th class="tg-19u4">বর্তমান ষ্ট্যাটাস</th>
                                 <td class="tg-nluh"> @if ($info->status === 1)
                                    নতুন!
                                    @elseif ($info->status === 2)
                                    চলমান!
                                    @elseif ($info->status === 3)
                                    আপিল!
                                    @else
                                    সম্পাদিত !
                                    @endif
                                 </td>
                              </tr>
                           </table>
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
                                 <td class="tg-nluh">{{$k}}.</td>
                                 <td class="tg-nluh">{{ $badi->badi_name }}</td>
                                 <td class="tg-nluh">{{ $badi->badi_spouse_name }}</td>
                                 <td class="tg-nluh">{{ $badi->badi_address }}</td>
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
                                 <td class="tg-nluh">{{ $k }}.</td>
                                 <td class="tg-nluh">{{ $bibadi->bibadi_name }}</td>
                                 <td class="tg-nluh">{{ $bibadi->bibadi_spouse_name }}</td>
                                 <td class="tg-nluh">{{ $bibadi->bibadi_address }}</td>
                              </tr>
                              @php $k++; @endphp
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-md-12">
                       <h4 class="font-weight-bolder">জরিপের বিবরণ</h4>
                       <table class="tg">
                        <thead>
                           <tr>
                              <th class="tg-19u4" width="10">ক্রম</th>
                              <th class="tg-19u4 text-center">জরিপের ধরণ </th>
                              <th class="tg-19u4 text-center">খতিয়ান নং</th>
                              <th class="tg-19u4 text-center">দাগ নং</th>
                              <th class="tg-19u4 text-center">জমির শ্রেণী</th>
                              <th class="tg-19u4" width="150">জমির পরিমাণ (শতক)</th>
                              <th class="tg-19u4" width="170">নালিশী জমির পরিমাণ (শতক)</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php $k = 1; @endphp
                           @foreach ($surveys as $survey)
                           <tr>
                              <td class="tg-nluh">{{ $k }}.</td>
                              <td class="tg-nluh">{{ $survey->st_name }}</td>
                              <td class="tg-nluh">{{ $survey->khotian_no  }}</td>
                              <td class="tg-nluh">{{ $survey->daag_no }}</td>
                              <td class="tg-nluh">{{ $survey->lt_name }}</td>
                              <td class="tg-nluh text-right">{{ $survey->land_size }}</td>
                              <td class="tg-nluh text-right">{{ $survey->land_demand }}</td>
                           </tr>
                           @php $k++; @endphp
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               <br>

               <div class="row">
                  <div class="col-md-12">
                     <h4 class="font-weight-bolder">তফশীল বিবরণ</h4>
                     <table class="tg">
                        <tr>
                           <td class="tg-nluh font-size-lg font-weight-bold">{{ $info->tafsil }}</td>
                        </tr>
                     </table>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="font-weight-bolder">চৌহদ্দীর বিবরণ</h4>
                     <table class="tg">
                        <tr>
                           <td class="tg-nluh font-size-lg font-weight-bold">{{ $info->chowhaddi }}</td>
                        </tr>
                     </table>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="font-weight-bolder">কারণ দর্শাইবার স্ক্যান কপি</h4>

                     <!-- <a href="uploads/{{$info->show_cause_file}}" target="_blank">কারণ দর্শাইবার স্ক্যান কপি ডাউনলোড</a> -->

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

                                 <embed src="{{ asset('uploads/'.$info->show_cause_file) }}" type="application/pdf" width="100%" height="400px" />

                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold font-size-h5" data-dismiss="modal">বন্ধ করুন</button>
                                 </div>
                              </div>
                           </div>
                        </div> <!-- /modal -->

                     </div>
                  </div>
               </div> <!--end::Tab Content-->
            </div>
            <!--end::Tab Content-->

            <!--begin::Tab Content-->
            <div class="tab-pane" id="tab_sf" role="tabpanel">
               <div class="container">
                  <div class="alert alert-danger" style="display:none"></div>

                  <div class="alert alert-custom alert-light-success fade show mb-9" role="alert" id="sf_notice_success" style="display:none">
                     <div class="alert-icon">
                        <i class="flaticon2-check-mark"></i>
                     </div>
                     <div class="alert-text font-size-h3">এস এফ প্রতিবেদন সফলভাবে তৈরি হয়েছে</div>
                     <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">
                              <i class="ki ki-close"></i>
                           </span>
                        </button>
                     </div>
                  </div>

                  <div class="alert alert-custom alert-light-success fade show mb-9" role="alert" id="sf_notice_updated" style="display:none">
                     <div class="alert-icon">
                        <i class="flaticon2-check-mark"></i>
                     </div>
                     <div class="alert-text font-size-h3">সফলভাবে এস এফ প্রতিবেদন সংশোধন করা হয়েছে</div>
                     <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">
                              <i class="ki ki-close"></i>
                           </span>
                        </button>
                     </div>
                  </div>

                  <?php if($info->is_sf){ ?>
                  <!--begin::Row Edit SF-->
                  <div class="row" id="sf_edit_content" style="display: none;">
                     <div class="col-md-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b example example-compact">
                           <!--begin::Form-->
                           <form action="{{ url('dashboard/editsf') }}" class="form" method="POST" enctype="multipart/form-data">
                              @csrf

                              <!-- <div class="loadersmall"></div> -->
                              <div class="row mb-5">
                                 <div class="col-md-6">
                                    <fieldset>
                                       <legend style="width: 70%;">কারণ দর্শানো নোটিশের প্যারা ভিত্তিক জবাব সংশোধন করুন</legend>
                                       <div class="form-group row">
                                          <div class="col-lg-12">
                                             <textarea name="sf_details" id="sf_details" class="form-control" rows="13" spellcheck="false"><?php echo $sf->sf_details?></textarea>
                                          </div>
                                          <input type="hidden" name="hide_case_id" id="hide_case_id" value="{{ $info->id }}">
                                          <input type="hidden" name="hide_sf_id" id="hide_sf_id" value="{{ $sf->id }}">
                                       </div>
                                    </fieldset>
                                 </div>

                                 <div class="col-md-6">
                                    <embed src="{{ asset('uploads/'.$info->show_cause_file) }}" type="application/pdf" width="100%" height="400px" />
                                    </div>
                                 </div>

                                 <div class="card-footer">
                                    <div class="row">
                                       <div class="col-lg-4"></div>
                                       <div class="col-lg-7">
                                          <button type="button" id="sfUpdateSubmit" class="btn btn-primary font-weight-bold font-size-h2 px-8 py-3"><i class="flaticon2-box icon-3x"></i> সংরক্ষণ করুন</button>
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
                     <?php } ?>


                     <!--begin::Row Create SF-->
                     <div class="row" id="sf_content" style="display: none;">
                        <div class="col-md-12">
                           <!--begin::Card-->
                           <div class="card card-custom gutter-b example example-compact">
                              <!--begin::Form-->
                              <form action="{{ url('dashboard.createsf') }}" class="form" method="POST" enctype="multipart/form-data">
                                 @csrf
                                 <!-- <div class="loadersmall"></div> -->
                                 <div class="row mb-5">
                                    <div class="col-md-6">
                                       <fieldset>
                                          <legend style="width: 70%;">কারণ দর্শানো নোটিশের প্যারা ভিত্তিক জবাব লিখুন</legend>
                                          <div class="form-group row">
                                             <div class="col-lg-12">
                                                <textarea name="sf_details" id="sf_details" class="form-control" rows="13" spellcheck="false"></textarea>
                                             </div>
                                             <input type="hidden" name="hide_case_id" id="hide_case_id" value="{{ $info->id }}">
                                          </div>
                                       </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                       <embed src="{{ asset('uploads/'.$info->show_cause_file) }}" type="application/pdf" width="100%" height="400px" />
                                       </div>
                                    </div>

                                    <div class="card-footer">
                                       <div class="row">
                                          <div class="col-lg-4"></div>
                                          <div class="col-lg-7">
                                             <button type="button" id="sfCreateSubmit" class="btn btn-primary font-weight-bold font-size-h2 px-8 py-3"><i class="flaticon2-box icon-3x"></i> সংরক্ষণ করুন</button>
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

                        <?php if($info->is_sf){ ?>
                        <div id="sf_docs">
                           

                              <div class="text-center font-weight-bolder font-size-h2">কারণ দর্শাইবার জবাব</div>
                              <div class="text-center font-weight-bolder font-size-h3">মোকামঃ {{ $info->court_name }}</div>
                              <div class="text-center font-weight-bold font-size-h3"><b>বিষয়ঃ</b> দেওয়ানী মোকাদ্দমা নং {{ $info->case_number }} এর প্যারাভিত্তিক জবাব প্রেরণ প্রসঙ্গে</div> <br>
                              <p class="font-size-h4">
                                 @php $badi_sl = 1; @endphp
                                 @foreach ($badis as $badi)
                                 {{$badi_sl}}। {{ $badi->badi_name }}, পিতা/স্বামীঃ {{ $badi->badi_spouse_name }} <br>
                                 সাং {{ $badi->badi_address }}
                                 <br>
                                 @php $badi_sl++; @endphp
                                 @endforeach
                                 ................................................................. বাদী
                              </p>

                              <div class="font-weight-bolder font-size-h3 mt-5 mb-5">বনাম</div>

                              <p class="font-size-h4">
                                @php $bibadi_sl = 1; @endphp
                                @foreach ($bibadis as $bibadi)
                                {{$bibadi_sl}}। {{ $bibadi->bibadi_name }}, পিতা/স্বামীঃ {{ $bibadi->bibadi_spouse_name }} <br>
                                সাং {{ $bibadi->bibadi_address }}
                                <br>
                                @php $bibadi_sl++; @endphp
                                @endforeach
                                ................................................................. বিবাদী
                             </p>

                             <p class="font-size-h4 mt-15">
                              <?php echo nl2br($sf->sf_details); ?>
                           </p>
                        </div>

                        <?php }else{ ?>

                        <!--begin::Notice-->
                        <div class="alert alert-custom alert-light-danger fade show mb-9" role="alert" id="sf_notice">
                           <div class="alert-icon">
                              <i class="flaticon-warning"></i>
                           </div>
                           <div class="alert-text font-size-h3">এখনও পর্যন্ত কোন এসএফ প্রতিবেদন তৈরি করা হয়নি !</div>
                           <div class="alert-close">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">
                                    <i class="ki ki-close"></i>
                                 </span>
                              </button>
                           </div>
                        </div>
                        <!--end::Notice-->

                        
                           <?php } ?>

                        </div>
                     </div>
                     <!--end::Tab Content-->
                     <!--begin::Tab Content-->
                     <div class="tab-pane" id="tab_notice" role="tabpanel">
                        <div class="container">

                           <div class="alert alert-danger" style="display:none"></div>

                           <div class="alert alert-custom alert-light-success fade show mb-9" role="alert" id="hearing_notice_success" style="display:none">
                              <div class="alert-icon">
                                 <i class="flaticon2-check-mark"></i>
                              </div>
                              <div class="alert-text font-size-h3">শুনানির তারিখ সংরক্ষণ করা হয়েছে</div>
                              <div class="alert-close">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">
                                       <i class="ki ki-close"></i>
                                    </span>
                                 </button>
                              </div>
                           </div>


                              <div class="clearfix"></div>

                              <div id="hearing_content">
                                 <?php if(!empty($hearings)){ ?>
                                 <table class="table table-hover mb-6 font-size-h5">
                                    <thead class="thead-light  font-size-h3">
                                       <tr>
                                          <th scope="col" width="30">#</th>
                                          <th scope="col" width="200">শুনানির তারিখ</th>
                                          <th scope="col">মন্তব্য</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $i=0; ?>
                                       @foreach ($hearings as $row)
                                       <tr>
                                          <td scope="row">{{ ++$i }}.</td>
                                          <td>{{ $row->hearing_date }}</td>
                                          <td>{{ $row->hearing_comment }}</td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                                 <?php }else{ ?>
                                 <!--begin::Notice-->
                                 <div class="alert alert-custom alert-light-success fade show mb-9" role="alert">
                                    <div class="alert-icon">
                                       <i class="flaticon-warning"></i>
                                    </div>
                                    <div class="alert-text font-size-h3">কোন শুনানির নোটিশ পাওয়া যাইনি</div>
                                    <div class="alert-close">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">
                                             <i class="ki ki-close"></i>
                                          </span>
                                       </button>
                                    </div>
                                 </div>
                                 <!--end::Notice-->
                                 <?php } ?>
                              </div>

                              <!--begin::Row Create SF-->
                              <div class="row" id="hearing_add_content" style="display: none;">
                                 <div class="col-md-12">
                                    <!--begin::Card-->
                                    <div class="card card-custom gutter-b example example-compact">
                                       <!--begin::Form-->
                                       <form action="{{ url('dashboard.hearing-add') }}" class="form" method="POST" enctype="multipart/form-data">
                                          @csrf
                                          <!-- <div class="loadersmall"></div> -->
                                          <div class="row mb-5">
                                             <div class="col-md-12">
                                                <fieldset>
                                                   <div class="form-group row">
                                                      <div class="col-lg-4">
                                                         <label>শুনানির তারিখ <span class="text-danger">*</span></label>
                                                         <input type="text" name="hearing_date" id="hearing_date" class="form-control form-control-sm common_datepicker" placeholder="দিন/মাস/তারিখ" autocomplete="off">
                                                      </div>
                                                      <div class="col-lg-8">
                                                         <label>মন্তব্য <span class="text-danger">*</span></label>
                                                         <textarea name="hearing_comment" id="hearing_comment" class="form-control" rows="5" spellcheck="false"></textarea>
                                                      </div>
                                                      <input type="hidden" name="hide_case_id" id="hide_case_id" value="{{ $info->id }}">
                                                   </div>
                                                </fieldset>
                                             </div>
                                          </div>

                                          <div class="card-footer">
                                             <div class="row">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-7">
                                                   <button type="button" id="hearingSubmit" class="btn btn-primary font-weight-bold font-size-h2 px-8 py-3"><i class="flaticon2-box icon-3x"></i> সংরক্ষণ করুন</button>
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

                           </div>
                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->
                        <div class="tab-pane" id="tab_history" role="tabpanel">
                           <div class="container">
                              <!-- <div class="separator separator-dashed my-10"></div> -->

                              <?php if(!empty($logs)){ ?>
                              <!--begin::Timeline-->
                              <div class="timeline timeline-3">
                                 <div class="timeline-items">

                                    <?php foreach ($logs as $row) { ?>
                                    <div class="timeline-item">
                                       <div class="timeline-media">
                                          <i class="fa fas fa-angle-double-up text-warning"></i>
                                       </div>
                                       <div class="timeline-content">
                                          <div class="d-flex align-items-center justify-content-between mb-3">
                                             <div class="mr-2">
                                                <a href="javascript:void(0)" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5"><?=$row->status_name?></a>
                                                <span class="text-muted ml-2 font-size-h6 "><?=$row->created_at?> | <?=$row->name?> | <?=$row->role_name?></span>
                                             </div>
                                          </div>
                                          <p class="p-0 font-italic font-size-h5"><?=$row->comment?></p>
                                       </div>
                                    </div>
                                    <?php } ?>

                        
                     </div>
                  </div>
                  <!--end::Timeline-->
                  <?php } else { ?>

                  <!--begin::Notice-->
                  <div class="alert alert-custom alert-light-success fade show mb-9" role="alert">
                     <div class="alert-icon">
                        <i class="flaticon-warning"></i>
                     </div>
                     <div class="alert-text font-size-h3">কোন তথ্য পাওয়া যাইনি</div>
                  </div>
                  <!--end::Notice-->

                  <?php } ?>
               </div>
               <!--end::Container-->
            </div>
            <!--end::Tab Content-->
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
