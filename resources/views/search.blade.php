@extends('layouts.frontend_temp')



@section('content')

           

        <div class="container-fluid search">



            <section class="search_content">           

                {!! Form::open(['method' => 'GET','url' => 'search/','class' => 'form-inline','id' => 'search-services-form']) !!}

                    <div class="row">

                        

                        {!! displayAlert() !!}



                        <div class="col-md-6 col-sm-6">   

                            <div class="form-group">       

                                <span class="location_icon"><img src="{{asset('images/location.png')}}"></span>

                                {!!Form::text('search',null,array('class'=>'form-control','id'=>'search_location'))!!}

                                {!!Form::hidden('latitude','',array('id'=>'latitude'))!!}

                                {!!Form::hidden('longitude','',array('id'=>'longitude'))!!}

                                <span class="location_point"><img src="{{asset('images/location_point.png')}}"> Detect</span>

                            </div>

                        </div>

                        <div class="col-md-6 col-sm-6">   

                            <div class="form-group">                                               

                                <span class="location_icon"><img src="{{asset('images/search_icon.png')}}"></span>

                                {!!Form::text('service',null,array('class'=>'form-control','id'=>'providers-list-input','list' => 'providers-list'))!!}

                                <!-- <datalist id="providers-list">                                                           

                                </datalist> -->

                                <!-- search -->

                                <div class="search-results">



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

            <section class="search_result">

                <div class="container-fluid">

                    <div class="search-result-for"><h4> search result for: <span class="search-list"> {{$searchresult['location']}} <i class="fa fa-long-arrow-right"></i> {{$searchresult['service']}} </span></h4></div>

                    <div class="row">

                        <div class="service">

                            <div class="container-fluid">    

                                <div class="service_list">

                                    <div class="row" id="search-result-for">

                                        @forelse($providers as $provider)

                                         <div class="col-md-3  wow bounceInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">

                                       

                                         <div class="panel panel-default">

                                            <div class="panel-body">

                                                <a href="{{  url('provider-overview').'/'.$provider['user_slug']  }}" data-appId="{{$provider['user_id']}}">

                                                    <div id="myCarousel-{{$provider['id']}}" class="carousel slide" data-ride="carousel">

                                                    <div class="carousel-inner">

                                                            @if(!empty($provider['provider_gallery']))

                                                                @foreach($provider['provider_gallery'] as $key => $file)



                                                                <div class="item {{($key==0) ? 'active' : ''}}">

                                                                     <img src="{{($file['file_name'] !='' && File::exists(public_path('uploads').'/gallery/'.$file['file_name'])) ? asset('uploads').'/gallery/'.$file['file_name'] : asset('uploads').'/gallery/no-preview.png'}}">

                                                                </div>

                                                                @endforeach

                                                            @else

                                                            <div class="item active">

                                                                 <img src="{{asset('uploads/gallery/')}}/no-preview.png" alt="Service_Img" class="img-responsive">

                                                            </div>

                                                            @endif

                                                        </div>

                                                        <a class="left carousel-control" href="#myCarousel-{{$provider['id']}}" data-slide="prev">

                                                            <span class="glyphicon glyphicon-chevron-left"></span>

                                                            <span class="sr-only">Previous</span>

                                                        </a>

                                                        <a class="right carousel-control" href="#myCarousel-{{$provider['id']}}" data-slide="next">

                                                            <span class="glyphicon glyphicon-chevron-right"></span>

                                                            <span class="sr-only">Next</span>

                                                        </a>



                                                </div>

                                                </a>



                                                  <div class="list_content text-justify">

                                                      <a href="{{  url('provider-overview').'/'.$provider['user_slug']  }}" data-appId="{{$provider['user_id']}}">



                                                      <div class="col-md-5 col-sm-5 text-center">

                                                           <div class="user-profile-img">

                                                                <img src="{{($provider['photo'] !='' && File::exists(public_path('uploads').'/profile_photos/'.$provider['photo'])) ? asset('uploads').'/profile_photos/'.$provider['photo'] : asset('uploads').'/profile_photos/default_user.png'}}">

                                                            </div>

                                                        </div>

                                                        <div class="col-md-7 col-sm-7">

                                                              <h4><b>{{$provider['name']}}</b></h4>

                                                            

                                                            <p>{{$provider['city']}}</p>

                                                            <p><b>{{$provider['time_from']}} - {{$provider['time_to']}}</b></p>

                                                        </div>

                                                      </a>

                                                        <div class="col-md-12">

                                                             <div class="list_btn_cols">

                                                                <!-- show only on serice by array slice -->

                                                                @foreach(array_slice($provider['provider_services']['service'],0,1) as $services)

                                                                 <a href="{{  url('provider-overview').'/'.$provider['user_slug']  }}" data-appId="{{$provider['user_id']}}">



                                                                 <div class="row list-price-info">

                                                                    <div class="col-md-12">

                                                                        <button class="btn btn-primary"><b>{{$services['service']}}</b><br>{{(isset($provider['provider_services']['material']['name'])) ? $provider['provider_services']['material']['name'] : ''}}{{(isset($provider['provider_services']['material']['amount'])) ? ' - '.conversion_to_pound($provider['provider_services']['material']['amount']) : ''}}
</button>

                                                                    </div>    

                                                                      

                                                                </div>

                                                                     </a>

                                                                @endforeach

                                                                @if($user_login_status)

                                                                <a href="{{url('book-an-appointment').'/'.$provider['user_slug']}}" class="btn btn-primary book_appoint">Book An Appointment</a>

                                                                @else

                                                                <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary book_appoint" data-appId="{{$provider['user_slug']}}">Book An Appointment</a>

                                                                @endif

                                                            </div>

                                                        </div>    

                                                    </div>  



                                                </div>



                                            </div>





                                         </div>

                                        @empty

                                        <div>

                                            <p class="no-result">No results found</p>

                                        </div>

                                        @endforelse 

                                      

                                    </div>                            

                                </div>

                            </div> 
                            @if(!empty($providers) && count($providers) >= 4)
                            <div class="no-data-found text-center" style="display: none">No more data available</div>
                            <div class="text-center">
                                <a href="javascript:void(0);" class="btn btn-primary" id="ajax_search_load_more" data-queryString="{{$queryString}}" data-id="3">Load More </a>
                            </div>
                            @endif
                        </div>        

                    </div>  

                       <!-- pangination link place -->

                </div>

            </section>

        </div> 

@endsection