@extends('admin.layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')

@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'Meta tag'])

<div class="panel panel-primary" style="margin: 50px;background-color:#fff !important">
              <div class="panel-heading" style="padding:10px !important">
                <h3><i class="fa fa-tag"></i> Meta tag management</h3>
                As an admin you can manage the meta tags of this site!
              </div>
              <div class="panel-body" style="overflow-x: scroll;">
                   <div style="width: 100%; padding-left: -10px;">
                     <div class="table-responsive">
                         <table class="table table-striped table-hover display nowrap data-table table-bordered" cellspacing="0" id="social_table" width="100%">
                             <thead>
                                 <tr>
                                     <th scope="col">id</th>
                                     <th scope="col">Route</th>
                                     <th scope="col">Page Name</th>
                                     <th scope="col">Description</th>
                                     <th scope="col">Keywords</th>
                                     <th scope="col">Author</th>
                                     <th scope="col">action</th>
                                 </tr>
                             </thead>

                             <tbody>
                             </tbody>
                         </table>
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
                      <h3><i class="fa fa-hand-pointer-o"></i> <span id="form-add"></span> </h3>
                    </div>
                    <div class="card-body">
                      <form id="frm" name="frm" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                                                <input type="hidden" name="id" value="" id="meta_id">
                                                <p style="font-size:1rem;font-weight:600">Regular meta tags</p>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">Description</label>
                                                      <input type="text" name="description" value="" class="form-control" id="description">
                                                      </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">Keywords</label>
                                                          <input type='text' name="keywords" value="" class="form-control" id="keywords">
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">Author</label>
                                                          <input type="text" name="author" value="" class="form-control" id="author">
                                                      </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">Canonical</label>
                                                          <input type="text" name="canonical" value="" class="form-control" id="canonical">
                                                      </div>
                                                  </div>
                                                </div>
                                                <p style="font-size:1rem;font-weight:600">Facebook meta tags</p>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">og:url</label>
                                                          <input type="text" name="og_url" value="" class="form-control" id="og_url">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">og:image</label>
                                                          <input data-parsley-type='url' name="og_image" value="" class="form-control" id="og_image">
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">og:description</label>
                                                          <input type="text" name="og_description" value="" class="form-control" id="og_description">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">og:title</label>
                                                          <input data-parsley-type='url' name="og_title" value="" class="form-control" id="og_title">
                                                      </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">og:site_name</label>
                                                          <input type="text" name="og_site_name" value="" class="form-control" id="og_site_name">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">og:see_also</label>
                                                          <input data-parsley-type='url' name="og_see_also" value="" class="form-control" id="og_see_also">
                                                      </div>
                                                  </div>
                                                </div>

                                                <p style="font-size:1rem;font-weight:600">Google meta tags</p>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">name</label>
                                                          <input type="text" name="name" value="" class="form-control" id="name">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">googledescription</label>
                                                          <input data-parsley-type='url' name="googledescription" value="" class="form-control" id="googledescription">
                                                      </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">image</label>
                                                          <input type="text" name="image" value="" class="form-control" id="image">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">twitter:card</label>
                                                          <input data-parsley-type='url' name="twitter_card" value="" class="form-control" id="twitter_card">
                                                      </div>
                                                  </div>
                                                </div>

                                                <p style="font-size:1rem;font-weight:600">Twitter meta tags</p>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">twitter:url</label>
                                                          <input type="text" name="twitter_url" value="" class="form-control" id="twitter_url">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">twitter:title</label>
                                                          <input data-parsley-type='url' name="twitter_title" value="" class="form-control" id="twitter_title">
                                                      </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">twitter:description</label>
                                                          <input type="text" name="twitter_description" value="" class="form-control" id="twitter_description">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">twitter:image</label>
                                                          <input data-parsley-type='url' name="twitter_image" value="" class="form-control" id="twitter_image">
                                                      </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="userName">title<span class="text-danger">*</span></label>
                                                          <input type="text" name="title" value="" class="form-control" id="title" required>
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
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('meta.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'route', name: 'route'},
            {data: 'page_name', name: 'page_name'},
            {data: 'description', name: 'description'},
            {data: 'keywords', name: 'keywords'},
            {data: 'author', name: 'author'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "fnDrawCallback": function(data) {
            jQuery('#social_table #status_update').bootstrapToggle();
            $('.toggle-class').change(function() {
                                                 var social_status = $(this).prop('checked') == true ? 1 : 0;
                                                 var social_id = $(this).data('id');
                                                 $.ajax({
                                                       type: "GET",
                                                       dataType: "json",
                                                       url: '',
                                                       data: {'social_status': social_status, 'social_id': social_id},
                                                       success: function(data){
                                                                               if(data.social.social_status == 0)
                                                                                 {
                                                                                   toastr.error('danger', 'Deactivated');
                                                                                 }
                                                                               else
                                                                                 {
                                                                                   toastr.success('success', 'Activated');
                                                                                 }
                                                                              }
                                                       });

                                                 })
        }
    });

    $('body').on('click', '.editTheme', function () {
      $('#frm').parsley().reset();
      $('#edit').html('Submit');
      $('#form-add').html('Edit Meta tags');
      var product_id = $(this).data('id');
      $.get("meta/" + product_id +'/edit' , function (data) {
          $('#form-edit').html("Edit Property");
          $('#saveBtn').val("edit-user");
          $('#AddModel').modal('show');
          $('#meta_id').val(data.id);
          $('#description').val(data.description);
          $('#keywords').val(data.keywords);
          $('#author').val(data.author);
          $('#canonical').val(data.canonical);
          $('#og_url').val(data.og_url);
          $('#og_image').val(data.og_image);
          $('#og_description').val(data.og_description);
          $('#og_title').val(data.og_title);
          $('#og_site_name').val(data.og_site_name);
          $('#og_see_also').val(data.og_see_also);
          $('#name').val(data.name);
          $('#googledescription').val(data.googledescription);
          $('#image').val(data.image);
          $('#twitter_card').val(data.twitter_card);
          $('#twitter_url').val(data.twitter_url);
          $('#twitter_title').val(data.twitter_title);
          $('#twitter_description').val(data.twitter_description);
          $('#twitter_image').val(data.twitter_image);
          $('#title').val(data.title);
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
          url: "{{ route('meta.store') }}",
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (data) {
              $('#frm').trigger("reset");
              $('#AddModel').modal('hide');
              $('#submit').html('Submit');
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
        var url = "{{url('property/delete/')}}/" + product_id;
        {
            delete_this(url);
        }
    });
  });
</script>
@include('admin.inc.view')
@endsection
