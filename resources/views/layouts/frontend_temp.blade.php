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
        <link rel="stylesheet" href="{{asset('admin_backend/dist/css/croppie.css')}} ">

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
        .demo a:hover {
            color: purple !important;

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
                                    @if (Auth::guest() || Auth::user()->user_type == 'end_user')
                                    <li><a href="{{url('/')}}" class="{{$home}} {{(Request::is('/') ? 'active' : '')}}">Home</a></li>
                                    <li><a href="{{url('about-us')}}" class="{{$about}} {{(Request::is('about-us') ? 'active' : '')}}">About Us</a></li>
                                    <li><a href="{{url('blog')}}" class="{{$blog}} {{(Request::is('blog') ? 'active' : '')}}">Blog</a></li>
                                    <li><a href="{{url('services')}}" class="{{$service}} {{(Request::is('services') ? 'active' : '')}}">Our Services</a></li>
                                    @endif
                                    @if (Auth::guest())
                                    <li  class="demo"><a href="javascript:void(0)" class="{{$provider}} login-signup-provider {{(Request::is('become-a-provider') ? 'active' : '')}}">Become a provider</a></li>
                                    @endif
                                    <!-- @if (!Auth::guest())
									<li><a class="{{$provider}}" href="{{url('become-a-provider')}}">Become a provider</a></li>
                                    @endif -->
									@if (Auth::guest())
                                    <li><a class="{{$login}} login-btn  login-signup-user {{(Request::is('login') ? 'active' : '')}}" href="javascript:void(0)">Login / Sign Up</a></li> 
                                    @else
									<li class="dropdown">
                                        <a href="#" class="dropdown-toggle"  data-toggle="dropdown">{{ Auth::user()->name }}
                                        <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                                <li><a href="{{url('my-account')}}">{{ Auth::user()->name }}</a></li>

                                                

											@if(Auth::user()->user_type == 'super_admin' )
												<li><a href="{{url('admin/home')}}">Dashboard</a></li>
											@elseif(Auth::user()->user_type == 'prescriber' || Auth::user()->user_type == 'non_prescriber')
                                                <!-- <li><a href="{{url('/provider/become-a-provider')}}">Edit Profile</a></li> -->
												<li><a href="{{url('provider/home')}}">Dashboard</a></li>
											@elseif(Auth::user()->user_type == 'end_user')
                                                <li><a href="{{url('my-account')}}">My Account</a></li>
                                            @endif
                                            <li><a href="{{ url('/logout') }}">Logout</a></li>
                                        </ul>
									</li>
									@endif
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
                    <p style="margin-left: 15px" class="footer_desc">A one-stop platform for the freelance aesthetics market.
                    </p>
                    <div class="social-icons" style="margin-left: 15px">
                        <a target="_blank" href="https://www.facebook.com/linkaestheticsltd"><img src="{{asset('images/facebook.png')}}"  width="12%"></a>
                        <a target="_blank" href="https://www.twitter.com/laestheticsltd"><img src="{{asset('images/twitter.png')}}"  width="12%"></a>
                        <a target="_blank" href="https://www.instagram.com/linkaesthetics"><img src="{{asset('images/instagram.png')}}"  width="12%"></a>
                    </div>
				 </div>
                <div class="col-md-3 col-sm-3 first_list">
                    <h4 class="text-left">Get In Touch</h4> 
                    <ul class="list-unstyled">
                        <li><img src="{{asset('images/footer_icon1.png')}}"> Lovell House, 4 Skinner Lane,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Leeds, Ls7 1AR, UK
                        </li>
                       <!--<li><img src="{{asset('images/footer_icon2.png')}}"> Contact number</li>-->
                        <li><img src="{{asset('images/footer_icon3.png')}}"><a href="mailto:info@linkaesthetics.com" style="color: #fff"> info@linkaesthetics.com</a></li>
                        <li><a href="terms" style="color: #fff">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terms & conditions </a></li>
                        <li><a href="privacy-policy" style="color: #fff">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Privacy & policy </a></li>
                        <li><a href="{{url('sitemap')}}" style="color: #fff">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sitemap </a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h4 class="text-left">Latest news</h4>                  
                    <div class="footer_list">
                        <!--  -->
                        <a  style="color: #fff" class="twitter-timeline" href="https://twitter.com/LAestheticsLtd?ref_src=twsrc%5Etfw" data-height="150">Tweets by LAestheticsLtd</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <!--  -->
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

                        {!! Form::open(['url' => 'subscribe','method' => 'post','id' => 'Subscribe']) !!}
                        <div class="row">

                            <div class="col-md-12  col-sm-12 sub_scribe">
                                <div class="from-group">
                                    <input name="subscribe_email" type="text" id="inputError" class="form-control" placeholder="Enter email address">
                                    <button class="btn btn-primary Subscribe" type="button">Subscribe now.</button>
                                </div>
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
        <script src="{{asset('js/bootstrap.min.js')}}"></script>       
        <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
        <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('js/jquery.isotope.min.js')}}"></script>
        <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{asset('js/functions.js')}}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2FaWTT1z9azn7kYrnier298Yt8jx_dfE&libraries=places"></script>
        <script src="{{asset('provider_backend/sweet.js')}}"></script>
        <script src="{{asset('js/jquery.notice.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>
        <!-- <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.min.js"></script> -->
        
        <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
        </script>
        <script src="{{asset('js/bootstrap3-typeahead.js')}}"></script>
        <script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
        <script src="{{asset('admin_backend/dist/js/croppie.js')}}"></script>
        <script src="{{asset('js/custom.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/validate.js')}}"></script>

        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdqlVBZ8TXcg8dFKhJoZkmnhqvpEnPzmM&callback=myMap"></script> -->

		<!--Login/Register Modal-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg login-modal">
                <div class="modal-content">                       
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×</button>  
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li ><a href="#Login" data-toggle="tab">Login</a></li>
                                    <li class="active"><a href="#Registration" data-toggle="tab">Registration</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">  
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane " id="Login">
                                        <div class="" id="login-response" style="display: none">
                                        </div>
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" id="loginForm">
											{{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">
                                                            Email
                                                        </label>
                                                        <input name="email" value="{{ Cookie::get('user_email') }}" type="email" class="form-control" id="email1" placeholder="Email" />
														 @if ($errors->has('email'))
															<span class="help-block">
																<strong>{{ $errors->first('email') }}</strong>
															</span>
														@endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">
                                                            Password
                                                        </label>
                                                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                                                        <input type="hidden" id="app_id" value="" name="appointment_id">
                                                        
														@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 text-center">
<!--                                                      {!! Form::checkbox( 'remember_me', '', TRUE) !!} Remember me -->
                                                </div>
                                                <div class="col-sm-6 col-md-6 text-center">
                                                    <a href="{{url('password-reset')}}" class="forgot">Forgot your password?</a>
                                                </div>
                                            </div>
                                            <div class="row text-center">                                              
                                                <div class="col-sm-12 col-md-12">
                                                    <button type="submit" class="btn btn-primary btn-lg">
                                                        Login
                                                    </button>                                                 
                                                </div>
                                            </div>
                                            
                                            <div class="row text-center"  style="display: none">                                              
                                                <div class="col-sm-12 col-md-12" id="social-login-auth-icon">
                                                    <div class="or">
                                                       <p> (OR)</p>
                                                   </div>
                                                    <!-- <button type="button" class="btn btn-info btn-lg">
                                                        <img src="{{asset('images/social.png')}}" style="height: 29px;"> Connect with Facebook
                                                    </button> -->
                                                    <a href="{{ url('/fbauth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Registration Form -->
                                    <div class="tab-pane active" id="Registration">
                                        <div id="registration-response" >
                                            
                                        </div>
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" id="registerForm">
											{{ csrf_field() }}
                                            <div class="row">                                                       
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input name="name" value="{{ old('name') }}" type="text" class="form-control" placeholder="Name" />
														@if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">
                                                            Email</label>
                                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Email" />
															@if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">                                                       
                                                
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">
                                                          Password</label>
                                                        <input name="password" type="password" class="form-control" id="password" placeholder="Password" />
														@if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div><div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">
                                                          Confirm Password</label>
                                                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Re-enter password" />
                                                        <input type="hidden" name="user_type" id="register-by-user-type" value="">
														@if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                                                                    
                                            <div class="row">                                               
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" id="registerForm-" class="btn btn-primary btn-sm">
                                                        Register
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Registration Form END-->
                                </div>                               
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                var date_input=$('input[name="date_of_birth"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'dd/mm/yyyy',
                    container: container,
                    todayHighlight: false,
                    endDate: '+0d',
                    autoclose: true,
                };
                date_input.datepicker(options);
            })
            $(document).ready(function(){
                var date_input=$('input[name="aesthetic_training_date"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'dd/mm/yyyy',
                    container: container,
                    todayHighlight: true,
                    endDate: '+0d',
                    autoclose: true,
                };
                date_input.datepicker(options);
            })

        </script>
		<script type="text/javascript">
            $(document).ready(function(){
            /* $("#sf-next").click(function(){
                if($(this).text() == 'submit'){ $(this).attr('type','submit');
                    if ($('.declaration').is(':checked')) {
                        $("#sf-next").attr('type','submit');
                    }
                    //$("#save_become_a_provider").submit();
                }
            }); */

            var ckbox = $('#checkbox');

            $('select.have_others').on('change', function() {
                var id = $(this).attr('id');
                str = $(this).val();
                if (str.indexOf("others") >= 0){
                    $("."+id).show();
                }else{
                    $("."+id).hide();
                }
            });

            google.maps.event.addDomListener(window, 'load', function () {
            var options = {
            //types: ['(cities)'],
            //componentRestrictions: {country: "fr"}
            };
            var places = new google.maps.places.Autocomplete(document.getElementById('address'),options);
            google.maps.event.addListener(places, 'place_changed', function () {
            $('#city').val("");
            $('#state').val("");
            $('#country').val("");
            $('#post_code').val("");
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var mesg = "Address: " + address;
            mesg += "\nLatitude: " + latitude;
            mesg += "\nLongitude: " + longitude;
            //a = get_api(latitude,longitude);
            $("#latitude").val(latitude);
            $("#longitude").val(longitude);
            var address_components = place.address_components;

            for( var i=0; i<address_components.length; i++ ){

                for (var j = 0; j < address_components[i].types.length; j++) {

                    if (address_components[i].types[j] == "administrative_area_level_2")
                    {
                        $('#city').val(address_components[i].long_name);

                    }
                    if (address_components[i].types[j] == "administrative_area_level_1")
                    {
                        $('#state').val(address_components[i].long_name);

                    }
                    if (address_components[i].types[j] == "country")
                    {
                        $('#country').val(address_components[i].long_name).removeClass('sf-error');


                    }
                    if (address_components[i].types[j] == "postal_code")
                    {
                         $('#post_code').val(address_components[i].long_name);

                    }
                }
            }
            });
            });
            //---------------------------
            $(".login-signup-provider").click(function(){

            $("#social-login-auth-icon").hide();
            $("#register-by-user-type").val('non_prescriber');
            $("#myModal").modal();

            });
            $(".login-signup-user").click(function(){

            $("#social-login-auth-icon").show();
            $("#register-by-user-type").val('end_user');
            $("#myModal").modal();

        });
            });
    </script>
    <script type="text/javascript">
        @yield('inline-scripts')
    </script>
    </body>
</html>
