<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>PANEL DE CONTROL</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('img/logo.ico') }}">


        <!-- App css -->
        <link href="{{ asset('admin_template/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin_template/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- import CSS -->
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link href="{{ asset('admin_template/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin_template/css/custom.css') }}" rel="stylesheet" type="text/css" />
        @stack('styles')
    </head>
    <body>

        <!-- Begin page -->

        <div id="app" >
            <div id="wrapper">
                <!-- Navbar Start -->
                @include('admin.template.navBar')
                <!-- end Navbar -->

                <!-- ========== Left Sidebar Start ========== -->
                @include('admin.template.leftSideBar')
                <!-- Left Sidebar End -->

                <!-- ============================================================== -->
                <!-- Start Page Content here -->
                <!-- ============================================================== -->

                <div class="content-page" >
                    <div class="content">

                        <!-- Start Content-->
                        <div class="container-fluid">

                            @yield('content')

                        </div> <!-- container -->

                    </div> <!-- content -->

                    <!-- Footer Start -->

                    @include('admin.template.footer')
                    <!-- end Footer -->

                </div>

                <!-- ============================================================== -->
                <!-- End Page content -->
                <!-- ============================================================== -->
            </div>
        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        @include('admin.template.rightSideBar')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <script>
            const base_url= "{{ url('') }}";
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('scripts')
        <script src="{{ asset('admin_template/js/vendor.min.js') }}"></script>
        @stack('special_scripts')
        <script src="{{ asset('admin_template/js/app.min.js') }}"></script>
        <script src="{{ asset('js/general.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>
