 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin/home')}}" class="brand-link">
    <img src="{{asset('image/football.png')}}" alt="lara Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Football</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{asset('image/programmer.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ Auth::guard('admin')->user()->username }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{url('/admin/home')}}" class="nav-link  @yield('admin')" >
            <i class="nav-icon text-success fas fa-user"></i>
            <p>Admin</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('/admin/users')}}" class="nav-link @yield('user')" >
            <i class="nav-icon text-primary fas fa-user"></i>
            <p>User</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('/admin/leagues')}}" class="nav-link @yield('league')" >
            <i class="nav-icon text-light fas fa-futbol"></i>
            <p>League</p>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#"
                onclick="
                event.preventDefault();
                if(confirm('Are you sure you want to logout?'))
                document.getElementById('logout-form').submit();
                ">
                <p> <i class="nav-icon text-danger fas fa-power-off"></i> Logout</p>
            </a>

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>