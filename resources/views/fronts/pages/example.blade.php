@extends('fronts.layouts.master')
@section('meta_tags')
        <title>laravelhelper</title>
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
<div class="container-fluid p-4 mt-4">
    <table class="table table-striped table-bordered table-responsive mt-4">
     <thead>
       <tr>
         <th>Category name</th>
         @for ($i = 0; $i < 31 ; $i++)
         <th>{{$i+1}}</th>
         @endfor
       </tr>
     </thead>
     <tbody>
       @foreach ($finale_data['categories_wise_count'] as $key => $categories)
       <tr>
        <td>{{$key}}</td>
         @for ($i = 0; $i < 31 ; $i++)
         <td>{{$i+1}}</td>
         @endfor  
       </tr>
       @endforeach
     </tbody>
    </table>
</div>

@endsection
@section('js')
@endsection