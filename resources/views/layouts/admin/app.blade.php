<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title> {{ config('app.name') }} </title>

         <!-- DataTables -->
        <link href="{{ url('public/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ url('public/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="{{ url('public/assets/plugins/morris/morris.css') }}">

        <!-- Switchery css -->
        <link href="{{ url('public/assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="{{ url('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="{{ url('public/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="{{ url('public/assets/js/modernizr.min.js') }}"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="{{ url('/') }}" class="logo">
                        <span><img style="width:90%;" src="{{ url('public/assets/images/logo3.jpg') }}"></span></a>
                </div>

               @include('layouts.admin.nav')

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
             @include('layouts.admin.sidebar')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
             @yield('content')
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



            <footer class="footer text-right">
                {{ date('Y') }} © {{ config('app.name') }}.
            </footer>


        </div>
        <!-- END wrapper -->


        <script>
            var resizefunc = [];
        </script>

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

        <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var base_url = '{{ url("/") }}';

        </script> 

        @yield('footer_script')

        <!-- App js -->
        <script src="{{ url('public/assets/js/jquery.core.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.app.js') }}"></script>

        

    </body>
</html>