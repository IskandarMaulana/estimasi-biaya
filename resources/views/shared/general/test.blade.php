<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/daihatsu_favicon.png') }}" type="image/ico" />

    <title>{{ config('app.name', 'Estimasi Biaya') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendorsadmin/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendorsadmin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/vendorsadmin/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Custom Scroll -->
    <link href="{{ asset('assets/vendorsadmin/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}"
        rel="stylesheet" />
    <!-- iCheck -->
    <link href="{{ asset('assets/vendorsadmin/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('assets/vendorsadmin/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('assets/vendorsadmin/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('assets/vendorsadmin/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link href="{{ asset('assets/vendorsadmin/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendorsadmin/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/vendorsadmin/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/vendorsadmin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/vendorsadmin/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
        rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/vendorsadmin/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/buildadmin/css/custom.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('assets/vendorsadmin/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- Flatpickr -->
    <link href="{{ asset('assets/vendorsadmin/node_modules/flatpickr/dist/flatpickr.min.css') }}" rel="stylesheet">

    @stack('styles')

    <style>
        #flash-overlay {
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.4);
            /* semi-transparent black */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #flash-popup {
            background: white;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 90%;
        }

        .left_col {
            background-color: #373737 !important;
        }

        .nav_title {
            background-color: #373737 !important;
        }
    </style>
</head>

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
                        <a href="{{ route('parts.index') }}" class="site_title text-center">
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
                            <a href="{{ route('parts.index') }}">
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
                                <li><a href="{{ route('parts.index') }}"><b><i
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
                                <li><a href="{{ route('materials.index') }}"><b><i class="fa fa-calendar"></i>Working Calendar</b></a></li>
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
                                            <li><a href="{{ route('materials.index') }}">Calendar</a></li>
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

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- Content will be yielded here -->
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Developed by : Estimasi Biaya Team
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    @if (session('message'))
        <script>
            $(document).ready(function () {
                Swal.fire({
                    title: "{{ session('title') }}",
                    text: "{{ session('message') }}",
                    icon: "{{ session('ikon') }}",
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif

    <!-- jQuery -->
    <script src="{{ asset('assets/vendorsadmin/jquery/dist/jquery.min.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('assets/vendorsadmin/select2/dist/js/select2.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendorsadmin/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets/vendorsadmin/nprogress/nprogress.js') }}"></script>
    <script
        src="{{ asset('assets/vendorsadmin/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('assets/vendorsadmin/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/morris.js/morris.min.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('assets/vendorsadmin/DateJS/build/date.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('assets/vendorsadmin/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('assets/vendorsadmin/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>

    <script src="{{ asset('assets/vendorsadmin/node_modules/xlsx/dist/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/node_modules/flatpickr/dist/flatpickr.min.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('assets/buildadmin/js/custom.min.js') }}"></script>

    <script src="{{ asset('assets/vendorsadmin/node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script>
        // Function to update the date and time
        function updateDateTime() {
            var now = new Date();
            var options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            $('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
        }
        
        // Update the date and time on page load
        updateDateTime();
        
        // Update the date and time every second
        setInterval(updateDateTime, 1000);
    </script>

    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>
</html>
<!-- Global Javascript -->
<script>
    var dataTable;
    $(document).ready(function () {
        dataTable = $("#datatable-fixed-header").DataTable({
            fixedHeader: true,
            searching: true,
            scrollX: true,
        });
    });

    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    function resetForm() {
        $('form')[0].reset();
    }

    function hapus(id, url) {
        Swal.fire({
            title: 'Delete Confirmation',
            text: 'Are you sure you want to delete this data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const token = $('meta[name="csrf-token"]').attr('content');

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.icon,
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            if (result.isConfirmed || result.dismiss) {
                                location.reload();
                            }
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'An error occurred while contacting the server',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    });
            }
        });
    }

    function updateStatus(checkbox, status, id, url) {
        Swal.fire({
            title: 'Status Confirmation',
            text: 'Are you sure you want to change the status?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const token = $('meta[name="csrf-token"]').attr('content');

                fetch(url, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id,
                        status: status
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.icon,
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            if (result.isConfirmed || result.dismiss) {
                                location.reload();
                            }
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'An error occurred while contacting the server',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            if (result.isConfirmed || result.dismiss) {
                                location.reload();
                            }
                        });
                    });
            } else {
                // If user selects "Cancel", revert checkbox to original state
                setTimeout(function () {
                    checkbox.checked = !checkbox.checked;
                }, 0);
            }
        });
    }

    function handleKeyPress(event) {
        if (event.key === "Enter") {
            search();
        }
    }

    function reset() {
        location.reload();
    }

    function checkMaxLength(input, maxLength) {
        // Check if the input starts with a plus sign
        var hasPlusSign = input.value.startsWith('+');

        // Remove non-digit characters (excluding the plus sign)
        var sanitizedValue = input.value.replace(/\D/g, '');

        // Truncate the value to the maximum length
        var truncatedValue = sanitizedValue.slice(0, maxLength);

        // Add the plus sign back if it was originally present
        input.value = (hasPlusSign ? '+' : '') + truncatedValue;
    }

    function showDelayedAlert(timerset) {
        let timerInterval;
        Swal.fire({
            title: "System Processing!",
            html: "Please wait while processing...",
            allowOutsideClick: false,
            showCloseButton: false,
            didOpen: () => {
                Swal.showLoading();
                setTimeout(() => {
                    Swal.close();
                }, timerset);
            },
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
            }
        });
    }

    function alertnormal(title, message, icon) {
        Swal.fire({
            title: title,
            text: message,
            icon: icon,
            confirmButtonText: 'OK',
            timer: 5000,
            timerProgressBar: true,
        });
    }
</script>

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
</html>