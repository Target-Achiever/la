@extends('layouts.provider_temp')@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box paymeny_history">
            <div class="box-header with-border">
                <h3 class="box-title">Manage Advertisement</h3> {!! displayAlert() !!}
                <div class="add-service pull-right"> <a href="{{ url('provider/advertisement/create') }}" class="btn btn-primary">Add                    </a> </div>
                <br>
                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <!-- <th>Service</th> -->
                                <th>Header</th>
                                <th>Description</th>
                                <th>Ad-Banner</th>
                                <th>Time period from and to</th>
                                <th>Action</th>
                                <th>Ad payment status</th>
                            </tr>
                        </thead>
                        <tbody> @foreach ($advertisement as $key => $advertisement_list )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <!-- <td>{{ ucfirst($advertisement_list->service)}}</td> -->
                                <td>{{ ucfirst($advertisement_list->ad_header)}}</td>
                                <td>{{ ucfirst($advertisement_list->ad_description)}}</td>
                                <td><img src="{{ asset('uploads/ad_banner/'.$advertisement_list->ad_banner) }}" width="30%" class="img-square"> </td>
                                <td>{{ \Carbon\Carbon::parse($advertisement_list->period_from)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($advertisement_list->period_to)->format('d/m/Y')}} </td>
                                <td> <span class=""><a href="{{ url('provider/advertisement/edit/'.$advertisement_list->id) }}"><i                        class="fa fa-edit"> Edit</i></a></span> &nbsp;&nbsp; <span> <a                                            href="javascript:void(0)" class="destroy-element" data-service="{{$advertisement_list->id}}"><i class="fa fa-trash"> Delete</i></a> </span> {!! Form::open(['url' => 'provider/advertisement/destroy/'.$advertisement_list->id,'files' => true , 'method' => 'DELETE' ,'id' => 'delete-form-'.$advertisement_list->id]) !!} {!! Form::close() !!} </td>
                                <td>{{$statusArray[$advertisement_list->ad_payment_status]}}</td>
                            </tr> @endforeach </tbody>
                    </table>
                </div>
                <!-- table box end -->
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed   immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    <!-- </div> -->
    <!-- ./wrapper -->@endsection