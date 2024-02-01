<!-- Main Sidebar Container -->
  <aside class="main-sidebar">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{!! asset('theme/dist/img/sideHeader-logo.png') !!}" alt="AdminLTE Logo" class="img-fluid">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel d-flex">
        <div class="user_img">
          <img src="{!! asset('theme/dist/img/avatar5.png') !!}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="userName d-flex align-items-center">
          <a href="{{ route('profile') }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 menu__nav">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('job-categories.index') }}" class="nav-link {{ (request()->is('job-categories*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-list-ul"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ (request()->is('subscribers*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Subscribers
                <i class="fas fa-angle-up float-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('subscribers.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Subscribers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('subscribers.index') }}?s=Yes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('subscribers.index') }}?s=No" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Deactivated</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('emaillogs.index') }}" class="nav-link {{ (request()->is('emaillogs*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-envelope"></i>
              <p>
                Email Logs
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <div class="last_child">
            <a class="" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                <i class="fa fa-sign-out-alt"></i>
            </a>
      </div>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>