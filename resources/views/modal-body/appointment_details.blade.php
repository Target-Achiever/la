<div>
	@foreach($appointment_info as $app)
	<a href="{{url('get-appointment-details').'/'.$app->appid.'/'.$app->user_id}}"><div class="alert alert-info alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			Appointment for {{$app->service}} with {{$app->name}}
	</div></a>
	@endforeach
</div>