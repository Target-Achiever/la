@extends('layouts.provider_temp')
<style type="text/css">
    .time {
        border: 1px solid #fff;
        padding: 5px;
        border-radius: 3px;
        margin: 10px 5px;
        cursor: pointer;
    }
    
    .time:hover {
        background-color: #10afec;
        border-color: transparent;
        color: #fff;
    }
    
    .select_time {
        padding: 0 30px;
    }
    
    .btn.active {
        box-shadow: none;
    }
    
    .select_time label {
        font-weight: normal;
    }
    
    .prescription-form {
        padding: 20px;
        background: #fff;
        width: 750px;
        margin: 0 auto;
    }
    .notification .box-header
    {
        margin-bottom:30px;
    }
</style>@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="notification">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h3 class="box-title">Prescription Request</h3> </div>
                </div>
            </div> @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul> @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> @endforeach </ul>
            </div> @endif {!! Form::open(['url' => 'provider/prescription_service/book','method' => 'post','id' => 'prescription_request_frm']) !!}
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <input type="text" name="user_name" placeholder="Name" class="form-control">
                        <input type="hidden" name="provider_id" id="provider_id" value="{{$providerData['provider_id']}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <select name="service_needed" id="service_needed" class="form-control load-time-slots"> 
                        	<option value="">Select service</option>
                        	@forelse($providerData['provider_services'] as $key => $info)
                            <optgroup label="{{$key}}"> @foreach($info as $sub)
                                <option value="{{$sub['service_id']}}">{{$sub['service']}}{{($sub['type'] == '1') ? ' ('.$sub['volume'].'ml)' : ''}} - {{conversion_to_pound($sub['pre_amount'])}} </option> @endforeach </optgroup> @empty
                            <option>no service provided</option> @endforelse </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6  col-md-offset-3 col-sm-offset-3">
                    <div class="form-group">
                        <input type="text" name="preferred_date" class="form-control load-time-slots" placeholder="Preferred Date*" id="preferred_date"> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6  col-md-offset-3 col-sm-offset-3 select_time">
                    <!-- load availabel time slots here -->
                    <div id="check-load"> </div>
                    <!-- end -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group text-center">
                        <button class="btn btn-primary"> Send</button>
                        <button class="btn btn-primary"> Cancel</button>
                    </div>
                </div>
            </div> {!! Form::close() !!} </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->@endsection

@section('inline-scripts')
    
  $(document).ready(function()
{
  $("#prescription_request_frm").validate({
        rules: {
            "user_name": {
                required: true
            },
            "service_needed": {
                required: true
            },
            "preferred_date": {
                required: true
            }
        },
        messages: {
            "user_name": {
                required: "Please enter the name"
            },
            "service_needed": {
                required: "Please select the service"
            },
            "preferred_date": {
                required: "Please select the preferred date"
            }
        },
        submitHandler: function (form) { 
            $("#prescription_request_frm").submit();
        }
    });
});

@endsection