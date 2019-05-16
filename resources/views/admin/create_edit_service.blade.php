@extends('layouts.admin_temp')@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box create_edit_service">
            <div class="box-header with-border">
                <h3 class="box-title">Manage services</h3> {!! displayAlert() !!}
                <div class="service-form-sec"> @if(isset($service)) {!! Form::model($service, ['id'=>'manage_service_form','method' => 'PATCH','url' => ['admin/services', $service->services_id],'files' => true]) !!} @else {!! Form::open(['id'=>'manage_service_form','url' => 'admin/services','files' => true,'method' => 'post']) !!} @endif
                    <div class="form-group {{ $errors->has('service') ? 'has-error' : '' }}"> {!!Form::label('service', 'Services')!!} {!!Form::text('service',null,['class'=>'form-control', 'placeholder'=>'service'])!!} <span class="text-danger">{{ $errors->first('service') }}</span> </div>
                    <div class="form-group {{ $errors->has('service') ? 'has-error' : '' }}"> {!!Form::label('description', 'Description')!!} {!!Form::textarea('description',null,['class'=>'form-control', 'placeholder'=>'description','id'=>'editor1','rows'=>'10','cols'=>'91'])!!} <span class="text-danger">{{ $errors->first('description') }}</span> </div>
                    <div class="form-group {{ $errors->has('service_readmore') ? 'has-error' : '' }}"> {!!Form::label('service_readmore', 'Read More Content')!!} {!!Form::textarea('service_readmore',null,['class'=>'form-control', 'placeholder'=>'description','id'=>'editor2','rows'=>'10','cols'=>'91'])!!} <span class="text-danger">{{ $errors->first('service_readmore') }}</span> </div>
                    <div class="form-group {{ $errors->has('service_status') ? 'has-error' : '' }}"> {!!Form::label('status', 'Status')!!} {!!Form::select('service_status',$status,null,['class'=>'form-control'])!!} <span class="text-danger">{{ $errors->first('service_status') }}</span> </div>
                    <div class="form-group" >
                        <div class="form-group {{ $errors->has('service_banner') ? 'has-error' : '' }}">
                            {!!Form::label('service_banner', 'Banner')!!}
                            <br>

                            <div id="upload-demo-services" class="upload-demo"
                                 style="display:none;"></div>

                            <br/>
                            @if(isset($service))
                            <div class="img-preview upload-imgs"><img
                                        src="{{ asset('uploads/service_banner/'.$service->service_banner) }}"> &nbsp;&nbsp;
                                <span class="text-danger"><a href="javascript:void(0)"
                                                             onclick="$('.btn-bs-file').show();$('.img-preview').hide()">X</a></span>
                            </div>
                            @endif

                            <div id="banner_image"></div>
                            <label class="btn-bs-file btn btn-sm btn-success" style="display:{{ isset($service) ? 'none' : ''}}">
                                Browse
                                {!!Form::file('service_banner',null,array('id' => 'service_banner'))!!}
                                {!!Form::hidden('service_banner_image',null,array('id' => 'service_banner_image'))!!}
                            </label>
                            <span class="text-danger">{{ $errors->first('service_banner') }}</span>
                        </div>


                    </div>
                    <!--<div class="form-group {{ $errors->has('service_banner') ? 'has-error' : '' }}">
                            {!!Form::label('service_banner', 'Banner')!!} @if(isset($service))
                            <div class="img-preview upload-imgs"> <img src="{{ asset('uploads/service_banner/'.$service->service_banner) }}">
                                &nbsp;&nbsp; <span class="text-danger">
                                    <a href="javascript:void(0)" onclick="$('.btn-bs-file').show();$('.img-preview').hide()">X</a></span> </div>
                            @endif
                            <img id="blah" width="30%">
                            <label class="btn-bs-file btn btn-sm btn-success" style="@if(isset($service)) {{  $service->service_banner ? 'display:none' : 'display:block' }}  @endif ">
                                Browse
                                {!!Form::file('service_banner',null)!!} </label>
                            <span class="text-danger">{{ $errors->first('service_banner') }}</span>
                        </div>-->
                    <div class="form-group">  {!!Form::button(isset($service) ? 'Update' : 'Save',array('class' => 'btn
                        btn-primary upload-result-services','data-type' => ''))!!} </div> {!! Form::close() !!} </div>
            </div>
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