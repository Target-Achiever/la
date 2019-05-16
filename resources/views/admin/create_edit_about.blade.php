@extends('layouts.admin_temp')@section('content')

<?php   //alert()->success('You have been logged out.', 'Good bye!');?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

        <!-- SELECT2 EXAMPLE -->

        <div class="box paymeny_history">

            <div class="box-header with-border">

                <h3 class="box-title">About us</h3> {!! displayAlert() !!}

                <div class="service-form-sec"> @if(isset($about))
                    {!! Form::model($about, ['method' => 'PATCH','url' => ['admin/about/update', $about->id,],'files' => true]) !!}
                    @else {!! Form::open(['url' => 'admin/about/store','files' => true,'method' => 'post']) !!} @endif

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group  {{ $errors->has('service_amount') ? 'has-error' : '' }}">
                                {!!Form::label('about_header', 'Header')!!}
                                {!!Form::text('about_header',null,['class'=>'form-control', 'placeholder'=>'Header',isset($about)? 'readonly' :'' ])!!}
                                <span class="text-danger">{{ $errors->first('about_header') }}</span> </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group {{ $errors->has('about_content') ? 'has-error' : '' }}">
                                {!!Form::label('about_content', 'About content')!!}
                                {!!Form::textarea('about_content',null,['id'=>'editor1','rows'=>'10','cols'=>'91','placeholder'=>'Content'])!!}
                                <span class="text-danger">{{ $errors->first('about_content') }}</span>
                            </div>

                        </div>

                    </div>

                    <div class="form-group {{ $errors->has('about_readmore') ? 'has-error' : '' }}">

                        {!!Form::label('about_readmore', 'Read More Content')!!}
                        {!!Form::textarea('about_readmore',null,['class'=>'form-control', 'placeholder'=>'Read more content','id'=>'editor2','rows'=>'10','cols'=>'91'])!!} <span class="text-danger">{{ $errors->first('about_readmore') }}</span> </div>

                    <div class="form-group {{ $errors->has('about_banner') ? 'has-error' : '' }}">
                        {!!Form::label('about_banner', 'Banner')!!}
                        @if(isset($about))

                        <div class="img-preview">
                            <img class="img-square " width="20%" style="@if(isset($service)) {{ $service->service_banner ? 'display:none' : 'display:block' }}  @endif  " src="{{asset('uploads/about_banner/'.$about->about_banner)}}">
                            &nbsp;&nbsp; <span class="text-danger">
                                <a href="javascript:void(0)" onclick="$('.btn-bs-file').show();$('.img-preview').hide()">X</a></span>
                         </div> @endif

                        <img id="blah" width="30%"/>
                        <label class="btn-bs-file btn btn-sm btn-success" > Browse
                            {!!Form::file('about_banner',null,"",['id' => 'about_banner'])!!} </label> <span class="text-danger">{{ $errors->first('about_banner') }}</span> </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group"> {!!Form::submit(isset($about) ? 'Update' : 'Save',array('class' => 'btn btn-primary'))!!} </div>

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