@extends('admin.layouts.master')
@section('content')
<div class="container-fluid" style="padding:0px;">
      <div class="card shadow" style="border-radius:0px;padding:3px;background-color:#ffffff;color:#212529 ;padding:10px;">
            <div class="row">
                <div class="col-md-8">
                            <h4 style="background:#fff">Admin Dashboard</h4>
                </div>
                <div class="col-md-4">
                  <p class="float-right" style="color:#212529;font-weight:600">Home / <span style="color:#6c757d">show role</span> </p>
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
                    <strong>Permissions:</strong>
                    <div class="row">
                    @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                    <div class="col-md-3">
                        <span class="text-black font-weight-bold">{{ $v->name }}</span>
                    </div>
                    @endforeach
                    @endif
                    </div>
              </div> 
  </div>
</div>
@endsection