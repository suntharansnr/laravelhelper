@extends('admin.layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection

@section('css')

@endsection


@section('content')
@include('admin.inc.breadcrumb',['page' => 'Profile'])

<div class="container-fluid" style="padding:30px;min-height:100vh;background-color:#fff;">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Change password</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <table class="table table-striped table-bordered mt-2" id="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <td>{{Auth::user()->id}}</td>
                        </tr>
                    </thead>

                    <tbody>
                      <tr>
                          <th scope="row">Avatar</th>
                          <td id="view_image"><img src="{{asset(Auth::user()->profile_photo_path)}}" alt="" style="width:100px !important;height:100px !important;border-radius:100%"></td>
                      </tr>
                      <tr>
                          <th scope="row">Name</th>
                          <td id="view_name">{{Auth::user()->name}}</td>
                      </tr>

                      <tr>
                          <th scope="col">Email</th>
                          <td id="view_email">{{Auth::user()->email}}</td>
                      </tr>

                      <tr>
                          <th scope="col">Role</th>
                          <td>
                            {{ Auth::user()->getRoleNames()->first() }}
                          </td>
                      </tr>
                      <tr>
                          <th scope="col">Status</th>
                          <td>
                            @if (Auth::user()->user_status == 1)
                            Active
                            @else
                            Suspend
                            @endif
                         </td>
                      </tr>
                    </tbody>
                </table>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <form id="frm" name="frm" class="form-horizontal mt-2" enctype="multipart/form-data" data-parsley-validate>
                                          <input type="hidden" name="id" id="user_id" value="{{Auth::user()->id}}">
                                          <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" value="{{Auth::user()->name}}" id="name" data-parsley-trigger="change" maxlength="20" required placeholder="Enter users name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="email">Email address<span class="text-danger">*</span></label>
                                                  <input type="email" name="email" value="{{Auth::user()->email}}" id="email" data-parsley-trigger="change" required placeholder="Enter email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                                              </div>
                                            </div>
                                          </div>


                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="image">Profile picture<span class="text-danger">*</span></label>
                                                  <input type="file" name="image" id="image" data-parsley-trigger="change"  data-parsley-filemaxmegabytes="2" data-parsley-filemimetypes="image/jpeg,image/png" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('image') }}">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="profile_picture">Current profile picture</label>
                                                  <div class="col-md-3">
                                                  <span id="store_image">
                                                        <img src="{{Auth::user()->profile_photo_path}}" width='150px' height='150px' style='border-radius:50% !important'/>
                                                  </span>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary submit" type="submit" id="submit">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary m-l-5 cancel">
                                                Cancel
                                            </button>
                                          </div>

                </form>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  <form id="" name="frm" class="form-horizontal mt-2" method="post" enctype="multipart/form-data" action="{{route('profile.change_password')}}" data-parsley-validate>
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

@include('admin.inc.loader')
@endsection

@section('scripts')
<script type="text/javascript">
var app = app || {};

// Utils
(function ($, app) {
  'use strict';

  app.utils = {};

  app.utils.formDataSuppoerted = (function () {
      return !!('FormData' in window);
  }());

}(jQuery, app));

// Parsley validators
(function ($, app) {
  'use strict';

  window.Parsley
      .addValidator('filemaxmegabytes', {
          requirementType: 'string',
          validateString: function (value, requirement, parsleyInstance) {

              if (!app.utils.formDataSuppoerted) {
                  return true;
              }

              var file = parsleyInstance.$element[0].files;
              var maxBytes = requirement * 1048576;

              if (file.length == 0) {
                  return true;
              }

              return file.length === 1 && file[0].size <= maxBytes;

          },
          messages: {
              en: 'File is to big'
          }
      })
      .addValidator('filemimetypes', {
          requirementType: 'string',
          validateString: function (value, requirement, parsleyInstance) {

              if (!app.utils.formDataSuppoerted) {
                  return true;
              }

              var file = parsleyInstance.$element[0].files;

              if (file.length == 0) {
                  return true;
              }

              var allowedMimeTypes = requirement.replace(/\s/g, "").split(',');
              return allowedMimeTypes.indexOf(file[0].type) !== -1;

          },
          messages: {
              en: 'File mime type not allowed'
          }
      });

}(jQuery, app));
</script>
<script type="text/javascript">
  $(function () {
    $('body').on('click','.submit',function(e) {
        e.preventDefault();
        $('.loading').show();
        $('#frm').parsley().validate();
        if ( $('#frm').parsley().isValid() ) {
        // Serialize the entire form:
        var data = new FormData(this.form);
        $.ajaxSetup({
                         headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                   });
        $.ajax({
          url: "{{ route('profile.updateprofile') }}",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (data) {
              if($.isEmptyObject(data.error)){
              $("#name").val(data.name);
              $("#email").val(data.email);
              $('#store_image').html("<img src={{ URL::to('/') }}/" + data.profile_photo_path + " width='150px' height='150px' style='border-radius:50% !important'/>");
  
              $("#view_name").html(data.name);
              $("#view_email").html(data.email);
              $('#view_image').html("<img src={{ URL::to('/') }}/" + data.profile_photo_path + " width='150px' height='150px' style='border-radius:50% !important'/>");
  
              $('.loading').hide();
              toastr.success('Profile updated successfully');
              }else{
                    $.each( data.error, function( key, value ) {
                    toastr.error(value);
                    });
                    $('.loading').hide();
                }
              
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
       }
       else{
        $('.loading').hide();
       }
    });
  });
</script>
@endsection


