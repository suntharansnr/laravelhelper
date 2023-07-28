<header id="scrolltops">
  <div class="container">
  <nav class="navbar navbar-expand-lg shrink shadow fixed-top" id="banner">
       <!-- Brand -->
       <a class="navbar-brand" href="{{route('homepage')}}"><img src="{{asset($theme->logo)}}" alt="Laravelhelper" class="img-fluid"></a>
      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        {{-- <li class="nav-item">
          <a class="nav-link">Learn laravel from begginer level to master level on laravel.xyz</a>
        </li> --}}
        @if(Auth::check())
        @else
          <li class="nav-item">
            <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}" href="{{route('login')}}"><i class="fas fa-sign-in-alt"></i> Login<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}" href="{{route('register')}}"><i class="fa fa-user-plus"></i> Register<span class="sr-only">(current)</span></a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="https://wa.me/+940773624880">Hire us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('blog.popular')}}">Popular posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('blog.recent')}}">Recently visited</a>
        </li>
        @if(Auth::check())
        <li class="nav-item">
        <a class="nav-link {{ Route::is('logout') ? 'active' : '' }}" href="{{route('logout')}}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         <i class="fa fa-sign-out"></i> Log-out</a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
        </li>
        @endif
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search here..." aria-label="Search" id="search" onkeyup="searchBlog()">
      </form>
      <div class="card search_result" id="searchBox" style="display: none">
        <div class="card-body">
          <div id="searchResults"></div>
        </div>
      </div>
      </div>
  </nav>
</header>
