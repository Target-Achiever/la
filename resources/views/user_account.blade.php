@extends('layouts.frontend_temp')

<style>



/*  bhoechie tab */

div.bhoechie-tab-container{

  z-index: 10;

  background-color: #ffffff;

  padding: 0 !important;

  border-radius: 4px;

  -moz-border-radius: 4px;

  border:1px solid #ddd;

  margin-top: 20px;

  margin-left: 50px;

  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);

  box-shadow: 0 6px 12px rgba(0,0,0,.175);

  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);

  background-clip: padding-box;

  opacity: 0.97;

  filter: alpha(opacity=97);

  margin:50px auto;

}

div.bhoechie-tab-menu{

  padding-right: 0;

  padding-left: 0;

  padding-bottom: 0;

}

div.bhoechie-tab-menu div.list-group{

  margin-bottom: 0;

}
.strip_button button {
    width:100%;
}
div.bhoechie-tab-menu div.list-group>a{

  margin-bottom: 0;

}

div.bhoechie-tab-menu div.list-group>a .glyphicon,

div.bhoechie-tab-menu div.list-group>a .fa {

  color: #5A55A3;

}

div.bhoechie-tab-menu div.list-group>a:first-child{

  border-top-right-radius: 0;

  -moz-border-top-right-radius: 0;

}

div.bhoechie-tab-menu div.list-group>a:last-child{

  border-bottom-right-radius: 0;

  -moz-border-bottom-right-radius: 0;

}

div.bhoechie-tab-menu div.list-group>a.active,

div.bhoechie-tab-menu div.list-group>a.active .glyphicon,

div.bhoechie-tab-menu div.list-group>a.active .fa{

  background-color: #5A55A3;

  background-image: #5A55A3;

  color: #ffffff;

}

div.bhoechie-tab-menu div.list-group>a.active:after{

  content: '';

  position: absolute;

  left: 100%;

  top: 50%;

  margin-top: -13px;

  border-left: 0;

  border-bottom: 13px solid transparent;

  border-top: 13px solid transparent;

  border-left: 10px solid #5A55A3;

}



div.bhoechie-tab-content{

  background-color: #ffffff;

  /* border: 1px solid #eeeeee; */

  padding: 20px;

  padding-top: 10px;

}



div.bhoechie-tab div.bhoechie-tab-content:not(.active){

  display: none;

}

.profile lable

{

  color:#333;

}

 .btn-bs-file{

   position:relative;

   margin-top:20px;

   background-color: #5A55A3 !important;

   border-color: #5A55A3 !important;

}

.btn-bs-file input[type="file"]{

   position: absolute;

   top: -9999999;

   filter: alpha(opacity=0);

   opacity: 0;

   width:0;

   height:0;

   outline: none;

   cursor: inherit;

}

.feedback_img img

{

 max-height: 150px;

}

.form-group {

    margin: 7px 15px !important;

}

/*Custom Scroll*/



.scrollbar

{

  max-height: 450px;

  overflow-y: auto;

  padding: 0px 7px;

}

.force-overflow

{

  max-height: 450px;

  overflow-y: auto;

}

#style-4::-webkit-scrollbar-track

{

  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);

  background-color: #F5F5F5;

}



#style-4::-webkit-scrollbar

{

  width: 10px;

  background-color: #F5F5F5;

}



#style-4::-webkit-scrollbar-thumb

{

  background-color: #000000;

  border: 2px solid #555555;

}

/*Custom Scroll*/



</style>

@section('content')



<div class="container">

  <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">

        {!! displayAlert() !!}

          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">

            <div class="list-group">

              <a href="javascript:void(0)" class="list-group-item active text-center">

                <h4 class="glyphicon glyphicon-user"></h4><br/>Profile

              </a>

              <a href="javascript:void(0)" onclick="$('.user-noti-count').hide();" class="list-group-item text-center">

                <h4 class="glyphicon glyphicon-bell">
                  @php
                  $count = \DB::table('notifications')->where('notify_status','=','2')->where('notify_action_to',Auth::user()->id)->count();

                  if($count > 0)
                  {
                    @endphp
                    <span class="user-noti-count">{{ $count }} </span>
                    @php
                  }
                  @endphp
                </h4>
                <br/>Notification

              </a>

              <a href="javascript:void(0)" class="list-group-item text-center">

                <h4 class="glyphicon glyphicon-pencil"></h4><br/>Appointment

              </a>

              <a href="javascript:void(0)" class="list-group-item text-center">

                <h4 class="glyphicon glyphicon-comment"></h4><br/>Feedback

              </a>

              <a href="{{url('/logout')}}" class="list-group-item text-center">

                <h4 class="glyphicon glyphicon-log-out"></h4><br/>Logout

              </a>

            </div>

          </div>



          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">

              <!-- flight section -->

              <div class="bhoechie-tab-content active">

                @if (count($errors) > 0)

                         <div class = "alert alert-danger">

                            <ul>

                               @foreach ($errors->all() as $error)

                                  <li>{{ $error }}</li>

                               @endforeach

                            </ul>

                         </div>

                      @endif

                <h4>Profile:</h4>

                <div class="col-md-12 text-center feedback_img">



                          <img class="img-circle" id="displayImage" src="{{($profile->photo !='' && File::exists(public_path('uploads').'/profile_photos/'.$profile->photo)) ?

                          asset('uploads').'/profile_photos/'.$profile->photo : asset('uploads').'/profile_photos/default_user.png'}}">

                          {!!Form::open(['url' => 'user_account_profile/save','method' => 'post','files' => true ,'id' => 'user_update'])!!}

                       <div class="form-group">

                        <label class="btn-bs-file btn btn-sm btn-success">

                          Choose Profile Image

                          {!!Form::file('profile',array('id' => 'imgInp') )!!}

                        </label>

                       </div>

                </div>

                  <!-- <form class="profile" action="#" method="post"> -->



                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>Name:</lable>

                              <input type="text" name="user_name" placeholder="Name" class="form-control" readonly="" value="{{$profile->name}}">

                              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            </div>

                        </div>

                         <div class="col-md-6">

                            <div class="form-group">

                              <lable>Email:</lable>

                              <input type="email" name="email" placeholder="Email" class="form-control" readonly="" value="{{$profile->email}}">

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>Address:</lable>

                              <input type="text" name="user_address" placeholder="Address" class="form-control" value="{{$profile->address_line_1}}" id="user_address">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>Country:</lable>

                              <input type="text" name="user_country" placeholder="Country" class="form-control" value="{{ucfirst($profile->country)}}">

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>State:</lable>

                              <input type="text" name="user_state" placeholder="State" class="form-control" value="{{ucfirst($profile->state)}}">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>City:</lable>

                              <input type="text" name="user_city" placeholder="City" class="form-control" value="{{ucfirst($profile->city)}}">

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>Mobile Number:</lable>

                              <input type="text" name="phone" placeholder="Mobile Number" class="form-control bfh-phone" data-format="+0 ddd ddd dddd" value="{{$profile->phone}}" autocomplete="false">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>Old Password:</lable>

                              <input type="password" name="old_password" placeholder="Old Password" class="form-control">

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>New Password:</lable>

                              <input type="password" name="new_password" placeholder="New Password" class="form-control">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <lable>Confirm Password:</lable>

                              <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-8 col-md-offset-2">

                            <div class="form-group text-center">

                              <button class="btn btn-primary" id="update_profile"> Update</button>

                              <!-- <button class="btn btn-primary" id="cancel"> Cancel</button> -->

                            </div>

                        </div>

                      </div>

                  <!-- </form> -->

                  {!!Form::close()!!}

              </div>

              <!-- Notification -->

              <div class="bhoechie-tab-content">

                 <h4>Notification</h4>

                 <div class="user-notification-list">

                  @forelse($notifications as $noti)

                  <div class="{{($noti->notify_status == 1) ? 'notification-1' : 'notification-2'}} alert alert-info alert-dismissible notification_bar" data-noti-id="{{$noti->id}}" data-noti-type="{{$noti->notify_action_type}}" id="notification_box_{{$noti->id}}">

                      <a href="#" class="close remove-notification" data-dismiss="alert" aria-label="close" data-noti-id="{{$noti->id}}">×</a>

                      {{$noti->notification_message}}
                      <!-- <br>
                      <i class="fa fa-clock-o"></i> {!! App\Feedback::timeAgo($noti->created_at)  !!} -->

                  </div>

                  @empty

                  <div class="alert alert-warning alert-white rounded notify"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> <div class="icon"> <i class="fa fa-exclamation-triangle"></i> </div>No notification found</div>

                  @endforelse

              </div>

              </div>

              <!-- Appointment -->

              <div class="bhoechie-tab-content ">

                <h4>Appointment</h4>

                <div class="scrollbar" id="style-4">

                   <div class="force-overflow">

                  @forelse($appointments  as $app)

                  <div class="alert alert-info alert-dismissible">

                   <div class="app-preferred-date row app_div">
                     <div class="col-md-3 col-sm-3">Date:</div>
                     <div class="col-md-9 col-sm-9"> {{date("F j", strtotime($app->preferred_date))}}
                     </div>
                   </div>
                    <div class="app-status row app_div">
                       <div class="col-md-3 col-sm-3">Appointment Status:</div>
                        <div class="col-md-9 col-sm-9 app_status">
                          <p> {{$status_array[$app->appointment_status]}} <p>
                        </div>
                    </div>
                    <div class="row app_div">
                       <div class="col-md-3 col-sm-3">Payment Status:</div>
                        <div class="col-md-9 col-sm-9"> {{($app->payment_status == 1) ? 'Paid' : 'Not paid'}}
                        </div>
                    </div>
                      <div class="row app_div">
                       <div class="col-md-3 col-sm-3">Appointment for:</div>
                        <div class="col-md-9 col-sm-9"> {{ ($app->service_type == '3') ? $app->service_name : $app->service }} with {{$app->name}}
                        </div>
                      </div>


                        @if($app->service_type == '3')
                          <div class="row app-material-name app_div">
                             <div class="col-md-3 col-sm-3">Brand:</div>
                              <div class="col-md-9 col-sm-9">{{$app->service}}
                              </div>
                          </div>
                        @endif
                        <!-- vlome and time required -->
                        @if($app->service_type == '3')
                          <div class="row app-material-name app_div">
                             <div class="col-md-3 col-sm-3">Volume:</div>
                              <div class="col-md-9 col-sm-9">{{$app->quantity}}ml
                              </div>
                          </div>
                        @endif

                          <div class="row app-material-name app_div">
                             <div class="col-md-3 col-sm-3">Time required:</div>
                              <div class="col-md-9 col-sm-9">{{$app->time_needed}}hr(s)
                              </div>
                          </div>

                        <!--  -->
                      <div class="row app-preferred-time app_div">
                         <div class="col-md-3 col-sm-3">Time:</div>
                          <div class="col-md-9 col-sm-9"> {{$app->appointment_time_from}}
                          </div>
                      </div>
                      <div class="row">
                        @if($app->paybutton == 'true' && $app->appointment_status == 2)
                        <div class="col-md-3 col-sm-3 strip_button">

                            <!-- <a href="{{url('appointment-payment').'/'.$app->payment_url}}" class="pay-for-appointment"><button class="app-paynow-btn">PAY NOW</button></a> -->

                            {!!Form::open(['url' => 'appointment-payment/'.$app->payment_url,'method' => 'post'])!!}

                              <script

                                  src="https://checkout.stripe.com/checkout.js" class="stripe-button"

                                  data-key="{{env('STRIPE_KEY')}}"

                                  data-amount="{{$app->service_amount}}"

                                  data-name="Linkaesthetics"

                                  data-description="Appointment payment"

                                  data-image="https://stripe.com/img/documentation/checkout/marketplace.png"

                                  data-locale="auto"

                                  data-currency="GBP">

                              </script>

                            {!! Form::close()!!}

                         </div>
                        @endif
                        @if($app->cancel_button)
                          <div class="col-md-2 col-sm-3">

                            <div class="mob_pay">

                              <a href="{{url('cancel-appointment').'/'.$app->payment_url}}" class="btn btn-info app-cancel-btn">Cancel</a>

                              </div>

                          </div>
                        @endif
                    </div>
                  </div>



                  @empty

                  <div class="alert alert-warning alert-white rounded notify"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> <div class="icon"> <i class="fa fa-exclamation-triangle"></i> </div>No appointment found</div>

                  @endforelse

                    </div>

                </div>

              </div>

              <!--Feedback-->

              <div class="bhoechie-tab-content">

                 <h4>Feedback</h4>

                 <div class="row">

                     <div class="col-md-12 col-sm-12" id="load-data">

                         @forelse ($feedback as $user_feedback )

                         <div class="row">

                             <div class="col-md-2 text-center">

                                 @if( $user_feedback['photo'] )

                                 <img alt="" src="{{ asset('uploads/profile_photos/'.$user_feedback['photo'] )}}" class=" img-circle" width="70%"/>

                                 @else

                                 <h2>{{ substr(ucfirst($user_feedback['name']), 0, 1)  }}</h2>

                                 @endif

                                 <h5>{{ ucfirst( $user_feedback['name'] ) }}</h5>

                             </div>

                             <div class="col-md-10 comment-box">

                                 <p>{{ $user_feedback['feedback'] }}</p>

                                 <h6 align="right">
                                  <span class="text-info" >
                                      {!! App\Feedback::timeAgo($user_feedback['created_at'])  !!}</span></h6>

                             </div>

                         </div>

                         @empty


                         @endforelse
                         @if($feedback !=null)
                         @if(count($feedback_count)>4)
                         <div align="center" id="remove-row">
                             <button class="btn btn-primary" data-type="user_account" data-id="{{$user_feedback['fb_id']}}" id="load_more_feedback"><i class="fa fa-refresh"></i> Load more </button>
                         </div>
                         @endif
                         @else
                         <div class="alert alert-warning alert-white rounded notify">
                             <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                             <div class="icon"> <i class="fa fa-exclamation-triangle"></i> </div>No feedback found</div>

                         @endif
                     </div>


                 </div>

              </div>

          </div>

      </div>

    </div>

  </div>

@endsection

