@extends('fronts.layouts.master')
@section('meta_tags')
        <title>laravelhelper | blogs</title>
  <meta name=google-site-verification content="">
  <meta name=yandex-verification content="">
  <meta name=msvalidate.01 content="">
  <link rel="shortcut icon" type=image/png href=https://www.laravelhelper.monster/assets/images/logo.png>
  <meta name=p:domain_verify content="">
  <meta property="fb:app_id" content="">
  <title>Laravelhelper.monster | Web Development Tutorials & Solutions - Laravelhelper.monster</title>
  <meta name=description
    content="Laravelhelper website focuses on all web language and framework tutorial PHP, Laravel, Codeigniter, Nodejs, API, MySQL, AJAX, jQuery, JavaScript, Demo">
  <meta name=keywords
    content="laravel helper of it programming language,php,laravel 9,jquery,javascript,mysql,git,html,css,MySQL,HTML,CSS,git,AJAX,bootstrap, jQuery,JavaScript,Designing,Demo,laravelhelper.">
  <meta name=twitter:image content="https://www.laravelhelper.monster/upload/laravelhelper.png">
  <link rel=canonical href=https://www.laravelhelper.monster>
  <meta property="og:description"
    content="Laravelhelper website focuses on all web language and framework tutorial PHP, Laravel, Codeigniter, Nodejs, API, MySQL, AJAX, jQuery, JavaScript, Demo">
  <meta property="og:title" content="Laravelhelper.monster | Web Development Tutorials & Solutions">
  <meta property="og:url" content="https://www.laravelhelper.monster">
  <meta property="og:image:url" content="https://www.laravelhelper.com/upload/laravelhelper.png">
  <meta content="https://www.facebook.com/rajvarman" property="article:publisher">
  <meta content="https://www.facebook.com/rajvarman" property="article:author">
  <meta content="Raj varman" name=author>
  <meta name=twitter:title content="Laravelhelper.monster | Web Development Tutorials & Solutions">
  <meta name=twitter:site content="https://www.laravelhelper.monster">
  <meta name=twitter:description
    content="Laravelhelper.monster website focuses on all web language and framework tutorial PHP, Laravel, Codeigniter, Nodejs, API, MySQL, AJAX, jQuery, JavaScript, Demo">   
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
       @if(isset($posts) && $posts->count() != 0)
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
             <!-- <li class="list-group-item">
               <p style="font-size:1rem">{{ Illuminate\Support\Str::limit(strip_tags($post->content,200)) }}</p>
              </li> -->
              <li  class="list-group-item">
                <h6 style="font-weight:500;color:#261630">Total views:{{$post->views_count}}  <a class="stretched-link" href="{{asset('/blog/'.$post->slug)}}" style="text-decoration:none"><i class="far fa-hand-point-right float-right"> Read more</i></a></h6>
              </li>
           </ul>
         </div>
       </div>
       @endforeach
       @else
       <h3 class="card-title" style="font-weight:600">Sorry no posts found!</h3>
       @endif
    </div>
  </div>
</div>
{{-- Urgent ad list end --}}
@endsection
@section('js')
@endsection
☺