@extends('../layouts.admin_temp')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box paymeny_history">
            <div class="box-header with-border">
                <h3 class="box-title">Advertisement payment</h3>


                {!! displayAlert() !!}

                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Date</th>
                            <th>Provider</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($adPayment as $key => $pay)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$pay->payment_date}}</td>
                            <td>{{$pay->name}}</td>
                            <td>{{conversion_to_pound($pay->amount)}}</td>
                            
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
