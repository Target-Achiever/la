<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Linkaesthetics</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="icon" href="{{asset('images/la-favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('admin_backend/plugins/iCheck/all.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{asset('admin_backend/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Datatable-->
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!--Loader-->
    <link rel="stylesheet" href="{{asset('admin_backend/loader.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin_backend/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admin_backend/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_backend/dist/css/effects.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_backend/dist/css/croppie.css')}} ">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{asset('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
    <script src="{{asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="{{asset('provider_backend/sweet.css')}}">
    <link rel="stylesheet" href="{{asset('admin_backend/dist/css/jquery.fancybox.min.css')}}" media="screen">
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- ajax loader -->
<div class="spinner" id="la-ajaxloader">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
<!-- ajax loader end -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('/')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">
               <img src="{{asset('provider_backend/img/logo_mini.png')}}" alt="Logo">
               </span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
               <img src="{{asset('provider_backend/img/logo.png')}}" alt="Logo">
               </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('/logout') }}" data-toggle=""><i class="fa fa-sign-out" data-toggle="tooltip" title="logout" data-placement="left"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="image text-center">
                    <?php $photo = Auth::user()->photo;
                    $photo = (!empty($photo)) ? URL::to('/uploads/profile_photos/'.$photo) : URL::to('provider_backend/img/logo_mini.png');

                    ?>
                    <img src="{!! $photo !!}" alt="User Image">
                </div>
                <div class="text-center side_info">
                    <h4> Welcome</h4>
                    <h5>{{ ucfirst( Auth::user()->name )}} </h5>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <!--<ul class="sidebar-menu" data-widget="tree">
              <li >
                 <a href="index.html">
                 <img src="{{asset('admin_backend/img/menu1.png')}}"> <span>Dashboard</span>
                 </a>
              </li>
              <li class="treeview">
                  <a href="#">
                    <img src="{{asset('admin_backend/img/menu2.png')}}"> <span>Manage Providers</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="active_providers.html"><i class="fa fa-circle-o"></i> Active Providers</a></li>
                    <li ><a href="pending_providers.html"><i class="fa fa-circle-o"></i> Pending Providers</a></li>
                     <li><a href="earnings.html"><i class="fa fa-circle-o"></i> Earnings</a></li>
                  </ul>
              </li>
              <li><a href="notification.html"><img src="{{asset('admin_backend/img/menu3.png')}}"> <span>Notification</span></a></li>
              <li class="treeview">
                  <a href="#">
                    <img src="{{asset('admin_backend/img/menu6.png')}}"> <span>Appointment history</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li ><a href="appointment_history_patients.html"><i class="fa fa-circle-o"></i> Patients</a></li>
                    <li><a href="appointment_history_providers.html"><i class="fa fa-circle-o"></i> Providers</a></li>
                  </ul>
              </li>
              <li><a href="payment_history.html"><img src="{{asset('admin_backend/img/menu4.png')}}"> <span>Payment history</span></a></li>
              <li><a href="manage_user.html"><img src="{{asset('admin_backend/img/menu5.png')}}"> <span>Manage Users</span></a></li>
              <li><a href="profile.html"><img src="{{asset('admin_backend/img/menu9.png')}}"> <span>Profile</span></a></li>
              <li><a href="#"><img src="{{asset('admin_backend/img/menu8.png')}}"> <span>Logout Admin Panel</span></a></li>
           </ul>-->
            <ul class="sidebar-menu" data-widget="tree">
                <li>
                    <a href="{{url('admin/home')}}">
                        <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span>
                        <!-- <img src="{{asset('admin_backend/img/Dashboard-1.png')}}"> <span>Dashboard</span> -->
                    </a>
                </li>
                <li class="treeview {{ (Request::is('admin/pending_profile/*')|| Request::is('admin/provider_profile/*') ) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-users" aria-hidden="true"></i> <span>Manage Providers</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/provider_profile/*')  ? 'active' : '' }}"><a href="{{url('admin/providers')}}"><i class="fa fa-circle-o"></i> Available Providers</a></li>
                        <li class="{{ Request::is('admin/pending_profile/*') ? 'active' : ''}}"><a href="{{url('admin/pending_providers')}}"><i class="fa fa-circle-o"></i> Pending Providers</a></li>
                        <!--  <li><a href="{{url('admin/appointment_history')}}"><i class="fa fa-circle-o"></i> Earnings</a></li>
                        -->
                    </ul>
                </li>
                <li class="{{ Request::is('admin/view/*')  ? 'active' : '' }}"><a href="{{url('admin/users')}}"><i class="fa fa-user" aria-hidden="true"></i> <span>Manage Users</span></a></li>
                <li>
                    <a href="{{url('admin/appointment_history')}}">
                        <i class="fa fa-history" aria-hidden="true"></i> <span>Appointment History</span>
                        <!-- <img src="{{asset('admin_backend/img/Dashboard-1.png')}}"> <span>Dashboard</span> -->
                    </a>
                </li>

                <li><a href="{{url('admin/notification')}}">
                        <i class="fa fa-bell" aria-hidden="true"></i><span>Notification</span>
                        @php $count = \DB::table('notifications')->where('notify_action_to',Auth::user()->id)->where('notify_status','=','2')->count() @endphp
                        {!! $count > 0 ?  '<span id="badge" class="badge count">'.$count.'</span>' : "" !!}
                    </a></li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i> <span>Advertisements</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li ><a href="{{url('admin/advertisements')}}"><i class="fa fa-circle-o"></i> Advertisements List</a></li>
                        <li><a href="{{url('admin/advertisements/setting ')}}"><i class="fa fa-circle-o"></i> Advertisements Settings</a></li>
                    </ul>
                </li>
                <li class="treeview {{ (Request::is('admin/services/*/edit')||
                Request::is('admin/services/create')||
                Request::is('admin/professional/create')||
                Request::is('admin/manage_home/create')||
                Request::is('admin/about/create')||Request::is('admin/gain/create')||
                Request::is('admin/blog/create')||
                Request::is('admin/gain/*/edit')||
                Request::is('admin/manage_home/*/edit')||
                Request::is('admin/edit/*')||
                Request::is('admin/professional/edit/*')||
                Request::is('admin/about/edit/*') ) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-cog" aria-hidden="true"></i><span> Admin Setting</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class=""><a href="{{url('admin/profile')}}"><i class="fa fa-circle-o"></i> Edit Profile</a></li>
                        <li class="{{ (Request::is('admin/services/*/edit')||Request::is('admin/services/create')) ? 'active' : '' }}"><a href="{{url('admin/services')}}"><i class="fa fa-circle-o"></i> Manage Services</a></li>
                        <li class="{{ (Request::is('admin/about/edit/*')||Request::is('admin/about/create')) ? 'active' : '' }}" ><a href="{{url('admin/about')}}"><i class="fa fa-circle-o"></i> Manage About Us</a></li>
                        <li class="{{ (Request::is('admin/blog/edit/*')||Request::is('admin/blog/create')) ? 'active' : '' }}" ><a href="{{url('admin/blog')}}"><i class="fa fa-circle-o"></i> Manage Blog</a></li>

                        <li class="{{ (Request::is('admin/gain/*/edit')||Request::is('admin/gain/create')) ? 'active' : '' }}"><a href="{{url('admin/gain')}}"><i class="fa fa-circle-o"></i> Provider Qualification</a></li>
                        <li class="{{ (Request::is('admin/edit/*')) ? 'active' : '' }}"><a href="{{url('admin/disclaimer')}}"><i class="fa fa-circle-o"></i> Disclaimer & Terms</a></li>
                        <li class="{{ (Request::is('admin/professional/edit/*')||Request::is('admin/professional/create')) ? 'active' : '' }}"><a href="{{url('admin/professional')}}"><i class="fa fa-circle-o"></i> Manage Professional</a></li>
                        <li class="{{ (Request::is('admin/manage_home/*/edit')||Request::is('admin/manage_home/create')) ? 'active' : '' }}"><a href="{{url('admin/manage_home')}}"><i class="fa fa-circle-o"></i> Manage Home</a></li>
                        <li><a href="{{url('admin/admin_setting')}}"><i class="fa fa-circle-o"></i> Extra Setting</a></li>
                    </ul>
                </li>

                <!--<li><a href="{{url('admin/services')}}"><i class="fa fa-cog" aria-hidden="true"></i> <span>Manage Services</span></a></li>
                <li><a href="{{url('admin/about')}}"><i class="fa fa-user" aria-hidden="true"></i> <span>Manage About Us</span></a></li>
                <li><a href="{{url('admin/gain')}}"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Manage Gain</span></a></li>
                <li><a href="{{url('admin/disclaimer')}}"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span>Disclaimer & Terms</span></a></li>
                <li><a href="{{url('admin/professional')}}"><i class="fa fa-line-chart" aria-hidden="true"></i> <span>Manage Professional</span></a></li>
                <!-- <li><a href="{{url('admin/payment_history')}}"><i class="fa fa-money" aria-hidden="true"></i> <span>Payment history</span></a></li> -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-money" aria-hidden="true"></i> <span>Payment History</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li ><a href="{{url('admin/appointment_payment')}}"><i class="fa fa-circle-o"></i> Appointment</a></li>
                        <li><a href="{{url('admin/advertisement_payment')}}"><i class="fa fa-circle-o"></i> Advertisement</a></li>
                    </ul>
                </li>
                <li><a href="{{url('admin/policies')}}"><i class="fa fa-file" aria-hidden="true"></i> <span>Providers Policies</span></a></li>
                <li><a href="{{url('admin/feedbacks')}}"><i class="fa fa-commenting-o" aria-hidden="true"></i> <span>Users Feedbacks</span></a></li>


                <!--<li><a href="{{ url('admin/manage_home') }}" class="la-home-header"><i class="fa fa-file" aria-hidden="true"></i> <span>Manage Home </span></a></li>-->
<li><a href="{{url('admin/seo')}}" class=""><i class="fa fa-search" aria-hidden="true"></i> <span>SEO</span></a></li>
                <li><a href="{{url('admin/business-data')}}" class=""><i class="fa fa-file" aria-hidden="true"></i> <span>Business Data</span></a></li>


                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->

    <!-- jQuery 3 -->
    <script src="{{asset('admin_backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('admin_backend/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    @yield('content')
    @include('dynamicContentmodel')
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('admin_backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="{{asset('admin_backend/bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('admin_backend/bower_components/morris.js/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('admin_backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('admin_backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('admin_backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('admin_backend/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('admin_backend/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('admin_backend/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('admin_backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('admin_backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('admin_backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('admin_backend/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin_backend/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin_backend/dist/js/pages/dashboard.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('admin_backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('provider_backend/sweet.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admin_backend/dist/js/demo.js')}}"></script>
    <!--Ck_editor-->
    <script src="{{asset('admin_backend/bower_components/ckeditor/ckeditor.js')}}"></script>
    <!-- export options datatable -->
    <script type="text/javascript" src="{{asset('admin_backend/dataTables.buttons.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin_backend/buttons.flash.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin_backend/jszip.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin_backend/pdfmake.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin_backend/vfs_fonts.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin_backend/buttons.html5.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin_backend/dist/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>

    <!--  -->
    <!-- <script src="{{asset('admin_backend/dist/js/ck_config.js')}}"></script> -->
    <script>
        $(function () {
            CKEDITOR.replace('editor1')
            CKEDITOR.replace('editor2')
            //CKEDITOR.config.customConfig = "{{asset('admin_backend/dist/js/ck_config.js')}}";
        })
    </script>

    <script>
        $(function () {
            //Initialize Select2 Elements

            $('#example1').DataTable();
            $('#example2').DataTable();
            $('#example3').DataTable();
            $('#example4').DataTable();


            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })


        })
    </script>
    <!-- FLOT CHARTS -->
    <script src="{{asset('admin_backend/bower_components/Flot/jquery.flot.js')}}"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="{{asset('admin_backend/bower_components/Flot/jquery.flot.resize.js')}}"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="{{asset('admin_backend/bower_components/Flot/jquery.flot.pie.js')}}"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="{{asset('admin_backend/bower_components/Flot/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('admin_backend/dist/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('admin_backend/dist/js/croppie.js')}}"></script>

    <script src="{{asset('admin_backend/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>

    <!-- custom js -->
    <script type="text/javascript" src="{{asset('admin_backend/validate.js')}}"></script>
    <script src="{{asset('admin_backend/custom.js')}}"></script>
    <!-- Page script -->
    <script>

        /*
         * Custom Label formatter
         * ----------------------
         */
        function labelFormatter(label, series) {
            return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
                + label
                + '<br>'
                + Math.round(series.percent) + '%</div>'
        }
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');
        //Top bar
        $('ul.navbar-nav a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

    </script>
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};

    </script>
    <!--Image Light Box-->
    <script>
        $(document).ready(function(){
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });
        });
    </script>
    <!--Image Light Box-->

    <script type="text/javascript">
        @yield('inline-scripts')
    </script>
</body>
</html>