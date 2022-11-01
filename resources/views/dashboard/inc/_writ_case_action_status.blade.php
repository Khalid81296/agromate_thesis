@if ( count($writcase_status) != 0)
   <div class="col-md-8 mt-5">
      <div class="card card-custom">
         <div class="card-header flex-wrap bg-danger py-5">
            <div class="card-title">
               <h3 class="card-label h3 font-weight-bolder"> পদক্ষেপ নিতে হবে এমন মামলাসমূহ ( রিট মামলা )</h3>
            </div>
         </div>
         <div class="card-body p-0">
            <ul class="navi navi-border navi-hover navi-active">
               @forelse ($writcase_status as $row)

               <li class="navi-item">
                  <a class="navi-link" href="{{ route('writcase.action.receive', $row->cs_id) }}">
                     <span class="navi-icon"><i class="fas fa-folder-open icon-lg text-danger mr-3"></i></span>
                     <div class="navi-text">
                        <span class="d-block font-weight-bold h4 pt-2">{{ $row->status_name }}</span>
                     </div>
                     <span class="navi-label">
                        <span class="label label-xl label-danger h5">{{ $row->total_case }}</span>
                     </span>
                  </a>
               </li>

               @empty

               <li class="navi-item">
                  <div class="alert alert-custom alert-light-success fade show m-5" role="alert">
                     <div class="alert-icon">
                        <i class="flaticon-list"></i>
                     </div>
                     <div class="alert-text font-size-h4">পদক্ষেপ নিতে হবে এমন কোন মামলা পাওয়া যায়নি</div>
                  </div>
               </li>

               @endforelse
            </ul>
         </div>
      </div>
   </div>
   @endif
