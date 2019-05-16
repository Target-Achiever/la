<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Linkaesthetics</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
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
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('admin_backend/dist/css/AdminLTE.min.css')}}">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{asset('admin_backend/dist/css/skins/_all-skins.min.css')}}">
      <link rel="stylesheet" href="{{asset('admin_backend/dist/css/effects.min.css')}}">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="{{asset('admin_backend/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
      <script src="{{asset('admin_backend/https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
      <![endif]-->
      <!-- Google Font -->
      <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
         <link rel="stylesheet" type="text/css" href="{{asset('provider_backend/sweet.css')}}">
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
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
                        <a href="{{ url('/logout') }}" data-toggle=""><i class="fa fa-sign-out"></i></a>
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
					$photo = (!empty($photo)) ? URL::to('/uploads/profile_photos/'.$photo) : URL::to('/uploads/profile_photos/admin.png');

					?>
						<img src="{!! $photo !!}" alt="User Image">
				  </div>
                  <div class="text-center side_info">
                     <h4> Welcome</h4>
                     <h5>{{Auth::user()->name}} </h5>
                  </div>
               </div>
               <!-- sidebar menu: : style can be found in sidebar.less -->
                <!--<ul class="sidebar-menu" data-widget="tree">
                  <li class="active">
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
                        <li class="active"><a href="pending_providers.html"><i class="fa fa-circle-o"></i> Pending Providers</a></li>
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
                        <li class="active"><a href="appointment_history_patients.html"><i class="fa fa-circle-o"></i> Patients</a></li>
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
                     <img src="{{asset('admin_backend/img/Dashboard-2.png')}}"> <span>Dashboard</span>
                     <!-- <img src="{{asset('admin_backend/img/Dashboard-1.png')}}"> <span>Dashboard</span> -->
                     </a>         
                  </li>
                   <li class="treeview">
                       <a href="#">
                           <img src="{{asset('admin_backend/img/Manage Providers-1.png')}}"> <span>Manage Providers</span>
                           <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                       </a>
                       <ul class="treeview-menu">
                           <li><a href="{{url('admin/providers')}}"><i class="fa fa-circle-o"></i> Available Providers</a></li>
                           <li ><a href="{{url('admin/pending_providers')}}"><i class="fa fa-circle-o"></i> Pending Providers</a></li>
                           <li><a href="#"><i class="fa fa-circle-o"></i> Earnings</a></li>
                       </ul>
                   </li>
                   <li><a href="{{url('admin/notification')}}"><img src="{{asset('admin_backend/img/Natification-2.png')}}"><span>Notification</span>  <span id="badge" class="badge"></span></a></li>
                   <li><a href="{{url('admin/disclaimer')}}"><img src="{{asset('admin_backend/img/Disclaimer-2.png')}}"> <span>Disclaimer</span></a></li>
                   <li><a href="{{url('admin/about')}}"><img src="{{asset('admin_backend/img/about-us-2.png')}}"> <span>Manage About us</span></a></li>
                   <li><a href="{{url('admin/professional')}}"><img src="{{asset('admin_backend/img/Manage Professional-2.png')}}"> <span>Manage Professional</span></a></li>
                   <li><a href="{{url('admin/gain')}}"><img src="{{asset('admin_backend/img/Manage Professional-2.png')}}"> <span>Manage Gain</span></a></li>

                   <li class="treeview">
                      <a href="#">
                        <img src="{{asset('admin_backend/img/Appointment history-2.png')}}"> <span>Appointment history</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li class="active"><a href="{{url('admin/users_appointment')}}"><i class="fa fa-circle-o"></i> Users</a></li>
                        <li><a href="{{url('admin/provider_appointment')}}"><i class="fa fa-circle-o"></i> Providers</a></li>
                      </ul>
                  </li>
                  <li><a href="{{url('admin/payment_history')}}"><img src="{{asset('admin_backend/img/Payment history-2.png')}}"> <span>Payment history</span></a></li>

                  <li><a href="{{url('admin/users')}}"><img src="{{asset('admin_backend/img/Manage Users-2.png')}}"> <span>Manage Users</span></a></li>

                  <li><a href="{{url('admin/services')}}"><img src="{{asset('admin_backend/img/Manage Services-2.png')}}"> <span>Manage Services</span></a></li>

                  <li><a href="{{url('admin/policies')}}"><img src="{{asset('admin_backend/img/Providers Policies-2.png')}}"> <span>Providers Policies</span></a></li>

                  <li><a href="{{url('admin/feedbacks')}}"><img src="{{asset('admin_backend/img/Users Feedback-2.png')}}"> <span>Users Feedback</span></a></li>

                   <li class="treeview">
                       <a href="#">
                           <img src="{{asset('admin_backend/img/Advertisement services-2.png')}}"> <span>Advertisements</span>
                           <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                       </a>
                       <ul class="treeview-menu">
                           <li class="active"><a href="{{url('admin/advertisements')}}"><i class="fa fa-circle-o"></i> Advertisements List</a></li>
                           <li><a href="{{url('admin/advertisements/setting ')}}"><i class="fa fa-circle-o"></i> Advertisements setting</a></li>
                       </ul>
                   </li>


                  <li><a href="{{ url('/logout') }}"><img src="{{asset('admin_backend/img/Logout-2.png')}}"> <span>Logout Admin Panel</span></a>
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
<!-- custom js -->
<script src="{{asset('admin_backend/custom.js')}}"></script>
<!-- Page script -->
<script>
  $(function () {
    
    /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    var sin = [], cos = []
    for (var i = 0; i < 14; i += 0.5) {
      sin.push([i, Math.sin(i)])
      cos.push([i, Math.cos(i)])
    }
    var line_data1 = {
      data : sin,
      color: '#3c8dbc'
    }
    var line_data2 = {
      data : cos,
      color: '#00c0ef'
    }
    $.plot('#line-chart', [line_data1, line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
          .css({ top: item.pageY + 5, left: item.pageX + 5 })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
    /* END LINE CHART */


  })

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
   </body>
</html>