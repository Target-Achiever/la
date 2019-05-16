@extends('layouts.provider_temp')@section('content')<?php $policy_arr2 = $policy_arr; ?>
<style>    .box-header {
        color: #fff;
        display: block;
        padding: 10px;
        position: relative;
        background: #10afec;
    }

    .box {
        position: relative;
        border-radius: 0px;
        background: #ffffff;
        border-top: 0;
        margin-bottom: 3px !important;
        width: 100%;
        box-shadow: none;
    }

    .box-title a {
        color: #fff;
    }

    .box.box-default {
        border-top-color: transparent;
        margin: 10px 0;
        border: 1px solid #ddd;
    }</style><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">    <!-- Main content -->
    <section class="content">        <!-- SELECT2 EXAMPLE -->
        <div class="policy">
            <div class="">
                <div class="row">
                    <div class="col-md-6 col-sm-6"><h3 class="box-title">Policy</h3></div>
                </div>
                {!! displayAlert() !!}
                <div class="policy_box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <div class="panel box box-default">
                                            <div class="box-header with-border"><h4 class="box-title"><a
                                                            data-toggle="collapse" data-parent="#accordion"
                                                            href="#Reschedule_collapse"> Reschedule Policy </a></h4>
                                                <div class="edit_policy" data-toggle="modal" data-type="reschedule"
                                                     data-target="#edit_policy"><i class="fa fa-pencil"></i></div>
                                            </div>
                                            <div class="box-group" id="accordion">
                                                <div id="Reschedule_collapse" class="panel-collapse collapse">
                                                    <div class="box-body">
                                                        @foreach($policies as $policies_cancel)
                                                        @if ($policies_cancel->policy_type == 'reschedule')
                                                        {!!
                                                        $policies_cancel->policy !!}
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-group" id="accordion">
                                            <div class="panel box box-default">
                                                <div class="box-header with-border"><h4 class="box-title"><a
                                                                data-toggle="collapse" data-parent="#accordion"
                                                                href="#Dissatisfaction_collapse"> Customer
                                                            Dissatisfaction </a></h4>
                                                    <div class="edit_policy" data-toggle="modal"
                                                         data-type="dissatisfaction" data-target="#edit_policy"><i
                                                                class="fa fa-pencil"></i></div>
                                                </div>
                                                <div id="Dissatisfaction_collapse" class="panel-collapse collapse">
                                                    <div class="box-body">
                                                        @foreach($policies as $policies_cancel)
                                                        @if ($policies_cancel->policy_type == 'dissatisfaction')
                                                        {!!
                                                        $policies_cancel->policy !!}
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-group" id="accordion">
                                            <div class="panel box box-default"><a data-toggle="collapse"
                                                                                  data-parent="#accordion"
                                                                                  href="#Cancellation_collapse">
                                                    <div class="box-header with-border"><h4 class="box-title">
                                                            Cancellation Policy </h4></div>
                                                </a>
                                                <div id="Cancellation_collapse" class="panel-collapse collapse"> {!!
                                                    Form::model($refund, ['method' => 'get','url' =>
                                                    ['provider/policies/refund/'.$refund->user_id], 'class'=>'form',])
                                                    !!}
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="sf_columns column_3">
                                                                    <div class="sf-radio"><p>Refund percentage if cancelled above 7 Days</p></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="sf_columns column_3">
                                                                    <div class="sf-radio"> {!!
                                                                        Form::select('percentage_week',
                                                                        array(''=>'Select','100'=>'Full Refund', '0' =>
                                                                        '0%','10' => '10%','20' => '20%','30' =>
                                                                        '30%','40' => '40%','50' => '50%', '60' =>
                                                                        '60%','70' => '70%','80' => '80%'), $refund ?
                                                                        $refund->percentage_week : 'null',
                                                                        array('class'=>'have_others form-control
                                                                        refunds','required' => 'required')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="sf_columns column_3">
                                                                    <div class="sf-radio"><p>Refund percentage if cancelled bellow 7 Days</p></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="sf_columns column_3">
                                                                    <div class="sf-radio"> {!!
                                                                        Form::select('percentage_days',
                                                                        array(''=>'Select','100'=>'Full Refund', '0' =>
                                                                        '0%','10' => '10%','20' => '20%', '30' =>
                                                                        '30%','40' => '40%','50' => '50%','60' =>
                                                                        '60%','70' => '70%','80' => '80%'), $refund ?
                                                                        $refund->percentage_days : 'null',
                                                                        array('class'=>'have_others form-control
                                                                        refunds','required' => 'required')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="sf_columns column_3">
                                                                    <div class="sf-radio"><p> Refund percentage if cancelled within 24hours of your appointment</p></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="sf_columns column_3">
                                                                    <div class="sf-radio"> {!!
                                                                        Form::select('percentage_appointment_day',
                                                                        array(''=>'Select','100'=>'Full Refund', '0' =>
                                                                        '0%', '10' => '10%','20' => '20%','30' => '30%',
                                                                        '40' => '40%','50' => '50%','60' => '60%','70'
                                                                        => '70%','80' => '80%'), $refund ?
                                                                        $refund->percentage_appointment_day : 'null',
                                                                        array('class'=>'have_others form-control
                                                                        refunds','required' => 'required')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="sf_columns column_3"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="sf_columns column_3">
                                                                    <div class="sf-radio"> {!!
                                                                        Form::submit('Update',array('class' => 'btn
                                                                        btn-info')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>    <!-- /.content --></div>
<div class="control-sidebar-bg"></div>@endsection