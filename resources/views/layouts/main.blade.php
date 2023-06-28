<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset("assets/vendor/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/circular-std/style.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/libs/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/fontawesome/css/fontawesome-all.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/charts/chartist-bundle/chartist.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/charts/morris-bundle/morris.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/charts/c3charts/c3.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/flag-icon-css/flag-icon.min.css") }}">
    {{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> --}}
    @stack('head-link')
    {{-- <script src="{{ asset('js/gpsAPI.js') }}"></script> --}}
    <title>@yield('title', 'GPS APP')</title>

    {{-- Para acceder a ciertos datos del usuario --}}
    <script>
        const user = {!! json_encode((array) [
                'username' => auth()->user()->username,
                'empresa_id' => auth()->user()->empresa_id
            ]) !!};
    </script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        @include('components.navbar')
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- sidebar -->
        <!-- ============================================================== -->
        @include('components.sidebar')
        <!-- ============================================================== -->
        <!-- end sidebar -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- content  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        @yield('content')
                    </div>
                    <!-- ============================================================== -->
                    <!-- end content  -->
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->

    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- slimscroll js -->
    <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
    <!-- chart chartist js -->
    {{-- <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script> --}}
    <!-- sparkline js -->
    <script src="{{ asset('assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
    <!-- morris js -->
    {{-- <script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script> --}}
    <!-- chart c3 js -->
    <script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/js/dashboard-ecommerce.js') }}"></script> --}}
    @stack('body-link')
    
</body>

</html>