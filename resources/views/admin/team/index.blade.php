@extends('layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')
@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'Team'])

<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-building"></i> Team details</h3>
                As an admin you can manage all the team details!
                <a role="button" href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="createNewtestimonial">Create New Team <i class="fa fa-plus"></i></a>
              </div>
              <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover display data-table" id="user_table" width="100%">
                             <thead>
                                 <tr>
                                     <th scope="col">ID</th>
                                     <th scope="col">Name</th>
                                     <th scope="col">Profession</th>
                                     <th scope="col">Content</th>
                                     <th scope="col">Image</th>
                                     <th scope="col">Action</th>
                                 </tr>
                             </thead>

                             <tbody>
                             </tbody>
                         </table>
              </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="AddModel" tabindex="-1" role="dialog" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content" id="modal_content">
            <div class="col-md-12">
                  <div class="card mb-3" style="margin-top:20px;">
                    <div class="card-header">
                      <h3 id="form-add"></h3>
                    </div>
                    <div class="card-body">
                      <form id="frm" name="frm" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>

                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title">Name<span class="text-danger">*</span></label>
                                                          <input type="text" name="name" data-parsley-trigger="change" required data-parsley-required-message="The name field is required" placeholder="Enter user name" class="form-control" id="title" required>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title">Profession<span class="text-danger">*</span></label>
                                                          <input type="text" name="profession" data-parsley-trigger="change" required data-parsley-required-message="The profession field is required" placeholder="Enter profession" class="form-control" id="profession" required>
                                                      </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-md-12" id="testimonial_with_image">
                                                    <div class="form-group">
                                                      <label for="image">Image<span class="text-danger">*</span></label>
                                                      <input type="file" name="image" id="image" class="form-control-file"  data-parsley-trigger="change"  data-parsley-filemaxmegabytes="2" data-parsley-filemimetypes="image/jpeg,image/png">
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="row" id="content">
                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="message">Description (20 chars min, 250 max) :</label>
                                                        <div>
                                                            <p id="textareavalidate1" class="text-danger text-muted" style="display:none;margin-top:1px;margin-bottom:1px">Content can't be empty</p>
                                                            <textarea id="message1" class="form-control" name="content" data-parsley-trigger="keyup"></textarea>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="form-group text-right m-b-0">
                                                  <button class="btn btn-primary" type="submit" id="submit">
                                                      Submit
                                                  </button>
                                                  <button type="reset" class="btn btn-secondary m-l-5" data-dismiss="modal">
                                                      Cancel
                                                  </button>
                                                </div>

                      </form>
                    </div>
                  </div><!-- end card-->
            </div>
       </div>
     </div>
</div>

<div class="modal fade bd-example-modal-lg" id="EditModel" tabindex="-1" role="dialog" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content" id="modal_content">
            <div class="col-md-12">
                  <div class="card mb-3" style="margin-top:20px;">
                    <div class="card-header">
                      <h3 id="form-edit"></h3>
                    </div>
                    <div class="card-body">
                      <form id="Editform" name="Editform" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                                                <input type="hidden" name="id" id="testimonial_id">

                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title">Name<span class="text-danger">*</span></label>
                                                          <input type="text" name="name" data-parsley-trigger="change" required placeholder="Enter testimonial title" class="form-control" id="title_edit" required>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title">Profession<span class="text-danger">*</span></label>
                                                          <input type="text" name="profession" data-parsley-trigger="change" required data-parsley-required-message="The profession field is required" placeholder="Enter profession" class="form-control" id="profession_edit" required>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-12" id="testimonial_with_image_edit">
                                                    <div class="form-group">
                                                      <label for="image">Images<span class="text-danger">*</span></label>
                                                      <input type="file" name="image" id="image_edit" class="form-control-file">
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="row" id="current_image" display="none">
                                                    <div class="col-md-12">
                                                      <div class="form-group">
                                                        <label for="current_imagr">Current image<span class="text-danger">*</span></label><br>
                                                        <span id="store_image" class="text-center"></span>
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="content_edit">
                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="message">Description (20 chars min, 250 max) :</label>
                                                        <div>
                                                            <p id="textareavalidate" class="text-danger text-muted" style="display:none;margin-top:1px;margin-bottom:1px">Message can't be empty</p>
                                                            <textarea id="message_edit" class="form-control" name="content" data-parsley-trigger="keyup"  value="{{ old('message') }}"></textarea>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="form-group text-right m-b-0">
                                                  <button class="btn btn-primary" type="submit" id="update">
                                                      Submit
                                                  </button>
                                                  <button type="reset" class="btn btn-secondary m-l-5" data-dismiss="modal">
                                                      Cancel
                                                  </button>
                                                </div>

                      </form>
                    </div>
                  </div><!-- end card-->
            </div>
       </div>
     </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content" id="modal_contentRaj"></div>
     </div>
</div>

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
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('team.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'profession', name: 'profession'},
            {data: 'content', name: 'content'},
            {data: 'image', name: 'image'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "fnDrawCallback": function(data) {
            jQuery('#user_table #status_update').bootstrapToggle();
            $('.toggle-class').change(function() {
                                                 var status = $(this).prop('checked') == true ? 1 : 0;
                                                 var user_id = $(this).data('id');
                                                 $.ajax({
                                                       type: "GET",
                                                       dataType: "json",
                                                       url: '{{route('team.status')}}',
                                                       data: {'status': status, 'user_id': user_id},
                                                       success: function(data){
                                                                               if(data.testimonial.status == 0)
                                                                                 {
                                                                                   toastr.error('danger', 'team detail deactivated');
                                                                                 }
                                                                               else
                                                                                 {
                                                                                   toastr.success('success', 'team detail activated');
                                                                                 }
                                                                              }
                                                       });

                                                 })
        }
    });

    $('#createNewtestimonial').click(function () {
        CKEDITOR.instances.message1.setData( '', function() { this.updateElement(); } )
        $("#selecter").val(null).trigger("change");
        $('#frm').trigger("reset");
        $('#frm').parsley().reset()
        $('#form-add').html("Create new team");
        $('#AddModel').modal('show');
    });

    $('body').on('click', '.editUser', function () {
      $('#Editform').parsley().reset();
      var product_id = $(this).data('id');
      $.get("team/edit" +'/' + product_id, function (data) {
          $('#form-edit').html("Edit team");
          $('#EditModel').modal('show');
          $('#testimonial_id').val(data.prop.id);
          $('#title_edit').val(data.prop.name);
          $('#profession_edit').val(data.prop.profession);
          $('#store_image').html("<img src={{ URL::to('/') }}/" + data.prop.img_path + " width='150px' height='150px' style='border-radius:50% !important'/>");
          $('#message_edit').val(data.prop.content);
          if (data.prop.img_path == null) {
            $('#image_edit').prop('required',true);
          }
          else{
            $('#image_edit').prop('required',false);
          }

          CKEDITOR.instances.message_edit.setData( data.prop.content, function()
            {
                this.checkDirty();  // true
            });
      })
   });

   CKEDITOR.replace( 'message_edit' );
   CKEDITOR.replace( 'message1' );

    $('#submit').click(function (e) {
        e.preventDefault();
        $('#frm').parsley().validate();
        var testimonial_type = $('#testimonial_type').val();

        var raj1 = CKEDITOR.instances.message1.getData();
        if (raj1 == "" && testimonial_type != "testimonial_with_url") {
           $('#textareavalidate1').show();
        }
        else {
         $('#textareavalidate1').hide();
        if ( $('#frm').parsley().isValid() ) {

        for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
        }
        // Serialize the entire form:
        var data = new FormData(this.form);
        $.ajax({
          url: "{{ route('team.store') }}",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (data) {
              $('#frm').trigger("reset");
              $('#AddModel').modal('hide');
              table.row(this).remove().draw(false);
              $.fn.select2.defaults.reset();
              toastr.success('success', 'team added successfully');
          },
          error: function (data) {
              console.log('Error:', data);
              toastr.error('error', 'Please try again later');
          }
      });
       }
       }
    });

    $('#update').click(function (e) {
        e.preventDefault();
        $('#Editform').parsley().validate();
        var raj = CKEDITOR.instances.message_edit.getData();
        if (raj == "") {
           $('#textareavalidate').show();
        }
        else {
        $('#textareavalidate').hide();
        if ( $('#Editform').parsley().isValid() ) {
        for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
        }
        // Serialize the entire form:
        var data = new FormData(this.form);
        $.ajax({
          url: "{{ route('team.update') }}",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (data) {
              $('#Editform').trigger("reset");
              $('#EditModel').modal('hide');
              table.row(this).remove().draw(false);
              toastr.success('success', 'team details updated successfully');
          },
          error: function (data) {
              console.log('Error:', data);
              toastr.error('error', 'Please try again later');
          }
      });
       }
       }
    });

    $('body').on('click', '.deleteProduct', function () {
        var product_id = $(this).data("id");
        var url = "{{url('team/delete/')}}/" + product_id;
        {
            delete_this(url);
        }
    });

    $('body').on('click', '.request', function () {
        var id = $(this).data("id");
        var status = $(this).data("status");

        if (status == 'Request_to_publish') {
          {
              Swal.fire({
                  title: "Request to publish?",
                  text: "Please ensure and then confirm!",
                  confirmButtonText: "Yes, Request it to publish!",
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
                        type: 'PATCH',
                        url: "{{url('team/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'team details requested to publish');
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
        } else if (status == 'Draft') {
          {
              Swal.fire({
                  title: "Move to Draft?",
                  text: "Please ensure and then confirm!",
                  confirmButtonText: "Yes, move to draft!",
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
                        type: 'PATCH',
                        url: "{{url('team/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'team details moved to draft');
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
        } else if (status == 'Accept') {
          {
              Swal.fire({
                  title: "Make team details to live?",
                  text: "Please ensure and then confirm!",
                  confirmButtonText: "Yes, Make team details to live!",
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
                        type: 'PATCH',
                        url: "{{url('team/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'team details set to live');
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
        }else {
          {
              Swal.fire({
                  title: "Deactivate team details?",
                  text: "Please ensure and then confirm!",
                  confirmButtonText: "Yes, Deactivate team details!",
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
                        type: 'PATCH',
                        url: "{{url('team/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'Deactivated team details');
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
        }
    });
  });
</script>
@include('admin.inc.view')
@endsection
