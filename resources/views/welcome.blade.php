@extends('layouts.frontend_temp')

@section('content')
<style>
    .flex, .flex > div[class*='col-'] {
        /*margin-top: -50px;*/
        z-index: 999;

    }
    /* Ads*/
    .carousel-control {
        left: -12px;
        height: 40px;
        width: 40px;
        background: none repeat scroll 0 0 #222222;
        border: 4px solid #FFFFFF;
        border-radius: 23px 23px 23px 23px;
        margin-top: 90px;
    }
    .carousel-control.right {
        right: -12px;
    }
    /* The indicators */
    .carousel-indicators {
        right: 50%;
        top: auto;
        bottom: -25px;
        margin-right: -19px;
    }
    /* The colour of the indicators */
    .carousel-indicators li {
        background: #cecece;
    }
    .carousel-indicators .active {
        background: #428bca;
    }
    .Ads-cols .thumbnail
    {
        background: transparent !important;
        border-color: transparent !important;
    }
    #main-slider .carousel-inner
    {
        overflow: visible;
    }

</style>

<section id="main-slider" class="no-margin">

    {!! displayAlert() !!}

    @if (count($errors) > 0)
    <div class = "alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @php
    $image = 'images/slider/bg1.jpg';
    $sub_banner = 'partner';
    $sub_image = '';
    $head_text = '';
    $sub_banner_mobi = 'images/about.jpg';

    $head_sub_text = '<h3> Welcome to Link Aesthetics</h3>
    <p> LinkAesthetics was created to provide a professional platform for the growing freelance aesthetics industry.
    </p><p>LinkAesthetics addresses the need to bridge the gap between customers and freelance aesthetics providers, providing a convenient way to connect and arrange consultations.</p>

    <ul class="list-unstyled">
        <li><img src="images/check.png" alt="Check"> Determine what you want a change:</li>
        <li><img src="images/check.png" alt="Check"> Check out our services and prices:</li>
        <li><img src="images/check.png" alt="Check"> Call us quickly: <span style="color:#fe9829"><a href="callto:012345647969" class="callto"> 012345647969 </a></span></li>
    </ul>';
    @endphp

    @foreach( $headerText as $header)
        @if($header->type == 'home_sub_banner')
            @php
                $sub_banner = '';
                $sub_image = $header->home_banner ? 'style="background: url('."'".asset("uploads/home_banner/".$header->home_banner)."'".') 50% 50% no-repeat; background-size: cover;min-height:400px"' : 'style="background: url('."'".asset("images/about.jpg")."'".') 50% 50% no-repeat; background-size: cover;min-height:400px"';
                $head_sub_text = $header->header_text;
                $sub_banner_mobi = 'uploads/home_banner/'.$header->home_banner;
            @endphp
        @elseif($header->type == 'home_banner')
            @php
                $image = $header->home_banner ? asset('uploads/home_banner/'.$header->home_banner) : 'images/slider/bg1.jpg';
                $head_text = $header->header_text;
            @endphp
        @endif
    @endforeach

    <div class="carousel slide">
        <div class="carousel-inner">
            <div class="item active home_slider">
                <img src="{{ $image }}" class="img-responsive">
                <div class="container form_content">
                    <div class="row slide-margin">
                        <div class="col-sm-12">
                            <div class="carousel-content">
                                <div class="text-center" > {!! $head_text !!}</div>
                                <!-- search start -->
                                @if($setting !="" && $setting->home_page == 'true')
                                <section class="search_content">
                                    {!! Form::open(['method' => 'GET','url' => 'search/','class' => 'form-inline','id' => 'search-services-form']) !!}
                                    <div class="row">

                                        <div class="col-xs-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <span class="location_icon"><img src="images/location.png"></span>
                                                {!!Form::text('search',null,array('class'=>'form-control','id'=>'search_location','placeholder' => 'Location'))!!}
                                                {!!Form::hidden('latitude','',array('id'=>'latitude'))!!}
                                                {!!Form::hidden('longitude','',array('id'=>'longitude'))!!}

                                                <a href="javascript:void(0)">  <span class="location_point hidden-xs"><img src="images/location_point.png"> Detect</span></a>
                                                <a href="javascript:void(0)">  <span class="location_point hidden-md hidden-lg hidden-sm"><img src="images/location_point.png"> </span></a>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <span class="location_icon"><img src="images/search_icon.png"></span>
                                                {!!Form::text('service',null,array('class'=>'form-control','id'=>'providers-list-input','list' => 'providers-list','autocomplete' => 'off'))!!}
                                                <!-- <datalist id="providers-list">
                                                </datalist> -->
                                                <!-- search -->
                                                <div class="search-results" style="display: none">

                                                    <div class="search-result-content" id="providers-list">

                                                    </div>
                                                </div>
                                                <!-- search end -->
                                            </div>
                                        </div>

                                    </div>
                                    <!-- </form> -->
                                    {!! Form::close() !!}
                                </section>
                                @endif
                                <!-- search end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.item-->
        </div>
        <!--/.carousel-inner-->
    </div>
    <!--/.carousel-->
</section>
<!--/#partner-->
<!--Desktop Device Ads-->
<section class="places hidden-xs">
    <div class="container-fluid">
        <!--Ads Start-->
        <div class="row">
            <div class="col-md-12">
                <div id="Carousel" class="carousel slide Ads-cols">
                    <ol class="carousel-indicators">

                        <?php
                        $array_count = count($ads);

                        $x = 0;

                        if($array_count > 0) {

                            do {
                                $class='';
                                if($x == 0) {
                                    $class='active';
                                    $val = 0;
                                }
                                else {
                                    $val = $x/3;
                                }
                                echo "<li data-target='#Carousel' data-slide-to='".$val."' class='".$class."'></li>";
                                $x = $x+3;
                            } while ($x < $array_count);
                        }
                        ?>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                @forelse($ads as $key => $ad)

                                @if($key % 3 == 0 && $key!=0)
                                <div class="item">
                                    <div class="row">
                                        @endif
                                        <div class="col-md-4 col-sm-4 text-center">
                                           
                                            <a @if($setting !="" && $setting->home_page == 'true') href="{{  url('provider-overview').'/'.$ad->user_slug }}" @endif class="thumbnail">
                                                <img src="{{($ad->ad_banner !='' && File::exists(public_path('uploads').'/ad_banner/'.$ad->ad_banner)) ? asset('uploads').'/ad_banner/'.$ad->ad_banner : asset('images').'/no_banner.png'}}">
                                            </a>
                                            <div class="row places_bottom">
                                                <div class="col-xs-9 col-md-9 col-sm-9">
                                                     <h3>{{ ucfirst( $ad->name) }}</h3>
                                                     <p>{{$ad->ad_header}}</p>
                                                    <h4>{{$ad->city}}</h4>
                                                </div>
                                                <div class="col-xs-3 col-md-3 col-sm-3">
                                                    <img class="img-circle" src="{{($ad->photo !='' && File::exists(public_path('uploads').'/profile_photos/'.$ad->photo)) ? asset('uploads').'/profile_photos/'.$ad->photo : asset('uploads').'/profile_photos/user_profile.png'}}">
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $key_val = $key+1;
                                        ?>
                                        @if($key_val % 3 == 0 || $array_count == $key_val)
                                    </div><!--.row-->
                                </div><!--.item-->
                                @endif
                                @empty
                                @endforelse
                            </div>
                        </div><!--.Carousel-->
                    </div>
                </div>
            </div>
</section>
<!--Desktop Device Ads-->
<!--Mobile Device Ads-->
<section class="places hidden-sm hidden-md hidden-lg hidden-lg">
    <div class="container-fluid">
        <!--Ads Start-->
        <div class="row">
            <div class="col-md-12">
                <div id="Carousel3" class="carousel slide Ads-cols">
                    <ol class="carousel-indicators">

                        <?php
                        $array_count = count($ads);

                        $x = 0;

                        if($array_count > 0) {

                            while($x < $array_count) {
                                $class='';
                                if($x == 0) {
                                    $class='active';
                                }
                                echo "<li data-target='#Carousel3' data-slide-to='".$x."' class='".$class."'></li>";
                                $x++;
                            }                  
                        }
                        ?>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">                        
                                @forelse($ads as $key => $ad)
                                @php 
                                $class='';
                                @endphp                        
                                @if($key == 0)
                                    @php $class='active'; @endphp
                                @endif
                                <div class="item {{$class}}">
                                    <div class="row">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 text-center">
                                            <!-- <h3>{{ ucfirst( $ad->name) }}</h3> -->
                                            <!--<p>{{$ad->service}}</p>-->
                                            <a @if($setting->home_page == 'true') href="{{  url('provider-overview').'/'.$ad->user_slug }}" @endif class="thumbnail">
                                                <img src="{{($ad->ad_banner !='' && File::exists(public_path('uploads').'/ad_banner/'.$ad->ad_banner)) ? asset('uploads').'/ad_banner/'.$ad->ad_banner : asset('images').'/no_banner.png'}}">
                                            </a>
                                            <div class="row places_bottom">
                                                <div class="col-xs-9 col-md-9 col-sm-9">
                                                    <h3>{{ ucfirst( $ad->name) }}</h3>
                                                     <p>{{$ad->ad_header}}</p>
                                                    <h4>{{$ad->city}}</h4>
                                                </div>
                                                <div class="col-xs-3 col-md-3 col-sm-3">
                                                    <img class="img-circle" src="{{($ad->photo !='' && File::exists(public_path('uploads').'/profile_photos/'.$ad->photo)) ? asset('uploads').'/profile_photos/'.$ad->photo : asset('uploads').'/profile_photos/user_profile.png'}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--.row-->
                                </div><!--.item-->
                                </div>
                        </div><!--.Carousel-->
                                @empty
                                <div class="no-advertisement">No Advertisement</div>
                                @endforelse                            
                    </div>
                </div>
            </div>
</section>
<!--Mobile Device Ads-->
<!--Mobile Device Sub Banner-->
<section class="sub_banner_mob hidden-sm hidden-md hidden-lg hidden-xl">
    <div class="row">
        <div class="col-xs-12">
             <div class="wow fadeInDown subbaner_content">
                {!! $head_sub_text !!}
            </div>
        </div>
        <div class="col-xs-12 sub_mob_banner">
            <img src="{{asset($sub_banner_mobi)}}" alt="Sub-banner" class="img-responsive">
        </div>        
    </div>
</section>
<!--Mobile Device Sub Banner-->
<!--Desktop Device Sub Banner-->
<section id="{!! $sub_banner !!}" class="partner hidden-xs" {!! $sub_image !!} >
    <div class="container-fluid">
        <div class="col-sm-6 col-md-6">
            <div class="wow fadeInDown subbaner_content">
                {!! $head_sub_text !!}
            </div>
        </div>
    </div>
    <!--/.container-->
</section>
<!--Desktop Device Sub Banner-->
<!--Desktop Device Services-->
<div class="feature hidden-xs">
    <div class="container">
        <div id="Carousel1" class="carousel slide Ads-cols">
            <ol class="carousel-indicators">
                <?php
                $array_count = count($services);

                $x = 0;

                if($array_count > 0) {

                    do {
                        $class='';
                        if($x == 0) {
                            $class='active';
                            $val = 0;
                        }
                        else {
                            $val = $x/3;
                        }
                        echo "<li data-target='#Carousel1' data-slide-to='".$val."' class='".$class."'></li>";
                        $x = $x+3;
                    } while ($x < $array_count);
                }
                ?>
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row flex">
                        @forelse ($services as $key => $services_list)
                        @if($key % 3 == 0 && $key!=0)
                        <div class="item">
                            <div class="row">
                                @endif
                                <div class="col-md-4  wow  @if ($key == '0') bounceInLeft @elseif ($key == '1') bounceInUp @elseif($key == '2') bounceInRight @endif " data-wow-duration="1000ms" data-wow-delay="300ms">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <img src="{{ asset('uploads/service_banner/'.$services_list->service_banner) }}" alt="Service_Img" class="img-responsive">
                                            <h3 class="text-center">{{ $services_list->service }}</h3>
                                            <p>{!! str_limit($services_list->description , $limit = 350, $end = '...') !!}</p>
                                            <div class="text-center">
                                                <a href="{{ url($services_list->services_id.'/services_read_content') }}" class="btn btn-primary ">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $key_val = $key+1;
                                ?>
                                @if($key_val % 3 == 0 || $array_count == $key_val)
                            </div>
                            <!--.row-->
                        </div>
                        <!--.item-->
                        @endif
                        @empty
                        <div class="no-advertisement">No service</div>
                        @endforelse
                    </div>
                </div>
                <!--.Carousel-->
            </div>
        </div>
    </div>
</div>
<!--Desktop Device Services-->
<!--Mobile Device-->
<div class="feature hidden-sm hidden-md hidden-lg hidden-xl">
    <div class="container">
        <div id="Carousel2" class="carousel slide Ads-cols">
            <ol class="carousel-indicators">
                <?php
                $array_count = count($services);

                $x = 0;

                if($array_count > 0) {

                    while($x < $array_count) {
                        $class='';
                        if($x == 0) {
                            $class='active';
                        }
                        echo "<li data-target='#Carousel2' data-slide-to='".$x."' class='".$class."'></li>";
                        $x++;
                    }                  
                }
                ?>
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">
                
                        @forelse ($services as $key => $services_list)
                        @php 
                        $class='';
                        @endphp                        
                        @if($key == 0)
                            @php $class='active'; @endphp
                        @endif
                        <div class="item {{$class}}">
                    <div class="row flex">
                        <div class="item">
                            <div class="row">
                                <div class="col-md-12    @if ($key == '0')  @elseif ($key == '1')  @elseif($key == '2')  @endif " data-wow-duration="1000ms" data-wow-delay="300ms">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <img src="{{ asset('uploads/service_banner/'.$services_list->service_banner) }}" alt="Service_Img" class="img-responsive">
                                            <h3 class="text-center">{{ $services_list->service }}</h3>
                                            <p>{!! str_limit($services_list->description , $limit = 350, $end = '...') !!}</p>
                                            <div class="text-center">
                                                <a href="{{ url($services_list->services_id.'/services_read_content') }}" class="btn btn-primary ">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--.row-->
                        </div>
                        <!--.item-->
                            </div>
                        </div>
                        <!--.Carousel-->
                        @empty
                        <div class="no-advertisement">No service</div>
                        @endforelse
         
            </div>
        </div>
    </div>
</div>
<!--Mobile Device-->
@endsection

@section('inline-scripts')

$(window).load(function()
{
var toAppend = '';
$.ajax({
type:'POST',
url:APP_URL+'/predefined_services_list',
success:function(res){
//-------------------------------
if(res != '')
{
$.each(res, function(i, v)
{

if(v.service !=null)
{
toAppend += '<div class="list-item" data-service="'+v.service+'"><i class="fa fa-search"></i>'+v.service+'</div>';
}
});
toAppend += '<div class="list-item" data-service="offers&deals"><i class="fa fa-search"></i>Offers & Deals</div>';
}else
{
toAppend += '<div class="list-item"><i class="fa fa-search"></i>no data found</div>';
}

$('#providers-list').html(toAppend);

}
});
})

$("#providers-list-input").click(function(){
$(".search-results").fadeIn(200);
})

@endsection