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
                  <p class="float-right" style="color:#212529;font-weight:600">Home / <span style="color:#6c757d">{{$page}} management</span> </p>
                </div>
            </div>
      </div>
      <!-- end row -->
</div>