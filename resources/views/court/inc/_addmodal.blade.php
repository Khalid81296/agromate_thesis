<!-- <div id="contact-modal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content"> -->
<div id="contact-modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
         <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>নতুন আদালত এন্ট্রি ফরম</h3>
         </div>
         <!-- <form id="contactForm" name="contact" role="form">
            <div class="modal-body">            
               <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control">
               </div>
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control">
               </div>
               <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="message" class="form-control"></textarea>
               </div>               
            </div>
            <div class="modal-footer">             
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <input type="submit" class="btn btn-success" id="submit">
            </div>
         </form> -->
        
         <form id="courtEntry" action="{{ route('court.save') }}" class="form" method="POST">
         @csrf
             <div class="modal-body">
                 <div class="form-group row">
                     @if($roleID == 1 || $roleID == 2 || $roleID == 3 || $roleID == 4 )
                         <div class="col-lg-3 mb-5">
                             <label>বিভাগ <span class="text-danger">*</span></label>
                             <select name="division" id="division_id" class="form-control form-control-sm" >
                                 <option value="">-- নির্বাচন করুন --</option>
                                 @foreach ($division as $value)
                                 <option value="{{ $value->id }}" {{ old('division') == $value->id ? 'selected' : '' }}> {{ $value->division_name_bn }} </option>
                                 @endforeach 
                             </select>
                         </div>
                         <div class="col-lg-3 mb-5">
                             <label>জেলা <span class="text-danger">*</span></label>
                             <select name="district" id="district_id" class="form-control form-control-sm" >
                                 <option value="">-- নির্বাচন করুন --</option>
                                 
                             </select>
                         </div>
                     @elseif(($roleID == 5 || $roleID == 6 || $roleID == 7 || $roleID == 8 || $roleID == 13))    
                         {{-- <div class="col-lg-3 mb-5">
                             <label>জেলা <span class="text-danger">*</span></label>
                             <select name="district" id="district_id" class="form-control form-control-sm" >
                                 <option value="">-- নির্বাচন করুন --</option>
                                 @foreach ($district as $value)
                                 <option value="{{ $value->id }}" {{ old('district') == $value->id ? 'selected' : '' }}> {{ $value->district_name_bn }} </option>
                                 @endforeach 
                             </select>
                         </div> --}}
                    
                   @endif    
                         <div class="col-lg-3 mb-5">
                             <label>আদালতের ধরণ <span class="text-danger">*</span></label>
                             <select name="ct_id" id="ct_id" class="form-control form-control-sm" >
                                 <option value="">-- নির্বাচন করুন --</option>
                                 @foreach ($court_type as $value)
                                 <option value="{{ $value->id }}" {{ old('ct_id') == $value->id ? 'selected' : '' }}> {{ $value->court_type_name }} </option>
                                 @endforeach 
                             </select>
                         </div>
                         <div class="form-group col-lg-6">
                             <label for="court_name" class=" form-control-label">আদালতের নাম <span class="text-danger">*</span></label>
                             <input type="text" id="court_name" name="court_name" placeholder="আদালতের নাম লিখুন" class="form-control form-control-sm">
                             <span style="color: red">
                                 {{ $errors->first('name') }}
                             </span>
                         </div>

                     <div class="col-lg-4">
                        <label>স্ট্যাটাস</label>
                     <div class="radio-inline">
                        <label class="radio">
                        <input type="radio" name="status" value="1" checked="checke" />
                        <span></span>সক্রিয়</label>
                        <label class="radio">
                        <input type="radio" name="status" value="0" />
                        <span></span>নিষ্ক্রিয়</label>
                     </div>
                     </div>
               </div> <!--end::Card-body-->

            <div class="modal-footer text-center">
                 <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button type="button" data-toggle="modal" data-target="#myModalPreview" class="btn btn-primary mr-3" id="preview">প্রিভিউ</button> -->
                        <button type="submit" class="btn btn-primary mr-2" onclick="return confirm('আপনি কি সংরক্ষণ করতে চান?')">সংরক্ষণ করুন</button>
                    </div>
                 </div>
            </div>
                 <div class="modal fade" id="myModalPreview">
                 <div class="modal-dialog">
                   <div class="modal-content">
                   
                     <!-- Modal Header -->
                     <div class="modal-header">
                       <h4 class="modal-title">আদালত এন্ট্রি প্রিভিউ</h4>
                       <button type="button" class="close" data-dismiss="modal">×</button>
                     </div>
                     
                     <!-- Modal body -->
                     <div class="modal-body">
                        <table class="tg">
                             <tr>
                                 <th class="tg-19u4 text-center">বিভাগের নাম</th>
                                 <td class="tg-nluh" id="previewDivision_id"></td>
                             </tr>
                             <tr>
                                 <th class="tg-19u4 text-center">জেলা</th>
                                 <td class="tg-nluh" id="previewDistrict_id"></td>
                             </tr>
                             <tr>
                                 <th class="tg-19u4 text-center">আদালতের ধরণ </th>
                                 <td class="tg-nluh" id="previewCt_id"></td>
                             </tr>
                             <tr>
                                 <th class="tg-19u4 text-center">আদালতের নাম</th>
                                 <td class="tg-nluh" id="previewCourt_name"></td>
                             </tr>
                         </table>
                     </div>
                     
                     <!-- Modal footer -->
                     <div class="modal-footer">
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                     </div>
                     
                   </div>
                 </div>
             </div>
         </form>
      </div>
   </div>
</div>