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
        <link href="{{ asset('admin_template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin_template/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin_template/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- import CSS -->
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
<!-- import JavaScript -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
    </head>

    <body class="authentication-bg authentication-bg-pattern" style="background: #093028;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to left, #237A57, #093028);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, #237A57, #093028); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    ">
        <div class="account-pages mt-5">
            <div class="container" id="app">
                <login-admin></login-admin>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            2019 &copy; Xeria theme by <a href="" class="text-muted">Coderthemes</a>
        </footer>
        <script>
            const base_url= "{{ url('') }}";
        </script>
        <script src="{{ asset('js/app.js') }} "></script>

        <script src="{{ asset('admin_template/js/vendor.min.js') }} "></script>
        <script src="{{ asset('admin_template/js/app.min.js') }} "></script>
    </body>
</html>
