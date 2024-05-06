<!DOCTYPE html>
<html>
    <head>
        <title>Joyas Aremar - Login</title>
        <link href="{{asset("plugin/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("plugin/sweetalert2/sweetalert2.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("login.css")}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ asset('icons/favicon.png') }}" type="image/x-icon" />
        @yield('css')
    </head>
    <body>
        @yield('body')
        <script src="{{asset("plugin/jquery.min.js") }}" type="text/javascript"></script>
        <script src="{{asset("plugin/ladda/spin.min.js") }}" type="text/javascript"></script>
        <script src="{{asset("plugin/ladda/ladda.min.js") }}" type="text/javascript"></script>
        <script src="{{asset("plugin/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("plugin/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("plugin/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("plugin/sweetalert2/sweetalert2.js")}}" type="text/javascript"></script>
        @yield('js')
    </body>
</html>
