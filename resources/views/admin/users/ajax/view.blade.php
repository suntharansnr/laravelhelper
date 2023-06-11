       <div class="col-md-12">
          <div class="card mb-3" style="margin-top:20px;">
            <div class="card-header">
              <h3><i class="fa fa-users"></i> user details</h3>
              <br>
            </div>

            <div class="card-body">
              <div class="row">
               <div class="col-md-3">
                 <div class="card shadow">
                   <img src="{{asset($user->profile_photo_path)}}" alt="img" style="width:100%" class="img-fluid">
                 </div>
               </div>
               <div class="col-md-9">
                 <div class="card shadow">
                   <div class="card-header bg-primary">
                     <h5>{{$user->address_1}}</h5>
                   </div>
                   <div class="card-body">
                       <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Id:</span><span class="float-right" style="color:#6b7074 !important">{{$user->id}}</span></li>
                       <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Name:</span><span class="float-right" style="color:#6b7074 !important">{{$user->name}}</span></li>
                       <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Email:</span><span class="float-right" style="color:#6b7074 !important">{{$user->email}}</span></li>
                       <li style="color:#6b7074 !important"><span style="font-weight:700 !important;color:#6b7074 !important">Role:</span><span class="float-right" style="color:#6b7074 !important">{{$user->getRoleNames()->first()}}</span></li>
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
