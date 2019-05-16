@extends('layouts.frontend_temp')



@section('content')

<style type="text/css">

    .btn-fixed

    {

        position: fixed;

        top: 100px;

        right: 20px;

        background-color: #fff;

        z-index: 9999999999999999999999;

        transition: all 1s;

    }

</style>

<!--/#main-slider-->

           <!--/#main-slider-->

        <div class="aboutus">

            <div class="container">

                <h3>{{ $blog[0]['blog_header']}}</h3>

                <div class="divider"></div>

                <hr>

                <div class="col-sm-9 col-md-9 wow fadeInDown about_cols more-details-content" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="service-list-image">

                                <img src="{{ asset('uploads/blog_banner/'.$blog[0]['blog_banner'])}}" class="img-responsive" alt="Services">

                            </div>

                        </div>

                        <div class="col-md-6">

                            {!! $blog[0]['blog_content']!!}



                            <!-- blog content end -->

                        </div>

                    </div>


                <div class="service-ctrl">

                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back</a>

                </div>

                </div>       

                <div class="col-sm-3 col-md-3 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"">

                    <div class="more-service-side">

                        <div class="head-title">    

                            <h4>Blog List:</h4>

                        </div> 



                        <div class="list-group" style="width: 100%; height: 100%; overflow-y: scroll;">

                            <!-- blog list -->

                            @foreach ($blog_list as $type => $blog_lists)

                                <a href="{{ url('blog-single/'.$blog_lists->id)}}" class="list-group-item {{$blog_lists->id ==$blog[0]['id']  ? 'active' : ''}}">

                                    <i class="fa fa-arrow-right"></i> {{ $blog_lists->blog_header}}

                                </a>

                            @endforeach

                        </div>

                    </div>    

                </div>       

            </div>

        </div>





@endsection

