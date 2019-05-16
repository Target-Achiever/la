@extends('layouts.admin_temp')@section('content')
<?php   //alert()->success('You have been logged out.', 'Good bye!');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box paymeny_history">
            <div class="box-header with-border">
                <h3 class="box-title">Home screen </h3> {!! displayAlert() !!}
                <div class="service-form-sec">
                    @if(isset($screen))
                    {!! Form::model($screen, ['id' => 'manage_home_form','method' => 'post','url' => ['admin/manage_home/update', $screen->id]]) !!}

                    @else
                    {!! Form::open(['url' => 'admin/manage_home/store','files' => true,'method' => 'post','id' => 'manage_home_form']) !!}

                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                {!!Form::label('type', 'Type')!!}
                                {!!Form::select('type',array('home_banner'=> 'Home banner','home_sub_banner' => 'Home sub banner'),null,['class'=>'form-control'])!!}
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group {{ $errors->has('header_text') ? 'has-error' : '' }}">
                                {!!Form::label('header_text', 'Header text')!!}
                                {!!Form::textarea('header_text',null,['id'=>'editor1','rows'=>'10','cols'=>'91'])!!}
                                <span class="text-danger">{{ $errors->first('header_text') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group {{ $errors->has('home_banner') ? 'has-error' : '' }}">
                                {!!Form::label('home_banner', 'Banner')!!}

                                <br>

                                <div id="upload-demo-banner" class="upload-demo"
                                     style="display:none;overflow: scroll"></div>

                                <br/>
                                @if(isset($screen))
                                <div class="home_banner_image">
                                    <img src="{{ asset('uploads/home_banner/'.$screen->home_banner) }}" width="50%">
                                    <a href="javascript:void(0)"> <span class="text-danger remove_banner">X</span></a>
                                </div>
                                @endif

                                <div id="banner_image"></div>
                                <label class="btn-bs-file btn btn-sm btn-success" style="display:{{ isset($screen) ? 'none' : ''}}">
                                    Browse
                                    {!!Form::file('home_banner',null,array('id' => 'home_banner'))!!}
                                    {!!Form::hidden('home_banner_image',null,array('id' => 'home_banner_image'))!!}
                                </label>
                                <span class="text-danger">{{ $errors->first('home_banner') }}</span>                               
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!!Form::button(isset($screen) ? 'Update' : 'Save',array('data-type'=> '', 'class' => 'btn btn-primary upload-result-banner '))!!}
                            </div>
                        </div>
                    </div> {!! Form::close() !!} </div>
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed            immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- </div> -->
<!-- ./wrapper -->@endsection