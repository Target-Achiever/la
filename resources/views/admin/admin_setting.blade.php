@extends('layouts.admin_temp')
@section('content')
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
                    <div class="col-md-12 col-12 text-justify"><h3 class="box-title">Extra Setting</h3></div>
                </div>
                {!! displayAlert() !!}
                <div id="alert"></div>
                <div class="policy_box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseOne">
                                                <div class="box-header with-border"><h4 class="box-title"> Page
                                                        Enable and disable  </h4>                                                <span
                                                            class="caret" style="float: right;margin-top: 10px"></span>
                                                </div>
                                            </a>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="box-body">

                                                    <div class="checkbox">
                                                        <label> Home page</label>
                                                        <label>

                                                            <input data-toggle="toggle" data-on="Enabled"
                                                                   data-off="Disabled"
                                                                   type="checkbox" name="home_page" id="home_page" class="home_page"
                                                                   {{ $setting !="" ? $setting->home_page == 'true' ? 'checked' : '' : 'checked' }} >

                                                        </label>
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
<script>

</script>
@endsection