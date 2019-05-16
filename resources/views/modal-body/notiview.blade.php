<style>
    .img_user_icon{
        width: 150px;
        margin:0 auto;
        display: block;
        margin-bottom: 20px;
    }
</style>

<div>
    <div class="user_profile_icon text-center">
      <img
      src="{{($appointment['photo'] !='' && File::exists(public_path('uploads').'/profile_photos/'.$appointment['photo'])) ? asset('uploads').'/profile_photos/'.$appointment['photo'] : asset('uploads').'/profile_photos/default_user.png'}}"
      class="img_user_icon img-circle">
    </div>
<div class="table-responsive">    
	<table class="table table-bordered table-hover">

		<tr>

			<td><label>Name</label></td>

			<td>{!! $appointment->user_name ? $appointment->user_name :  $appointment->name !!}</td>

		</tr>

		@if($appointment->payment_status == '1')
    <tr>
      <td><label>Email</label></td>
      <td>{!! $appointment->user_email ? $appointment->user_email :  $appointment->email !!} </td>
    </tr>
    <tr>
      <td><label>Contact</label></td>
      <td>{!! $appointment->user_contact ? $appointment->user_contact :  $appointment->phone !!}</td>
    </tr>
    @endif

    @if($appointment->service_type == '1' )

		<tr>

      <td><label>Serivce requested</label></td>

      <td>{{$appointment->service_name}}</td>

    </tr>

    @endif

    <tr>

      <td><label>{{ $appointment->service_type == '3' ? 'Brand' : 'Service' }}</label></td>

      <td>{{$appointment->service}}</td>

    </tr>

    <!--  -->
    @if($appointment->service_type == '1')
    <tr>

      <td><label>Volume</label></td>

      <td>{{$appointment->quantity}}ml</td>

    </tr>
    @endif
    <tr>

      <td><label>Time required</label></td>

      <td>{{$appointment->time_needed}}hr(s)</td>

    </tr>
    <!--  -->

		<tr>

			<td><label>Preferred date</label></td>

			<td>{{$appointment->preferred_date}}</td>

		</tr>

		<tr>

			<td><label>Preferred time</label></td>

			<td>{{$appointment->appointment_time_from}}</td>

		</tr>

    <tr>

      <td><label>Appointment status</label></td>

      <td>{{$status_array[$appointment->appointment_status]}}</td>

    </tr>

		<tr>

			<td><label>Payment status</label></td>

			<td>{{($appointment->payment_status == 1) ? 'Paid' : (($appointment->payment_status == 2) ? 'Not paid' : 'Not paid')}}</td>

		</tr>

	</table>
</div>
	<div class="row">

     <div class="col-md-12">

         <div class="form-group text-right"> 

           <!-- appointment status wil update by url parameter appointment_result/appointment id/status/notification id-->            

           @if($appointment->appointment_status == 1)      

           <a href="appointment_result/{{$appointment->id}}/2" class="change_accept_status"><button class="btn btn-primary"> Accept</button></a>

           

           @else

           <!--<div class="alert alert-info">{{$status_array[$appointment->appointment_status]}}</div>-->

           @endif
          
           @if($appointment->appointment_status != '3' && $appointment->appointment_status != '4' && $appointment->appointment_status != '5')

              @if(\Carbon\Carbon::today() <= \Carbon\Carbon::parse($appointment->preferred_date))

              <a href="{{url('cancel-appointment').'/'.$appointment->payment_url}}" class="btn btn-primary app-cancel-btn">Cancel</a>

              @endif

           @endif
          
           @if($appointment->appointment_status == 2 && $appointment->paybutton == 'true')

           <!-- <button>PAY NOW</button> -->

          		 {!!Form::open(['url' => 'appointment-payment/'.$appointment->payment_url,'method' => 'post'])!!}

                        <script

                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"

                                data-key="{{env('STRIPE_KEY')}}"

                                data-amount="{{$appointment->service_amount}}"

                                data-name="Linkaesthetics"

                                data-description="Appointment payment"

                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"

                                data-locale="auto"

                                data-currency="gbp">

                        </script>

             	{!! Form::close()!!}

           @endif         
        </div>

     </div>

  </div>

</div>