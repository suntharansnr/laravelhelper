@extends('fronts.layouts.master')
@section('meta_tags')
        <title>laravelhelper | {{$post->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
        <meta name="description" content="{{strip_tags(Str::limit($post->content,200))}}">
        <meta name="keywords" content="laravel helper">
        <link rel="author" href="https://plus.google.com/suntharansnr" />
        <link rel="canonical" href="{{url()->current()}}" />

        <meta property="og:url" content="{{url()->current()}}">
        <meta property="og:image" content="{{asset($post->img_path)}}">
        <meta property="og:description" content="{{strip_tags(Str::limit($post->content,200))}}">
        <meta property="og:title" content="{{$post->title}}">
        <meta property="og:site_name" content="laravelhelper.xyz">
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
<div class="container-fluid">
  <h3 class="text-center"> <a>{{$post->title}} </a> </h3>
  <div class="container-fluid blog-container" style="background-color:#ffffff;margin-top:30px;padding:20px;padding-right:10px !important;">
    <div class="row">
      <div class="col-md-8 pt-4">
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
        <div class="post-description">
          {!! $post->content !!}
        </div>
      </div>
      <div class="col-md-4">
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
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
@endsection