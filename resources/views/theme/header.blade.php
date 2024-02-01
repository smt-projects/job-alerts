<!-- Left navbar links -->
    <ul class="navbar-nav topNav_list">
      <li class="nav-item hamburger_icon">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://www.vanderhouwen.com/" class="nav-link" target="_blank"><i class="fas fa-globe-africa pr-2"></i>Visit Website</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">0 Notifications</span>
          <div class="dropdown-divider"></div>
          <span id="notiarea">
              <a href="#" class="dropdown-item">
                <span id="unsubnoti"></span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <span id="alertnoti"></span>
              </a>
          </span>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="" href="{{ route('profile') }}" role="button">
          <i class="fas fa-cog"></i>
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
              <i class="fa fa-sign-out-alt"></i>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
      </li>
    </ul>