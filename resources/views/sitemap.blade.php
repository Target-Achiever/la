@extends('layouts.frontend_temp')

@section('content')
<style type="text/css">
.site a{
    text-decoration: none !important;
    color: black !important;
}
	
.head-title{
	margin-top: 15px;
}
.head-title .fa-arrow-right{
	padding-right: 5px;
}
</style>
<div class="aboutus">
	 <div class="container">
	 	<h3>Sitemap</h3>
        <div class="divider"></div>

         <hr>
         <div class="site head-title">
          <a href="{{url('/')}}"><strong>Home</strong></a>
      
        </div>
         <div class="site head-title">
        <a href="{{url('about-us')}}"><strong>About Us</strong></a>
         </div>
         <div class="site head-title">
         <a href="{{url('blog')}}"><strong>Blog</strong></a>
             <div class="list-group" style="width: 100%;">

                            <!-- blog list --> 
                            @foreach ($blog as $key => $blog_list)

                                <a href="{{url('blog-single/'.$blog_list->id)}}" class="list-group-item ">
                                    <i class="fa fa-arrow-right"></i> {{ $blog_list->blog_header }}
                                </a>
                             
 @endforeach
                            
                        </div>
          </div>
          <div class="site head-title">
          <a href="{{url('services')}}"><strong>Our Services</strong></a>
           <div class="list-group" style="width: 100%;  ">

                            <!-- blog list --> 
                              @foreach ($services as $key => $services_list )
                                <a href="{{url($services_list->services_id.'/services_read_content')}}" class="list-group-item ">
                                    <i class="fa fa-arrow-right"></i> {{ $services_list->service }}

                                </a>
  @endforeach
                        </div>
      </div>
    <!--   <div class="site head-title">
          <a href="{{url('password-reset')}}"><strong>Password Reset</strong></a>
      
        </div> -->
        <div class="site head-title">
          <a href="terms"><strong>Terms & Conditions</strong></a>
      
        </div>
         <div class="site head-title">
        <a href="privacy-policy"><strong>Privacy Policy</strong></a>
         </div>
	 </div>
	</div>
	@endsection