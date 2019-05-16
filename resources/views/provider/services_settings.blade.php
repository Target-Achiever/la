@extends('layouts.provider_temp')@section('content')
<style>    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }</style>
<style>    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .container_new {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 20px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .container_new input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
        background-color: #ccc;
    }

    .container_new:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    .container_new input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
        display: block;
    }

    .container_new input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .container_new .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box create_edit_service">
            <div class="box-header with-border">
                <h3 class="box-title">Appointment Settings</h3> {!! displayAlert() !!} @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul> @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- instant appointment -->                {!! Form::open(['url' =>
                'provider/instant-appointment','method' => 'post' ,'id' => 'instant_appointment_frm']) !!}
                <div class="checkbox ">
                    <label for="">Instant appointment</label>
                    <label>
                        <input data-toggle="toggle" data-on="Yes" data-off="No" data-size="mini" type="checkbox"
                               name="instant_appointment" id="instant_appointment_check" class="instant_appointment"
                               {{(isset($ServicesSettings->instant_appointment) &&
                        $ServicesSettings->instant_appointment == 1) ? 'checked' :''}} >
                    </label>
                </div>
                {!! Form::close() !!}
                <!-- instant appointment end -->
                <div class="service-form-sec"> @if(isset($ServicesSettings)) {!! Form::model($ServicesSettings,
                    ['method' => 'POST','url' => ['provider/save_services_settings'],'id' => 'save_settings_frm']) !!}
                    @else {!! Form::open(['url' => 'provider/save_services_settings','files' => true,'method' =>
                    'post','id' => 'save_settings_frm']) !!} @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                {!!Form::label('service_from', 'Service from')!!}
                                {!!Form::text('time_from',null,['class'=>'form-control
                                services_avail','id'=>'service_from','readonly'])!!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                {!!Form::label('service_to', 'Service to')!!}
                                {!!Form::text('time_to',null,['class'=>'form-control
                                services_avail','id'=>'service_to','readonly'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group"> {!!Form::label('', 'Available days')!!}&nbsp;&nbsp;
                        <label class="container_new"> {{ Form::checkbox('available_days',
                            'full-day',false,['class'=>'field','id' => 'checkAll']) }} {!!Form::label('checkAll','Full
                            week') !!}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="container"> {{ Form::checkbox('available_days[]', '1',(in_array('1',$days)) ? true
                            : false, ['class' => 'field','id' => 'Monday' ]) }} {!!Form::label('Monday','Monday') !!}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="container"> {!! Form::checkbox('available_days[]', '2', (in_array('2',$days)) ?
                            true : false,['class'=>'field','id' => 'Tuesday']) !!} {!!Form::label('Tuesday','Tuesday')
                            !!}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="container"> {!! Form::checkbox('available_days[]', '3',(in_array('3',$days)) ?
                            true : false,['class'=>'field','id' => 'Wednesday']) !!}
                            {!!Form::label('Wednesday','Wednesday') !!}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="container"> {!! Form::checkbox('available_days[]', '4',(in_array('4',$days)) ?
                            true : false,['class'=>'field','id' => 'Thursday']) !!}
                            {!!Form::label('Thursday','Thursday') !!}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="container"> {!! Form::checkbox('available_days[]', '5',(in_array('5',$days)) ?
                            true : false,['class'=>'field','id' => 'Friday']) !!} {!!Form::label('Friday','Friday') !!}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="container"> {!! Form::checkbox('available_days[]', '6',(in_array('6',$days)) ?
                            true : false,['class'=>'field','id' => 'Saturday']) !!}
                            <span class="checkmark"></span> {!!Form::label('Saturday','Saturday') !!}
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="container"> {!! Form::checkbox('available_days[]', '7', (in_array('7',$days)) ?
                            true : false,['class'=>'field','id' => 'Sunday']) !!} {!!Form::label('Sunday','Sunday') !!}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <hr>
                    <!-- service location preference -->
                    <div class="form-group">
                        <label>{!!Form::label('Location preference')!!}</label>
                        {!!Form::select('service_location_preference',$locationPreference,null,['class'=>'form-control'])!!}
                    </div>
                    <!-- service location preference end -->
                    <div class="form-group"> {!!Form::submit('Save',array('class' => 'btn btn-primary'))!!}</div>
                    {!! Form::close() !!}
                </div>
            </div>
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