@extends('admin.layouts.master')
@section('meta_tags')
        <title>Admin | Notifications</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')
@endsection
@section('content')
@include('admin.inc.breadcrumb',['page' => 'Post visit'])

<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-users"></i> New user visit notifications</h3>
                As an admin you can view notifications regarding your posts
              </div>
              <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover display data-table" id="user_table" style="width: 100%;">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th>Time</th>
                                 </tr>
                             </thead>
                             <tbody>
                             </tbody>
                         </table>
              </div>
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
        orderable: false,
        ajax: "{{ route('admin.notifications') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'message', name: 'message'},
            {data: 'time', name: 'time'},
        ],
        "fnDrawCallback": function(data) {
        }
    });
  });
</script>
@endsection
