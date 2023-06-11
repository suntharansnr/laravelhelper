
@extends('admin.layouts.master')
@section('content')
<div class="container-fluid" style="padding:0px;">
      <div class="card shadow" style="border-radius:0px;padding:3px;background-color:#ffffff;color:#212529 ;padding:10px;">
            <div class="row">
                <div class="col-md-8">
                            <h4 style="background:#fff">Admin Dashboard</h4>
                </div>
                <div class="col-md-4">
                  <p class="float-right" style="color:#212529;font-weight:600">Home / <span style="color:#6c757d">edit role {{$role->name}}</span> </p>
                </div>
            </div>
      </div>
      <!-- end row -->
</div>

<div class="container-fluid" style="padding:30px;background-color:#efefef;min-height:100vh">
  <div class="card mb-3">
              <div class="card-header">
                <h3><i class="fa fa-building"></i> <strong>Name:</strong>
                {{ $role->name }}</h3>
                As an admin you can manage all the roles!
                <a role="button" href="{{route('roles.index')}}" class="btn btn-primary btn-sm float-right">back <i class="fa fa-back"></i></a>
              </div>
              <div class="card-body">
                   {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                       <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                      <strong>Name:</strong>
                                      {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','disabled' => 'disabled')) !!}
                                </div>
                            </div>
                        </div>
                        <strong>Permission:</strong><br/>
                        <p class="text-danger"> @if($errors->has('permission')) {{ $errors->first('permission') }} @endif</p>
                        <div class="row">
                            @foreach($permission as $value)
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                     <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                     {{ $value->name }}</label><br/>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                 <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                   {!! Form::close() !!}
              </div> 
  </div>
</div>
@endsection


