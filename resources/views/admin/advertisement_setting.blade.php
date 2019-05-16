@extends('layouts.admin_temp')@section('content')
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

    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }</style><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">    <!-- Main content -->
    <section class="content">        <!-- SELECT2 EXAMPLE -->
        <div class="policy">
            <div class="">
                <div class="row">
                    <div class="col-md-12 col-12 text-justify"><h3 class="box-title">Advertisement Setting</h3></div>
                </div>
                {!! displayAlert() !!}

                <div class="policy_box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseOne">
                                                <div class="box-header with-border"><h4 class="box-title"> Advertisement
                                                        Type </h4>                                                <span
                                                            class="caret" style="float: right;margin-top: 10px"></span>
                                                </div>
                                            </a>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="box-body">
                                                    <div id="alert"></div>
                                                    <label>Days</label> <label class="switch"> <input  type="checkbox"
                                                                                                      name="ad_days" {{
                                                                                                      $ad_type ?
                                                                                                      $ad_type->ad_days=='1'
                                                        ? "checked" : "" : "" }} id="ad_days" class="ad_days"> <span
                                                                class="slider round"></span> </label>
                                                    <label>Weeks</label> <label class="switch"> <input type="checkbox"
                                                                                                       name="ad_weeks"
                                                                                                       {{ $ad_type ?
                                                                                                       $ad_type->ad_weeks=='1'
                                                        ? "checked" : "" : "" }} id="ad_weeks" class="ad_weeks"> <span
                                                                class="slider round"></span> </label></div>
                                            </div>
                                        </div>
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseTwo">
                                                <div class="box-header with-border"><h4 class="box-title"> Advertisement
                                                        Amount </h4>
                                                    <span class="caret" style="float: right;margin-top: 10px"></span>
                                                </div>
                                            </a>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="box-body"><a class="btn btn-primary ad_setting" href="#"
                                                                         data-toggle="modal"
                                                                         data-target="#myModal">Add</a> <br> <br>
                                                    <div class="table_box" id="datatable">
                                                        <table id="example1" class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th> S.no</th>
                                                                <th> Advertisement amount</th>
                                                                <th> Type</th>
                                                                <th> Updated at</th>
                                                                <th> Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody> @foreach ($amount as $key => $amount_list )
                                                            <tr>
                                                                <td>{{ $key +1 }}</td>
                                                                <td>{{
                                                                    conversion_to_pound($amount_list->ad_amount) }}
                                                                </td>
                                                                <td>{{ $amount_list->ad_type == 2 ? 'Days' : 'Weeks'
                                                                    }}
                                                                </td>
                                                                <td>{{ $amount_list->updated_at }}</td>
                                                                <td><span class=""><a href="javascript:void(0)"
                                                                                      data-toggle="modal"
                                                                                      data-target="#myModal"
                                                                                      class="edit_ad_amount"
                                                                                      data-id="{{  $amount_list->id }}"><i
                                                                                    class="fa fa-edit"> Edit</i></a></span>
                                                                    <span
                                                                            class="destroy-element" data-service="{{$amount_list->id}}"> <a
                                                                                href="javascript:void(0)" class="destroy-element"><i class="fa fa-trash"> Delete</i></a> </span>

                                                                    {!! Form::open(['url' => 'admin/advertisements_amount/destroy/'.$amount_list->id,'files' => true ,  'method' => 'get' ,'id' => 'delete-form-'.$amount_list->id]) !!}

                                                                    {!! Form::close() !!}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
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
            </div>
        </div>
    </section>    <!-- /.content --></div>
<div class="control-sidebar-bg"></div>
<script type="text/javascript">    function toggleIcon(e) {
        $(e.target).prev('.panel-heading').find(".more-less").toggleClass('glyphicon-plus glyphicon-minus');
    }

    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);</script>@endsection