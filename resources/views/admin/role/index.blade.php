@extends('admin.layouts.master')
@section('content')
@include('admin.inc.breadcrumb',['page' => 'Roles'])
<div class="container-fluid" style="padding:30px;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-building"></i> roles details</h3>
                As an admin you can manage all the roles!
                <a role="button" href="{{route('roles.create')}}" class="btn btn-primary btn-sm float-right">Create new role <i class="fa fa-plus"></i></a>
              </div>
              <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover display data-table" id="user_table" style="width: 100%;"> 
                             <thead>
                                 <tr>
                                     <th scope="col">ID</th>
                                     <th scope="col">Name</th>
                                     <th width="35%">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                             @foreach ($roles as $key => $role)
                                      <tr>
                                          <td>{{ ++$i }}</td>
                                          <td>{{ $role->name }}</td>
                                          <td>
                                              <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
                                              @can('role-edit')
                                                  <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                              @endcan
                                              @can('role-delete')
                                                  <!--display:inline-->
                                                  {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:none']) !!}
                                                      {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                  {!! Form::close() !!}
                                              @endcan
                                          </td>
                                      </tr>
                             @endforeach
                             </tbody>
                         </table>
              </div>
  </div>
</div>
{!! $roles->render() !!}
@endsection