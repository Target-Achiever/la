@extends('layouts.provider_temp')@section('content')
<style type="text/css">    .Stepwizard-Form {
        margin-top: 30px;
        width: 900px;
    }

    .stepwizard-step p {
        margin-top: 0px;
        color: #666;
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }

    .stepwizard-step button[disabled] { /*opacity: 1 !important;        filter: alpha(opacity=100) !important;*/
    }

    .stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
        opacity: 1 !important;
        color: #bbb;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-index: 0;
    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }

    .has-error .form-control {
        border-color: #a94442 !important;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075) !important;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075) !important;
    }

    .has-error .sf-radio label input[type=radio] + span {
        border-color: #a94442 !important;
    }

    .has-error .sf-check label input[type=checkbox]:active + span {
        border-color: #a94442 !important;
    }

    .btn-default {
        color: #fff;
        background-color: #337ab7;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        background-color: #10afec;
        font-weight: normal;
    }

    #photo, #other_certificate, #identity, #address_proof, #medical_qualification, #rights_prescribe, #aesthetic_training_certificate, #insurance_certificate {
        display: none;
    }

    .custom-upload .file-name {
        color: #333;
        font-size: 12px;
    }

    .custom-upload span {
        color: #333;
    }

    .twitter-typeahead {
        display: initial !important;
    }

    .bootstrap-tagsinput {
        display: block !important;
    }

    .bootstrap-tagsinput .tag {
        background: #09F;
        padding: 5px;
        border-radius: 4px;
    }

    .tt-hint {
        top: 2px !important;
    }

    .tt-input {
        vertical-align: baseline !important;
    }

    .typeahead {
        border: 1px solid #CCCCCC;
        border-radius: 4px;
        padding: 8px 12px;
        width: 300px;
        font-size: 1.5em;
    }

    .tt-menu {
        width: 300px;
    }

    span.twitter-typeahead .tt-suggestion {
        padding: 10px 20px;
        border-bottom: #CCC 1px solid;
        cursor: pointer;
    }

    span.twitter-typeahead .tt-suggestion:last-child {
        border-bottom: 0px;
    }

    .demo-label {
        font-size: 1.5em;
        color: #686868;
        font-weight: 500;
    }
    .bgcolor input {
        border: 0 !important;
    }
    .gallery .thumbnail a>img, .thumbnail>img
    {
        height: 150px;
    }
</style>
<div class="content-wrapper Stepwizard-Form"> {!! displayAlert() !!}
    <div id="message"></div>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home"><h4 class="box-title">Update profile</h4></a></li>
        <li><a data-toggle="tab" href="#menu3"><h4 class="box-title">Documents</h4></a></li>
    </ul>
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active"> @if(isset($user_detail)) {!! Form::model($user_detail, ['method'
            => 'post','url' => ['provider/become_a_provider_backend_save'], 'class'=>'form stepsForm',
            'id'=>'save_become_a_provider', 'enctype'=>'multipart/form-data']) !!} @else {!!
            Form::open(['method'=>'post','files' => true, 'url'=>'provider/become_a_provider_backend_save',
            'class'=>'form', 'id'=>'save_become_a_provider', 'enctype'=>'multipart/form-data']) !!} @endif
            <div class="panel-body">
                <div class="form-group custom-upload" align="center"> @if($user_detail and $user_detail->photo) <img
                            width="20%" class="img-circle" id="blah"
                            src="{{ URL::asset('uploads/profile_photos/'.$user_detail->photo) }}"> @endif <br>
                    <div id="upload-demo" class="upload-demo"
                         style="width:350px;display: {{ $user_detail && $user_detail->photo ? 'none': 'block' }}"></div>
                    <br/> <label for="photo" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Browse image
                    </label> <label id="photo-name" class="file-name"></label> {!! Form::file('photo', array('id' =>
                    'photo')) !!}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('name',ucfirst(Auth::user()->name),
                            array('placeholder'=>'Forenames','id'=>'forename','class'=>'form-control', 'required' =>
                            'required' ))!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('surname',null,
                            array('placeholder'=>'Surnames','id'=>'surname','class'=>'form-control', 'required' =>
                            'required',)) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('address_line_2',null, array('placeholder'=>'Search
                            Address','id'=>'address','class'=>'form-control', 'required' => 'required', ))!!} {!!
                            Form::hidden('latitude',null,array('id'=>'latitude'))!!} {!!
                            Form::hidden('longitude',null,array('id'=>'longitude'))!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('city',null,
                            array('placeholder'=>'City','id'=>'city','class'=>'form-control', 'required' => 'required',
                            ))!!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('state',null,
                            array('placeholder'=>'State','id'=>'state','class'=>'form-control', 'required' =>
                            'required', ))!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('country',null,
                            array('placeholder'=>'Country','id'=>'country','class'=>'form-control', 'required' =>
                            'required', ))!!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('post_code',null, array('placeholder'=>'Post
                            code','id'=>'post_code','class'=>'form-control', 'required' => 'required', ))!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('phone',null,
                            array('placeholder'=>'Phone','id'=>'phone','class'=>'form-control', 'required' =>
                            'required', ))!!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('business',null,
                            array('placeholder'=>'Business','id'=>'business','class'=>'form-control', 'required' =>
                            'required', ))!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> {!! Form::text('business_address',null, array('id' =>
                            'business_address','placeholder'=>'Business Address','class'=>'form-control', 'required' =>
                            'required', ))!!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"><input type="password" name="old_password" placeholder="Old Password"
                                                       class="form-control"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}"><input type="password" name="new_password" placeholder="New Password"
                                                                                                             class="form-control">
                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                            <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        </div>
                    </div>
                </div>
                <div align="center"> {!! Form::button('Update',array('class' => 'btn btn-primary upload-result', 'id' =>
                    'provider_update' ,'data-type' => '')) !!} {!! Form::button('Cancel',array('class' => 'btn
                    btn-primary cancel_profile')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div id="menu3" class="tab-pane fade">
            <div class="row">
                <div class='list-group gallery'>
                    <div class='col-sm-4 col-xs-6 col-md-4 col-lg-4'><a class="thumbnail fancybox" rel="ligthbox"
                                                                        href="                        {{ $user_detail->identity ? asset('uploads/providers/'.$user_detail->identity) : asset('images/photo_not.png') }}">
                            <img class="img-responsive" alt=""
                                 src="{{ $user_detail->identity ? asset('uploads/providers/'.$user_detail->identity) : asset('images/photo_not.png') }}"/>
                            <div class='text-center'>
                                <small class='text-muted'>Identity</small>
                            </div> <!-- text-right / end -->                        </a></div> <!-- col-6 / end -->
                    <div class='col-sm-4 col-xs-6 col-md-4 col-lg-4'><a class="thumbnail fancybox" rel="ligthbox"
                                                                        href="{{ $user_detail->address_proof ? asset('uploads/providers/'.$user_detail->address_proof) : asset('images/photo_not.png') }}">
                            <img class="img-responsive" alt=""
                                 src="{{ $user_detail->address_proof ? asset('uploads/providers/'.$user_detail->address_proof) : asset('images/photo_not.png') }}"/>
                            <div class='text-center'>
                                <small class='text-muted'>Proof of Address</small>
                            </div> <!-- text-right / end -->                        </a></div> <!-- col-6 / end -->
                    <div class='col-sm-4 col-xs-6 col-md-4 col-lg-4'><a class="thumbnail fancybox" rel="ligthbox"
                                                                        href="{{ $user_detail->rights_prescribe ? asset('uploads/providers/'.$user_detail->rights_prescribe) : asset('images/photo_not.png') }}">
                            <img class="img-responsive" alt=""
                                 src="{{ $user_detail->rights_prescribe ? asset('uploads/providers/'.$user_detail->rights_prescribe) : asset('images/photo_not.png') }}"/>
                            <div class='text-center'>
                                <small class='text-muted'>Right to prescribe certificate</small>
                            </div> <!-- text-right / end -->                        </a></div> <!-- col-6 / end -->
                    <div class='col-sm-4 col-xs-6 col-md-4 col-lg-4'><a class="thumbnail fancybox" rel="ligthbox"
                                                                        href="{{ $user_detail->medical_qualification ? asset('uploads/providers/'.$user_detail->medical_qualification) : asset('images/photo_not.png') }}">
                            <img class="img-responsive" alt=""
                                 src="{{ $user_detail->medical_qualification ? asset('uploads/providers/'.$user_detail->medical_qualification) : asset('images/photo_not.png') }}"/>
                            <div class='text-center'>
                                <small class='text-muted'>Medical Qualification certificate</small>
                            </div> <!-- text-right / end -->                        </a></div> <!-- col-6 / end -->
                    <div class='col-sm-4 col-xs-6 col-md-4 col-lg-4'><a class="thumbnail fancybox" rel="ligthbox"
                                                                        href="{{ $user_detail->aesthetic_training_certificate ? asset('uploads/providers/'.$user_detail->aesthetic_training_certificate) : asset('images/photo_not.png') }}">
                            <img class="img-responsive" alt=""
                                 src="{{ $user_detail->aesthetic_training_certificate ? asset('uploads/providers/'.$user_detail->aesthetic_training_certificate) : asset('images/photo_not.png') }}"/>
                            <div class='text-center'>
                                <small class='text-muted'>Aesthetic Training Certificate</small>
                            </div> <!-- text-right / end -->                        </a></div> <!-- col-6 / end -->
                    <div class='col-sm-4 col-xs-6 col-md-4 col-lg-4'><a class="thumbnail fancybox" rel="ligthbox"
                                                                        href="{{ $user_detail->insurance_certificate ? asset('uploads/providers/'.$user_detail->insurance_certificate) : asset('images/photo_not.png') }}">
                            <img class="img-responsive" alt=""
                                 src="{{ $user_detail->insurance_certificate ? asset('uploads/providers/'.$user_detail->insurance_certificate) : asset('images/photo_not.png') }}"/>
                            <div class='text-center'>
                                <small class='text-muted'>Insurance certificate</small>
                            </div> <!-- text-right / end -->                        </a></div> <!-- col-6 / end -->
                    <div class='col-sm-4 col-xs-6 col-md-4 col-lg-4'><a class="thumbnail fancybox" rel="ligthbox"
                                                                        href="{{ $user_detail->other_certificate ? asset('uploads/providers/'.$user_detail->other_certificate) : asset('images/photo_not.png') }}">
                            <img class="img-responsive" alt=""
                                 src="{{ $user_detail->other_certificate ? asset('uploads/providers/'.$user_detail->other_certificate) : asset('images/photo_not.png') }}"/>
                            <div class='text-center'>
                                <small class='text-muted'>Other certificate</small>
                            </div> <!-- text-right / end -->                        </a></div> <!-- col-6 / end -->
                </div> <!-- list-group / end -->            </div> <!-- row / end -->        </div>
    </div>
</div>@endsection