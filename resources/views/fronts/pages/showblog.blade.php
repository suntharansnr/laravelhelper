@extends('fronts.layouts.master')
@section('meta_tags')
        <title>Plusiunedevelopers | {{$post->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
        <meta name="description" content="{{strip_tags(Str::limit($post->content,200))}}">
        <meta name="keywords" content="laravel helper">
        <link rel="author" href="https://plus.google.com/suntharansnr" />
        <link rel="canonical" href="{{url()->current()}}" />

        <meta property="og:url" content="{{url()->current()}}">
        <meta property="og:image" content="{{asset($post->img_path)}}">
        <meta property="og:description" content="{{strip_tags(Str::limit($post->content,200))}}">
        <meta property="og:title" content="{{$post->title}}">
        <meta property="og:site_name" content="plusiunedevelopers.xyz">
        <meta property="og:see_also" content="{{url()->current()}}">

        <meta itemprop="name" content="{{$post->title}}">
        <meta itemprop="description" content="{{strip_tags(Str::limit($post->content,200))}}">
        <meta itemprop="image" content="{{asset($post->img_path)}}">

        <meta name="twitter:card" content="summary">
        <meta name="twitter:url" content="{{url()->current()}}">
        <meta name="twitter:title" content="{{$post->title}}">
        <meta name="twitter:description" content="{{strip_tags(Str::limit($post->content,200))}}">
        <meta name="twitter:image" content="{{asset($post->img_path)}}">
@endsection
@section('css')
<style media="screen">
  .loading {
    background: lightgrey;
    padding: 15px;
    position: fixed;
    border-radius: 4px;
    left: 50%;
    top: 50%;
    text-align: center;
    margin: -40px 0 0 -50px;
    z-index: 2000;
    display: none;
  }
</style>



<!--social media sharing styles starts -->
<style media="screen">
  .xmas ul {
    position: relative;
    margin: 0 auto;
    padding: 0;
    text-align: center;
    width: 70%;
    display: flex;
    background: rgba(0, 0, 0, 0.2);
    transition: 0.5s;
  }

  .xmas ul li {
    list-style: none;
    width: 20%;
    box-sizing: border-box;
  }

  .xmas ul li a {
    color: #fff;
    font-size: 20px;
    margin: 10px;
    display: inline-block;
  }

  .xmas ul li:nth-child(1) {
    background: #3b5999;
  }

  .xmas ul li:nth-child(2) {
    background: #55acee;
  }

  .xmas ul li:nth-child(3) {
    background: #dd4b39;
  }

  .xmas ul li:nth-child(4) {
    background: #0077B5;
  }

  .xmas ul li:nth-child(5) {
    background: #8a3ab9;
  }
</style>
<!--social media sharing styles ends -->
@endsection

@section('content')
<div class="container text-center pt-2 pb-2 shadow" style="margin-top: 100px;background-color:#55acee;width:50%">
<a href="https://backendeasysale.plusiunedevelopers.xyz/ad/106/laravel-real-estate-site-for-sale-with-admin-panel-at-20" class="link-stretched text-decoration-none text-white">
  <h3>Looking for ready made laravel scripts</h3>
</a>
</div>
<div class="container-fluid">
  <h3 class="text-center"> <a>{{$post->title}} </a> <button class="badge badge-info"></button> </h3>
  <div class="container-fluid blog-container" style="background-color:#ffffff;margin-top:30px;padding:20px;padding-right:10px !important;">
    <div class="row">
      <div class="col-md-9 pt-4">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <h6 class="float-left" style="font-size:1rem">Posted on:{{date('d-M-Y H:i:s A', strtotime($post->updated_at))}}</h6>
          </div>
          <div class="col-md-6 col-sm-12">
            <h6 class="float-right sm-left" style="font-size:1rem">Posted by:{{$post->user ? $post->user->name : ''}}</h6>
          </div>
        </div>
        <div class="text-center">
          <!-- @if ($post->post_type == "post_with_video")
      <video controls class="img-fluid">
        <source src="{{asset($post->video_path)}}" type="video/mp4" class="blogimg">
      </video>
      @else
      <img src="{{asset($post->img_path)}}" alt="" class="blogimg">
      @endif -->
          <hr>
          <h6 style="color:#337ab7">{{$post->category ? $post->category->name : ''}}</h6>
          <hr>
        </div>
        <div class="post-description" style="width: 100%;overflow:scroll-x;">
          {!! $post->content !!}
        </div>

      <div class="row" style="padding:0px !important">
        <div class="col-md-12" style="padding-top:10px">
          <div class="articles" id="content">
              @include('fronts.pages.ajaxcomment')
          </div>
          <hr/>
          @if (Auth::user())
            <h4>Add comment</h4>
            <form id="frm">
                @csrf
                <div class="form-group">
                    <textarea name="body" class="form-control rounded-0" rows="5" cols="80"></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                </div>
                <div class="form-group text-center">
                    <button type="button" align="center" class="btn btn-info btn-small rounded-0" id="submit">Post Comment</button>
                </div>
            </form>
          @else
            <h4 style="margin-bottom:0px">Please login to comment <span><a href="{{route('login')}}" class="badge badge-info badge-small">login</a></span> </h4>
          @endif
        </div>
        <div class="col-md-4" align="right">
        </div>
      </div>

      </div>
      <div class="col-md-3">
         <div class="card shadow"> 
              <ul class="list-group list-group-flush">
                @foreach($cat_data as $category)
                <li class="list-group-item">
                    <a href="{{route('blogs.category',$category['cat_id'])}}">{{ $category['cat_name'] }}
                    <span class="badge badge-success float-right">{{$category['cat_count']}}</span>
                    </a>
                </li>
                @endforeach
              </ol>
         </div>
      </div>
    </div>
  </div>
</div>

<!-- <div class="container-fluid" style="padding-left:7% !important;padding-right:7% !important;padding-top:0px;padding-bottom:0px !important;">
  <h4 style="color:#337ab7;margin-bottom:0px;">Related posts</h4>
</div>
<div class="col-md-12" style="padding-left:7% !important;padding-right:7% !important;padding-top:0px;padding-right:0px;margin-top:1px;">
  <hr>
</div>

<div class="container-fluid" style="padding-left:6% !important;padding-right:6% !important;padding-bottom:10px;">
  <div class="row">
    @foreach ($related as $post)
    <div class="col-md-4" style="padding-top:5px;padding-bottom:5px">
      <div class="card shadow">
        @if ($post->post_type == "post_with_video")
        <video controls class="img-fluid">
          <source src="{{asset($post->video_path)}}" type="video/mp4">
        </video>
        @else
        <img src="{{asset($post->img_path)}}" class="img-fluid" alt="">
        @endif
        <div class="card-body text-center" style="padding-top:5px;padding-bottom:5px;">
          <h3 class="card-title" style="font-weight:600">{{$post->title}}</h3>
          <h6 class="card-subtitle mb-2 text-muted float-left" style="font-size:1rem">By: {{$post->user ? $post->user->name : ''}}</h6> on {{date('d-M-Y H:i:s A', strtotime($post->updated_at))}}</h6>
          <h6 class="card-subtitle mb-2 float-left" style="color:#337ab7">{{$post->category ? $post->category->name : ''}}</h6>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <p style="font-size:1rem">{{ Illuminate\Support\Str::limit(strip_tags($post->content,200)) }}</p>
            <a href="{{asset('/blog/'.$post->slug)}}" style="text-decoration:none"><i class="far fa-hand-point-right float-right"> Read more</i></a>
          </li>
        </ul>
      </div>
    </div>
    @endforeach
  </div>
</div> -->


<div class="modal fade bd-example-modal-lg" id="subscribeModal" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" id="modal_content">
          <div class="modal-header">
              <h5 class="modal-title">Subscribe here!</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
         </div>
         <div class="modal-body">
                  <form id="my-form">
                        <div class="form-group">
                          <input type="email" class="form-control rounded-0" name="email" required placeholder="Email Address">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded-0">Submit</button>
                  </form>
         </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content" id="modal_content" style="padding:0px !important;">
               <div class="col-md-12" style="padding:0px !important;">
                     <div class="card mb-3 rounded-0 shadow-lg" style="margin-bottom:0px !important;">
                       <div class="card-header">
                         <h3 id="form-add-edit"><i class="fa fa-edit"> Edit comment</i>
                          <span class="float-right">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                          </span> </h3>
                       </div>
                       <div class="card-body">
                         <form id="editfrm">
                           <div class="form-group">
                             <textarea name="body" class="form-control rounded-0" rows="5" cols="80" id="edit_body"></textarea>
                             <input type="hidden" name="comment_id" value="" id="edit_comment_id"/>
                           </div>
                           <div class="form-group">
                             <button type="button"class="btn btn-info btn-small rounded-0 editSubmit">Edit Comment</button>
                           </div>
                         </form>
                       </div>
                     </div><!-- end card-->
               </div>
          </div>
        </div>
   </div>
@endsection
@section('js')
<script>
  $(document).ready(function(){
    var is_modal_show = sessionStorage.getItem('isShown');
    if(is_modal_show != '☺'){
      $("#subscribeModal").modal('show');
      sessionStorage.setItem('isShown','☺');
    }
  });
</script>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>

<script type="text/javascript">
  $('#report').click(function (e) {
      e.preventDefault();
      // Serialize the entire form:
      var formdata = new FormData(this.form);
      $.ajax(
        {
        url: "{{ route('report.store') }}",
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (data) {
            $('#reportfrm').trigger("reset");
            $('#exampleModalCenter').modal('hide');
            toastr.success('success', 'Thank you for your concern');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
  });
  </script>

  <script type="text/javascript">
  $('body').on('click', '.editcomment', function () {
      $('#ajaxModel').modal('show');
      var comment_id = $(this).data("id");
      $.get("{{asset("")}}comment/edit" +'/' + comment_id, function (data) {
          $('#edit_body').val(data.body);
          $('#edit_comment_id').val(data.id);
      })
  });
  </script>


  <script type="text/javascript">
         jQuery(document).ready(function(){
             $('body').on('click', '.editSubmit', function(e) {
               e.preventDefault();
               $('.loading').show();
               $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
               });
               $.ajax({
                  url: "{{route('comment.update')}}",
                  method: 'post',
                  data: {
                     body: jQuery('#edit_body').val(),
                     id: jQuery('#edit_comment_id').val()
                  },
                  success: function (data) {
                      $('.loading').hide();
                      $('#editfrm').trigger("reset");
                      $('#ajaxModel').modal('hide');
                      var url = window.location.href;
                      getRajVFX(url);
                      window.history.pushState("", "", url);
                  },
                  error: function (data) {
                      console.log('Error:', data);
                      $('#editsubmit').html('Save Changes');
                  }
                });
               });
            });
  </script>


  <script type="text/javascript">
  $('#submit').click(function (e) {
      e.preventDefault();

      $('.loading').show();

      // Serialize the entire form:
      var data = new FormData(this.form);
      $.ajax({
        url: "{{ route('comments.store') }}",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (data) {
            $('.loading').hide();
            $('#frm').trigger("reset");
//          ajaxLoad(data.redirect_url);
            var url = window.location.href;
            getRajVFX(url);
            window.history.pushState("", "", url);
        },
        error: function (data) {
            console.log('Error:', data);
            $('#submit').html('Save Changes');
        }
    });
  });
  </script>

  <script type="text/javascript">
         jQuery(document).ready(function(){
             $('body').on('click', '.ajaxSubmit', function(e) {
               e.preventDefault();
               $('.loading').show();
               var btn_id = $(this).data("id");
  //           alert(btn_id);
               $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
               });
               $.ajax({
                  url: "{{ route('comments.store') }}",
                  method: 'post',
                  data: {
                     body: jQuery('#body'+btn_id).val(),
                     post_id: jQuery('#property_id'+btn_id).val(),
                     parent_id: jQuery('#parent_id'+btn_id).val()
                  },
                  success: function (data) {
                      $('.loading').hide();
                      $('#frm').trigger("reset");
          //          ajaxLoad(button.data('href'),'modal_contentRaj');
                      var url = window.location.href;
                      getRajVFX(url);
                      window.history.pushState("", "", url);
                  },
                  error: function (data) {
                      console.log('Error:', data);
                      $('#submit').html('Save Changes');
                  }
                });
               });
            });
  </script>
  <script type="text/javascript">
  function getRajVFX(url) {
      $.ajax({
          url : url
      }).done(function (data) {
          $('.articles').html(data);
      }).fail(function () {
          alert('Articles could not be loaded.');
      });
  }
  </script>
  <script type="text/javascript">
          document.documentElement.setAttribute("lang", "en");
          document.documentElement.removeAttribute("class");
  </script>

  <script type="text/javascript">
  $('body').on('click', '.deleteComment', function () {
      var product_id = $(this).data("id");
      {
          Swal.fire({
              title: "Are you sure?",
              text: "Please ensure and then confirm!",
              confirmButtonText: "Yes, delete the comment!",
              type: "warning",
              showCancelButton: !0,
              cancelButtonText: "No, cancel!",
              reverseButtons: !0
          }).then(function (e) {

              if (e.value === true) {
                $.ajaxSetup({
                     headers: {
                               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                            });
                  $.ajax({
                    type: "DELETE",
                    url: "{{url('comment/')}}/" + product_id,
                    success: function (data) {
                        toastr.error('Deleted', 'Comment deleted successfully');
                        $('.loading').hide();
                        var url = window.location.href;
                        getRajVFX(url);
                        window.history.pushState("", "", url);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                  });

              } else {
                  e.dismiss;
              }

          }, function (dismiss) {
              return false;
          })
      }
  });
  $('body').on('click','.favorite', function(e) {
    if ( $(this).hasClass("noClick") ) {
        e.preventDefault;
    } else {
        var elem = $(this);
        $(this).addClass("noClick");
        var post_id = $(this).data('id');
        $.ajax({
          type: "get",
          dataType: 'json',
          data: {'id': post_id},
          url: "{{route('favorite.store')}}",
          success: function (data) {
              toastr.success('Added', 'Property saved as favorite');
              window.location.reload();
          },
          error: function (data) {
              console.log('Error:', data);
          }
        })
    }
  })

  $('body').on('click', '.remove-favorite', function () {
      var product_id = $(this).data("id");
      {
          Swal.fire({
              title: "Are you sure?",
              text: "Please ensure and then confirm!",
              confirmButtonText: "Yes, remove this from favorite!",
              type: "warning",
              showCancelButton: !0,
              cancelButtonText: "No, cancel!",
              reverseButtons: !0
          }).then(function (e) {

              if (e.value === true) {
                $.ajaxSetup({
                     headers: {
                               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                            });
                  $.ajax({
                    type: "DELETE",
                    url: "{{url('favorite/delete')}}/" + product_id,
                    success: function (data) {
                        toastr.error('removed', 'Removed from favorite');
                        window.location.reload();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                  });

              } else {
                  e.dismiss;
              }

          }, function (dismiss) {
              return false;
          })
      }
  });
  </script>
@endsection