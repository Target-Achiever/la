@extends('layouts.provider_temp')
<style>

    .btn-bs-file{

        position:relative;

    }

    .btn-bs-file input[type="file"]{

        position: absolute;

        top: -9999999;

        filter: alpha(opacity=0);

        opacity: 0;

        width:0;

        height:0;

        outline: none;

        cursor: inherit;

    }

</style>
@section('content')
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
               <!-- SELECT2 EXAMPLE -->
               <div class="box create_edit_service">
                  <div class="box-header with-border">
                    <h3  style="margin: 0 0 20px;">
                    Add image
                    <a href="{{ url('provider/gallery') }}"class="btn btn-primary pull-right"><i class="fa fa-reply"></i> Back to gallery</a>
                  </h3>
                    <div id="message"></div>
                      <div class="service-form-sec">
                          {!! Form::open([ 'url' => 'provider/gallery/store' , 'files' => true,
                             'enctype' => 'multipart/form-data', 'class' => '','id' => 'gallery_banner']) !!}
                          <div class="col-sm-12">
                              <div id="image_div"></div>
                          </div>
                             <div class="col-md-12 ">
                                 <div class="form-group {{ $errors->has('ad_banner') ? 'has-error' : '' }}">
                                     {!!Form::label('ad_banner', 'Browse image')!!}
                                     <div id="upload-demo-gallery" class="upload-demo"
                                          style="width:350px;display:none"></div>

                                     <br/>
                                     <div id="banner_image"></div>
                                     <label class="btn-bs-file btn btn-sm btn-success">
                                         <span class="gallery_btn">Browse</span>
                                         {!!Form::file('gallery',array('class' => '', 'id' => 'gallery'))!!}
                                     </label>
                                     <span class="text-danger">{{ $errors->first('ad_banner') }}</span>
                                     <button class="btn btn-success btn-sm upload-result-gallery upload-demo"  data-type="gallery" type="button"
                                             style="display: none">
                                         Upload</button>
                                 </div>


                             </div>

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
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      <!-- </div> -->
      <!-- ./wrapper -->
      @endsection
