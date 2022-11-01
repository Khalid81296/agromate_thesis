<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="font-weight-bolder">সাধারণ তথ্য</h4>
            <table class="tg">
                <thead>
                    <tr>
                        <th class="tg-19u4" width="130">বিভাগ</th>
                        <td class="tg-nluh">{{ $info->division->division_name_bn ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="tg-19u4">জেলা</th>
                        <td class="tg-nluh">{{ $info->district->district_name_bn ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="tg-19u4">মামলা নং</th>
                        <td class="tg-nluh">{{ $info->case_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="tg-19u4">মামলা রুজুর তারিখ</th>
                        <td class="tg-nluh">{{ en2bn($info->case_date) ?? '' }}</td>
                    </tr>


                    <tr>
                        <th class="tg-19u4">ফলাফল</th>
                        <td class="tg-nluh">
                            {{ $info->result_text ?? '-' }}
                            {{-- @if ($info->case_result == '1')
                                জয়!
                            @elseif($info->case_result == '0')
                                পরাজয়!
                            @else
                                চলমান
                            @endif --}}
                        </td>
                        {{-- @dd($info->case_result) --}}
                    </tr>
                    {{-- @if (!empty($info->lost_reason))
                        <tr>
                            <th class="tg-19u4">পরাজয়ের কারণ</th>
                            <td class="tg-nluh">{{ $info->lost_reason ?? '' }}</td>
                        </tr>
                    @endif --}}
                    <tr>
                        <th class="tg-19u4">মামলায় হেরে গিয়ে কি আপিল করা হয়েছে</th>
                        <td class="tg-nluh">
                            @if ($info->is_lost_appeal == 1)
                                হ্যা!
                            @else
                                না!
                            @endif
                        </td>
                    </tr>
                    @if (!empty($info->rm_case_ref_id))
                        <tr>
                            <th class="tg-19u4">পূর্বের মামলা নং</th>
                            <td class="tg-nluh"><a href="{{ route('rmcase.show', $info->rm_case_ref_id) }}"
                                    target="_blank">{{ $info->ref_rm_case_no }}</a> </td>
                        </tr>
                    @endif
                    @if (!empty($info->status))
                        <tr>
                            <th class="tg-19u4">মামলার বর্তমান অবস্থান</th>
                            <td class="tg-nluh">
                                {{ $info->case_status->status_name }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <th class="tg-19u4">মন্তব্য</th>
                        <td class="tg-nluh">{{ $info->comments }}</td>
                    </tr>
                    <tr>
                        <th class="tg-19u4">বর্তমান ষ্ট্যাটাস</th>
                        <td class="tg-nluh">
                            @if ($info->status == 1)
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
                    @forelse($info->badis as $key => $badi)
                        <tr>
                            <td class="tg-nluh">{{ en2bn(++$key) }}.</td>
                            <td class="tg-nluh">{{ $badi->name ?? '' }}</td>
                            <td class="tg-nluh">{{ $badi->spouse_name ?? '' }}</td>
                            <td class="tg-nluh">{{ $badi->address ?? '' }}</td>
                        </tr>
                    @empty
                    @endforelse
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
                    @forelse($info->bibadis as $key => $bibadi)
                        <tr>
                            <td class="tg-nluh">{{ en2bn(++$key) }}.</td>
                            <td class="tg-nluh">{{ $bibadi->name ?? '' }}</td>
                            <td class="tg-nluh">{{ $bibadi->spouse_name ?? '' }}</td>
                            <td class="tg-nluh">{{ $bibadi->address ?? '' }}</td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="font-weight-bolder">কারণ দর্শাইবার স্ক্যান কপি</h4>

            <?php if($info->arji_file != NULL){ ?>
            <a href="#" class="btn btn-success btn-shadow font-weight-bold font-size-h4" data-toggle="modal"
                data-target="#showCauseModal">
                <i class="fa fas fa-file-pdf icon-md"></i> কারণ দর্শাইবার স্ক্যান কপি
            </a>

            <!-- Modal-->
            <div class="modal fade" id="showCauseModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder font-size-h3" id="exampleModalLabel">কারণ
                                দর্শাইবার স্ক্যান কপি</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <embed src="{{ asset($info->arji_file) }}" type="application/pdf" width="100%"
                                height="400px" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold font-size-h5"
                                data-dismiss="modal">বন্ধ করুন</button>
                        </div>
                    </div>
                </div>
            </div> <!-- /modal -->
            <?php } ?>

        </div>
    </div>
</div>
<!--end::Tab Content-->
