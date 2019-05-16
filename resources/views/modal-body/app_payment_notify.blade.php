<div>
	<table class="table table-bordered table-hover">
		<tr>
			<td><label>Service</label></td>
			<td>{{$payment_history->service}}</td>
		</tr>
		<tr>
			<td><label>Appointment date</label></td>
			<td>{{$payment_history->preferred_date}}</td>
		</tr>
		<tr>
			<td><label>Appointment time</label></td>
			<td>{{$payment_history->appointment_time_from}}</td>
		</tr>
		<tr>
			<td><label>Transaction id</label></td>
			<td>{{$payment_history->transaction_id}}</td>
		</tr>
		
	</table>
</div>