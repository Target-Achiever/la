@extends('layouts.admin_temp')@section('content')
<style type="text/css">
    .dataTables_filter {
        display: none;
    }
</style>
<div class="content-wrapper">    <!-- Main content -->
    <section class="content">        <!-- SELECT2 EXAMPLE -->
        <div class="box paymeny_history">
            <div class="box-header with-border"><h3 class="box-title">{{ $page_type }}</h3>
                <div class="search">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text"  data-type='2' class="form-control" id="provider_search"
                                       placeholder="Search for Provider name, Status and more"></div>
                        </div>
                    </div>
                </div>
                {!! displayAlert() !!}
                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th> S.no</th>
                            <th> Forename</th>
                            <th> Country</th>
                            <th> Phone number</th>
                            <th> Medical professional</th>
                            <th> Treatments</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody> @foreach($users as $key => $user_list)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ ucfirst($user_list->name) }} {{ ucfirst($user_list->surname) }}</td>
                            <td> {{ $user_list->country ? ucfirst($user_list->country) : "-" }}</td>
                            <td>{{ $user_list->phone ? $user_list->phone : "-" }}</td>
                            <td>{{ ucfirst($user_list->prescribing_rights) }}</td>
                            <td>@php $services = \DB::table('services')->whereIn('services_id',
                                explode(',',$user_list->aesthetic_treatment) )->select('services.service')->get();
                                @endphp
                                @foreach ($services as $services_list) {!! $services_list->service.'<br>' !!}
                                @endforeach
                            </td>
                            <td>

                                <span><a href="{{url('/admin/pending_profile/'.$user_list->user_id)}}"><i
                                                class="fa fa-check"> View &nbsp;</i></a></span>
                                <span><a class="approve_provider" href="javascript:void(0)"
                                         data-service="{{$user_list->id}}"><i class="fa fa-thumbs-up"> Approve&nbsp;</i> </a></span>
                                <span><a class="reject_provider " href="javascript:void(0)"
                                         data-service="{{$user_list->id}}"><i class="fa fa-times">
                                  Reject</i></a>  </span>

                                {!! Form::open(['url' => 'admin/approve','files' => true , 'method' => 'get' ,'id' =>
                                'approve-form-'.$user_list->user_id]) !!} {{ Form::hidden('admin_status_text',null,
                                array('class' => 'admin_status_text')) }} {{ Form::hidden('user_id',$user_list->user_id,
                                array('class' => 'provider_id')) }} {!! Form::close() !!} {!! Form::open(['url' =>
                                'admin/reject','files' => true , 'method' => 'GET' ,'id' =>
                                'delete-form-'.$user_list->user_id]) !!} {{ Form::hidden('admin_status_text',null,
                                array('class' => 'admin_status_text')) }} {{ Form::hidden('user_id',$user_list->user_id,
                                array('class' => 'provider_id')) }} {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                <!-- /.box -->    </section>    <!-- /.content -->
</div><!-- Content Wrapper. Contains page content --><!-- /.content-wrapper --><!-- /.control-sidebar --><!-- Add the sidebar's background. This div must be placed   immediately after the control sidebar -->
<div class="control-sidebar-bg"></div><!-- </div> --><!-- ./wrapper -->
@endsection