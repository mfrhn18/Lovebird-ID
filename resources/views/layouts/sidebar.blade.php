<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Session::get('src')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Session::get('name')}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="home">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="birdfarm">
                    <i class="glyphicon glyphicon-info-sign"></i> <span>BirdFarm Management</span>
                </a>
            </li>
            <li>
                <a href="breeding">
                    <i class="glyphicon glyphicon-record"></i> <span>Breeding</span>
                </a>
            </li>
            <li>
                <a href="gallery">
                    <i class="fa fa-picture-o"></i> <span>Gallery</span>
                </a>
            </li>
            <li>
                <a href="finance">
                    <i class="fa fa-dollar"></i> <span>Finance</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>