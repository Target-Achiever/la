@extends('layouts.frontend_temp')

@section('content')
        <div class="container-fluid search">
            
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
                                                            <img src="">
                                                            <h4><b>name</b></h4>
                                                            
                                                            <p>nationality</p>
                                                            <p><b>04:00 to 06:00 PM</b></p>
                                                        </div>
                                                        <div class="col-md-7 col-sm-7">
                                                            <div class="list_btn_cols">
                                                                foreach
                                                                <button class="btn btn-primary">service</button><span class="price">amount</span>
                                                                endforeach
                                                                <a href="book_an_appointment.html" class="btn btn-primary book_appoint">Book An Appointment</a>
                                                            </div>
                                                        </div>
                                                    </div>  

                                                </div>

                                            </div>


                                         </div>
                                        @endforeach  
                                       {!!$providers->links()!!}

                                    </div>                            
                                </div>
                            </div> 
                        </div>        
                    </div>                      
                </div>
            </section>
        </div> 
@endsection