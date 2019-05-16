@extends('layouts.provider_temp')

@section('content')

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

        <!-- SELECT2 EXAMPLE -->

        <div class="notification">

            <div class="box-header with-border">

                <div class="row">

                    <div class="col-md-9 col-sm-9">

                        <h3 class="box-title">Prescription Services</h3>

                    </div>


                    <div class="col-md-3 col-sm-3 ">

                        <div class="checkbox pull-right">
                            <label>
                                <input data-toggle="toggle" data-on="On"
                                       data-off="Off"
                                       data-size="small"
                                       type="checkbox" id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round-flat set-service-availability"
                                       data-provider="{{Auth::user()->id}}"
                                       {{(isset($servicesSettings->prescription_enable) && $servicesSettings->prescription_enable == 1) ? 'checked' : ''}}
                                >
                            </label>
                        </div>

                    </div>


                </div>

              <div class="set-updated"></div>


                {!! displayAlert() !!}


                <div class="search">

                    <div class="row">

                        <div class="col-md-6 col-md-offset-3">

                            <!-- <div class="input-group">

                               <span class="input-group-addon"><i cla  ss="fa fa-search"></i></span>

                               <input type="text" class="form-control" placeholder="Search for Treatment type,name">

                            </div> -->

                        </div>

                    </div>

                </div>

                <div class="perscription_box">

                    <div class="col-md-12">

                        <!-- Custom Tabs -->

                        <div class="nav-tabs-custom">

                            <ul class="nav nav-tabs">

                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">History</a>
                                </li>

                                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Requests</a></li>

                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane active" id="tab_1">

                                    <div class="table_box">

                                        <table id="example1" class="table table-bordered table-hover">

                                            <thead>

                                            <tr>

                                                <th>S.no</th>

                                                <th>User</th>

                                                <th>Appointment date</th>

                                                <th>Time</th>

                                                <th>Service</th>

                                                <th>Brand</th>

                                                <th>Appointment Status</th>

                                                <th>Payment Status</th>

                                                <th>Action</th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            @foreach($apphistory as $key => $history)

                                            <tr class="{{($history->appointment_status == 1) ? 'app-upcoming' :  ''}} app-details"
                                                data-app="{{$history->id}}">

                                                <td>{!! $key + 1 !!}</td>

                                                <td>{{$history->name}}</td>

                                                <td>{{$history->preferred_date}}</td>

                                                <td>{{$history->appointment_time_from}}</td>

                                                <td>{{($history->categoryname != '' ? $history->categoryname :
                                                    'Combination deals')}}
                                                </td>

                                                <td>{{$history->service}}</td>

                                                <td><span class="label label-@if($status_array[$history->appointment_status]=='Request')warning
                                                                @elseif($status_array[$history->appointment_status]=='Accepted')success
                                                                @elseif($status_array[$history->appointment_status]=='Cancelled by requester')primary
                                                                @elseif($status_array[$history->appointment_status]=='Cancelled by Prescriber')primary
                                                                @elseif($status_array[$history->appointment_status]=='Declined')danger
                                                                @elseif($status_array[$history->appointment_status]=='Auto cancel due to no payment')info
                                                                @endif">{{ $status_array[$history->appointment_status]}}</span> </td>

                                                <td>{{$history->payment_status == '1' ? 'Paid' : 'Not paid'}}</td>

                                                <td>
                                                    @if($history->cancel_button)
                                                    <span class=""><a href="{{url('cancel-appointment').'/'.$history->cancel_url}}" class="change_accept_status"><i
                                                                    class="fa fa-times"> Cancel</i></a></span>


                                                    @endif
                                                </td>



                                            </tr>

                                            @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                 <!-- /.tab-pane -->

                                <div class="tab-pane" id="tab_2">

                                    <div class="row">

                                        @foreach($prescription_request as $request)

                                        <a href="javascript:void(0)">
                                            <div class="col-md-6">

                                                <div class="info-box" data-toggle="modal" data-target="#modal-default">


                                                    <div class="info-box-content">
                                                        <div class="row">
                                                            <div class="col-md-5 col-sm-5">
                                                                 <span class="info-box-text info_head">{{'Name'}}</span>
                                                            </div>
                                                            <div class="col-md-1 col-sm-1">: </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <span class="info-box-text info_head">{{$request->name}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5 col-sm-5">
                                                                <span class="info-box-text info_head">{{'Service '}}</span>
                                                            </div>
                                                            <div class="col-md-1 col-sm-1">: </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <span class="info-box-text info_head">{{($request->service_type == '2') ? 'Deals' : $request->categoryname}}</span>
                                                            </div>
                                                        </div>
                                                       <div class="row">
                                                            <div class="col-md-5 col-sm-5">
                                                                 <span class="info-box-text info_head">{{($request->service_type == '3') ? 'Brand ' : 'Deals & combinations'}}</span>
                                                            </div>
                                                            <div class="col-md-1 col-sm-1">: </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                 <span class="info-box-text info_head">{{($request->service_type == '3') ? $request->service : $request->service}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5 col-sm-5">
                                                                 <span class="info-box-text info_head">Preferred date</span>
                                                            </div>
                                                            <div class="col-md-1 col-sm-1">: </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                 <span class="info-box-text info_head">{{$request->preferred_date}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5 col-sm-5">
                                                                  <span class="info-box-text info_head">{{'Time'}}</span>
                                                            </div>
                                                            <div class="col-md-1 col-sm-1">: </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                  <span class="info-box-text info_head">{{$request->appointment_time_from}}</span>
                                                            </div>
                                                        </div>                                               
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-8 col-md-offset-2">

                                                            <div class="form-group text-center">

                                                                <!-- appointment status wil update by url parameter appointment_result/appointment id/status/notification id-->

                                                                <a href="{{url('provider/appointment_result').'/'.$request->id.'/2'}}"
                                                                   class="change_noty_status change_accept_status">
                                                                    <button class="btn btn-primary"> Accept</button>
                                                                </a>

                                                                @if($request->cancel_button)

                                                                <a href="{{url('cancel-appointment').'/'.$request-> cancel_url}}"
                                                                   class="change_accept_status btn btn-primary"> Cancel</a>
                                                                @endif

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <!-- /.info-box-content -->

                                                </div>

                                            </div>
                                        </a>

                                        @endforeach


                                    </div>

                                </div>

                                <!-- /.tab-pane -->

                            </div>

                            <!-- /.tab-content -->

                        </div>

                        <!-- nav-tabs-custom -->

                    </div>

                </div>

            </div>

        </div>

        <!-- /.box -->

    </section>

    <!-- /.content -->

</div>

<!-- /.content-wrapper -->

@endsection