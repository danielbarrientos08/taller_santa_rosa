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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
 

    <style>
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 10%) !important;
        };
        
    </style>
       <link href="{{ asset('admin_template/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="app" class="">  
        <nav class="navbar navbar-expand-md navbar-light bg-white  fixed-top shadow-sm pt-1 pb-2">
            <div  class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="{{asset ('img/banner1.png')}}" style="max-width: 150px;">
                                       
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}"> <i class="la la-lg la-home"></i> Inicio</a>
                        </li>
                        
                       
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                       
                      
                    </ul>
                </div>
            </div>
        </nav>
         

        <main class="py-4 mt-5">
            <br>
            <br>
            <div class="container">
                @yield('content')
            </div>
         
        </main>

       
    </div>
    @yield('footer')
   
    
    <script>
        const base_url = "{{ url('') }}";
        const sesion_usuario = @json(Auth::user())
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/general.js') }}"></script>
    
    <script src="{{ asset('js/boostrap.js') }}"></script>

</body>
</html>
