@extends('layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')

@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'password'])
<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3" style="width:50%;margin-left:25%;">
              <div class="card-header" id="editrajpro">
                <h3>Change password </h3>
                You can change your password!
              </div>
              <div class="card-body" id="contentfrm">
                <form id="" name="frm" class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('profile.change_password')}}" data-parsley-validate>
                                          @csrf
                                          <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="current_password">Current password<span class="text-danger">*</span></label>
                                                    <input type="password" name="current_password" required placeholder="Enter your previous password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}">
                                                    @error('current_password')<p class="text-danger">The current password is not match with your old password</p>@enderror
                                                </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="new_password">New passwords<span class="text-danger">*</span></label>
                                                    <input type="password" name="new_password" id="new_password" required placeholder="Enter the new password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}">
                                                    @error('new_password')<p class="text-danger">{{$message}}</p>@enderror
                                                </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="new_confirm_password">Confirm password<span class="text-danger">*</span></label>
                                                  <input type="password" name="new_confirm_password" id="new_confirm_password" required placeholder="Enter the new password again" class="form-control{{ $errors->has('new_confirm_password') ? ' is-invalid' : '' }}">
                                                  @error('new_confirm_password')<p class="text-danger">{{$message}}</p>@enderror
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group m-b-0">
                                            <button class="btn btn-primary" type="submit"  title="disabled for demo account">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary m-l-5" data-dismiss="modal">
                                                Cancel
                                            </button>
                                          </div>

                </form>
              </div>
  </div>
</div>


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

@include('admin.inc.loader')

@endsection

@section('js')
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
