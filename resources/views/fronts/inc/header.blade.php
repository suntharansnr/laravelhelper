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
        <li class="nav-item">
          <a class="nav-link" href="{{route('blog.popular')}}">Popular posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('blog.recent')}}">Recently visited</a>
        </li>
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
