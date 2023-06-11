<nav class="navbar navbar-expand-lg fixed-top" id="navbar" style="background-image: linear-gradient(to right,#E7F1FC,#277FE5);">
<button align="left"  name="button" id="menu-toggle" class="btn btn-info"><i class="fa fa-bars" style="font-size:1.2rem"></i></button>
  <li class="dropdown d-lg-none" style="list-style:none">
        <a align="right" href="#" id="mobilenotifications" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fa-stack fa-3x" data-count="" id="mobilecountno" style="font-size:1.6rem;">
                  <i class="fa fa-bell fa-stack-1x fa-inverse"></i>
            </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="mobilenotificationsMenu" id="mobilenotificationsMenu" style="padding:10px !important;padding-bottom:0px !important;padding-top:0px !important;margin-top:10px !important;width:250px">
                  <li class="dropdown-header">No notifications</li>
        </ul>
      </li>

      <li class="dropdown d-lg-none" style="list-style:none">
        <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img align="right" src="{{asset(Auth::user()->profile_photo_path)}}" style="width:40px;height:40px;border-radius:50%">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top:10px !important;width:175px">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </div>
      </li>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown" style="width:175px;">
        <a href="#" id="notifications" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fa-stack fa-3x" data-count="" id="countno" style="font-size:1.6rem;margin-left:120px !important;">
                  <i class="fa fa-bell fa-stack-1x fa-inverse"></i>
            </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsMenu" id="notificationsMenu" style="padding:10px !important;padding-bottom:0px !important;padding-top:0px !important;margin-top:10px !important;width:250px">
                  <li class="dropdown-header">No notifications</li>
        </ul>
      </li>

      <li class="nav-item dropdown" style="width:70px;">
        <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img align="right" src="{{asset(Auth::user()->profile_photo_path)}}" class="nav-link dropdown-toggle" style="width:50px;height:50px;border-radius:50%">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top:10px !important;width:175px">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </div>
      </li>
    </ul>
  </div>
</nav>

