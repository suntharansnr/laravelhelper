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

      @canany(['radio-list','category-list','language-list','genre-list','type-list'])
      <a class="rounded-0 vraj" data-toggle="collapse" href="#radio" role="button" @if (\Route::current()->getName() == "radio.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "category.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "language.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "genre.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "type.index")
        aria-expanded="true"
        @else
        aria-expanded="false"
        @endif aria-controls="collapseExample">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-music"></i>
            </div>
            <div class="col-md-8 col-8">
              <span>Radio Mng</span>
            </div>
            <div class="col-md-2 col-2">
              <i class="fa ravis"></i>
            </div>
          </div>
        </li>
      </a>
      @endcan
      <div class="collapse @if(\Route::current()->getName() == " radio.index") show @elseif (\Route::current()->getName() == "category.index")
        show
        @elseif (\Route::current()->getName() == "language.index")
        show
        @elseif (\Route::current()->getName() == "genre.index")
        show
        @elseif (\Route::current()->getName() == "type.index")
        show
        @else
        @endif" id="radio">
        <div class="card card-body rounded-0" style="padding:0px !important;background:transparent !important">
          @can('radio-list')
          <a class="{{ Route::is('radio.index') ? 'ho' : '' }}" href="{{route('radio.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Radios</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div </div>
            </li>
          </a>
          @endcan

          @can('category-list')
          <a class="{{ Route::is('category.index') ? 'ho' : '' }}" href="{{route('category.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Categories</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan

          @can('language-list')
          <a class="{{ Route::is('language.index') ? 'ho' : '' }}" href="{{route('language.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Languages</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan

          @can('genre-list')
          <a class="{{ Route::is('genre.index') ? 'ho' : '' }}" href="{{route('genre.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Genres</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan

          @can('type-list')
          <a class="{{ Route::is('type.index') ? 'ho' : '' }}" href="{{route('type.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Types</span>
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


      @can('contact-list')
      <a class="{{ Route::is('contact.index') ? 'ho' : '' }} vraj" href="{{route('contact.index')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-inbox"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Message</span>
            </div>
          </div>
        </li>
      </a>
      @endcan
      @can('report-list')
      <a class="{{ Route::is('report.index') ? 'ho' : '' }} vraj" href="{{route('report.index')}}">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-file"></i>
            </div>
            <div class="col-md-10 col-10">
              <span>Report</span>
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

      @if(Auth::check())
      @if(Auth::user()->isAdmin())
      <a class="rounded-0 vraj" data-toggle="collapse" href="#page" role="button" @if (\Route::current()->getName() == "about.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "faq.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "testimonial.index")
        aria-expanded="true"
        @else
        aria-expanded="false"
        @endif aria-controls="collapseExample">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fas fa-file"></i>
            </div>
            <div class="col-md-8 col-8">
              <span>Pages</span>
            </div>
            <div class="col-md-2 col-2">
              <i class="fa ravis"></i>
            </div>
          </div>
        </li>
      </a>
      <div class="collapse @if(\Route::current()->getName() == " about.index") show @elseif (\Route::current()->getName() == "faq.index")
        show
        @elseif (\Route::current()->getName() == "testimonial.index")
        show
        @else
        @endif" id="page">
        <div class="card card-body rounded-0" style="padding:0px !important;background:transparent !important">
          <a class="{{ Route::is('about.index') ? 'ho' : '' }}" href="{{route('about.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem"></i>
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>About us</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          <a class="{{ Route::is('faq.index') ? 'ho' : '' }}" href="{{route('faq.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Faq</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          <a class="{{ Route::is('testimonial.index') ? 'ho' : '' }}" href="{{route('testimonial.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem">
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Testimonial</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
        </div>
      </div>
      @endif
      @endif

      @canany(['theme-list','meta-list','social-list'])
      <a class="rounded-0 vraj" data-toggle="collapse" href="#meta_tag" role="button" aria-controls="collapseExample" @if (\Route::current()->getName() == "theme.index")
        aria-expanded="true"
        @elseif (\Route::current()->getName() == "social-urls.index")
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
      <div id="meta_tag" class="collapse @if (\Route::current()->getName() == " theme.index") show @elseif (\Route::current()->getName() == "social-urls.index")
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

          @can('social-list')
          <a class="{{ Route::is('social-urls.index') ? 'ho' : '' }}" href="{{route('social-urls.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem"></i>
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Social URL</span>
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

      @canany(['continent-list','country-list','state-list','city-list'])
      <a class="rounded-0 vraj" data-toggle="collapse" href="#countries" role="button" aria-expanded="false" aria-controls="collapseExample">
        <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:1.05rem">
          <div class="row">
            <div class="col-md-2 col-2">
              <i class="fa fa-map-marker"></i>
            </div>
            <div class="col-md-8 col-8">
              <span>Locations</span>
            </div>
            <div class="col-md-2 col-2">
              <i class="fa ravis"></i>
            </div>
          </div>
        </li>
      </a>
      @endcan

      <div class="collapse" id="countries">
        <div class="card card-body rounded-0" style="padding:0px !important;background-color:transparent">
          @can('continent-list')
          <a class="{{ Route::is('continent.index') ? 'ho' : '' }}" href="{{route('continent.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem"></i>
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Continent</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan
          @can('country-list')
          <a class="{{ Route::is('country.index') ? 'ho' : '' }}" href="{{route('country.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem"></i>
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Countries</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan
          @can('state-list')
          <a class="{{ Route::is('state.index') ? 'ho' : '' }}" href="{{route('state.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem"></i>
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>States</span>
                </div>
                <div class="col-md-2 col-2">
                  <i class="fa ravis"></i>
                </div>
              </div>
            </li>
          </a>
          @endcan
          @can('city-list')
          <a class="{{ Route::is('city.index') ? 'ho' : '' }}" href="{{route('city.index')}}">
            <li class="list-group-item" style="background-color:transparent !important;color:#fff;font-size:0.9rem"></i>
              <div class="row">
                <div class="col-md-2 col-2">
                </div>
                <div class="col-md-8 col-8">
                  <span>Cities</span>
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