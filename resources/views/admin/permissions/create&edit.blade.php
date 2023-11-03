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
                                                <input type="hidden" name="id" id="permission_id">
                                                <div class="row">
                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="name" id="name" data-parsley-trigger="change" required placeholder="Enter permission name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
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