<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Linkaesthetics</title>
        <!-- Bootstrap -->
        <link rel="icon" href="{{asset('images/la-favicon.ico')}}" type="image/x-icon">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/animate.css')}}">
        <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet" /> 
        <link href="{{asset('css/custom.css')}}" rel="stylesheet" /> 
        <link href="{{asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" /> 
        <link rel="stylesheet" type="text/css" href="{{asset('provider_backend/sweet.css')}}">
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/loader.css')}}">  
        <link rel="stylesheet" type="text/css" href="{{asset('css/notice.css')}}">  
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-tagsinput-typeahead.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-tagsinput.css')}}"> 
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-multiselect.css')}}">        
        <!--<link href="{{asset('css/bootstrap-datepaginator.css')}}" rel="stylesheet" /> -->
		<style type="text/css">
		.register_cols
          {
            background: #e8e8e8;
            padding: 100px 0 25px;
          }
          .registration_title
            {
              color: #5188c0;             
            } 
            .tab-content-cols
            {
              width:750px;
              margin: 50px auto;
            }
            .tab-content-cols .form-group
            {
              margin: 25px 0;
            }
            hr
            {
              border-bottom: 1px solid #ddd;
            }
            .tab-content-cols li
            {
              line-height: 3;
            }
            .tab-content-cols 
            {
                color:#333;
            }            
            .sf-radio span
            {
              font-size:12px;
            }           
            .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td {
                padding: 5px;
                color: #333 !important;
            }
            .btn-facebook
           {
               display: inline-block;
               padding: 5px 120px;
               margin-bottom: 0;
               font-size: 14px;
               font-weight: 400;
               line-height: 1.42857143;
               text-align: center;
               white-space: nowrap;
               vertical-align: middle;
               -ms-touch-action: manipulation;
               touch-action: manipulation;
               cursor: pointer;
               -webkit-user-select: none;
               -moz-user-select: none;
               -ms-user-select: none;
               user-select: none;
               background-image: none;
               border: 1px solid #ddd;
               border-radius: 0;
               font-weight: bold;
           }
         #Login .text-center i {
               font-size: 20px;
               margin-top: 0;
               margin-bottom: 0;
               color: #fff;
               padding: 5px 12px;
               background: #3b5999;
               border-radius: 50%;
           }
           .or p
           {
               padding-bottom: 17px;
               font-size: 16px;
               font-weight: bold;
               text-align: center;;
           }
        .notify_register {
            position: absolute;
            top: -10px;
            z-index: 999;
            max-width: 800px;
            text-align: center;
        }
		</style>
    </head>
    <body>
        <!-- ajax loader -->
         <div class="spinner" id="la-ajaxloader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
          </div>
        <!-- ajax loader end -->
        <header>
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="top_bar"></div>  
                <div class="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="navbar-brand">
                                <a href="{{url('/')}}">
                                    <img src="{{asset('images/logo.png')}}" alt="Logo" class="header_logo" style="">
                                </a>
                            </div>
                        </div>
                        <div class="navbar-collapse collapse">
                            <div class="menu">
							<?php
								$home = $about = $blog = $service = $appointment = $provider = $contact = $login = '';
								$name = "active";

							?>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li><a href="{{url('/')}}" class="{{$home}} {{(Request::is('/') ? 'active' : '')}}">Home</a></li>
                                    <li><a href="{{url('about-us')}}" class="{{$about}} {{(Request::is('about-us') ? 'active' : '')}}">About Us</a></li>
                                    <li><a href="{{url('blog')}}" class="{{$blog}} {{(Request::is('blog') ? 'active' : '')}}">Blog</a></li>
                                    <li><a href="{{url('services')}}" class="{{$service}} {{(Request::is('services') ? 'active' : '')}}">Our Services</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header><?php if(isset($name));?>
		<?php if($name != 'become_a_provider'): ?>
        <section id="main-slider" class="no-margin">
            <div class="carousel slide">
                <div class="carousel-inner">
                    <div class="item active">  
						@if($name == 'home')
                        <img src="{{asset('images/slider/bg1.jpg')}}">
						@endif
						@if($name == 'about')
                        <img src="{{asset('images/slider/bg2.jpg')}}">
						@endif
						@if($name == 'service')
                        <img src="{{asset('images/slider/bg3.jpg')}}">
						@endif
						@if($name == 'blog')
                        <img src="{{asset('images/slider/bg4.jpg')}}">
						@endif
                        <div class="container form_content">
                            <div class="row slide-margin">
                                <div class="col-sm-12">
                                    <div class="carousel-content">
                                        <form class="form-inline" role="form">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">   
                                                    <div class="form-group">       
                                                        <a href="search.html"> <span class="location_icon"><img src="{{asset('images/location.png')}}"></span> </a>
                                                        <input type="text" class="form-control" list="location" placeholder="Location">
                                                        <datalist id="location">
                                                            <option value="Chennai">
                                                            <option value="Trichy">
                                                            <option value="Madurai">
                                                            <option value="Namakkal">
                                                            <option value="Salem">
                                                        </datalist>
                                                        <!-- <span class="location_point"><img src="{{asset('images/location_point.png')}}"> Detect</span> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">   
                                                    <div class="form-group">                                               
                                                        <a href="search.html"> <span class="location_icon"><img src="{{asset('images/search_icon.png')}}"></span></a>
                                                        <input type="text" class="form-control" list="doctors" placeholder="Search doctors,clinics,hospitals,etc">
                                                        <datalist id="doctors">
                                                            <option value="Lip Enhancement">
                                                            <option value="Lip Fillers">
                                                            <option value="Dermal fillers">
                                                            <option value="Laser Treatment">                                                           
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
		<?php endif; ?>
		@yield('content')
        <!-- include model  -->
        @include('dynamicContentmodel')
        <footer>
            <div class="container-fluid footer_top">
                <div class="col-md-3 col-sm-3 first_list">
                    <img src="{{asset('images/footer_logo.png')}}" class="foot_logo">
                    <p class="footer_desc">We are one- stop solution to <br>
                        all your health problems.
                    </p>
				 </div>
                <div class="col-md-3 col-sm-3 first_list">
                    <h4 class="text-left">Get In Touch</h4> 
                    <ul class="list-unstyled">
                        <li><img src="{{asset('images/footer_icon1.png')}}"> Location</li>
                        <li><img src="{{asset('images/footer_icon2.png')}}"> Contact number</li>
                        <li><img src="{{asset('images/footer_icon3.png')}}"> Mail id</li>
                        <li><a href="terms" style="color: #fff">  Terms & conditions </a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h4 class="text-left">Latest news</h4>                  
                    <div class="footer_list">
                        <div class="row fb_list">
                            <div class="col-md-3 col-sm-3 fb_list_col">   
                                <img src="{{asset('images/footer_blog1.png')}}">
                            </div>
                            <div class="col-md-9 col-sm-9 fb_list_col">   
                                <p> How to choose a plastic surgeon? </p>
                                <p>August 18,2018</p>
                            </div>
                        </div>
                        <div class="row fb_list">
                            <div class="col-md-3 col-sm-3 fb_list_col">   
                                <img src="{{asset('images/footer_blog2.png')}}">
                            </div>
                            <div class="col-md-9 col-sm-9 fb_list_col">   
                                <p>Doing a plastic surgery abroad? </p>
                                <p>November 02,2018</p>
                            </div>              
                        </div>              
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h4 class="text-left">Newsletter</h4>                  
                    <div class="footer_list">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 news_desc">   
                                <p>
                                    Be up to date with our tips and be aware of 
                                    discounts for our services! Stay updated with 
                                    our latest news and updates.
                                </p>
                            </div>
                        </div> 
                                   
                     {!! Form::open(['url' => 'subscribe','method' => 'post']) !!}
                        <div class="row">
                            <div class="col-md-12 col-sm-12">   
                                <form action="">
                                    <div class="from-group">
                                        <input name="subscribe_email" type="text" class="form-control" placeholder="Enter email address">
                                        <button class="btn btn-primary" type="submit">Subscribe now!</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {!! Form::close() !!}
                                   
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="container">    
                    <div class="col-md-12">
                        <div class="copyright">
                            © Copyright 2017-2018 www.linkaesthetics.com . All Rights Reserved.                          
                        </div>
                    </div>
                </div>

                <div class="pull-right">
                    <a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
                </div>
            </div>
        </footer>



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
        <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('js/jquery.isotope.min.js')}}"></script>
        <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{asset('js/functions.js')}}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAy9bbfXsq4kUXZT1q5iM8MIkzfdFfSnao&libraries=places"></script>
        <script src="{{asset('provider_backend/sweet.js')}}"></script>
        <script src="{{asset('js/jquery.notice.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
        <!-- <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.min.js"></script> -->
        
        <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
        </script>
        <script src="{{asset('js/bootstrap3-typeahead.js')}}"></script>
        <script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
        <script src="{{asset('js/custom.js')}}"></script>

        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdqlVBZ8TXcg8dFKhJoZkmnhqvpEnPzmM&callback=myMap"></script> -->

		<!--Login/Register Modal-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!--                    <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×</button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                Login/Registration </h4>
                                        </div>-->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#Login" data-toggle="tab">Login</a></li>
                                    <li><a href="#Registration" data-toggle="tab">Registration</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
