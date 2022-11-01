<?php if(!empty($selected_committee_members)){ ?>
    <table class="table table-hover mb-6 font-size-h5">
        <thead class="thead-light  font-size-h3">
            <tr>
                <th scope="col" width="30">#</th>
                <th scope="col" width="200">নাম</th>
                <th scope="col" width="200">পদবী</th>
                <th scope="col" width="200">মোবাইল</th>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($selected_committee_members as $row)
                <tr>
                    <td scope="row">{{ en2bn(++$i) }}.</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->designation }}</td>
                    <td>{{ $row->mobile_no }}</td>
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
        <div class="alert-text font-size-h3">এফিডেভিট কমিটি মেম্বর নির্বাচন করা হয়নি</div>
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
