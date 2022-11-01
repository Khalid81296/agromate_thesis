    <div class="container">

        <!--begin::Row Create SF-->
        <div class="alert alert-custom alert-light-success fade show mb-9" role="alert" id="committeeMemberAddSuccess"
            style="display:none">
            <div class="alert-icon">
                <i class="flaticon2-check-mark"></i>
            </div>
            <div class="alert-text font-size-h3">এফিডেভিট কমিটি মেম্বরের তথ্য সংরক্ষণ করা হয়েছে
            </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                    </span>
                </button>
            </div>
        </div>

        <?php if(Auth::user()->role_id == 26){ ?>
        <a href="javascript:void(0)" id="committee_member_add_button" class="btn btn-danger float-right"><i
                class="fa fas fa-landmark"></i> <b>এফিডেভিট কমিটি মেম্বর যুক্ত করুন</b></a>
        <?php } ?>
            <br>
            <br>
            <div id="caseCommitteeList">
                @include('write_case/action/inc_case_details/_selected_committee_members')
            </div>
            <br>
        <div class="row" id="committee_member_add_content" style="display: none;">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div>
                        <a href="javascript:void(0)" id="committee_member_add_button_close" class="mb-2 btn btn-danger float-right">
                            <i class="fa fas fa-arrow-alt-circle-left"></i> <b>পূর্বে ফিরে যান</b>
                        </a>
                    </div>
                    <!--begin::Form id="hearingSubmit"-->
                    <form method="POST" action="javascript:void(0)" id="ajax-affidavit-committee-upload"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <fieldset>
                                    <div class="form-group row">

                                        <div class="form-group col-lg-12">
                                            <table class="table table-hover mb-6 font-size-h6" >
                                                <thead class="thead-light">
                                                   <tr>
                                                      <!-- <th scope="col" width="30">#</th> -->
                                                       <th scope="col" >
                                                        সিলেক্ট করুণ
                                                     </th>
                                                      <th scope="col">এফিডেভিট কমিটি মেম্বরের নাম</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($affidavit_committee as $row)
                                                   
                                                      <tr>
                                                         <td>
                                                            <div class="checkbox-inline">
                                                               <label class="checkbox">
                                                               <input type="checkbox" name="affidavit_committee[]"  value="{{ $row->id }}" /><span></span>
                                                            </div>
                                                         </td>
                                                          <td>{{ $row->name }}</td>
                                                         
                                                       </tr>
                                                   @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <input type="hidden" name="hide_case_id" id="hide_case_id"
                                        value="{{ $info->id }}">
                                    <input type="hidden" name="hide_division_id" id="hide_division_id"
                                        value="{{ $info->division_id }}">
                                    <input type="hidden" name="hide_district_id" id="hide_district_id"
                                        value="{{ $info->district_id }}">
                                    <input type="hidden" name="hide_upazila_id" id="hide_upazila_id"
                                        value="{{ $info->upazila_id }}">
                                    
                                </fieldset>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-7">
                                    <button type="submit"
                                        class="btn btn-primary font-weight-bold font-size-h2 px-8 py-3"><i
                                            class="flaticon2-box icon-3x"></i> সংরক্ষণ করুন</button>
                                    <!--
                               <button type="button" id="hearingSubmit" class="btn btn-primary font-weight-bold font-size-h2 px-8 py-3"><i class="flaticon2-box icon-3x"></i> সংরক্ষণ করুন</button> -->
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->

                </div>
                <!--end::Card-->
            </div>
        </div>

    </div>
