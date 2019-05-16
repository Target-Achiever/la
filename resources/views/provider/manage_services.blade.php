@extends('layouts.provider_temp')@section('content')<?php //alert()->success('You have been logged out.', 'Good bye!');?>         <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">            <!-- Main content -->
    <section class="content">               <!-- SELECT2 EXAMPLE -->
        <div class="box paymeny_history">
            <div class="box-header with-border"><h3 class="box-title">Manage services</h3> {!! displayAlert() !!}
                <div class="add-service pull-right"><a href="{{ url('provider/services/create') }}"
                                                       class="btn btn-primary">Add </a> <a
                            href="{{ url('provider/services-settings') }}" class="btn btn-primary">Appointment
                        settings </a></div>
                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Service</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Service amount</th>
                            @if(Auth::user()->user_type == 'prescriber' )
                            <th>Prescription amount</th>
                            @endif
                            <th>Procedure time</th>
                            <th>Service type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> @foreach($services as $key => $service)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$service->category}}</td>
                            <td>{{$service->materialName}}</td>
                            <td> {{ $service->service_status == 1 ? 'Active' : 'In-active' }}</td>
                            <td> {{conversion_to_pound($service->service_amount)}}</td>
                            @if(Auth::user()->user_type == 'prescriber' )
                            <td> {{conversion_to_pound($service->prescription_amount)}}</td>
                            @endif
                            <td>{{$service->time_needed}}</td>
                            <td>{{$service_type[$service->service_type]}}</td>
                            <td class="">
                                <span class=""><a href="{{url('/provider/services/'.$service->provider_services_id).'/'.'edit'}}"><i
                                                class="fa fa-edit"> Edit</i></a></span> &nbsp;&nbsp; <span> <a
                                            href="javascript:void(0)" class="destroy-element" data-service="{{$service->provider_services_id}}"><i class="fa fa-trash"> Delete</i></a> </span>

                                {!! Form::open(['url' => 'provider/services/'.$service->provider_services_id,'files' =>
                                true , 'method' => 'DELETE' ,'id' => 'delete-form-'.$service->provider_services_id]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>                     <!-- table box end -->               </div>               <!-- /.box -->
    </section>            <!-- /.content -->
</div>         <!-- /.content-wrapper -->                  <!-- /.control-sidebar -->         <!-- Add the sidebar's background. This div must be placed            immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>      <!-- </div> -->      <!-- ./wrapper -->      @endsection