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
                            <th>Provider name</th>
                            <th>Patient name</th>
                            <th>Service </th>
                            <th>Brand </th>
                            <th>Preferred date</th>
                            <th>Appointment status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointment_history as $key => $history)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $history->provider_name }} </td>
                            <td>{{ $history->name }} </td>
                            <td>{{ $history->category != ''  ? $history->category : 'Combination deals'}} </td>
                            <td>{{ $history->service }} </td>
                            <td>{{ $history->preferred_date }} </td>
                            <td>{{ $status_array[$history->appointment_status] }} </td>
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
