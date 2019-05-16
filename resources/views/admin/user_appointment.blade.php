@extends('../layouts.admin_temp')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box paymeny_history">
            <div class="box-header with-border">
                <h3 class="box-title">User Appointment</h3>


                {!! displayAlert() !!}

                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th> User name </th>
                            <th> Contact </th>
                            <th>Email </th>
                            <th>Preferred date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userAppointment as $key => $notification_list)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ ucfirst($notification_list->user_name) }} </td>
                            <td>
                                {{ $notification_list->user_contact ? $notification_list->user_contact : "-"  }}
                            </td>
                            <td>{{ $notification_list->user_email ? $notification_list->user_email : "-" }}</td>
                            <td>{{ ucfirst($notification_list->preferred_date) }}</td>


                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>

@endsection
