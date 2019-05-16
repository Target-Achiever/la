@extends('layouts.frontend_temp')

<style type="text/css">
    .b_list .btn-primary
    {
        font-size: 16px;
    }
</style>

@section('content')

<!--/javascript:void(0)main-slider-->

        <div class="blog">

            <div class="container">

                <h3>Blog</h3>

                <div class="divider"></div>

                <hr>

                <div class="blog_content">

                    <p>Welcome to Link Aesthetics, a community of aesthetics users, providers and prescribers.



                    </p><p> Whether you are a customer looking to book a treatment or a non-prescribing provider looking for prescription services, at Link Aesthetics we have a passion for connecting customers and providers together. We want to assist you in locating experienced providers for your convenience. We do all the research for you with this easy to use, effective and helpful platform.

                    </p>

                     <div class="text-right">

                        <!--<a href="javascript:void(0)" class="btn btn-primary blog_content" data-blog="">Read More</a>-->



                      </div> 

                </div>

                <!--Blog List-->
                @foreach ($blog as $key => $blog_list)

                @if ($key % 2 == 0)
                <div class="row b_list">

                    <div class="col-sm-7 col-md-7 wow fadeInDown blog_cols" data-wow-duration="1000ms" data-wow-delay="300ms"> 

                       <div class="text-center">

                            <h3>{{ $blog_list->blog_header }}</h3>

                            <div class="divider1"></div>

                        </div>

                        <div class="b_list_content">

                            {!! \Illuminate\Support\Str::words($blog_list->blog_content, 150,'....')  !!}

                            <div class="text-center">

                                <a href="{{url('blog-single/'.$blog_list->id)}}" class="btn btn-primary blog_content" data-blog="EyeTrend">Read More</a>

                              </div> 

                        </div>

                    </div>

                    <div class="col-md-5 col-md-5 b_list_img wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">

                        <img src="{{ asset('uploads/blog_banner/'.$blog_list->blog_banner) }} " class="img-responsive" height="50%">

                        <h3 class="btn btn-primary">{{ $blog_list->blog_header }}</h3>



                    </div>

                </div>
                @else
                <div class="row b_list">

                    <div class="col-md-5 col-md-5 b_list_img wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >

                        <img src="{{ asset('uploads/blog_banner/'.$blog_list->blog_banner) }} " class="img-responsive" height="50%">

                        <h3 class="btn btn-primary">{{ $blog_list->blog_header }}</h3>



                    </div>

                    <div class="col-sm-7 col-md-7 wow fadeInDown blog_cols" data-wow-duration="1000ms" data-wow-delay="300ms">

                        <div class="text-center">

                            <h3>{{ $blog_list->blog_header }} </h3>

                            <div class="divider1"></div>

                        </div>

                        <div class="b_list_content">

                            {!! \Illuminate\Support\Str::words($blog_list->blog_content, 150,'....')  !!}



                            <div class="text-center">

                                <a href="{{url('blog-single/'.$blog_list->id)}}" class="btn btn-primary blog_content" data-blog="Game">Read More</a>

                            </div>

                        </div>

                    </div>

                </div>
                @endif
                @endforeach



                <!--Blog List-->

<!--                <div class="row b_list">

                    <div class="col-sm-7 col-md-7 wow fadeInDown blog_cols" data-wow-duration="1000ms" data-wow-delay="300ms"> 

                       <div class="text-center">

                            <h3>Save Face: Jane Iredale Lemongrass Hydration Spray</h3>

                            <div class="divider1"></div>

                        </div>

                        <div class="b_list_content">

                                <p>Hydration sprays are an overlooked beauty staple, we love them but what do they actually do? We recognise that they have an official purpose but interestingly, there are also alternative and creative uses for these beauty products. Hydration Sprays work simply as a facial spray, formulated to hydrate your skin and set your mineral powder. Individual hydration sprays have their own special added benefits depending on the product itself. Use hydrating sprays prior to applying foundation so as to ensure your skin is suitably nourished otherwise to set your mineral powder, a spritz helps captures the dewiness whilst keeping your makeup intact.

                                </p>

                                <p>This is where Jane Iredale comes in – notorious for her collection of eco-friendly and high-end mineral cosmetics, she introduced a makeup line which nurtures and protects skin and

                                </p>



                             <div class="text-center">

                                <a href="{{url('blog-single/Save')}}" class="btn btn-primary blog_content" data-blog="Save">Read More</a>

                              </div> 

                        </div>

                    </div>

                    <div class="col-md-5 col-md-5 b_list_img wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">

                        <img src="{{ asset('images/save_face.png') }}" class="img-responsive">

                        <h3 class="btn btn-primary">Save Face</h3>

                    </div>

                </div>
-->
                <!--Blog List-->

<!--                <div class="row b_list">

                    <div class="col-sm-7 col-md-7 wow fadeInDown blog_cols" data-wow-duration="1000ms" data-wow-delay="300ms">

                        <div class="text-center">

                            <h3>Top Skincare Secrets As Told By Celebs

                            </h3>

                            <div class="divider1"></div>

                        </div>

                        <div class="b_list_content">



                            <p>In the world of beauty and skincare, everyday brings with it an influx of new beauty ‘tricks’ and words of wisdom being imparted; from alternative ways to use a beauty blender to things you never knew you could do with primer. We give you the low down on beauty secrets that are literal game changers from celebrities themselves. With skin secrets good enough for the red carpet to make up hacks, A-listers are the perfect people to offer their insight into skin and beauty regimes.



                            </p>

                            <h4>Victoria Beckham</h4>

                            <p>A loyal fan of Lancer products, Beckham&rsquo;s dermatologist is the leading person behind the product. Loaded with exfoliating acids, glycolic and phytic and retinol, the product promises to renew the surface of the skin, making it baby soft and bouncy. Victoria has been known to share details of Lancer products especially their peeling cream on her social media, posting it on her Stories with the caption &ldquo;Love it!&rdquo;<em><strong> (Lancer Caviar Lime Acid Peel, &pound;90)</strong></em></p>





                            <div class="text-center">

                                <a href="{{url('blog-single/Skin')}}" class="btn btn-primary blog_content" data-blog="Skin">Read More</a>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-5 col-md-5 b_list_img wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">

                        <img src="{{ asset('images/top_skin.png') }} " class="img-responsive">

                        <h3 class="btn btn-primary">Top Skincare Secrets As Told By Celebs</h3>



                    </div>

                </div>
-->


            </div>

        </div>

        <!--<div class="blog_list">

            <div class="container">

                <div class="row blog_list_col b_list_video">

                    <div class="col-md-5 col-md-5 b_list_video_img wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">

                        <img src="images/blog_video.png" class="img-responsive">

                    </div>

                    <div class="col-sm-7 col-md-7 wow fadeInDown blogs_cols b_list_video_col" data-wow-duration="1000ms" data-wow-delay="300ms">

                        <h3>Lorem ipsum dolor sit amet,<br> consectetur adipiscing</h3>

                        <p>In neque lectus, lobortis a varius a, hendrerit eget dolor. Fusce scelerisque, sem ut viverra sollicitudin, est turpis blandit lacus, in pretium lectus sapien at est. Integer pretium ipsum sit amet dui feugiat vitae dapibus odio eleifend.</p>

                        <p>In neque lectus, lobortis a varius a, hendrerit eget dolor. Fusce scelerisque, sem ut viverra sollicitudin, est turpis blandit lacus, in pretium lectus sapien at est. Integer pretium ipsum sit amet dui feugiat vitae dapibus odio eleifend.</p>

                        <p>In neque lectus, lobortis a varius a, hendrerit eget dolor. Fusce scelerisque, sem ut viverra sollicitudin, est turpis blandit lacus, in pretium lectus sapien at est. Integer pretium ipsum sit amet dui feugiat vitae dapibus odio eleifend.</p>

                    </div>

                </div>

            </div>

        </div> -->

@endsection

