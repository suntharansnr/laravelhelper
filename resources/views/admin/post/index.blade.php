@extends('admin.layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')

@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'Post'])

<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-building"></i> Post details</h3>
                As an admin you can manage all the Posts!
                <a role="button" href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="createNewPost">Create New Post <i class="fa fa-plus"></i></a>
              </div>
              <div class="card-body" style="overflow-x: scroll;">
                         <p id="res_message"></p>
                         <table class="table table-bordered table-hover display data-table" id="user_table" width="100%">
                             <thead>
                                 <tr>
                                     <th scope="col">ID</th>
                                     <th scope="col">Slug</th>
                                     <th scope="col">Post type</th>
                                     <th scope="col">Content</th>
                                     <th scope="col">Category</th>
                                     <th scope="col">Posted by</th>
                                     <th scope="col">Status</th>
                                     <th width="15%">Change status</th>
                                     <th width="15%">Action</th>
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
                                                      <label for="userName">Post Type<span class="text-danger">*</span></label>
                                                      <select class="form-control select2" id="post_type" name="post_type" required data-parsley-required-message="Please select post type">
                                                        <option value="" disabled selected>Please select post type</option>
                                                        <option value="post_with_image">Post with image</option>
                                                        <option value="post_with_video">Post with video</option>
                                                        <option value="post_with_url">Post with url</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title">Title<span class="text-danger">*</span></label>
                                                          <input type="text" name="title" data-parsley-trigger="change" required data-parsley-required-message="The title field is required" placeholder="Enter post title" class="form-control" id="title" required>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="address_2">Category<span class="text-danger">*</span></label><br>
                                                        <select class="form-control" name="category_id" style="width:100%" id="category" required data-parsley-required-message="The category field is required">
                                                                <option value="" selected disabled>Please select a category</option>
                                                                @foreach ($categories as $category)
                                                                     <option class="" value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6" id="post_with_image">
                                                        <div class="form-group">
                                                            <label for="image">Images<span class="text-danger">*</span></label>
                                                            <input type="file" name="image" id="image" class="form-control-file"  data-parsley-trigger="change"  data-parsley-filemaxmegabytes="2" data-parsley-filemimetypes="image/jpeg,image/png">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="post_with_video" style="display:none">
                                                        <div class="form-group">
                                                            <label for="video">Video<span class="text-danger">*</span></label>
                                                            <input type="file" name="video" id="video" class="form-control-file">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="post_with_url" style="display:none">
                                                        <div class="form-group">
                                                            <label for="url">Url<span class="text-danger">*</span></label>
                                                            <input type="text" name="url" id="url" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="content">
                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="message">Description (20 chars min, 100 max) :</label>
                                                        <div>
                                                            <p id="textareavalidate1" class="text-danger text-muted" style="display:none;margin-top:1px;margin-bottom:1px">Content can't be empty</p>
                                                            <textarea id="message1" class="form-control" name="content" data-parsley-trigger="keyup"></textarea>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="form-group text-right m-b-0">
                                                  <button class="btn btn-primary submit" type="submit" id="submit">
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
                                                <input type="hidden" name="id" id="post_id">

                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="userName">Post Type<span class="text-danger">*</span></label>
                                                      <select class="form-control select2" id="post_type_edit" name="post_type" required>
                                                        <option value="post_with_image">Post with image</option>
                                                        <option value="post_with_video">Post with video</option>
                                                        <option value="post_with_url">Post with url</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title">Title<span class="text-danger">*</span></label>
                                                          <input type="text" name="title" data-parsley-trigger="change" required placeholder="Enter post title" class="form-control" id="title_edit" required>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="address_2">Category<span class="text-danger">*</span></label><br>
                                                        <select class="form-control" name="category_id" style="width:100%" id="category_edit" required>
                                                                @foreach ($categories as $category)
                                                                     <option class="" value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6" id="post_with_image_edit">
                                                        <div class="form-group">
                                                            <label for="image">Images<span class="text-danger">*</span></label>
                                                            <input type="file" name="image" id="image_edit" class="form-control-file">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="post_with_video_edit" style="display:none">
                                                        <div class="form-group">
                                                            <label for="video">Video<span class="text-danger">*</span></label>
                                                            <input type="file" name="video" id="video_edit" class="form-control-file">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="post_with_url_edit" style="display:none">
                                                        <div class="form-group">
                                                            <label for="url">Url<span class="text-danger">*</span></label>
                                                            <input type="text" name="url" class="form-control" id="url_edit">
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

                                                <div class="row" id="current_video" display="none">
                                                    <div class="col-md-12">
                                                      <div class="form-group">
                                                        <label for="address_2">Current video<span class="text-danger">*</span></label><br>
                                                        <video id="theVideo" width="640" height="480" controls>
                                                        </video><br>
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="content_edit">
                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="message">Description (20 chars min, 100 max) :</label>
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
        ajax: "{{ route('post.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'slug', name: 'slug'},
            {data: 'post_type', name: 'post_type'},
            {data: 'content', name: 'content'},
            {data: 'category', name: 'category'},
            {data: 'posted_by', name: 'posted_by'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'change_status', name: 'change_status', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });

    $('#createNewPost').click(function () {
        CKEDITOR.instances.message1.setData( '', function() { this.updateElement(); } )
        $("#selecter").val(null).trigger("change");
        $('#frm').trigger("reset");
        $('#frm').parsley().reset()
        var post_type = $('#post_type').val();
        if ( post_type == "post_with_url") {
             $('#post_with_url').css("display",'block');
             $('#post_with_video').css("display",'none');
             $('#post_with_image').css("display",'none');
             $('#content').css("display",'none');
             $('#url').prop('required',true);
             $('#video').prop('required',false);
             $('#image').prop('required',false);
        } else if (post_type == "post_with_video") {
             $('#post_with_video').css("display",'block');
             $('#post_with_image').css("display",'none');
             $('#post_with_url').css("display",'none');
             $('#content').css("display",'block');
             $('#video').prop('required',true);
             $('#url').prop('required',false);
             $('#image').prop('required',false);
        } else if (post_type == "post_with_image"){
             $('#post_with_image').css("display",'block');
             $('#post_with_url').css("display",'none');
             $('#post_with_video').css("display",'none');
             $('#content').css("display",'block');
             $('#image').prop('required',true);
             $('#video').prop('required',false);
             $('#url').prop('required',false);
        }
        else {

        }

        $('#form-add').html("Create new post");
        $('#AddModel').modal('show');
    });

    $('body').on('click', '.editUser', function () {
      $('#Editform').parsley().reset();
      var product_id = $(this).data('id');
      $.get("post/edit" +'/' + product_id, function (data) {
          $('#form-edit').html("Edit Post");
          $('#EditModel').modal('show');
          var post_type = data.prop.post_type;
          if ( post_type == "post_with_url") {
            $('#post_with_url_edit').css("display",'block');
            $('#post_with_video_edit').css("display",'none');
            $('#post_with_image_edit').css("display",'none');
            $('#content_edit').css("display",'none');
            $('#current_image').css("display",'none');
            $('#current_video').css("display",'none');
          } else if (post_type == "post_with_video") {
            $('#post_with_video_edit').css("display",'block');
            $('#post_with_image_edit').css("display",'none');
            $('#post_with_url_edit').css("display",'none');
            $('#content_edit').css("display",'block');
            $('#current_image').css("display",'none');
            $('#current_video').css("display",'block');
          } else{
            $('#post_with_image_edit').css("display",'block');
            $('#post_with_url_edit').css("display",'none');
            $('#post_with_video_edit').css("display",'none');
            $('#content_edit').css("display",'block');
            $('#current_image').css("display",'block');
            $('#current_video').css("display",'none');
          }
          $('#post_id').val(data.prop.id);
          $('#post_type_edit').val(data.prop.post_type);
          $('#title_edit').val(data.prop.title);
          $('#category_edit').val(data.prop.category_id);
          $('#store_image').html("<img src={{ URL::to('/') }}/" + data.prop.img_path + " width='150px' height='150px' style='border-radius:50% !important'/>");
          document.getElementById("theVideo").src = data.prop.video_path;
          $('#url_edit').val(data.prop.url);
          $('#message_edit').val(data.prop.content);
          if (data.prop.img_path == null) {
            // $('#image_edit').prop('required',true);
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


    CKEDITOR.replace( 'message_edit',{
            allowedContent: {
                script: true,
                div: true,
                $1: {
                    // This will set the default set of elements
                    elements: CKEDITOR.dtd,
                    attributes: true,
                    styles: true,
                    classes: true
                }
            }
        });
    CKEDITOR.replace( 'message1',{
            allowedContent: {
                script: true,
                div: true,
                $1: {
                    // This will set the default set of elements
                    elements: CKEDITOR.dtd,
                    attributes: true,
                    styles: true,
                    classes: true
                }
            }
        });

    $('.submit').click(function (e) {
        e.preventDefault();
        $('#frm').parsley().validate();
        var post_type = $('#post_type').val();

        var raj1 = CKEDITOR.instances.message1.getData();
        if (raj1 == "" && post_type != "post_with_url") {
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
          url: "{{ route('post.store') }}",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (data) {
            if($.isEmptyObject(data.error)){
              $('#frm').trigger("reset");
              $('#AddModel').modal('hide');
              table.row(this).remove().draw(false);
              $.fn.select2.defaults.reset();
              toastr.success('success', 'Post added successfully');
            }else{
                    $.each( data.error, function( key, value ) {
                    toastr.error(value);
                    });
                    $('.loading').hide();
                 }
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
          url: "{{ route('post.update') }}",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (data) {
            if($.isEmptyObject(data.error)){
              $('#Editform').trigger("reset");
              $('#EditModel').modal('hide');
              table.row(this).remove().draw(false);
              toastr.success('success', 'Post updated successfully');
            }else{
                    $.each( data.error, function( key, value ) {
                    toastr.error(value);
                    });
                    $('.loading').hide();
                 }
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
        var url = "{{url('post/delete/')}}/" + product_id;
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
                        url: "{{url('post/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'Post requested to publish');
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
                        url: "{{url('post/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'Post moved to draft');
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
                  title: "Make Post to live?",
                  text: "Please ensure and then confirm!",
                  confirmButtonText: "Yes, Make Post to live!",
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
                        url: "{{url('post/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'Post set to live');
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
                  title: "Deactivate Post?",
                  text: "Please ensure and then confirm!",
                  confirmButtonText: "Yes, Deactivate Post!",
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
                        url: "{{url('post/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'Deactivated Post');
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

<script type="text/javascript">
  $('body').on('change', '#post_type', function () {
    var post_type = $('#post_type').val();
    if ( post_type == "post_with_url") {
         $('#post_with_url').css("display",'block');
         $('#post_with_video').css("display",'none');
         $('#post_with_image').css("display",'none');
         $('#content').css("display",'none');
         $('#url').prop('required',true);
         $('#video').prop('required',false);
         $('#image').prop('required',false);
    } else if (post_type == "post_with_video") {
         $('#post_with_video').css("display",'block');
         $('#post_with_image').css("display",'none');
         $('#post_with_url').css("display",'none');
         $('#content').css("display",'block');
         $('#video').prop('required',true);
         $('#url').prop('required',false);
         $('#image').prop('required',false);
    } else if (post_type == "post_with_image"){
         $('#post_with_image').css("display",'block');
         $('#post_with_url').css("display",'none');
         $('#post_with_video').css("display",'none');
         $('#content').css("display",'block');
         $('#image').prop('required',true);
         $('#video').prop('required',false);
         $('#url').prop('required',false);
    }
    else {

    }
  });
</script>

<script type="text/javascript">
  $('body').on('change', '#post_type_edit', function () {
    var post_type = $('#post_type_edit').val();
    if ( post_type == "post_with_url") {
         $('#post_with_url_edit').css("display",'block');
         $('#post_with_video_edit').css("display",'none');
         $('#post_with_image_edit').css("display",'none');
         $('#content_edit').css("display",'none');
         $('#current_image').css("display",'none');
         $('#current_video').css("display",'none');
    } else if (post_type == "post_with_video") {
         $('#post_with_video_edit').css("display",'block');
         $('#post_with_image_edit').css("display",'none');
         $('#post_with_url_edit').css("display",'none');
         $('#content_edit').css("display",'block');
         $('#current_image').css("display",'none');
         $('#current_video').css("display",'block');
    } else{
         $('#post_with_image_edit').css("display",'block');
         $('#post_with_url_edit').css("display",'none');
         $('#post_with_video_edit').css("display",'none');
         $('#content_edit').css("display",'block');
         $('#current_image').css("display",'block');
         $('#current_video').css("display",'none');
    }
  });
</script>
@endsection
