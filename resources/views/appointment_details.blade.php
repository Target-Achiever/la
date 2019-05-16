@extends('layouts.frontend_temp')

@section('content')
        <div class="container appointment">            
            <section class="appointment_cols">
                <div class="appointment_title text-center">
                    <h3>Appointment details</h3>
                    <div class="appointment_divide"></div>
                </div>
                <div class="row appointment_list">
                    <div class="appointment_col">                       
                        <div class="col-sm-12 col-md-12 appointment_info">
                            <h4>{{date("F j", strtotime($app->preferred_date))}}</h4>
                            <div class="appointment_divide1"></div>
                            <p>
                            @if($app->appointment_status == 1)
                                    <?php echo $message = 'Appointment request with '.$app->name.' for '.$app->service.' treatment has been sent.';?>
                                    <span class="preferred_time">Time:{{$app->appointment_time_from}}</span>
                                    <!-- <a href="{{url('/cancell_appointment').'/'.$app->id.'/4'}}" class="change_noty_status"><button class="btn btn-primary"> Decline</button></a> -->
                            @elseif($app->appointment_status == 2)

                                    <?php echo $message = 'Appointment with '.$app->name.' for '.$app->service.' treatment has been scheduled.';?>
                                    <span class="preferred_time">Time:{{$app->appointment_time_from}}</span>
                            @elseif($app->appointment_status == 3)

                                <?php echo $message = 'Appointment with '.$app->name.' for '.$app->service.' treatment has been declined.';?>
                                <span class="preferred_time">Time:'.$app->appointment_time_from.'</span>
                            @else
                                    <span>Something went wrong, please try again</span>
                            @endif
                           
                            </p>    
                        </div>
                    </div>
                </div>                              
                <hr>                             
            </section>
        </div>       
@endsection