  <div class="col-md-12" style="margin-top:20px;">
    <div class="card mb-3">
      <div class="card-header">
        <h3><i class="fa fa-users"></i> Property details</h3>
        <br>
      </div>

      <div class="card-body">
        <div class="row">
         <div class="col-md-3">
           <div class="card shadow">
             <img src="{{asset('/'.$pro->image)}}" alt="" style="width:100%">
           </div>
         </div>
         <div class="col-md-9">
           <div class="card shadow">
             <div class="card-header bg-primary">
               <h5>{{$pro->address_1}}</h5>
             </div>
             <div class="card-body">
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Sale type:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->sale_type}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Property type:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->property_type}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Address 1:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->address_1}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Address 2:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->address_2}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">City:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->city}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Province:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->province}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Postalcode:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->postalcode}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Price:</span><span class="float-right" style="color:#6b7074 !important">{{number_format($pro->price,2)}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Beds:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->beds}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Baths:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->baths}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Area:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->area}}</span></li>
             </div>
           </div>
         </div>
       </div>
      </div>

      <div class="card-footer">
        <button type="reset" class="btn btn-secondary m-l-5 float-right" data-dismiss="modal">
            Close
        </button>
      </div>

    </div><!-- end card-->
  </div>
