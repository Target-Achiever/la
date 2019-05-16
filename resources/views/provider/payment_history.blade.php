@extends('layouts.provider_temp')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

        <!-- SELECT2 EXAMPLE -->

        <div class="box paymeny_history">

            <div class="box-header with-border">

                <h3 class="box-title">Payment History</h3>





                {!! displayAlert() !!}



                <div class="table_box">

                    <table id="example1" class="table table-bordered table-hover">

                        <thead>

                        <tr>

                            <th>S.no</th>

                            <th>Paid from</th>

                            <th>Paid to</th>

                            <th>Amount</th>

                            <th>Type</th>

                            <th>Payment status</th>

                            <th>Payment date</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($payment_history as $key => $history)

                        <tr>

                            <td>{{$key+1}}</td>

                            <td>{{$history->from}}</td>

                            <td>{{($history->to != '') ? $history->to  : 'Linkaesthetics'}}</td>

                            <td>{{conversion_to_pound($history->amount)}}</td>

                            <td>{{$typeArray[$history->payment_type]}}</td>

                            <td>{{$statusArray[$history->payment_status]}}</td>

                            <td>{{$history->payment_date}}</td>

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

