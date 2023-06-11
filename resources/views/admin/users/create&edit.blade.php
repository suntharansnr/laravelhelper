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
                                                          <label for="userName">Role<span class="text-danger">*</span></label>
                                                          <select class="form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" id="role" required name="roles" value="{{ old('roles') }}">
                                                              <option value="">Please select user role</option>
                                                              @foreach($roles as $role)
                                                              <option value="{{$role}}">{{$role}}</option>
                                                              @endforeach
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="name" id="name" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                                        <input type="email" name="email" id="email" data-parsley-trigger="change" required placeholder="Enter user email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6" id="hide_on_edit">
                                                    <div class="form-group">
                                                        <label for="password">Password<span class="text-danger">*</span></label>
                                                        <input type="password" name="password" id="password" data-parsley-trigger="change" required placeholder="Enter user password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}">
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