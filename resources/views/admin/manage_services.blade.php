@extends('layouts.admin_temp')
@section('content')

<div class="content-wrapper">                      <!-- Main content -->
    <section class="content">                             <!-- SELECT2 EXAMPLE -->
        <div class="box paymeny_history">
            <div class="box-header with-border">
                <h3 class="box-title">Manage services</h3>
                {!! displayAlert() !!}
                <div class="add-service pull-right">
                    <a href="{{ url('admin/services/create') }}" class="btn btn-primary">Add </a></div>
                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Service</th>
                            <th>Banner</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $key => $service)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{ ucfirst($service->service) }}</td>
                            <td><img src="{{ asset('uploads/service_banner/'.$service->service_banner) }}" class="img-square" width="30%"></td>
                            <td>{!!  str_limit($service->description,250 ) !!}</td>
                            <td class="">
                                <span><a href="{{url('/admin/services/'.$service->services_id).'/'.'edit'}}"><i class="fa fa-edit"> Edit</i>
                                    </a></span> &nbsp;
                                <span> <a href="javascript:void(0)" data-service=""><i class="fa fa-trash destroy-element" data-service="{{$service->services_id}}">  Delete</i></a></span>
                                {!! Form::open(['url' => 'admin/services/'.$service->services_id,'files' => true ,'method' => 'DELETE' ,'id' => 'delete-form-'.$service->services_id]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>                     <!-- table box end -->               </div>               <!-- /.box -->
    </section>            <!-- /.content -->
</div>         <!-- /.content-wrapper -->                           <!-- /.control-sidebar -->         <!-- Add the sidebar's background. This div must be placed            immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>      <!-- </div> -->      <!-- ./wrapper -->      @endsection