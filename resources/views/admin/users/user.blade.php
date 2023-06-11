@extends('admin.layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')
@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'User'])

<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-users"></i> Staff details</h3>
                As an admin you can manage your users!
                <a role="button" href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="createNewUser">Create New User <i class="fa fa-plus"></i></a>
              </div>
              <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover display data-table" id="user_table" style="width: 100%;">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th>Position</th>
                                     <th>Email</th>
                                     <th width="280px">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
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
@include('admin.users.create&edit')
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
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'position', name: 'position'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "fnDrawCallback": function(data) {
            jQuery('#user_table #status_update').bootstrapToggle();
            $('.toggle-class').change(function() {
                                                 var user_status = $(this).prop('checked') == true ? 1 : 0;
                                                 var user_id = $(this).data('id');
                                                 $.ajax({
                                                       type: "GET",
                                                       dataType: "json",
                                                       url: '{{route('Status_Update')}}',
                                                       data: {'user_status': user_status, 'user_id': user_id},
                                                       success: function(data){
                                                                               if(data.user.user_status == 0)
                                                                                 {
                                                                                   toastr.error('danger', 'User Deactivated');
                                                                                 }
                                                                               else
                                                                                 {
                                                                                   toastr.success('success', 'User Activated');
                                                                                 }
                                                                              }
                                                       });

                                                 })
        }
    });

    $('#createNewUser').click(function () {
        $('#frm').trigger("reset");
        $('#frm').parsley().reset();
        $('#textareavalidate').hide();
        $('#profile').hide();
        $('#passv1').show();
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#image').prop('required',true);
        $('#password').prop('required',true);
        $('#form-add-edit').html("Create New User");
        $('#hide_on_edit').show();
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editUser', function () {
      $('#textareavalidate').hide();
      $('#frm').parsley().reset();
      $('#profile').show();
      $('#submit').html('Submit');
      $('#password').prop('required',false);
      $('#passv1').hide();
      var product_id = $(this).data('id');
      $.get("users/edit" +'/' + product_id, function (data) {
          $('#form-add-edit').html("Edit User");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#user_id').val(data.id);
          $('#role').val(data.role_name);
          $('#name').val(data.name);
          $('#email').val(data.email);
          $('#hide_on_edit').hide();        
      })
   });

    $('#submit').click(function (e) {
        e.preventDefault();
        $('#frm').parsley().validate();
          if ( $('#frm').parsley().isValid() ) {
          $('.loading').show();
          // Serialize the entire form:
          var data = new FormData(this.form);
          $.ajax({
            url: "{{ route('user.store') }}",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {
                if($.isEmptyObject(data.error)){
                  $('.loading').hide();
                  $('#frm').trigger("reset");
                  $('#ajaxModel').modal('hide');
                  table.row(this).remove().draw(false);
                  toastr.success('success', 'User saved successfully');
                }else{
                    $.each( data.error, function( key, value ) {
                    toastr.error(value);
                    });
                    $('.loading').hide();
                }
            },
            error: function (data) {
                $('.loading').hide();
                $('#ajaxModel').modal('hide');
                console.log('Error:', data);
                $('#submit').html('Save Changes');
            }
        });
         }
        });
  

    $('body').on('click', '.deleteProduct', function () {
        var product_id = $(this).data("id");
        var url = "{{url('users/delete/')}}/" + product_id;
        {
            delete_this(url);
        }
    });


  });
</script>
@include('admin.inc.view')
@endsection
