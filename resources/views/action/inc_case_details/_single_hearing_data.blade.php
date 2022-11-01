
<?php if(!empty($hearings)){ ?>
    <table class="table table-hover mb-6 font-size-h5">
        <thead class="thead-light  font-size-h3">
            <tr>
                <th scope="col" width="30">#</th>
                <th scope="col" width="200">শুনানির তারিখ</th>
                <th scope="col" width="200">সংযুক্তি</th>
                <th scope="col" width="200">মন্তব্য</th>
                <th scope="col" width="400" class="text-center">শুনানির রায়</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @forelse ($hearings as $key => $row)
                <tr>
                    <td scope="row">{{ en2bn(++$i) }}.</td>
                    <td>{{ $row->hearing_date }}</td>
                    <td>
                        <a href="#" class="btn btn-success btn-shadow" data-toggle="modal"
                            data-target="#orderAttachmentModal">
                            <i class="fa fas fa-file-pdf icon-md"></i> সংযুক্তি
                        </a>

                        <!-- Modal-->
                        <div class="modal fade" id="orderAttachmentModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bolder font-size-h3"
                                            id="exampleModalLabel">সংযুক্তি</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <embed src="{{ asset('uploads/order/' . $row->hearing_file) }}"
                                            type="application/pdf" width="100%" height="400px" />

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"
                                            class="btn btn-light-primary font-weight-bold font-size-h5"
                                            data-dismiss="modal">বন্ধ করুন</button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /modal -->
                    </td>
                    <td>{{ $row->hearing_comment }}</td>

                    @if ( $row->hearing_result_updated == null)
                        <td>
                            <a class="text-danger  cursor-pointer" data-toggle="modal" data-target="#hearingResultUpdate"><u>শুনানির রায় প্রদান করুন</u></a>
                            <!-- Modal-->
                            <div class="modal fade" id="hearingResultUpdate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="javascript:void(0)" id="hearing_result_upload" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">শুনানির রায় প্রদান করুন </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <fieldset>
                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                            <label>রায়ের ফলাফল<span class="text-danger">*</span></label>
                                                            <div class="radio-inline">
                                                                <label class="radio">
                                                                <input type="radio" name="hearing_result" value="1" checked="checked" />
                                                                <span></span>জয়</label>
                                                                <label class="radio">
                                                                <input type="radio" name="hearing_result" value="0" />
                                                                <span></span>পরাজয়</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label>রায়ের মন্তব্য <span class="text-danger">*</span></label>
                                                            <textarea name="hearing_result_comment" id="hearing_comment" class="form-control" rows="5" spellcheck="false"></textarea>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>শুনানির রায়ের সংযুক্তি
                                                                    <span class="text-danger">*</span></label>
                                                                <div></div>
                                                                <div class="custom-file">
                                                                    <input type="file" accept="application/pdf" name="hearing_result_file" class="custom-file-input" id="customFile">
                                                                    <label class="custom-file-label" for="customFile">ফাইল নির্বাচন
                                                                        করুন</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="hide_hearing_id" id="hide_case_id" value="{{ $row->id }}">
                                                    <div class="progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                </fieldset>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold modal_close_btn" data-dismiss="modal">Close</button>
                                                {{-- <button type="button" class="btn btn-primary font-weight-bold"> সংরক্ষণ করুন</button> --}}
                                                <input type="submit" id="subLoader" class="btn btn-primary font-weight-bold" value="সংরক্ষণ করুন"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        {{-- <td>-</td> --}}
                    @else
                        <td class="text-center">
                            <table>
                                <tr>
                                    <th width="30">ফলাফল</th>
                                    <th width="300">মন্তব্য</th>
                                    <th width="200">সংযুক্তি</th>
                                </tr>
                                <tr>
                                    <td>
                                        @if($row->hearing_result == 1)
                                                জয়
                                            @else
                                                পরাজয়
                                            @endif

                                        </a>
                                    </td>
                                    <td>
                                        @if(strlen($row->hearing_result_comment) > 50)

                                            {{ substr($row->hearing_result_comment,0,50)."..." }}
                                            <a data-toggle="collapse" href="#collapseExample_{{$key}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                আরও
                                            </a>
                                        @else
                                            {{ $row->hearing_result_comment }}
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-shadow btn-block" data-toggle="modal" data-target="#resultHearing">
                                            <i class="fa fas fa-file-pdf icon-md"></i> সংযুক্তি
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <!-- Collapse -->
                            <div class="collapse" id="collapseExample_{{$key}}">
                              <div class="card card-body">
                                {{ $row->hearing_result_comment }}
                              </div>
                            </div>
                            <!-- //Collapse -->
                            <!-- Modal-->
                            <div class="modal fade" id="resultHearing" tabindex="-1" role="dialog"
                                aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bolder font-size-h3"
                                                id="ModalLabel">সংযুক্তি</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <embed src="{{ asset($row->hearing_result_file) }}"
                                                type="application/pdf" width="100%" height="400px" />

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-light-primary font-weight-bold font-size-h5"
                                                data-dismiss="modal">বন্ধ করুন</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /modal -->
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <p class="text-danger">কোনো তথ্য খুঁজে পাওয়া যায়নি</p>
                    </td>
                </tr>
            @endforelse
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
