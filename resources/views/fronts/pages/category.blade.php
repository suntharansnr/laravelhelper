@extends('fronts.layouts.master')
@section('meta_tags')
        <title>laravelhelper | blogs</title>
@endsection
@section('extra_css')
   <style media="screen">
   .loader {
            width:100px;
            height: 100px;
        }
    </style>
@endsection
@section('content')
{{-- Urgent ad list start --}}
<div class="container-fluid mainwrappad">
  <div class="infinite-scroll">
    <div class="row">
       @if ($posts->count() != 0)
       @foreach ($posts as $post)
       <div class="col-md-4" style="padding-top:5px;padding-bottom:5px">
         <div class="card shadow">
           @if ($post->post_type == "post_with_video")
             <video controls class="img-fluid">
               <source src="{{asset($post->video_path)}}" type="video/mp4">
             </video>
           @else
             <img src="{{asset($post->img_path)}}" class="img-fluid" alt="">
           @endif
           <div class="card-body text-center" style="padding-top:5px;padding-bottom:5px">
               <h5 class="card-title" style="font-weight:600">{{$post->title}}</h5>
               <h6 class="card-subtitle mb-2 text-muted float-left" style="font-size:1rem">By: {{$post->user ? $post->user->name : '' }} on {{date('d-M-Y H:i:s A', strtotime($post->updated_at))}}</h6>
               <h6 class="card-subtitle mb-2 float-left" style="color:#337ab7">{{$post->category ? $post->category->name : ''}}</h6>
           </div>
           <ul class="list-group list-group-flush">
             <li class="list-group-item">
               <!-- <p style="font-size:1rem">{{ Illuminate\Support\Str::limit(strip_tags($post->content,200)) }}</p> -->
               <h6 style="font-weight:500;color:#261630">Total views:{{$post->views_count}}  <a class="stretched-link" href="{{asset('/blog/'.$post->slug)}}" style="text-decoration:none"><i class="far fa-hand-point-right float-right"> Read more</i></a></h6>
              </li>
           </ul>
         </div>
       </div>
       @endforeach
       {{ $posts->links() }}
       @else
       <h3 class="card-title" style="font-weight:600">Sorry no posts found!</h3>
       @endif
    </div>
  </div>
</div>
{{-- Urgent ad list end --}}
@endsection
@section('js')
  <script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="d-block mx-auto loader" src="images/Spin-1s-200px.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
@endsection
