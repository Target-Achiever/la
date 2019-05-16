@extends('layouts.provider_temp')


@section('content')


<!-- Content Wrapper. Contains page content -->


<div class="content-wrapper">


    <!-- Main content -->


    <section class="content">


        <!-- SELECT2 EXAMPLE -->


        <div class="box paymeny_history">


            <div class="box-header with-border">


                <h3 class="box-title">Appointments</h3>


                {!! displayAlert() !!}


                <div class="table_box">


                    <table id="example1" class="table table-bordered table-hover">


                        <thead>


                        <tr>


                            <th>S.no</th>


                            <th>Appointment date</th>


                            <th>Service</th>


                            <th>Brand</th>


                            <th>Patient name</th>


                            <th>Time</th>


                            <th>Appointment Status</th>


                            <th>Payment Status</th>


                            <th>Action</th>


                        </tr>


                        </thead>


                        <tbody>


                        @foreach($appointments as $key => $app)


                        <tr>


                            <td>{{++$key}}</td>


                            <td>{{$app->preferred_date}}</td>


                            <td>{{($app->service_name != '') ? $app->service_name : 'Combination deals'}}</td>


                            <td>{{$app->service}}</td>


                            <td>{{$app->user_name}}</td>


                            <td>{{$app->appointment_time_from}}</td>


                            <td><span class="label label-@if($statusArray[$app->appointment_status]=='Request')warning
                                                                @elseif($statusArray[$app->appointment_status]=='Accepted')success
                                                                @elseif($statusArray[$app->appointment_status]=='Cancelled by requester')primary
                                                                @elseif($statusArray[$app->appointment_status]=='Cancelled by Prescriber')primary
                                                                @elseif($statusArray[$app->appointment_status]=='Declined')danger
                                                                @elseif($statusArray[$app->appointment_status]=='Cancelled due to no payment within the time period')info
                                                                @endif">
                                {{$statusArray[$app->appointment_status]}}</span></td>


                            <td>{{$payment_statusArray[$app->payment_status]}}</td>


                            <td>
                                <span class=""><a href="javascript:void(0)" class="appointment_view" data-app-id="{{$app->id}}"><i
                                                class="fa fa-file"  data-app-id="{{$app->id}}"> View</i></a></span>
                               </td>


                        </tr>


                        @endforeach


                        </tbody>


                    </table>


                </div>


            </div>


        </div>


        <!-- /.box -->


    </section>


    <!-- /.content -->


</div>


<!-- /.content-wrapper -->


<!-- /.control-sidebar -->


<!-- Add the sidebar's background. This div must be placed



   immediately after the control sidebar -->


<div class="control-sidebar-bg"></div>

<script> $('.close_badge').hide();</script>

@endsection