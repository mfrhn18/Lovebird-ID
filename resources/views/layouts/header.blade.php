<header class="main-header">
    <!-- Logo -->
    <a href="/home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>L</b>ID</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Lovebird ID</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{Session::get('src')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Session::get('name')}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{Session::get('src')}}" class="img-circle" alt="User Image">

                            <p>
                                {{Session::get('name')}}
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-body">
                            <div class="pull-left">
                                <a href="/breeder" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route ('login.create') }}" class="btn btn-default btn-flat">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>