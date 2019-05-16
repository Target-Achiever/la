@extends('layouts.admin_temp')@section('content')
<div class="content-wrapper">    <!-- Main content -->
    <section class="content">
        <div class="box paymeny_history">
            <div class="box-header with-border"><h3 class="box-title">Manage User</h3>
                <div class="box-body">
                    <div class="manage_user_view"> @foreach ($users as $user_list)
                        <div class="row">
                            <div class="col-md-4 col-sm-4  text-center user-pro">
                                <div class="form-group"><img
                                            src="{{ $user_list->photo ? asset('uploads/profile_photos/'.$user_list->photo) :                                     asset('images/user_profile.png') }}"
                                            class="img-circle img-responsive"></img></div>
                            </div>
                            <div class="col-md-3 col-sm-3 user-pro">
                                <div class="col-md-12 col-sm-12"><label>Name</label></div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group"> {{ ucfirst($user_list->name) }}</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 user-pro">
                                <div class="col-md-12 col-sm-12"><label>Email</label></div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group"> {{ $user_list->email }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <h3 class="box-title">Appointments</h3>
                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th> Date</th>
                            <th>Treatment</th>
                            <th>Prescribers</th>
                            <th>Amount Paid</th>
                        </tr>
                        </thead>
                        <tbody> @foreach($appointment as $key => $appointment_list)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ date('d M y',strtotime($appointment_list->preferred_date)) }}</td>
                            <td> {{ ucfirst($appointment_list->service) }}</td>
                            <td>{{ ucfirst($appointment_list->provider) }}</td>
                            <td>-</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <h4>Total Amount Paid: {{ $paid != '' ? conversion_to_pound($paid) : \Config::get('constants.currency').'0'}}</h4></div>
            </div>
        </div>        <!-- /.box -->    </section>    <!-- /.content -->
</div><!-- Content Wrapper. Contains page content --><!-- /.content-wrapper --><!-- /.control-sidebar --><!-- Add the sidebar's background. This div must be placed   immediately after the control sidebar -->
<div class="control-sidebar-bg"></div><!-- </div> --><!-- ./wrapper -->@endsection