<body class="nav-md">
    <!-- Flash Message Popup -->
    <div id="flash-overlay" style="display: none;">
        <div id="flash-popup">
            <h2 id="flash-title"></h2>
            <p id="flash-message"></p>
        </div>
    </div>

    <div class="container body">
        <div class="main_container">
            <!-- left sidebar -->
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ route('dashboard.index') }}" class="site_title text-center">
                            <img src="{{ asset('assets/img/Daihatsu_logo_2.png') }}" style="width: 180px">
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            @if (session('user_photo') != null)
                                <img src="{{ asset('assets/img/employee/') }}/{{ session('user_photo') }}" alt="..."
                                    class="img-circle profile_img" style="width: 70px; height: 70px;">
                            @else
                                <img src="{{ asset('assets/img/user.png') }}" alt="..." class="img-circle profile_img"
                                    style="width: 70px; height: 70px;">
                            @endif
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <a href="{{ route('dashboard.index') }}">
                                <h2>{{ session('nama') }}</h2>
                            </a>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Main</h3>
                            <ul class="nav side-menu">
                                <li><a href="{{ route('dashboard.index') }}"><b><i
                                                class="fa fa-home"></i>Dashboard</a></b></li>

                                @if (session('role') == 'Service Advisor 1' || session('role') == 'Service Advisor 2' || session('role') == 'Service Advisor 3' || session('role') == 'Umum' )
                                    <li><a><b><i class="fa fa-pencil-square-o"></i>Transaction<span
                                                    class="fa fa-chevron-down"></span></b></a>
                                        <ul class="nav child_menu">
                                            @if (session('role') == 'Service Advisor 1' || session('role') == 'Service Advisor 2' || session('role') == 'Service Advisor 3' || session('role') == 'Umum')
                                                <li>
                                                    <a href="{{ route('estimasibiayas.index') }}">Estimasi Biaya</a>
                                                </li>
                                            @endif

                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        @if (session('role') == 'Service Advisor 1' || session('role') == 'Service Advisor 2' || session('role') == 'Service Advisor 3')
                            <div class="menu_section">
                                <h3>Master Data</h3>
                                <ul class="nav side-menu">
                                    <li><a><b><i class="fa fa-database"></i>Master Data<span
                                                    class="fa fa-chevron-down"></span></b></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ route('parts.index') }}">Part</a></li>
                                            <li><a href="{{ route('materials.index') }}">Material</a></li>
                                            <li><a href="{{ route('jasavendors.index') }}">Jasa Vendor</a></li>
                                            <li><a href="{{ route('jasaberkalas.index') }}">Jasa Berkala</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars text-white"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class="navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px; font-size: 15px;">
                                <a id="currentDateTime" class="text-white"></a>
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    @if (session('user_photo') != null)
                                        | {{ session('user_name') }}<img class="ml-3"
                                            src="{{ asset('assets/img/employee/') }}/{{ session('emp_photo') }}">
                                    @else
                                        | {{ session('user_name') }}<img class="ml-3"
                                            src="{{ asset('assets/img/user.png') }}">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i> Log Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- Content will be yielded here -->