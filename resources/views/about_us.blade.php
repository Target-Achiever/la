@extends('layouts.frontend_temp')@section('content')
<div class="aboutus"> @foreach($aboutUs as $key => $about) @if($about->about_header=='About Us')
    <div class="container"><h3>{{ $about->about_header }}</h3>
        <div class="divider"></div>
        <hr>
        <div class="col-sm-7 col-md-7 wow fadeInDown about_cols" data-wow-duration="1000ms" data-wow-delay="300ms"> {!!
            $about ->about_content !!}
            <!--  <div class="text-center">                            <a href="javascript:void(0)" data-about="{{$about->id }}" class="btn btn-primary about_content">Read More</a>                          </div>-->                        </div>
        <div class="col-md-5 col-md-5 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms"><img
                    src="{{ asset('uploads/about_banner/'.$about->about_banner) }}" class="img-responsive"></div>
    </div>
    <br><br> @endif @if($about->about_header=='Our Vision')
    <div class="ourvision">
        <div class="container">
            <div class="row ourvision_col">
                <div class="ourvision_cols text-center"><h3>{{ $about->about_header }}</h3>
                    <div class="divider1"></div>
                </div>
                <div class="col-md-5 col-md-5 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms"><img
                            src="{{ asset('uploads/about_banner/'.$about->about_banner) }}" class="img-responsive">
                </div>
                <div class="col-sm-7 col-md-7 wow fadeInDown vision_cols" data-wow-duration="1000ms"
                     data-wow-delay="300ms"> {!! $about ->about_content !!}
                </div>
                <!--   <div class="text-center">                        <a href="javascript:void(0)" data-about="{{$about->id }}" class="btn btn-primary about_content">Read More</a>                    </div>--->
            </div>
        </div>
    </div>
    @endif @endforeach
</div>
<!--<div class="testimonial">-->
<!--    <div class="container">-->
<!--        <div class="row testimonial_col">-->
<!--            <div class="testimonial_cols text-center"><h3>Testimonial</h3>-->
<!--                <div class="divider1"></div>-->
<!--            </div>-->
<!--            <div class="col-sm-12 col-md-12 wow fadeInDown about_cols" data-wow-duration="1000ms"-->
<!--                 data-wow-delay="300ms"><p>Nam tempor velit sed turpis imperdiet vestibulum. In mattis leo ut sapien-->
<!--                    euismod id feugiat mauris euismod. Pellentesque habitant morbi tristique senectus et netus et-->
<!--                    malesuada fames ac turpis egestas. Phasellus id nulla risus, vel tincidunt turpis. Aliquam a nulla-->
<!--                    mi, placerat blandit eros. </p>-->
<!--                <p>In neque lectus, lobortis a varius a, hendrerit eget dolor. Fusce scelerisque, sem ut viverra-->
<!--                    sollicitudin, est turpis blandit lacus, in pretium lectus sapien at est. Integer pretium ipsum sit-->
<!--                    amet dui feugiat vitae dapibus odio eleifend.</p></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="contact">
    <div class="container">
        <div class="contact_col">
            <div class="text-center"><h3>Contact</h3>
                <div class="divider1"></div>
            </div>
            <div class="row">
                <div class="contact_col_list">
                    <div class="contact_list_inner">
                        <div class="col-md-6 col-sm-6 contact_list">
                            <div class="row">
                                <div class="col-xs-2 col-md-2 col-sm-2"><img
                                            src="{{asset('images/contact_icon1.png')}}"></div>
                                <div class="col-xs-10 col-md-10 col-sm-10"><h4>Address</h4>
                                    <p>Lovell House, 4 Skinner Lane, Leeds, Ls7 1AR, UK </p></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 contact_list">
                            <div class="row">
                                <div class="col-xs-2 col-md-2 col-sm-2"><img
                                            src="{{asset('images/contact_icon3.png')}}"></div>
                                <div class="col-xs-10 col-md-10 col-sm-10"><h4>Email</h4>
                                    <p><a href="mailto:info@linkaesthetics.com"> info@linkaesthetics.com</a></p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>@endsection