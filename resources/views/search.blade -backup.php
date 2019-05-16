@extends('layouts.frontend_temp')

@section('content')
        <div class="container-fluid search">
            <section class="search_content">
                {!! Form::open(['method' => 'GET','url' => 'search/','class' => 'form-inline','id' => 'search-services-form']) !!}
                    <div class="row">
                        <div class="col-md-6 col-sm-6">   
                            <div class="form-group">       
                                <span class="location_icon"><img src="images/location.png"></span>
                                {!!Form::text('search',null,array('class'=>'form-control','id'=>'search-location'))!!}
                                {!!Form::hidden('latitude','',array('id'=>'latitude'))!!}
                                {!!Form::hidden('longitude','',array('id'=>'longitude'))!!}
                                
                                <span class="location_point"><img src="images/location_point.png"> Detect</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">   
                            <div class="form-group">                                               
                                <span class="location_icon"><img src="images/search_icon.png"></span>
                                {!!Form::text('service',null,array('class'=>'form-control','id'=>'providers-list-input','list' => 'providers-list'))!!}
                                <datalist id="providers-list">                                                           
                                </datalist>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </section> 
            <section class="search_result">
                <div class="container-fluid">
                    <div class="row">
                        <div class="service">
                            <div class="container-fluid">                                
                                <div class="service_list">
                                    <div class="row">
                                       
                                        @foreach($providers as $provider)
                                        
                                        <div class="col-md-4  wow bounceInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
                                            <div class="panel panel-default">                            
                                                <div class="panel-body">
                                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">  
                                                        <!-- Wrapper for slides -->
                                                        <div class="carousel-inner">
                                                            <div class="item active">
                                                                 <img src="images/service1.png" alt="Service_Img" class="img-responsive">
                                                            </div>

                                                            <div class="item">
                                                                 <img src="images/service2.png" alt="Service_Img" class="img-responsive">
                                                            </div>

                                                            <div class="item">
                                                                 <img src="images/service3.png" alt="Service_Img" class="img-responsive">
                                                            </div>
                                                        </div>

                                                        <!-- Left and right controls -->
                                                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="list_content">
                                                        <div class="col-md-5 col-sm-5">
                                                            <img src="{{ $provider['photo'] != '' ? asset('uploads').'/providers/'.$provider['photo'] : 'images/user_profile1.png' }}">
                                                            <h4><b>{{$provider['name']}}</b></h4>
                                                            
                                                            <p>{{$provider['nationality']}}</p>
                                                            <p><b>04:00 to 06:00 PM</b></p>
                                                        </div>
                                                        <div class="col-md-7 col-sm-7">
                                                            <div class="list_btn_cols">
                                                                @foreach($provider['provider_services'] as $services)
                                                                <button class="btn btn-primary">{{$services['service']}}</button><span class="price">€{{$services['amount']}}</span>
                                                                @endforeach
                                                                <a href="book_an_appointment.html" class="btn btn-primary book_appoint">Book An Appointment</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--/col--> 
                                        @endforeach  
                                       
                                        {!!$providers->links()!!}                      
                                    </div> <!-- row end -- >
                                </div>
                            </div> 
                        </div>        
                    </div>                      
                </div>
            </section>
        </div> 
@endsection