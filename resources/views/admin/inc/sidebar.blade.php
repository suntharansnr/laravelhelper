<div class="" style="background:#192129;position: fixed;" id="sidebar-wrapper">
  <div class="card pb-0" style="border-radius:0px;background-color:transparent !important;">
  <a class="text-center" href="{{route('dashboard')}}">
          <img src="{{$theme->logo}}" alt=""  class="justify-content-center" style="height: 100px;width:auto">
  </a>
  </div>
  <div class="card" style="border-radius:0px;background-color:transparent !important;height:100vh;overflow-y:scroll;">
    <ul class="list-group list-group-flush" style="background-color:transparent !important">
      @can('home-list')
      <a class="{{ Route::is('dashboard') ? 'ho' : '' }} vraj" href="{{route('dashboard')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-sm-2 col-2">
              <i class="fas fa-tachometer-alt"></i>
            </div>
            <div class="col-md-10 col-sm-10  col-10">
              <span> Dashboard</span>
            </div>
          </div>
        </li>
      </a>
      @endcan

      @can('role-list')
      <a class="{{ Route::is('roles.index') ? 'ho' : '' }} vraj" href="{{route('roles.index')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fas fa-user-tag"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Roles Mng</span>
            </div>
          </div>
        </li>
      </a>
      @endif

      @can('permission-list')
      <a class="{{ Route::is('permissions.index') ? 'ho' : '' }} vraj" href="{{route('permissions.index')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fas fa-user-tag"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Permissions</span>
            </div>
          </div>
        </li>
      </a>
      @endif

      @can('user-list')
      <a class="{{ Route::is('users.index') ? 'ho' : '' }} vraj" href="{{route('users.index')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-users"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>User Mng</span>
            </div>
          </div>
        </li>
      </a>
      @endcan

      @can('notification-list')
      <a class="{{ Route::is('admin.notifications') ? 'ho' : '' }} vraj" href="{{route('admin.notifications')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-bell"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Notifications</span>
            </div>
          </div>
        </li>
      </a>
      @endcan

      @can('subscription-list')
      <a class="{{ Route::is('subscriptions.index') ? 'ho' : '' }} vraj" href="{{route('subscriptions.index')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-users"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Subscriptions</span>
            </div>
          </div>
        </li>
      </a>
      @endcan

      @can('category-list')
      <a class="{{ Route::is('category.index') ? 'ho' : '' }} vraj" href="{{route('category.index')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-inbox"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Categories</span>
            </div>
          </div>
        </li>
      </a>
      @endcan

      @canany(['post-list','tag-list'])
      <a class="rounded-0 vraj" data-toggle="collapse" href="#blog" role="button" @if (\Route::current()->getName() == "tag.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "post.index")
        aria-expanded="true"
        @else
        aria-expanded="false"
        @endif aria-controls="collapseExample">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fas fa-blog"></i>
            </div>
            <div class="col-md-8 col-8">
              <span>Blog</span>
            </div>
            <div class="col-md-2 col-2">
              <i class="fa ravis"></i>
            </div>
          </div>
        </li>
      </a>
      @endcan
      <div class="collapse @if(\Route::current()->getName() == " tag.index") show @elseif (\Route::current()->getName() == "post.index")
        show
        @else
        @endif" id="blog">
        <div class="card card-body rounded-0" style="padding:0px !important;background:transparent !important">
          @can('tag-list')
          <a class="{{ Route::is('tag.index') ? 'ho' : '' }} vraj" href="{{route('tag.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-10">
                  <span>Tags</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan
          @can('post-list')
          <a class="{{ Route::is('post.index') ? 'ho' : '' }}" href="{{route('post.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Posts</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan
        </div>
      </div>

      @canany(['theme-list','meta-list'])
      <a class="rounded-0 vraj" data-toggle="collapse" href="#meta_tag" role="button" aria-controls="collapseExample" @if (\Route::current()->getName() == "theme.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "meta.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "slider.index")
        aria-expanded="true"
        @else
        aria-expanded="false"
        @endif>
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-cog"></i>
            </div>
            <div class="col-md-8 col-8">
              <span>Settings</span>
            </div>
            <div class="col-md-2 col-2">
              <i class="fa ravis"></i>
            </div>
          </div>
        </li>
      </a>
      <div id="meta_tag" class="collapse 
        @if (\Route::current()->getName() == " theme.index") 
        show 
        @elseif (\Route::current()->getName() == "meta.index")
        show
        @elseif (\Route::current()->getName() == "slider.index")
        show
        @else

        @endif">
        <div class="card card-body rounded-0" style="padding:0px !important;background-color:transparent">
          @can('theme-list')
          <a class="{{ Route::is('theme.index') ? 'ho' : '' }}" href="{{route('theme.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Theme Setting</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan

          @can('slider-list')
          <a class="{{ Route::is('slider.index') ? 'ho' : '' }}" href="{{route('slider.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Slider Setting</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan

          @can('meta-list')
          <a class="{{ Route::is('meta.index') ? 'ho' : '' }}" href="{{route('meta.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem"></i>
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Meta tag</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan
        </div>
      </div>
      @endcan

      <a class="{{ Route::is('profile.show') ? 'ho' : '' }} vraj" href="{{route('profile.show')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-user"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Profile</span>
            </div>
          </div>
        </li>
      </a>
  </div>
</div>