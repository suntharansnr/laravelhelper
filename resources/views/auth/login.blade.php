@extends('auth.master')
@section('style')
  <style>
  .btn-facebook {
  	color: #ffffff !important;
  	background-color: #3b5998 !important;
  }
  .btn-google-plus{
    background: #dd4b39;
  }
  </style>
@endsection
@section('meta_tags')

@endsection
@section('content')
<div class="container-fluid" style="background-image:linear-gradient(#01D3D4,#261630);height:100vh !important">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mb-3" style="margin-top:20px;">
              <div class="card-header text-center">
                <h3 class="text-muted">Login</h3>
              </div>
              <div class="card-body">
                <form action="{{route('login')}}" method="POST" >
                   {{ csrf_field() }}
                   @if(session('message'))
                       <div class="alert alert-danger">{{ session('message') }}</div>
                   @endif
                   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                     <label for="exampleInputEmail1">Email address</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="width:3rem;"><i class="fa fa-user-circle bigfonts" aria-hidden="true"></i></div>
                        </div>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Enter email" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                     </div>
                     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                   </div>
                   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                     <label for="exampleInputPassword1">Password</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="width:3rem;"><i class="fa fa-unlock-alt bigfonts" aria-hidden="true"></i></div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Enter password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                     </div>
                   </div>
                   <div class="form-check" style="padding-left:0px">
                     <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                     <label class="form-check-label" for="exampleCheck1">Remember me</label>
                   </div>
                   <hr>
                   <div class="form-group">
                   <button type="submit" class="btn btn-primary btn-block">Login</button>
                   </div>
                   <div class="form-group">
                     <p class="text-muted" style="margin-top:2px;margin-bottom:2px">Or</p>
                   </div>
                   <div class="form-group">
                             <a href="{{ url('/login/facebook') }}" class="btn btn-block btn-facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i> Login with facebook</a>
                   </div>
                   <div class="form-group">
                             <a href="{{ url('/login/google') }}" class="btn btn-block btn-google-plus" style="color:#fff"><i class="fab fa-google" aria-hidden="true"></i> Login with google</a>
                   </div>
                   <a class="btn btn-link" href="{{ route('password.request') }}">
                       Forgot Your Password?
                   </a>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
