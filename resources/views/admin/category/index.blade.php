@extends('admin.layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')
  <style media="screen">
  .loading {
           background: lightgrey;
           padding: 15px;
           position: fixed;
           border-radius: 4px;
           left: 50%;
           top: 50%;
           text-align: center;
           margin: -40px 0 0 -50px;
           z-index: 2000;
           display: none;
       }
   </style>
@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'category'])

<div class="container-fluid" style="padding:30px;background-color:#efefef;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-building"></i> category details</h3>
                As an admin you can manage all the categories!
                @if (Auth::check())
                  @if(Auth::user()->isAdmin())
                      <a role="button" href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="createNewcategory">Create New category <i class="fa fa-plus"></i></a>
                  @endif
                @endif
              </div>
              <div class="card-body">
                         <p id="res_message"></p>
                         <table class="table table-bordered table-responsive-xl table-hover display data-table" id="user_table">
                             <thead>
                                 <tr>
                                     <th scope="col">ID</th>
                                     <th scope="col">Category name</th>
                                     <th scope="col">Status</th>
                                     <th width="15%">Action</th>
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

<div class="modal fade bd-example-modal-lg" id="AddModel" tabindex="-1" role="dialog" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content" id="modal_content">
            <div class="col-md-12">
                  <div class="card mb-3" style="margin-top:20px;">
                    <div class="card-header">
                      <h3 id="form-add"><i class="fa fa-hand-pointer-o"></i></h3>
                    </div>
                    <div class="card-body">
                      <form id="frm" name="frm" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                         <label for="name">Parent category</label><span class="text-danger">*</span></label>
                                                         <select class="form-control" name="parent_id" id="parent_id">
                                                                  @foreach ($allcategories as $key => $value)
                                                                  <option value="{{$value->id}}">{{$value->name}}</option>
                                                                  @endforeach
                                                          </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="name">Category name<span class="text-danger">*</span></label>
                                                          <input type="text" name="name" data-parsley-trigger="change" required placeholder="Enter category name" class="form-control" id="title" required>
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
                      <h3 id="form-edit"><i class="fa fa-hand-pointer-o"></i></h3>
                    </div>
                    <div class="card-body">
                      <form id="Editform" name="Editform" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                                                <input type="hidden" name="id" id="category_id">
                                                <div class="row">
                                                    <div col-md-6>
                                                    <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                                         <label for="name">Parent category</label>span class="text-danger">*</span></label>
                                                         <select class="form-control" name="continent_id" id="continent_id">
                                                                  @foreach ($allcategories as $key => $value)
                                                                  <option value="{{$value->Id}}">{{$value->name}}</option>
                                                                  @endforeach
                                                          </select>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">category Name<span class="text-danger">*</span></label>
                                                            <input type="text" name="name" data-parsley-trigger="change" required placeholder="Enter category name" class="form-control" id="name" required>
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

<div class="loading">
        <i class="fas fa-sync fa-spin fa-2x fa-fw"></i><br/>
        <span>Loading</span>
</div>

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
        ajax: "{{ route('category.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
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
                                                       url: '{{route('category.status_update')}}',
                                                       data: {'user_status': user_status, 'user_id': user_id},
                                                       success: function(data){
                                                                               if(data.category.status == 0)
                                                                                 {
                                                                                   toastr.error('Category deactivated');
                                                                                 }
                                                                               else
                                                                                 {
                                                                                   toastr.success('Category activated');
                                                                                 }
                                                                              }
                                                       });

                                                 })
        }
    });

    $('#createNewcategory').click(function () {
        $('#frm').trigger("reset");
        $('#frm').parsley().reset()
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#frm').trigger("reset");
        $('#form-add').html("Create New category");
        $('#AddModel').modal('show');
    });

    $('body').on('click', '.editUser', function () {
      $('#Editform').parsley().reset();
      $('#update').html('Submit');
      $('#edittag').html('');
      var product_id = $(this).data('id');
      $.get("category/edit" +'/' + product_id, function (data) {
          $('#form-edit').html("Edit category");
          $('#saveBtn').val("edit-user");
          $('#EditModel').modal('show');
          $('#category_id').val(data.prop.id);
          $('#name').val(data.prop.name);
      })
   });


    $('#submit').click(function (e) {
        e.preventDefault();
        $('#frm').parsley().validate();
        if ( $('#frm').parsley().isValid() ) {
        // Serialize the entire form:
        var data = new FormData(this.form);
        $.ajax({
          url: "{{ route('category.store') }}",
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
              if(data.user.user_status == 0)
                {
                  toastr.error('danger', 'User Deactivated');
                }
              else
                {
                  toastr.success('success', 'User Activated');
                }
          },
          error: function (data) {
              console.log('Error:', data);
              $('#submit').html('Save Changes');
          }
      });
       }
    });

    $('#update').click(function (e) {
        e.preventDefault();
        $('#Editform').parsley().validate();
        if ( $('#Editform').parsley().isValid() ) {
        $(this).html('Sending..');

        // Serialize the entire form:
        var data = new FormData(this.form);
        $.ajax({
          url: "{{ route('category.update') }}",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (data) {
              $('#Editform').trigger("reset");
              $('#EditModel').modal('hide');
              table.row(this).remove().draw(false);
//            $('#edittag').val(null).trigger('change');

          },
          error: function (data) {
              console.log('Error:', data);
              $('#update').html('Save Changes');
          }
      });
       }
    });

    $('body').on('click', '.deleteProduct', function () {
        var product_id = $(this).data("id");
        {
            Swal.fire({
                title: "Are you sure?",
                text: "Please ensure and then confirm!",
                confirmButtonText: "Yes, delete the category!",
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
                      type: "DELETE",
                      url: "{{url('category/delete/')}}/" + product_id,
                      success: function (data) {
                          table.row(this).remove().draw(false);
                          toastr.error('Deleted', 'category deleted successfully');
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
                        url: "{{url('/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'category requested to publish');
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
                        url: "{{url('/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'category moved to draft');
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
                  title: "Make category to live?",
                  text: "Please ensure and then confirm!",
                  confirmButtonText: "Yes, Make category to live!",
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
                        url: "{{url('/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'category set to live');
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
                  title: "Deactivate category?",
                  text: "Please ensure and then confirm!",
                  confirmButtonText: "Yes, Deactivate category!",
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
                        url: "{{url('/request/')}}/" + id,
                        dataType: "json",
                        data: {'status': status, 'id': id},
                        success: function (data) {
                            table.row(this).remove().draw(false);
                            toastr.success('success', 'Deactivated category');
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
  $('body').on('change', '#category_type', function () {
    var category_type = $('#category_type').val();
    if ( category_type == "category_with_url") {
         $('#category_with_url').css("display",'block');
         $('#category_with_video').css("display",'none');
         $('#category_with_image').css("display",'none');
         $('#content').css("display",'none');
    } else if (category_type == "category_with_video") {
         $('#category_with_video').css("display",'block');
         $('#category_with_image').css("display",'none');
         $('#category_with_url').css("display",'none');
    } else{
         $('#category_with_image').css("display",'block');
         $('#category_with_url').css("display",'none');
         $('#category_with_video').css("display",'none');
    }
  });
</script>
@endsection
