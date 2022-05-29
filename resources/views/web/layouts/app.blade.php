<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IE SANTA ROSA</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- App css -->
    <link href="{{ asset('admin_template/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_template/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- import CSS -->
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link href="{{ asset('admin_template/css/app2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_template/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <!-- import JavaScript -->
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>

       {{--  <link href="{{ asset('admin_template/css/custom.css') }}" rel="stylesheet" type="text/css" />  --}}

    <style>
    .wrapper {
        padding: 80px 12px 0 12px;
    }
    </style>

</head>
<body>
    <div id="app" class="">
        <header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                       
            
                

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('img/admin/users/default.jpg') }}" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1">
                
                                    {{ Auth::guard('web')->user()->nombres }} <i class="mdi mdi-chevron-down"></i>
                
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                              
                
                                <!-- item-->
                                <a class="dropdown-item notify-item"
                                    href="javascript:void(0);"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fe-log-out"></i>
                                    <span>Cerrar sesión</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                
                            </div>
                        </li>

                      

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index.html" class="logo text-center">
                            <span class="logo-lg">
                                <img src="{{ asset('img/banner1.png') }}" alt="" height="50">
                                {{--  <span class="logo-lg-text-dark">Xeria</span>  --}}
                            </span>
                            <span class="logo-sm">
                                {{--  <span class="logo-sm-text-dark">X</span>   --}}
                                <img src="{{ asset('img/banner1.png') }}" alt="" height="50">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            
                        {{--  <li class="dropdown d-none d-lg-block">
                            <a class="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                Reports
                                <i class="mdi mdi-chevron-down"></i> 
                            </a>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 70px, 0px);">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    Finance Report
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    Monthly Report
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    Revenue Report
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    Settings
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    Help &amp; Support
                                </a>

                            </div>
                        </li>  --}}

                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

        
            <!-- end navbar-custom -->

        </header>
        <div class="wrapper">
            <div class="container-fluid">
              
                       
                            @yield('content')
                       
            </div>
        </div>
       
    </div>
    @yield('footer')


    <script>
        const base_url = "{{ url('') }}";
        const sesion_usuario = @json(Auth::user())
    </script>
  
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('admin_template/js/vendor.min.js') }}"></script>
    @stack('special_scripts')
    <script src="{{ asset('admin_template/js/app.min.js') }}"></script>
    <script src="{{ asset('js/general.js') }}"></script>

</body>
</html>
