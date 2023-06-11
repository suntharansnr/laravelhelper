@extends('admin.layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/treeview.css')}}" />
@endsection
@section('content')
<div class="container-fluid" style="padding:0px;">

      <div class="card shadow" style="border-radius:0px;padding:3px;background-color:#ffffff;color:#212529 ;padding:10px;">
            <div class="row">
                <div class="col-md-8">
                    @if(Auth::check())
                        @if (Auth::user()->isAdmin())
                            <h4 style="background:#fff">Admin Dashboard</h4>
                        @else
                            <h4 style="background:#fff">Agent Dashboard</h4>
                        @endif
                    @endif
                </div>
                <div class="col-md-4">
                  <p class="float-right" style="color:#212529;font-weight:600">Home / <span style="color:#6c757d">category management</span> </p>
                </div>
            </div>
      </div>
      <!-- end row -->
</div>
<div class="container-fluid">
    <p id="res_message"></p>
</div>

<div class="container-fluid" style="padding:30px;background-color:#efefef;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-building"></i> category details</h3>
                As an admin you can manage all the categories!
                @if (Auth::check())
                  @if(Auth::user()->isAdmin())
                      <a role="button" href="" class="btn btn-primary btn-sm float-right createCategory" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="createNewcategory">Create New category <i class="fa fa-plus"></i></a>
                  @endif
                @endif
              </div>
              <div class="card-body">
                 <div id="jstree_demo_div">
                    <ul id="myUL">
                        @foreach($categories as $category)
                            <li class="mt-3" id="liselect{{$category->id}}"><span class="caret"></span>
                                {{ $category->name }} 
                                <a role="button" href="" class="btn btn-primary btn-sm createCategory" data-toggle="modal" data-id="{{$category->id}}" data-name="{{$category->name}}" data-backdrop="static" data-keyboard="false" id="createNewcategory"><i class="fa fa-plus"></i></a>
                                <a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="{{$category->id}}" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$category->id}}" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>
                                @if(count($category->childs))
                                    @include('admin.category.manageChild',['childs' => $category->childs])
                                @endif
                            </li>
                        @endforeach
                    </ul> 
                 </div>
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
                                                                  <option value="" selected="selected" disabled="true">Please select</option>
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
                                                    <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                                         <label for="name">Parent category</label><span class="text-danger">*</span></label>
                                                         <select class="form-control" name="parent_id" id="edit_parent_id">
                                                                  @foreach ($allcategories as $key => $value)
                                                                  <option value="{{$value->id}}">{{$value->name}}</option>
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

@include('admin.inc.loader')

@endsection
@section('js')
<script src="{{asset('assets/js/treeview.js')}}"></script>
<script type="text/javascript">
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $('body').on('click', '.createCategory', function () {
        $('#frm').trigger("reset");
        $('#frm').parsley().reset()
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#frm').trigger("reset");
        $('#form-add').html("Create New category");
        $('#AddModel').modal('show');
        var parent_id = typeof  $(this).data('id') == 'undefined' ? 0 : $(this).data('id');
        var parent_name = parent_id == 0 ? 'Root' : $(this).data('name');
        $('select[name="parent_id"]').html('<option selected value="'+ parent_id +'">'+ parent_name +'</option>');
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
          $('#edit_parent_id').val(data.prop.parent_id);
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
              let html = '';
              html += '<li class="mt-3"><span class="caret"></span>'
                               +data.name
                               + '<a role="button" href="" class="btn btn-primary btn-sm createCategory" data-toggle="modal" data-id="'+data.id+'" data-name="'+data.name+'" data-backdrop="static" data-keyboard="false" id="createNewcategory"><i class="fa fa-plus"></i></a>' 
                               + '&nbsp'
                               + '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="'+data.id+'" data-original-title="Edit"><i class="fa fa-edit"></i></a>'
                               + '&nbsp'
                               + '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>'
                               + '</li>';
              if(data.parent_id == 0) {
                 alert("parent_id is null");
                 if($('ul#myUL li').length >= 1){
                    $("#myUL").find( "li:last" ).append(html);
                 }
                 else {
                    $("#myUL").html(html);
                 }  
              } else {
                  if($('ul#nested li').length >= 1){
                    alert("rak");
                    $("#liselect"+data.parent_id).find( "li:last" ).append(html);
                  }
                  else{
                    alert("DFdf");
                    $("#liselect" + data.parent_id).html(html);
                  }
                                   
              }
              toastr.success('success', 'new category added');
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
                          if(data.success == 'true') {
                            $("#liselect"+data[0].id).remove();
                            toastr.success('Deleted', 'category deleted successfully');
                          }else{
                            toastr.error('Error', 'can not delete category.Category must not contain children to delete');
                          }
                      },
                      error: function (data) {
                           toastr.error('Error:', data);
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
@endsection
