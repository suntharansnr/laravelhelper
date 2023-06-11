@extends('admin.layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')
@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'Theme'])

<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header" id="proraj" style="display:none">
                <h3>Edit Profile</h3>
                Edit your profile!
              </div>

              <div class="card-header" id="editrajpro">
                <h3>Theme settings </h3>
                You can edit the theme of the site!
                <button type="button" name="edit" id="edit" class="editProfile btn btn-primary btn-sm"><i class="fa fa-edit"></i>Edit</button>
              </div>
              <div class="card-body" id="contentfrm" style="display:none">
                <form id="frm" name="frm" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                                          <input type="hidden" name="id" value="" id="social_id">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="userName">Additional css</label>
                                                  <textarea name="additional_css" rows="5" cols="80" placeholder="Additional css" class="form-control" id="additional_css"></textarea>
                                                  <p class="text-info">Please notice! no need to write style tags</p>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="userName">Additional js</label>
                                                  <textarea rows="5" cols="80" name="additional_js" value="" placeholder="Additional js" placeholder="Additional js" class="form-control" id="additional_js"></textarea>
                                                  <p class="text-info">Please notice! no need to write script tags</p>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="userName">Google map embedded code</label>
                                                  <textarea rows="5" cols="80" name="Google_map_embedded_code" value="" placeholder="Google map embedded code" class="form-control" id="Google_map_embedded_code"></textarea>
                                              </div>
                                          </div>
                                          <hr>

                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="footer_about_us">Footer about us</label>
                                              <textarea rows="5" cols="80" name="footer_about_us" value="" placeholder="Footer about us" id="footer_about_us" class="form-control"></textarea>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userName">Phone number</label>
                                                    <input type="text" name="Phone_number" value="" placeholder="Phone number" class="form-control" id="Phone_number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userName">Email address</label>
                                                    <input data-parsley-type='email' name="email_address" value="" placeholder="Email address" class="form-control" id="email_address">
                                                </div>
                                            </div>
                                          </div>
                                          <div class="row">

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="logo">Logo<span class="text-danger">*</span></label>
                                                  <input type="file" name="logo" id="logo" data-parsley-trigger="change"  data-parsley-filemaxmegabytes="2" data-parsley-filemimetypes="image/jpeg,image/png" class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}" value="{{ old('logo') }}">
                                              </div>
                                            </div>

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="welcome_banner">Welcome banner<span class="text-danger">*</span></label>
                                                  <input type="file" name="welcome_banner" id="welcome_banner" data-parsley-trigger="change"  data-parsley-filemaxmegabytes="2" data-parsley-filemimetypes="image/jpeg,image/png" class="form-control{{ $errors->has('welcome_banner') ? ' is-invalid' : '' }}" value="{{ old('welcome_banner') }}">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="logo">The current logo</label>
                                                  <span id="current_logo"></span>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="welcome_banner">The current welcome banner</label>
                                                  <span id="current_welcome_banner"></span>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="userName">Company name</label>
                                                <input type="text" name="company_name" value="" placeholder="Company name" class="form-control" id="company_name">
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="userName">Footer address</label>
                                                <input type='text' name="Footer_address" value="" placeholder="Footer address" class="form-control" id="Footer_address">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="footer_left_text">Footer left text</label>
                                                <input type="text" name="footer_left_text" value="" placeholder="Footer left text" class="form-control" id="footer_left_text">
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="userName">Footer right text</label>
                                                <input type="text" name="footer_right_text" value="" placeholder="Footer right text" class="form-control" id="footer_right_text">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary" type="submit" id="submit">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary m-l-5 cancel">
                                                Cancel
                                            </button>
                                          </div>

                </form>
              </div>
              <div class="card-body" id="content">
                <table class="table table-striped table-bordered table-responsive" id="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>{{$theme->id}}</th>
                        </tr>
                    </thead>

                    <tbody>
                      <tr>
                          <th scope="row">Logo</th>
                          <td><img src="{{asset("$theme->logo")}}" alt="" style="width:150px !important;height:100px !important;"></td>
                      </tr>
                      <tr>
                          <th scope="row">Welcome banner</th>
                          <td><img src="{{asset("$theme->welcome_banner")}}" alt="" style="width:150px !important;height:100px !important;"></td>
                      </tr>
                      <tr>
                          <th scope="row">Additional css</th>
                          <td>{{$theme->additional_css}}</td>
                      </tr>
                      <tr>
                          <th scope="row">Additional js</th>
                          <td>{{$theme->additional_js}}</td>
                      </tr>
                      <tr>
                          <th scope="col" width="25%">Google map embedded code</th>
                          <td width="75%">{{$theme->Google_map_embedded_code}}</td>
                      </tr>
                      <tr>
                          <th scope="col">Phone number</th>
                          <td>{{ $theme->Phone_number }}</td>
                      </tr>
                      <tr>
                          <th scope="col">Email address</th>
                          <td>{{$theme->email_address}}</td>
                      </tr>
                      <tr>
                          <th scope="col">Company name</th>
                          <td>{{$theme->company_name}}</td>
                      </tr>
                      <tr>
                          <th scope="col">Footer left text</th>
                          <td>{{$theme->footer_left_text}}</td>
                      </tr>
                      <tr>
                          <th scope="col">Footer right text</th>
                          <td>{{$theme->footer_right_text}}</td>
                      </tr>
                      <tr>
                          <th scope="col">Footer address</th>
                          <td>{{$theme->Footer_address}}</td>
                      </tr>
                      <tr>
                          <th scope="col">Footer about us</th>
                          <td>{{$theme->footer_about_us}}</td>
                      </tr>
                    </tbody>
                </table>
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
  var href1 = '{{route('theme.edit',$theme->id)}}';
  $(function () {
    $('body').on('click', '.editProfile',function (event) {
    $("#contentfrm").show();
    $("#content").hide();
    $("#edit").hide();
    $("#proraj").hide();
    $('#contentfrm').parsley().reset()
    $.get(href1, function (data) {
        $('#form-add-edit').html("Edit User");
        $('#saveBtn').val("edit-user");
        $('#ajaxModel').modal('show');
        $('#social_id').val(data.id);
        $('#additional_css').val(data.additional_css);
        $('#additional_css').val(data.additional_css);
        $('#additional_js').val(data.additional_js);
        $('#Google_map_embedded_code').val(data.Google_map_embedded_code);
        $('#Phone_number').val(data.Phone_number);
        $('#email_address').val(data.email_address);
        $('#company_name').val(data.company_name);
        $('#current_logo').html("<img src={{ URL::to('/') }}/" + data.logo + " width='150px' height='100px'/>");
        $('#current_welcome_banner').html("<img src={{ URL::to('/') }}/" + data.welcome_banner + " width='150px' height='100px'/>");
        $('#footer_left_text').val(data.footer_left_text);
        $('#footer_right_text').val(data.footer_right_text);
        $('#Footer_address').val(data.Footer_address);
        $('#footer_about_us').val(data.footer_about_us);

        if (data.logo == null) {
          $('#logo').prop('required',true);
        }
        else{
          $('#logo').prop('required',false);
        }

        if (datawelcome_banner == null) {
          $('#welcome_banner').prop('required',true);
        }
        else{
          $('#welcome_banner').prop('required',false);
        }
    })
    });



   $('#submit').click(function (e) {
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
         url: "{{ route('theme.store') }}",
         type: "POST",
         data: data,
         processData: false,
         contentType: false,
         dataType: 'json',
         success: function (data) {
           $('.loading').hide();
           $('#frm').trigger("reset");
           $("#contentfrm").hide();
           $("#content").show();
           $("#edit").show();
           ajaxLoad("{{route("theme.index")}}",'content');
         },
         error: function (data) {
             console.log('Error:', data);
             $('.loading').hide();
         }
     });
      }
   });

  });
</script>

<script type="text/javascript">
function ajaxLoad(filename, content) {
content = typeof content !== 'undefined' ? content : 'content';
$('.loading').show();
$.ajax({
   type: "GET",
   url: filename,
   contentType: false,
   success: function (data) {
       $("#" + content).html(data);
       $('.loading').hide();
   },
   error: function (xhr, status, error) {
       alert(xhr.responseText);
       $('.loading').hide();
   }
});
}
</script>
<script type="text/javascript">
    $('#modalForm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    ajaxLoad(button.data('href'),'modal_contentRaj');
    });

    $('#modalForm').on('shown.bs.modal', function () {
      $('#focus').trigger('focus')
    });
</script>

<script type="text/javascript">
  $('body').on('click', '.cancel',function (event) {
    $("#contentfrm").hide();
    $("#content").show();
    $("#edit").show();
  });
</script>
@endsection
