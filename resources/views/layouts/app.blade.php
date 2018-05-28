<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.ico') }}">

        <!-- App title -->
        <title>{{ config('app.name') }}</title>   

        <!-- Bootstrap CSS -->
        <link href="{{ url('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="{{ url('public/assets/css/style.css')}}" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
    <script src="{{ url('public/assets/js/modernizr.min.js')}}"></script>
        @yield('link')

        @yield('header_script')
    </head>

    <body>
  
     @yield('content')

             <!-- jQuery  -->
        <script src="{{ url('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('public/assets/js/popper.min.js') }}"></script><!-- Tether for Bootstrap -->
        <script src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('public/assets/js/detect.js') }}"></script>
        <script src="{{ url('public/assets/js/fastclick.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ url('public/assets/js/waves.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ url('public/assets/plugins/switchery/switchery.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ url('public/assets/js/jquery.core.js"></script>
        <script src="{{ url('public/assets/js/jquery.app.js"></script>


     @yield('footer_script')

    </body>
</html>
