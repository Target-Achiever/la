<div>
	@foreach($appointment_info as $app)
	<a href="{{url('appointment-details').'/'.$app->appid.'/'.$app->user_id}}">
		<div class="alert alert-info alert-dismissible">
			Appointment for {{$app->service}} with {{$app->name}}
		</div>
	</a>
	@endforeach
</div>