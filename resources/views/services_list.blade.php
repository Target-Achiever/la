@extends('layouts.frontend_temp')@section('content')
<style type="text/css">
    .btn-fixed {
        position: fixed;
        top: 100px;
        right: 20px;
        background-color: #fff;
        z-index: 9999999999999999999999;
        transition: all 1s;
    }
    .ul_list ul {
        padding-left:20px ;
    }
</style><!--/#main-slider-->           <!--/#main-slider-->
<div class="aboutus">
    <div class="container"><h3>{{ $service->service }}</h3>
        <div class="divider"></div>
        <hr>
        <div class="col-sm-9 col-md-9 wow fadeInDown about_cols more-details-content" data-wow-duration="1000ms"
             data-wow-delay="300ms">
            <div class="row">
                <div class="col-md-6">
                    <div class="service-list-image"><img
                                src="{{asset('uploads/service_banner/'.$service->service_banner)}}"
                                class="" alt="Services" width="90%"></div>
                </div>
                <div class="col-md-6 ul_list" > {!! $service->description !!} {!! $service->service_readmore !!}</div>
            </div>
            <!--<div class="service-ctrl">                    <a href="{{ url('services') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back</a>                </div>-->
        </div>
        <div class="col-sm-3 col-md-3 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"
        ">
        <div class="more-service-side">
            <div class="head-title"><h4>Services List:</h4></div>
            <div class="list-group"> @foreach ($service_all as $service_all_list) <a
                        href="{{ url($service_all_list->services_id.'/services_read_content') }}"
                        class="list-group-item"> <i class="fa fa-arrow-right"></i> {{ $service_all_list ->service}} </a>
                @endforeach
            </div>
        </div>
    </div>
    @if($setting !="" && $setting->home_page == 'true')
    <a href="{{ url('book-service/'.$service->services_id.'-'.$service->service)   }}"
       class="btn btn-primary btn-fixed"><i class="fa fa-book"></i> Book An Appointment</a>
    @endif

</div>        </div>@endsection