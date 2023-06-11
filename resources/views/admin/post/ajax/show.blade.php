  <div class="col-md-12" style="margin-top:20px;">
    <div class="card mb-3">
      <div class="card-header">
        <h3><i class="fa fa-users"></i> Post details</h3>
        <br>
      </div>

      <div class="card-body">
        <div class="row">
         <div class="col-md-3">
           <div class="card shadow">
             <img src="{{asset('/'.$pro->img_path)}}" alt="" style="width:100%">
           </div>
         </div>
         <div class="col-md-9">
           <div class="card shadow">
             <div class="card-header bg-primary">
               <h5>{{$pro->address_1}}</h5>
             </div>
             <div class="card-body">
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Post type:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->post_type}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Title:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->title}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Url:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->title}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Category:</span><span class="float-right" style="color:#6b7074 !important">{{$pro->category ? $post->category->name : 'Not found'}}</span></li>
                 <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Content:</span></li>
                 <p>{!! $pro->content !!}</p>
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
