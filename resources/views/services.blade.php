@extends('layouts.frontend_temp')



@section('content')

<!--/#main-slider-->

<!--/#main-slider-->

<div class="aboutus">

    <div class="container">

        <h3>Services</h3>

        <div class="divider"></div>

        <hr>

        <div class="col-sm-12 col-md-12 wow fadeInDown about_cols" data-wow-duration="1000ms" data-wow-delay="300ms">

            <!-- <p>Welcome to Link Aesthetics, a community of aesthetics users, providers and prescribers.</p>

            <p> Whether you are a customer looking to book a treatment or a non-prescribing provider looking for prescription services, at Link Aesthetics we have a passion for connecting customers and providers together. We want to assist you in locating experienced providers for your convenience. We do all the research for you with this easy to use, effective and helpful platform.

            </p>



            <h5>Convenient:

            </h5>

            <p>

                Whether you’re wanting regular procedures in your own area or looking for a last minute appointment whilst traveling, Link Aesthetics enables you to arrange appointments at your own home, or at your provider’s location.

            </p>

            <h5>Professional:</h5>

            </p>

            <p>

                Link Aesthetics connects you to certified health care professionals with specialisms in a wide variety of aesthetics procedures.

            </p>

            <h5> Affordable:</h5>

            <p>

                Compare prices, read testimonials, and enjoy great deals and discounts. Link Aesthetics brings together freelance providers from across the country to offer an affordable alternative to clinics and salons.

            </p><p>

                We pride ourselves in gifting this experience to people as self-care and love is a critical part of well-being. By giving someone the opportunity to focus on this, they can better serve not only themselves, but others.



            </p> -->

            <!--<div class="text-center">

                <a href="javascript:void (0)" class="btn btn-primary service_content_read ">Read More</a>

            </div>-->

        </div>

    </div>

</div>

<div class="service">

    <div class="container">

       <!-- <div class="service_title">

            <h3 class="text-center">Our Services</h3>

        </div>-->

        <div class="service_list container">

            <div class="row flex ">

                @foreach ($services as $key => $services_list )



                @if($key <= 2)

                <div class="col-md-4  wow bounceInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">

                    <div class="panel panel-default">

                        <div class="panel-body">

                            <img src="{{asset('uploads/service_banner/'.$services_list->service_banner)}}" alt="Service_Img" class="img-responsive">

                            <h3 class="text-center">{{ $services_list->service }}</h3>



                            <p>{!! str_limit( $services_list ->description,200) !!}

                            </p>

                            <div class="read">

                                <a href="{{url($services_list->services_id.'/services_read_content')}}">

                                    Read more <i class="fa fa-arrow-right"></i></a>

                            </div>

                        </div>

                    </div>

                </div><!--/col-->

                @endif



                @endforeach



            </div>



            <div class="row more-list" style="display: none;">



                @foreach ($services as $key => $service_list )



                @if($key > 2)



                <div class="col-md-4  wow bounceInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">

                    <div class="panel panel-default">

                        <div class="panel-body">

                            <img src="{{asset('uploads/service_banner/'.$services_list->service_banner)}}" alt="Service_Img" class="img-responsive">

                            <h3 class="text-center">{{ $service_list->service }}</h3>

                            <p>{!! str_limit( $service_list ->description,200) !!}

                            </p>

                            <div class="read">

                                <a href="{{url($service_list->services_id.'/services_read_content')}}">

                                    Read more <i class="fa fa-arrow-right"></i></a>

                            </div>

                        </div>

                    </div>

                </div><!--/col-->

                @endif



                @endforeach

            </div>





            <div class="text-center">

                <a href="javascript:void(0);" class="btn btn-primary load-more">More Service</a>

            </div>

        </div>

    </div>

</div>

<hr>

<div class="gain">

    <div class="container">

        <div class="gain_title">

            <h3 class="text-center">Gain a provider Qualification</h3>

        </div>



        <div class="row">

            @foreach ($gain as $key => $gain_list )


            <div class="col-sm-4  wow @if($key == 0) bounceInLeft @elseif($key == 1 ) bounceInUp @else bounceInRight @endif  " data-wow-duration="1000ms" data-wow-delay="300ms">

                <div class="panel panel-default">

                    <div class="panel-body">

                        <img src="{{ asset('uploads/gain_banner/'.$gain_list->gain_banner) }}" alt="Service_Img" class="img-responsive" style="width: 300px;">

                        <h3 class="text-center">{{ $gain_list->header }}</h3>

                        {!!$gain_list->content!!}

                        <div class="text-center">

                            <a href="{!! $gain_list->forward_link !!}" target="_blank" class="btn btn-primary">Read More</a>

                        </div>

                    </div>

                </div>

            </div><!--/col-->

            <!-- <div class="col-md-4  wow bounceInUp" data-wow-duration="1000ms" data-wow-delay="300ms">

                 <div class="panel panel-default">

                     <div class="panel-body">

                         <img src="images/blog_user1.png" alt="Service_Img" class="img-responsive">

                         <h3 class="text-center">Dorothy</h3>

                         <p>Nam tempor velit sed turpis imperdiet vestibulum. In mattis leo ut sapien euismod id feugiat mauris euismod. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus id nulla risus, vel tincidunt turpis. Aliquam a nulla mi, placerat blandit eros.</p>

                         <div class="text-center">

                             <a href="#" class="btn btn-primary">Read More</a>

                         </div>

                     </div>

                 </div>

             </div><!--/col-->

            <!--<div class="col-md-4 wow bounceInRight" data-wow-duration="1000ms" data-wow-delay="300ms">

                <div class="panel panel-default">

                    <div class="panel-body">

                        <img src="images/blog_user2.png" alt="Service_Img" class="img-responsive">

                        <h3 class="text-center">Lisa</h3>

                        <p>Nam tempor velit sed turpis imperdiet vestibulum. In mattis leo ut sapien euismod id feugiat mauris euismod. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus id nulla risus, vel tincidunt turpis. Aliquam a nulla mi, placerat blandit eros.</p>

                        <div class="text-center">

                            <a href="#" class="btn btn-primary">Read More</a>

                        </div>

                    </div>

                </div>

            </div><!--/col-->

            @endforeach

        </div>

    </div>

</div>

@endsection

