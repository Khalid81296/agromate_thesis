@php
   $user = Auth::user();
   $roleID = Auth::user()->role_id;
@endphp

@extends('layouts.default')

@section('content')

<style type="text/css">
   .tg {border-collapse:collapse;border-spacing:0;width: 100%;}
   .tg td{border-color:black;border-style:solid;border-width:1px;font-size:14px;overflow:hidden;padding:6px 5px;word-break:normal;}
   .tg th{border-color:black;border-style:solid;border-width:1px;font-size:14px;font-weight:normal;overflow:hidden;padding:6px 5px;word-break:normal;}
   .tg .tg-nluh{background-color:#dae8fc;border-color:#cbcefb;text-align:left;vertical-align:top}
   .tg .tg-19u4{background-color:#ecf4ff;border-color:#cbcefb;font-weight:bold;text-align:right;vertical-align:top}
</style>

<!--begin::Card-->
<div class="card card-custom">
   <div class="card-header flex-wrap py-5">
      {{-- <div class="card-title"> --}}
          <div class="container">
              <div class="row">
                  <div class="col-10"><h3 class="card-title h2 font-weight-bolder">{{ $page_title }}</h3></div>
                  
                  <div class="col-2">
                      @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 27)
                      <a href="{{ route('messages_group') }}?c={{ $info->id }}" class="btn btn-primary float-right">বার্তা</a>
                        @endif
                    </div>
              </div>
          </div>
         {{-- <h3 class="card-title h2 font-weight-bolder">{{ $page_title }}</h3>

         <table>
             <tr align="right">
                 <th>
                     <a  href="" class="btn btn-primary float-right">Message</a>

                 </th>
             </tr>
         </table> --}}
      {{-- </div> --}}
      @if ($roleID == 5 || $roleID == 7 || $roleID == 8)
      <div class="card-toolbar">
         <a href="{{ route('case.edit', $info->id) }}" class="btn btn-sm btn-primary font-weight-bolder">
            <i class="la la-edit"></i>মামলা সংশোধন করুন
         </a>
         <!-- &nbsp;
         <a href="{{ url('case/create') }}" class="btn btn-sm btn-primary font-weight-bolder">
            <i class="la la-plus"></i>পুরাতন চলমান মামলা এন্ট্রি
         </a>   -->
      </div>
      @endif
   </div>
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
                     <th class="tg-19u4" width="130">আদালতের নাম</th>
                     <td class="tg-nluh">{{ $info->type_name ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">বিভাগ</th>
                     <td class="tg-nluh">{{ $info->cast_name ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">জেলা</th>
                     <td class="tg-nluh">{{ $info->purpose_name ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">উপজেলা</th>
                     <td class="tg-nluh">{{ $info->farm_reg_date ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">মৌজা</th>
                     <td class="tg-nluh">{{ $info->birth_date ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">মামলা নং</th>
                     <td class="tg-nluh">{{ $info->avg_milk_amount ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">মামলা নং</th>
                     <td class="tg-nluh">{{ $info->weight ?? ''}}</td>
                  </tr>
                  
                     <th class="tg-19u4">ফলাফল</th>
                     <td class="tg-nluh">@if($info->ownership_type == '1')
                                              নিজের খামারে জন্ম!
                                         @elseif($info->ownership_type == '2')
                                              কেনা পশু!
                                          @else
                                              কোন তথ্য নেই
                                          @endif
                     </td>
                  </tr>
                  @if (!empty($info->buying_price))
                  <tr>
                     <th class="tg-19u4">মামলা নং</th>
                     <td class="tg-nluh">{{ $info->buying_price ?? ''}}</td>
                  </tr>
                  @endif
                  <tr>
                     <th class="tg-19u4">মামলা রুজুর তারিখ</th>
                     <td class="tg-nluh">{{ en2bn($info->anthrax_date) ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">মামলা রুজুর তারিখ</th>
                     <td class="tg-nluh">{{ en2bn($info->haemorrahagic_date) ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">মামলা রুজুর তারিখ</th>
                     <td class="tg-nluh">{{ en2bn($info->black_quarter_date) ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">মামলা রুজুর তারিখ</th>
                     <td class="tg-nluh">{{ en2bn($info->khurarog_date) ?? ''}}</td>
                  </tr>
                  <tr>
                     <th class="tg-19u4">মামলা রুজুর তারিখ</th>
                     <td class="tg-nluh">{{ en2bn($info->rabies_date) ?? ''}}</td>
                  </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
<!--end::Card-->

@endsection

{{-- Includable CSS Related Page --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
@endsection

{{-- Scripts Section Related Page--}}
@section('scripts')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('js/pages/crud/datatables/advanced/multiple-controls.js') }}"></script>
<!--end::Page Scripts-->
@endsection


