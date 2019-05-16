<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Linkaesthetics</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('images/la-favicon.ico')}}" type="image/x-icon">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('provider_backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('provider_backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('provider_backend/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('provider_backend/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('provider_backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('provider_backend/plugins/iCheck/all.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('provider_backend/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{asset('provider_backend/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('provider_backend/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('provider_backend/dist/css/AdminLTE.min.css')}}">
    <!--Loader-->
    <link rel="stylesheet" href="{{asset('provider_backend/loader.css')}}">
    <!-- Datatable-->
    <link rel="stylesheet" href="{{asset('admin_backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">


    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('provider_backend/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('provider_backend/dist/css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('provider_backend/custom.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="{{asset('provider_backend/sweet.css')}}">
    <link rel="stylesheet" href="{{asset('provider_backend/plugins/time-picker/timePicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/notice.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('provider_backend/bootstrap-multiselect.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('admin_backend/dist/css/jquery.fancybox.min.css')}}" media="screen"> -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{asset('admin_backend/dist/css/croppie.css')}}">
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
               <img src="{{ asset('provider_backend/img/logo.png')}}" alt="Logo">
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
                        <a href="{{url('logout')}}"><i class="fa fa-sign-out" data-toggle="tooltip" title="logout" data-placement="left"></i></a>
                    </li>
                </ul>
            </div>
            @php
            $serviceCount = \DB::table('provider_services')->where('user_id',Auth::user()->id)
            ->where('service_amount','!=','')->count();
            @endphp
            <div class="provider_profile_preview text-right">
                <a href="{{url('provider-overview').'/'.Auth::user()->user_slug}}" class="btn btn-primary profile_preview" data-value="{{$serviceCount}}" target="_blank">Profile preview</a>
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
                    <img class="img-circle" src="{!! Auth::user()->photo ? asset('uploads/profile_photos/'.Auth::user()->photo) : asset('provider_backend/img/user.png') !!}" >
                </div>
                <div class="text-center side_info">
                    <h4> Welcome</h4>
                    <h5>{{ ucfirst(Auth::user()->name) }}</h5>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li>
                    <a href="{{url('provider/home')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard
                             </span>
                    </a>
                </li>
                <li><a href="{{url('/provider/become_a_provider_backend')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Edit/Update Profile</span></a></li>
                <li><a href="{{url('provider/notification')}}"><i class="fa fa-bell" aria-hidden="true"></i> <span>Notification</span>
                        @php $count = \DB::table('notifications')->where('notify_action_to',Auth::user()->id)->where('notify_status','=','2')->count() @endphp
                        {!! $count > 0 ?  '<span id="badge" class="badge count">' .$count.'</span>' : "" !!}
                    </a></li>

                <li><a href="{{url('provider/bank-account')}}"><i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Bank Account</span></a></li>
                <li>
                    <a href="{{url('provider/appointments')}}"><i class="fa fa-file-text-o" aria-hidden="true">
                        </i> <span>Appointments</span>
                        @php $count = \DB::table('appointment')->where('provider_id',Auth::user()->id)
                        ->where('appointment_status','=','1')->count(); @endphp
                        @php
                        if($count > 0)
                        {@endphp
                        <span id="badge" class="badge close_badge {{$count > 0 ? 'count app_co' : 'no-count'}}">{{$count}}</span>
                        @php
                        }@endphp
                    </a>
                </li>

                <li><a href="{{url('provider/payment-history')}}"><i class="fa fa-money" aria-hidden="true"></i> <span>Payment History</span></a></li>

                <li class="{{ (Request::is('provider/services-settings')|| Request::is('provider/services/*/edit')
                  || Request::is('provider/services/create') ) ? 'active' : '' }}"> <a href="{{url('provider/services')}}"><i class="fa fa-cog" aria-hidden="true"></i> <span>Manage Services</span></a></li>
                <li class="{{ (Request::is('provider/advertisement/edit/*')|| Request::is('provider/advertisement/create') ) ? 'active' : '' }}"><a href="{{url('provider/advertisement')}}"><i class="fa fa-file-image-o" aria-hidden="true"></i> <span>Advertisement Services</span></a></li>
                <li><a href="{{url('provider/prescription-services')}}"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Prescription Services</span>
                        @if(Auth::user()->user_type == 'prescriber')
                        @php
                        $count = \DB::table('appointment')->where('appointment_status','=','1')->where('appointment_type','=','2')->where('provider_id',Auth::user()->id)->count();

                        if($count > 0)
                        {@endphp
                        <span id="badge" class="badge count close_badge_pre">{{ $count }}
                    </span>
                        @php
                        }@endphp
                        @endif
                    </a></li>
                <li><a href="{{url('provider/policies')}}"><i class="fa fa-file-o" aria-hidden="true"></i> <span>Policies</span></a></li>

                <li class="{{ (Request::is('provider/gallery/*/edit')|| Request::is('provider/gallery/create') ) ? 'active' : '' }}"><a href="{{url('provider/gallery')}}"><i class="fa fa-picture-o" aria-hidden="true"></i> <span>Manage Gallery</span></a></li>

                <li><a href="{{url('provider/feedback')}}"><i class="fa fa-commenting-o" aria-hidden="true"></i> <span>User Feedback</span></a></li>







                <li><a href="{{url('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <!-- jQuery 3 -->
    @yield('scripts')
    <script src="{{asset('provider_backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('provider_backend/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('provider_backend/dist/js/dropzone.min.js')}}"></script>
    <script src="{{asset('admin_backend/dist/js/jquery.fancybox.min.js')}}"></script>

    <!-- map -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2FaWTT1z9azn7kYrnier298Yt8jx_dfE&libraries=places"></script>

    <script src="{{asset('admin_backend/dist/js/croppie.js')}}"></script>

    <script src="{{asset('provider_backend/custom.js')}}"></script>
    <script src="{{asset('provider_backend/sweet.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('provider_backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="{{asset('provider_backend/bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('provider_backend/bower_components/morris.js/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('provider_backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('provider_backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('provider_backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('provider_backend/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('provider_backend/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('provider_backend/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('provider_backend/dist/js/canvasjs.min.js')}}"></script>

    <!-- datepicker -->
    <script src="{{asset('provider_backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('provider_backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('provider_backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('provider_backend/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('provider_backend/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('provider_backend/dist/js/demo.js')}}"></script>

    <!-- DataTables -->
    <script src="{{asset('admin_backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('provider_backend/bower_components/chart.js/Chart.js')}}"></script>
    <script src="{{asset('provider_backend/plugins/time-picker/jquery-timepicker.js')}}"></script>
    <script src="{{asset('provider_backend/plugins/time-picker/timePicker.js')}}"></script>

    <script src="{{asset('js/jquery.notice.js')}}"></script>
    <script src="{{asset('provider_backend/jquery.maskMoney.js')}}"></script>
    <script src="{{asset('admin_backend/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('provider_backend/bootstrap-multiselect.js')}}"></script>
    <script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('provider_backend/validate.js')}}"></script>
    @yield('content')
    <!-- include model  -->
    <script>
        $(function () {
            CKEDITOR.replace('editor1')
            CKEDITOR.replace('editor2')
            CKEDITOR.replace('editor3')
        })
    </script>
    @include('dynamicContentmodel')

    <script type="text/javascript">

        Dropzone.options.imageUpload = {

            maxFilesize         :       1,

            acceptedFiles: ".jpeg,.jpg,.png,.gif"

        };

    </script>
    <script>
        var APP_URL = {!! json_encode(url('/')) !!};
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
        @yield('inline-scripts')
    </script>
</body>
</html>