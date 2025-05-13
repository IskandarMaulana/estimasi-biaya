<style>
    .left_col {
        background-color: #373737 !important;
    }

    .nav_title {
        background-color: #373737 !important;
    }
</style>

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
                @if (session('emp_photo') != null)
                    <img src="{{ asset('assets/file/img/employee/') }}/{{ session('emp_photo') }}"
                        alt="..." class="img-circle profile_img" style="width: 70px; height: 70px;">
                @else
                    <img src="{{ asset('assets/file/img/empty_photo.png') }}" alt="..."
                        class="img-circle profile_img" style="width: 70px; height: 70px;">
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

                    @if (session('role') != "Service Advisor" && session('role') != "Ordering")
                        <li><a><b><i class="fa fa-pencil-square-o"></i>Transaction<span
                                        class="fa fa-chevron-down"></span></b></a>
                            <ul class="nav child_menu">
                                @if (session('role') != "Supervisor")
                                    <li>
                                        @if (session('role') == "Team" && in_array(session('plt_id'), ["4", "5"]))
                                            <a href="{{ route('trs_jitpartreturn.index') }}">Return Part by JIT</a>
                                        @else
                                            <a href="{{ route('trs_jitpartreturn.index_supplier') }}">Return Part by JIT</a>
                                        @endif
                                    </li>
                                @endif

                                @if (session('role') != "Supervisor")
                                    <li>
                                        @if (session('role') == "Team" && in_array(session('plt_id'), ["4", "5"]))
                                            <a href="{{ route('trs_wospartexchange.index') }}">Exchange Part by WOS</a>
                                        @else
                                            <a href="{{ route('trs_wospartexchange.index_supplier') }}">Exchange Part by WOS</a>
                                        @endif
                                    </li>
                                @endif

                                @if (session('role') != "Supervisor")
                                    <li>
                                        @if (session('role') == "Team" && in_array(session('plt_id'), ["4", "5"]))
                                            <a href="{{ route('trs_wospartreturn.index') }}">Return Part by WOS</a>
                                        @else
                                            <a href="{{ route('trs_wospartreturn.index_supplier') }}">Return Part by WOS</a>
                                        @endif
                                    </li>
                                @endif
                            </ul>
                        </li>

                        <li><a style="font-size: 12px;"><b><i class="fa fa-th-large"></i>Recap Transaction<span
                                        class="fa fa-chevron-down"></span></b></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('recap_data.recap_return_part_jit') }}">Recap Return Part by JIT</a></li>
                                <li><a href="{{ route('recap_data.recapbm') }}">Recap Exchange Part by WOS</a></li>
                                <li><a href="{{ route('recap_data.recapall') }}">Recap Return Part by WOS</a></li>
                            </ul>
                        </li>

                        @if (session('rol_scanner') == "10")
                            <li><a style="font-size: 12px;"><b><i class="fa fa-qrcode"></i>Scanning<span
                                            class="fa fa-chevron-down"></span></b></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('trs_jitpartreturn.scanQRJITReturnP4') }}">Scan Return Part by JIT</a></li>
                                    <li><a href="{{ route('trs_wospartexchange.scanQRExchangeP4') }}">Scan Exchange Part by WOS</a></li>
                                    <li><a href="{{ route('trs_wospartreturn.scanQRReturnP4') }}">Scan Return Part by WOS</a></li>
                                </ul>
                            </li>
                        @endif
                    @endif

                    @if (session('role') == "Admin Inventory")
                        <li><a style="font-size: 12px;"><b><i class="fa fa-archive"></i>Inventory<span
                                        class="fa fa-chevron-down"></span></b></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('inventory.pull_return_part_jit') }}">Return Part by JIT</a></li>
                                <li><a href="{{ route('inventory.exchange_part_jit') }}">Exchange Part by WOS</a></li>
                                <li><a href="{{ route('inventory.return_part_wos') }}">Return Part by WOS</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (session('role') == "Ordering")
                        <li><a style="font-size: 12px;"><b><i class="fa fa-shopping-cart"></i>Add Order<span
                                        class="fa fa-chevron-down"></span></b></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('ordering.pull_order_return_part_jit') }}">Return Part by JIT</a></li>
                                <li><a href="{{ route('inventory.exchange_part_jit') }}">Exchange Part by WOS</a></li>
                                <li><a href="{{ route('inventory.return_part_wos') }}">Return Part by WOS</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('mst_calendar.view') }}"><b><i class="fa fa-calendar"></i>Working Calendar</b></a></li>
                </ul>
            </div>
            
            @if (session('role') == "Admin")
                <div class="menu_section">
                    <h3>Master Data</h3>
                    <ul class="nav side-menu">
                        <li><a><i class="fa fa-book"></i><b>Company Master Data<span
                                        class="fa fa-chevron-down"></span></b></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('mst_employee.index') }}">Employee</a></li>
                                <li><a href="{{ route('mst_role.index') }}">Role</a></li>
                                <li><a href="{{ route('mst_level.index') }}">Job Level</a></li>
                                <li><a href="{{ route('mst_plant.index') }}">Plant</a></li>
                                <li><a href="{{ route('mst_area.index') }}">Area</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-book"></i><b>Operational Master Data<span
                                        class="fa fa-chevron-down"></span></b></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('mst_route.index') }}">Route</a></li>
                                <li><a href="{{ route('mst_part.index') }}">Part</a></li>
                                <li><a href="{{ route('mst_shift.index') }}">Shift</a></li>
                                <li><a href="{{ route('mst_supplierexternal.index') }}">Supplier Eksternal</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-book"></i><b>Supporting Master Data <span
                                        class="fa fa-chevron-down"></span></b></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('mst_calendar.index') }}">Calendar</a></li>
                                <li><a href="{{ route('mst_greeting.index') }}">Greeting</a></li>
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
                        @if (session('emp_photo') != null)
                            | {{ session('emp_name') }}<img class="ml-3"
                                src="{{ asset('assets/file/img/employee/') }}/{{ session('emp_photo') }}">
                        @else
                            | {{ session('emp_name') }}<img class="ml-3"
                                src="{{ asset('assets/file/img/empty_photo.png') }}">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right"
                        aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile.index') }}"> Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
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

<script>
    function updateTime() {
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        const now = new Date();
        const day = days[now.getDay()];
        const date = now.getDate();
        const month = months[now.getMonth()];
        const year = now.getFullYear();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');

        const suffix = getOrdinalSuffix(date);
        const formattedDateTime = `${day}, ${month} ${date}${suffix}, ${year}`;

        $('currentDateTime').innerText = formattedDateTime;
    }

    function getOrdinalSuffix(day) {
        if (day === 1 || day === 21 || day === 31) {
            return 'st';
        } else if (day === 2 || day === 22) {
            return 'nd';
        } else if (day === 3 || day === 23) {
            return 'rd';
        } else {
            return 'th';
        }
    }
    
    $(document).ready(function() {
        updateTime();
    });
</script>