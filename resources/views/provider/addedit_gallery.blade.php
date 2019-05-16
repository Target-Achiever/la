@extends('layouts.provider_temp')
<style>    .btn-bs-file {
        position: relative;
    }

    .btn-bs-file input[type="file"] {
        position: absolute;
        top: -9999999;
        filter: alpha(opacity=0);
        opacity: 0;
        width: 0;
        height: 0;
        outline: none;
        cursor: inherit;
    }</style>@section('content')
<div class="content-wrapper">    <!-- Main content -->
    <section class="content">        <!-- SELECT2 EXAMPLE -->
        <div class="box create_edit_service">
            <div class="box-header with-border"><h3 style="margin: 0 0 20px;">Update image</h3>
                <div class="service-form-sec"> {!! Form::model($gallery_files, ['id' => 'gallery_banner', 'method' =>
                    'PATCH','files'=> true,'url' => ['/provider/gallery', $gallery_files->id]]) !!}
                    <div class="col-sm-12"></div>
                    <div class="col-md-12 ">
                        <div class="form-group {{ $errors->has('gallery') ? 'has-error' : '' }}">
                            {!!Form::label('gallery', 'Browse image')!!}
                            <div id="image_div">
                                @if(isset($gallery_files))
                                    <div class="gallery_image"><img
                                                src="{{ asset('uploads/gallery/'.$gallery_files->file_name) }}" width="30%">
                                        <button data-toggle="tooltip" title="Remove" type="button" class="close"
                                                style="float: none; !important;font-size: 31px" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                    </div>
                                @endif
                            </div>
                            <div id="upload-demo-gallery" class="upload-demo" style="width:350px;display:none"></div>
                            <br/>
                            <div id="banner_image"></div>
                            <label class="btn-bs-file btn btn-sm btn-success"> Browse
                                {!!Form::file('gallery',array('class' => '', 'id' => 'gallery'))!!} </label> <span
                                    class="text-danger">{{ $errors->first('gallery') }}</span>
                            <button class="btn btn-success btn-sm upload-result-gallery-edit upload-demo"
                                    data-gallery_id="{{$gallery_files->id}}" data-type="gallery" type="button"
                                    style="display: none"> Upload
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>        <!-- /.box -->    </section>    <!-- /.content -->
</div><!-- Content Wrapper. Contains page content --><!--<div class="content-wrapper">   <section class="content">      <div class="box">         <div class="box-header with-border">            <h3 class="box-title">Manage gallery</h3>             {!! displayAlert() !!}             <div class="gallery-management-sec">               <div class="img-preview">                 <img src="{{url('/uploads').'/'.'gallery/'.$gallery_files->file_name}}" width="100" height="100">               </div>               <div class="service-form-sec">                 <div class="input-file-container">               <label tabindex="0" for="my-file" class="input-file-trigger">Select file</label>               @if(isset($gallery_files))               {!! Form::model($gallery_files, ['method' => 'PATCH','files'=> true,'url' => ['/provider/gallery', $gallery_files->id]]) !!}               @endif                     <div class="col-md-12 ">                         <div class="form-group {{ $errors->has('gallery') ? 'has-error' : '' }}">                             {!!Form::label('gallery', 'Browse image')!!}                             <div id="upload-demo-gallery" class="upload-demo"                                  style="width:350px;display:none"></div>                             <br/>                             <div id="banner_image"></div>                             <label class="btn-bs-file btn btn-sm btn-success">                                 Browse                                 {!!Form::file('gallery',array('class' => '', 'id' => 'gallery'))!!}                             </label>                             <span class="text-danger">{{ $errors->first('gallery') }}</span>                             <button class="btn btn-success btn-sm upload-result-gallery upload-demo"  data-type="gallery" type="button"                                     style="display: none">                                 Upload</button>                         </div>                     </div>              <div class="form-group {{ $errors->has('gallery') ? 'has-error' : '' }}">                     {!!Form::file('gallery',['id'=>'files','class'=>'input-file'])!!}               </div>               <div class="form-group">                   {!!Form::submit('Save',array('class' => 'btn btn-primary'))!!}               </div>                   {!! Form::close() !!}              </div>           </div>         </div>     </div>   </section></div>-->
<div class="control-sidebar-bg"></div><!-- </div> --><!-- ./wrapper -->@endsection