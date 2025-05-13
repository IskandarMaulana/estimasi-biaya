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
    <link href="{{ asset('assets/vendorsadmin/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet" />
    <!-- iCheck -->
    <link href="{{ asset('assets/vendorsadmin/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('assets/vendorsadmin/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('assets/vendorsadmin/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('assets/vendorsadmin/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link href="{{ asset('assets/vendorsadmin/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendorsadmin/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendorsadmin/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendorsadmin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendorsadmin/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/vendorsadmin/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/buildadmin/css/custom.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('assets/vendorsadmin/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- Flatpickr -->
    <link href="{{ asset('assets/vendorsadmin/node_modules/flatpickr/dist/flatpickr.min.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>

<!-- Flash Message Popup -->
<div id="flash-overlay" style="display: none;">
    <div id="flash-popup">
        <h2 id="flash-title"></h2>
        <p id="flash-message"></p>
    </div>
</div>

<style>
    #flash-overlay {
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.4); /* semi-transparent black */
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
</style>

<!-- @if (session('message'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '{{ session('title') }}',
            text: '{{ session('message') }}',
            icon: '{{ session('ikon') }}',
            confirmButtonText: 'OK',
            timer: 3000,
            timerProgressBar: true,
        });
    });
</script>
@endif -->