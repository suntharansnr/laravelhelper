<div class="container-fluid" style="padding:30px;background-color:#efefef;min-height:100vh">
  <div class="card mb-3">
    <div class="card-header">
      <div class="col-md-12">
      <h3>{{$testimonial->name}}</h3>
      </div>
    </div>

    <div class="card-body">
       <div class="col-md-12">
         <div class="card shadow">
           <img src="{{asset('/'.$testimonial->img_path)}}" alt="" style="width:100%">
         </div>
       </div>
       <div class="col-md-12">
             <p>{!! $testimonial->content!!}</p>
       </div>
    </div>
    <div class="card-footer">
      <button type="reset" class="btn btn-secondary m-l-5 float-right" data-dismiss="modal">
          Close
      </button>
    </div>
  </div>
</div>
