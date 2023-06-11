@extends('layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')

@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'Tag'])
<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-users"></i> Amenities</h3>
                As an admin you can manage the amenities!
                <a role="button" href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="createNewUser">Create new amenity <i class="fa fa-plus"></i></a>
              </div>
              <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover display data-table" id="user_table" width="100%">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Ammenity name</th>
                                     <th>Ammenity type</th>
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

<div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content" id="modal_content">
            <div class="col-md-12">
                  <div class="card mb-3" style="margin-top:20px;">
                    <div class="card-header">
                      <h3 id="form-add-edit"><i class="fa fa-hand-pointer-o"></i></h3>
                    </div>
                    <div class="card-body">
                      <form id="frm" name="frm" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                                                <input type="hidden" name="id" id="user_id">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">Amenity type<span class="text-danger">*</span></label>
                                                          <select class="form-control select2 rounded-0" id="amenities_type1" name="amenities_type" required>
    									                                        <option value="Indoor">Indoor</option>
    									                                        <option value="Outdoor">Outdoor</option>
    								                                      </select>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="First Name">Amenity<span class="text-danger">*</span></label>
                                                          <input type="text" name="name" id="first_name" data-parsley-trigger="change" maxlength="20" required placeholder="Enter amenity" class="form-control{{ $errors->has('First_Name') ? ' is-invalid' : '' }} rounded-0">
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
        ajax: "{{ route('tag.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'amenities_type', name: 'amenities_type'},
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
        $('#frm').parsley().reset()
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#frm').trigger("reset");
        $('#image').prop('required',true);
        $('#form-add-edit').html("Create new amenity");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editUser', function () {
      $('#frm').trigger("reset");
      $('#frm').parsley().reset()
      $('#submit').html('Submit');
      var product_id = $(this).data('id');
      $.get("tag" +'/' + product_id + "/edit", function (data) {
          $('#form-add-edit').html("Edit amenity");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#user_id').val(data.id);
          $('#first_name').val(data.name);
          $('#amenities_type1').val(data.amenities_type);
      })
   });

    $('#submit').click(function (e) {
        e.preventDefault();
        $('#frm').parsley().validate();


        if ( $('#frm').parsley().isValid() ) {
        $(this).html('Sending..');

        // Serialize the entire form:
        var data = new FormData(this.form);
        $.ajax({
          url: "{{ route('tag.store') }}",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (data) {
              $('#frm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.row(this).remove().draw(false);
          },
          error: function (data) {
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

@include('admin.inc.view')
@endsection
