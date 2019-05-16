@extends('layouts.frontend_temp')

@section('content')

<!-- content area start  -->

<div class="feedback appointment_details">

   <section class="container feedback_cols appointment_details_cols">

      <div class="row feedback_list">

         <div class="feedback_col">

            <div class="col-sm-3 col-md-3 feedback_img">

               <img src="{{($providerData['photo'] !='' && File::exists(public_path('uploads').'/profile_photos/'.$providerData['photo'])) ? asset('uploads').'/profile_photos/'.$providerData['photo'] : asset('uploads').'/profile_photos/'.'user_profile.png'}}">

            </div>

            <div class="col-sm-9 col-md-9 feedback_info">

               <div class="title text-justify">

                  <h3>{{$providerData['name']}}</h3>

                  <h3>{{$providerData['registered_with']}}</h3>

                  <h3> {{isset($providerData['service_location_preference']) ? 'Location: '.$locationPreference[$providerData['service_location_preference']] : ''}}</h3>

                  <!-- <h5><i class="fa fa-home"></i> Address:</h5>

                  <p>{{$providerData['address_line_1']}}</p> -->

               </div>             

               <div class="row">

                  <div class="col-md-12 col-sm-12">

                     <ul class="list-unstyled list-inline">

                        @foreach($providerData['provider_services'] as $key => $service)

                          <li><span class="price">{{$key}}</span>

                          @foreach($service as $sub)  

                            <ol>

                               @php

                                if($sub['offer'] == 1)

                                  {

                                    @endphp

                                      <div class="btn btn-primary" style="cursor: default">{{$sub['service']}}{{($sub['type'] == '1') ? ' ('.$sub['volume'].'ml)' : ''}} - <span class="price"><strike>{{conversion_to_pound($sub['actual_amount'])}}</strike>

                                      {{conversion_to_pound($sub['amount'])}}

                                      </span></div>

                                  @php}

                                  else

                                  {

                                    @endphp

                                      <div class="btn btn-primary" style="cursor: default">{{$sub['service']}}{{($sub['type'] == '1') ? ' ('.$sub['volume'].'ml)' : ''}} - <span class="price">

                                      {{conversion_to_pound($sub['amount'])}}

                                      </span></div>

                                    @php

                                  }

                               @endphp

                            </ol>

                          @endforeach  

                          </li>

                        @endforeach

                     </ul>

                  </div>

               </div>

               <div class="row">

                  <div class="col-md-12 col-sm-12  text-left">

                      @if (Auth::check())

                      <a href="{{url('book-an-appointment').'/'.$providerData['user_slug']}}"><button class="btn btn-primary book-now-btn">Book Appointment</button></a>

                      @else

                      <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary book-now-btn book_appoint" data-appId="{{$providerData['user_slug']}}">Book An Appointment</a>

                      @endif



                  </div>

               </div>

            </div>

         </div>

      </div>

      <div class="row overview-tab-cols">

         <div class="col-md-12">

            <div class="card" id="appoint-overview">

               <ul class="nav nav-tabs"  role="tablist">

                  <li role="presentation" class="active"><a href="#Info" aria-controls="Info" role="tab" data-toggle="tab">Info</a></li>

                  <li role="presentation"><a href="#Service" aria-controls="Service" role="tab" data-toggle="tab">Gallery</a></li>

                  <li role="presentation"><a href="#Cancellation" aria-controls="Cancellation" role="tab" data-toggle="tab">Cancellation Policy</a></li>

                  <li role="presentation"><a href="#Reschedule" aria-controls="Reschedule" role="tab" data-toggle="tab">Reschedule Policy</a></li>

                  <li role="presentation"><a href="#Dissatisfaction" aria-controls="Dissatisfaction" role="tab" data-toggle="tab">Customer Dissatisfaction</a></li>

                  <li role="presentation"><a href="#feedback" aria-controls="feedback" role="tab" data-toggle="tab">Feedback</a></li>

               </ul>

               <!-- Tab panes -->

               <div class="tab-content">

                  <div role="tabpanel" class="tab-pane active" id="Info">

                     <div class="row info-list">

                        <div class="col-md-2 col-sm-2">

                           <h5><i class="fa fa-clock-o info-icon" aria-hidden="true"></i> service time: </h5>

                           <p>{{$providerData['time_from']}} - {{$providerData['time_to']}}</p>

                        </div>

                        <div class="col-md-4 col-sm-4">

                           <h5><i class="fa fa-calendar info-icon"></i> Working Days:</h5>

                           <p>

                              <?php

                                 $avail = array();

                                 $avail = json_decode($providerData['available_days'],true);

                                 if(!empty($avail))

                                 {

                                                 

                                        $i = 0;

                                        $len = count($avail);

                                            ?>

                              @foreach(config('custom.days') as $key => $day)

                              <?php

                                 if(in_array($key,$avail))

                                 {

                                     $i++;

                                     echo $day;

                                     echo $comma = ($i != $len) ? ',' : '';

                                 }

                                 ?>

                              @endforeach

                              <?php

                                 }

                                 else

                                 {

                                     echo 'no days available';

                                 }

                                 ?>  

                        </div>

                     </div>

                     <div class="row info-list">

                        <div class="col-md-2 col-sm-2">

                           <h5><i class="fa fa-map-marker info-icon"></i> Location:</h5>
              
                           <p>{{isset($providerData['service_location_preference']) ? $locationPreference[$providerData['service_location_preference']] : 'not updated the settings'}}</p>

                        </div>

                        <div class="col-md-4 col-sm-4">

                           <h5><i class="fa fa-home info-icon"></i> Address:</h5>

                           <p>{{$providerData['city']}}, {{$providerData['state']}}, {{$providerData['country']}}</p>

                        </div>

                     </div>

                     <div class="row info-list">

                        <div class="col-md-12 col-sm-12"> 

                            <h5><i class="fa fa-file-text-o info-icon" aria-hidden="true"></i> Services:</h5>

                            <ul class="list-unstyled">

                                @foreach($providerData['provider_services'] as $key => $service)

                                  <li>{{$key}}

                                @foreach($service as $sub) 

                                  <ol> <i class="fa fa-check-circle-o" aria-hidden="true"></i> {{$sub['service']}}</ol>

                                @endforeach

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                     </div>

                  </div>

                  <div role="tabpanel" class="tab-pane" id="Service">

                    <div class="gallery">

                        <div class="row">

                            <div class='list-group gallery'>
                                @foreach($providerData['provider_gallery'] as $gallery)

                                <div class='col-sm-4 col-xs-6 col-md-3'>

                                    <a class="thumbnail fancybox" rel="ligthbox" href="{{ asset('uploads/gallery/original/'.$gallery['original_path']) }}">

                                        <img class="img-responsive" alt="" src="{{ asset('uploads/gallery/'.$gallery['file_name']) }}" />

                                    </a>

                                </div>



                                @endforeach



                            </div> 

                        </div> 

                    </div> 

                  </div>

                  <div role="tabpanel" class="tab-pane" id="Cancellation">

                     <p>


                     @if($refund_policy->refund == "0" )

                     <p> No cancel policies. </p>

                     @else

                     <h4> Cancel an appointment </h4>

                      <p>* Refund percentage if cancelled above 7 Days: <b>{{ $refund_policy->percentage_week }} %</b></p>

                      <p>* Refund percentage if cancelled bellow 7 Days: <b>{{ $refund_policy->percentage_days }} %</b></p>

                      <p>* Refund percentage if cancelled within 24hours of your appointment: <b>{{ $refund_policy->percentage_appointment_day }} %</b></p>

                     @endif



                     </p>

                  </div>

                  <div role="tabpanel" class="tab-pane" id="Reschedule">

                     <p>
                         @foreach($providerData['provider_policies'] as $policies)

                         {!! $policies['policy_type']=='reschedule' ? $policies['policy'] : "" !!}

                         @endforeach

                     </p>

                  </div>

                  <div role="tabpanel" class="tab-pane" id="Dissatisfaction">

                     <p>

                         @foreach($providerData['provider_policies'] as $key => $policies)

                         {!! $policies['policy_type']=='dissatisfaction' ? $policies['policy'] : "" !!}

                         @endforeach

                     </p>

                  </div>

                  <div role="tabpanel" class="tab-pane " id="feedback">

                      @if (Auth::check())



                      <div class="row">

                        <div class="col-md-12 col-sm-12">
                            @if (Auth::user()->user_type == 'end_user' && $appointment !="" )

                            <div class="feedback-form">

                                <h4>Post Your Feedback:</h4>

                                <div class="fdivider1"></div>

                                {{ Form::open(array('url' => '','method' => 'POST', 'id' => 'feedbackForm' )) }}



                                <div class="row ">

                                    <div class="col-md-12 col-sm-12 ">

                                        <div class="form-group feed_error">



                                            {{ Form::textarea('feedback',null,['placeholder' => 'Enter Your Feedback','rows' => '5' ,

                                            'class'=> 'form-control feed_error' ,'id' => 'feedback_text']) }}

                                        </div>

                                    </div>

                                </div>

                                {{ Form::hidden('provider_id',$providerData['user_id']) }}





                                <div class="row">

                                    <div class="col-md-12 col-sm-12">

                                        <div class="form-group pull-right">

                                            <button type="submit" class="btn btn-primary">Submit</button>

                                        </div>

                                    </div>

                                </div>



                              

                                {{ Form::close() }}



                            </div>
                            @endif
                        </div>

                     </div>

 @endif

                     <div class="row">

                         <div class="col-md-12 col-sm-12">

                             <div class="feedback-comments">

                                <h4>Reviews:</h4>

                                <div class="fdivider2"></div>

                                 <div class="row" id="feedback_message" >

                                     <!--Comment Start-->
                                     <div id="load-data">
                                         @foreach ($feedback as $feedback_list)

                                         <div class="col-md-12 col-sm-12 feedback-list">

                                             <div class="com-md-2 col-sm-2 text-center">

                                                 @if( $feedback_list['photo'] )

                                                 <img class="img-circle" alt="" src="{{ asset('uploads/profile_photos/'.$feedback_list['photo']) }}" />

                                                 @else

                                                 <h2>{{ substr(ucfirst($feedback_list['name']), 0, 1)  }}</h2>

                                                 @endif



                                                 <h5>{{ $feedback_list['name'] }} </h5>

                                                 <h6> {!! App\Feedback::timeAgo($feedback_list['created_at'])  !!}  </h6>

                                             </div>

                                             <div class="com-md-10 col-sm-10">

                                                 <div class="feed-msg">

                                                     <p>{{ $feedback_list['feedback'] }}</p>

                                                 </div>

                                             </div>

                                         </div>


                                         @endforeach

                                         <!--Comment End-->

                                     </div>
                                 </div>

                             </div>

                         </div>  {{ Form::hidden('provider_id',$providerData['user_id'],array('id' => 'provider_id')) }}
                         @if (Auth::check())
                             @if(Auth::user()->user_type == 'end_user')
                                 @if($feedback !=null)
                                     @if(count($feedback_count)>4)
                                     <div align="center" id="remove-row">
                                         <button class="btn btn-primary" data-type="provider_overview" data-id="{{$feedback_list['fb_id']}}" id="load_more_feedback"><i class="fa fa-refresh"></i> Load more </button>
                                     </div>
                                     @endif
                                 @else
                                 <div align="center" id="no_review"><p>No review available.</p></div>
                                 @endif
                             @endif
                         @endif
                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </section>

</div>

<!-- content area end  -->    

@endsection