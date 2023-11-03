@extends('admin.layouts.master')
@section('meta_tags')
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')
@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'Permission'])

<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-permissions"></i>Permission details</h3>
                As an admin you can manage your permissions!
                <a role="button" href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="createNewUser">Create New Permission <i class="fa fa-plus"></i></a>
              </div>
              <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover display data-table" id="permission_table" style="width: 100%;">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Name</th>
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
@include('admin.permissions.create&edit')
<div class="modal fade bd-example-modal-lg" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content" id="modal_contentRaj"></div>
     </div>
</div>

@include('admin.inc.loader')
@endsection

@section('js')
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
        ajax: "{{ route('permissions.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "fnDrawCallback": function(data) {
        }
    });

    $('#createNewUser').click(function () {
        $('#frm').trigger("reset");
        $('#frm').parsley().reset();
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#form-add-edit').html("Create New Permission");
        $('#hide_on_edit').show();
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editPermission', function () {
      $('#frm').parsley().reset();
      $('#submit').html('Submit');
      var product_id = $(this).data('id');
      $.get("permissions/edit" +'/' + product_id, function (data) {
          $('#form-add-edit').html("Edit Permission");
          $('#saveBtn').val("edit-permission");
          $('#ajaxModel').modal('show');
          $('#permission_id').val(data.id);
          $('#name').val(data.name);
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
            url: "{{ route('permission.store') }}",
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
                  toastr.success('success', 'Permission saved successfully');
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
        var url = "{{url('admin/permissions/delete/')}}/" + product_id;
        {
            delete_this(url,'permission');
        }
    });


  });
</script>
@endsection
