@extends('auth.master')
@section('meta_tags')

@endsection
@section('content')
  <style media="screen">
        #result
        {

        text-shadow:#666;
        }

        a
        {
        color:#000;
        }
        .result{color:#F00;}
        .red{color:red;}
        .orange{color:orange;}
        .green{color:green;}

  </style>
  <div class="container-fluid mainwrappad" style="background-image:linear-gradient(#01D3D4,#261630);height:100vh !important;position:fixed">
  <div class="row justify-content-center">
  <div class="col-md-8 col-lg-6 col-sm-12">
        <div class="card shadow">
          <div class="card-header text-center">
            <h3 class="text-muted">Register</h3>
          </div>
          <div class="card-body">
                <form action="{{route('register')}}" data-parsley-validate novalidate method="post">
                {{ csrf_field() }}
                                          <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="name" data-parsley-trigger="change" maxlength="20" required data-parsley-required-message="The name field is required" placeholder="Enter your name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
                                                    @error ('name')
                                                    <p><span id="result" class="result"> {{$message}} </span></p>
                                                    @enderror
                                                </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <label for="email">Email address<span class="text-danger">*</span></label>
                                                <input type="email" name="email" data-parsley-trigger="change" required data-parsley-required-message="The email address field is required" placeholder="Enter your email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ old('email') }}">
                                                @error ('email')
                                                <p><span id="result" class="result"> {{$message}} </span></p>
                                                @enderror
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-md-6">
                                               <div class="form-group">
                                                   <label for="pass1">Password<span class="text-danger">*</span></label>
                                                   <input name="password" id="pass1" type="password" placeholder="Enter your password" required data-parsley-required-message="The password field is required" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}">
                                                   @error ('password')
                                                   <p><span id="result" class="result"> {{$message}} </span></p>
                                                   @enderror
                                               </div>
                                             </div>
                                             <div class="col-md-6">
                                               <div class="form-group">
                                                   <label for="pass2">Confirm Password <span class="text-danger">*</span></label>
                                                   <input name="password_confirmation" data-parsley-equalto="#pass2" type="password" required data-parsley-required-message="The confirm password field is required" placeholder="Enter your password again" class="form-control" id="pass2">
                                                   @error ('password_confirmation')
                                                   <p><span id="result" class="result"> {{$message}} </span></p>
                                                   @enderror
                                               </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                                <div class="checkbox">
                                                    <input id="agree" type="checkbox" required data-parsley-required-message="You must agree with terms and condition">
                                                    <label for="agree"> I agree </label>
                                                </div>
                                                <div class="checkbox">
                                                  <strong>By clicking Register, you agree to the Terms and Conditions set out by this site, including our Cookie Use.</strong>
                                                </div>
                                          </div>
                                          <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary" type="submit" id="SubmitBtn">
                                                Submit
                                            </button>
                                            <a href="{{route('homepage')}}" class="btn btn-secondary m-l-5">Cancel</a>
                                          </div>

                </form>
          </div>
        </div><!-- end card-->
  </div>
  </div>
  </div>
  <!-- END container-fluid -->
  @endsection
  @section('scripts')
  <script type="text/javascript">
     jQuery(document).ready(function($)
     {
        jQuery('#pass1').keyup(function()
        {
            jQuery('#result').html(checkStrength($('#pass1').val()))
        })
        function checkStrength(password)
               {
                  var strength = 0
                  if (password.length < 6)
                     {
                            $('#result').removeClass();
                            $('#result').addClass('short green');
                            $("#SubmitBtn").attr("disabled", true);
                            return 'Too short(Min length should be 6)'
                     }
                  if (password.length > 7) strength += 1
                  if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
                  if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1
                  if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
                  if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
                  if (strength < 2 )
                     {
                       $('#result').removeClass();
                       $('#result').addClass('weak');
                       $('#result').addClass('green');
                       $("#SubmitBtn").attr("disabled",true);
                       return 'Weak(password should contain atleast one capitalize alphabet and small alphabet)'
                     }
                  else if (strength == 2 )
                     {
                       $('#result').removeClass('green');
                       $('#result').addClass('orange');
                       $("#SubmitBtn").attr("disabled",true);
                       return 'Good(password should contain atleast one special character)'
                     }
                  else
                     {
                       $('#result').removeClass('red');
                       $('#result').removeClass('orange');
                       $('#result').addClass('strong');
                       $('#result').addClass('green');
                       $("#SubmitBtn").attr("disabled",false);
                       return 'Strong'
                     }
               }
     });
  </script>
  @endsection
  @section('js')
    <script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
      });
    </script>
  @endsection
