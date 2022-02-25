 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4" >
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
            <a href="{{url('/admin/dashboard')}}" class="nav-link  @yield('dashboard')" >
            <i class="nav-icon fas fa-gauge"></i>
            <p>Dashboard</p>
            </a>
        </li>
        @can('admin')
        <li class="nav-item">
            <a href="{{url('/admin/home')}}" class="nav-link  @yield('admin')" >
            <i class="nav-icon  fas fa-user"></i>
            <p>Admin</p>
            </a>
        </li>
        @endcan

        @can('role')
            <li class="nav-item ">
                <a href="{{url('/admin/roles')}}" class="nav-link @yield('role')" >
                <i class="nav-icon  fab fa-shirtsinbulk"></i>
                <p>Role</p>
                </a>
            </li>
        @endcan

        @can('permission')
        <li class="nav-item">
            <a href="{{url('/admin/permissions')}}" class="nav-link @yield('permission')" >
            <i class="nav-icon  fas fa-user-lock"></i>
            <p>Permission</p>
            </a>
        </li>
        @endcan

        @can('user')
        <li class="nav-item">
            <a href="{{url('/admin/users')}}" class="nav-link @yield('user')" >
            <i class="nav-icon  fas fa-user"></i>
            <p>User</p>
            </a>
        </li>
        @endcan

        @can('league')
        <li class="nav-item">
            <a href="{{url('/admin/leagues')}}" class="nav-link @yield('league')" >
            <i class="nav-icon text-light fas fa-futbol"></i>
            <p>League</p>
            </a>
        </li>
        @endcan

        @can('team')
        <li class="nav-item">
            <a href="{{url('/admin/teams')}}" class="nav-link @yield('team')" >
            <i class="nav-icon text-light fas fa-toolbox"></i>
            <p>Team</p>
            </a>
        </li>
        @endcan

        @can('match')
        <li class="nav-item">
            <a href="{{url('/admin/matches')}}" class="nav-link @yield('match')" >
            <i class="nav-icon text-white fas fa-futbol"></i>
            <p>Match</p>
            </a>
        </li>
        @endcan

        @can('odds')
        <li class="nav-item">
            <a href="{{url('/admin/odds')}}" class="nav-link @yield('odds')" >
            <i class="nav-icon text-white fas fa-money-bill-alt"></i>
            <p>Odds</p>
            </a>
        </li>
        @endcan


        @can('balance')
        <li class="nav-item">
            <a href="{{url('/admin/wallets')}}" class="nav-link @yield('wallet')" >
            <i class="nav-icon text-light fas fa-wallet"></i>
            <p>Balance</p>
            </a>
        </li>
        @endcan
        
        @can('balance')
        <li class="nav-item">
            <a href="{{url('/admin/wallets/history')}}" class="nav-link @yield('history')" >
            <i class="nav-icon text-light fas fa-history"></i>
            <p>Balance History</p>
            </a>
        </li>
        @endcan

        @can('bet')
        <li class="nav-item">
            <a href="{{url('/admin/bets')}}" class="nav-link @yield('bet')" >
            <i class="nav-icon text-light fas fa-dollar-sign"></i>
            <p>Bet</p>
            </a>
        </li>
        @endcan

        <li class="nav-item">
            <a href="{{url('/feedbacks')}}" class="nav-link @yield('feedback')" >
            <i class="nav-icon text-light fas fa-comment"></i>
            <p>Feedback</p>
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