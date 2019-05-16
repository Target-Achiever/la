@extends('layouts.admin_temp') @section('content')

<style>
    .box-header {
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

    .user-pro {
        border: 1px solid #ddd;
        border-collapse: collapse;
    }

    .manage_user_view {
        margin-left: 6px;
    }
</style>

<div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

        <!-- SELECT2 EXAMPLE -->

        <div class="policy">

            <div class="">

                <div class="row">

                    <div class="col-md-12 col-12 text-justify">

                        <h3 class="box-title">Verify profile</h3> @foreach ($users as $user_list)

                    </div>

                </div>

                <div class="policy_box">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="box box-solid">

                                <div class="box-body">

                                    <div class="box-group" id="accordion">

                                        <div class="panel box box-default">

                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">

                                                <div class="box-header with-border">

                                                    <h4 class="box-title">

                                                        Profile

                                                    </h4>

                                                </div>

                                            </a>

                                            <div id="collapseOne" class="panel-collapse collapse in">

                                                <div class="box-body">

                                                    <div class="manage_user_view">

                                                        @foreach ($users as $user_list)

                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6  text-center user-pro">

                                                                <div class="form-group" align="center">

                                                                    <img src="{{ $user_list->photo ? asset('uploads/profile_photos/'.$user_list->photo) : asset('uploads/profile_photos/user_profile.png') }}" class="img-circle img-responsive" width="30%"></img>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Title</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->title) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Forename</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->name) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Surname</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->surname) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Date Of Birth</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->date_of_birth) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Nationality</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->nationality) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Address Line</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->address_line_2) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>City</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->city) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>State</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->state) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Country</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->country) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Post Code</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->post_code) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Phone</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->phone) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3 col-sm-3 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Business</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->business) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6 user-pro">

                                                                <div class="col-md-12 col-sm-12">

                                                                    <label>Business Address</label>

                                                                </div>

                                                                <div class="col-md-12 col-sm-12">

                                                                    <div class="form-group">

                                                                        {{ ucfirst($user_list->business_address) }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        @endforeach

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="panel box box-default">

                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">

                                                <div class="box-header with-border">

                                                    <h4 class="box-title">

                                                        User Answers

                                                    </h4>

                                                </div>

                                            </a>

                                            <div id="collapseTwo" class="panel-collapse collapse">

                                                <div class="box-body">

                                                    <div class="table_box">

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label>Do you currently reside in the U.K and have the right to work? </label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->uk== 'Y' ? 'Yes' : $user_list->other_uk }}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label>Do you have a U.K bassed medical qualification? </label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->uk_qualification== 'Y' ? 'Yes' : $user_list->other_uk_qualification }}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label>Please specify which medical professional you are?</label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->professional ? $user_list->professional : $user_list->other_professional }}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> Please specify the regulatory body you are presently registered with? </label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->professional_pin}}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> Professional Pin or Registeration Number</label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->registration_number}}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> Have you completed your aesthetic training?</label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->aesthetic_training == 'Y' ? 'Yes' : $user_list->other_aesthetic_training }}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> What date did you complete your aesthetic training?</label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->aesthetic_training_date }}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> Specify the type of aesthetic treatment</label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>
                                                                        @php $service_list="";
                                                                        $services = \DB::table('services')->whereIn('services_id', explode(',',$user_list->aesthetic_treatment) )->select('services.service')->get();
                                                                        foreach ($services as $services_list){
                                                                            $service_list .= $services_list->service.', ';
                                                                        }
                                                                        echo rtrim($service_list,', ');
                                                                        @endphp

                                                                    </p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> Insurance Company Name</label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->insurance_company_name}}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> Insurance Policy number</label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->insurance_policy_number}}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> Please indicate your prescribing rights</label>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group">

                                                                    <p>{{ $user_list->prescribing_rights ? $user_list->prescribing_rights : $user_list->other_prescribing_rights}}</p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="panel box box-default">

                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">

                                                <div class="box-header with-border">

                                                    <h4 class="box-title">

                                                        User Documents

                                                    </h4>

                                                </div>

                                            </a>

                                            <div id="collapseThree" class="panel-collapse collapse">

                                                <div class="box-body">

                                                    <div class="table_box pending-policy-cols">

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> (i) Proof of identity (Driving license or a valid passport)</label>

                                                            </div>

                                                            <div class="col-md-3">
  <?php if($user_list->identity != ''){ $file_info  = new finfo(FILEINFO_MIME_TYPE);
                                                                     $check = $file_info->buffer(file_get_contents( asset('uploads/providers/'.$user_list->identity) ));
                                                                     $ext = explode('/', $check);

                                                                     if($ext[0] != 'image'){ ?> 
                                                                    
                                                                    <div class="form-group"/>
                                                                    <a href="{{url('downloadF').'/'.$user_list->identity.'/'.$ext[1]}}" type="button" class="btn btn-primary">Download</a>
                                                                </div>
                                                                        <?php 
                                                                     } else {
                                                                     ?>
                                                                <div class="form-group">

                                                                    <a class="fancybox" rel="ligthbox" href="{{ $user_list->identity ?

                                                                    URL::asset('uploads/providers/'.$user_list->identity) :

                                                                    URL::asset('images/photo_not.png') }}">

                                                                        <img src="{{ $user_list->identity ?

                                                                    URL::asset('uploads/providers/'.$user_list->identity) :

                                                                    URL::asset('images/photo_not.png') }}" class="img-responsive img-squer">

                                                                    </a>

                                                                </div>
 <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->identity) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->identity) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> (ii) Proof of address</label>

                                                            </div>

                                                            <div class="col-md-3">
 <?php if($user_list->address_proof != ''){ $file_info  = new finfo(FILEINFO_MIME_TYPE);
                                                                     $check = $file_info->buffer(file_get_contents( asset('uploads/providers/'.$user_list->address_proof) ));
                                                                     $ext = explode('/', $check);

                                                                     if($ext[0] != 'image'){ ?> 
                                                                    
                                                                    <div class="form-group"/>
                                                                    <a href="{{url('downloadF').'/'.$user_list->address_proof.'/'.$ext[1]}}" type="button" class="btn btn-primary">Download</a>
                                                                </div>
                                                                        <?php 
                                                                     } else {
                                                                     ?>
                                                                <div class="form-group">

                                                                    <a class="fancybox" rel="ligthbox" href="{{ $user_list->address_proof ?

                                                                        URL::asset('uploads/providers/'.$user_list->address_proof) :

                                                                        URL::asset('images/photo_not.png') }}">

                                                                        <img  src="{{ $user_list->address_proof ?

                                                                        URL::asset('uploads/providers/'.$user_list->address_proof) :

                                                                        URL::asset('images/photo_not.png') }}" class="img-responsive img-squer">

                                                                    </a>

                                                                </div>
  <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->address_proof ? asset('uploads/providers/'.$user_list->address_proof) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->address_proof) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> (iii) Certificate of Medical Qualification</label>

                                                            </div>

                                                            <div class="col-md-3">
                                                                   <?php if($user_list->medical_qualification != ''){ $file_info  = new finfo(FILEINFO_MIME_TYPE);
                                                                     $check = $file_info->buffer(file_get_contents( asset('uploads/providers/'.$user_list->medical_qualification) ));
                                                                     $ext = explode('/', $check);

                                                                     if($ext[0] != 'image'){ ?> 
                                                                      <div class="form-group"/>
                                                                    <a href="{{url('downloadF').'/'.$user_list->medical_qualification.'/'.$ext[1]}}" type="button" class="btn btn-primary">Download</a>
                                                                </div>
                                                                        <?php 
                                                                     } else {
                                                                     ?>
                                                                <div class="form-group">

                                                                    <a class="fancybox" rel="ligthbox" href="{{ $user_list->medical_qualification ?

                                                                URL::asset('uploads/providers/'.$user_list->medical_qualification) :

                                                                URL::asset('images/photo_not.png') }}">

                                                                        <img src="{{ $user_list->medical_qualification ?

                                                                URL::asset('uploads/providers/'.$user_list->medical_qualification) :

                                                                URL::asset('images/photo_not.png') }}" class="img-responsive img-squer">

                                                                    </a>

                                                                </div>
   <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->medical_qualification) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->medical_qualification ? asset('uploads/providers/'.$user_list->medical_qualification) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> (iv) Certificate of your rights to prescribe (if applicable)</label>

                                                            </div>

                                                            <div class="col-md-3">
                                                                  <?php if($user_list->rights_prescribe != ''){ $file_info  = new finfo(FILEINFO_MIME_TYPE);
                                                                     $check = $file_info->buffer(file_get_contents( asset('uploads/providers/'.$user_list->rights_prescribe) ));
                                                                     $ext = explode('/', $check);

                                                                     if($ext[0] != 'image'){ ?> 
                                                                     <div class="form-group"/>
                                                                    <a href="{{url('downloadF').'/'.$user_list->rights_prescribe.'/'.$ext[1]}}" type="button" class="btn btn-primary">Download</a>
                                                                </div>
                                                                        <?php 
                                                                     } else {
                                                                     ?>
                                                                <div class="form-group">

                                                                    <a class="fancybox" rel="ligthbox" href="{{ $user_list->rights_prescribe ?

                                                                URL::asset('uploads/providers/'.$user_list->rights_prescribe) :

                                                                URL::asset('images/photo_not.png') }}">

                                                                        <img src="{{ $user_list->rights_prescribe ?

                                                                    URL::asset('uploads/providers/'.$user_list->rights_prescribe) :

                                                                    URL::asset('images/photo_not.png') }}" class="img-responsive img-squer">

                                                                    </a>

                                                                </div>
 <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->rights_prescribe ? asset('uploads/providers/'.$user_list->rights_prescribe) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->rights_prescribe ? asset('uploads/providers/'.$user_list->rights_prescribe) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>

                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label> (v) Certificate(s) of aesthetic training</label>

                                                            </div>

                                                            <div class="col-md-3">
 <?php if($user_list->aesthetic_training_certificate != ''){ $file_info  = new finfo(FILEINFO_MIME_TYPE);
                                                                     $check = $file_info->buffer(file_get_contents( asset('uploads/providers/'.$user_list->aesthetic_training_certificate) ));
                                                                     $ext = explode('/', $check);

                                                                     if($ext[0] != 'image'){ ?> 
                                                                     <div class="form-group"/>
                                                                    <a href="{{url('downloadF').'/'.$user_list->aesthetic_training_certificate.'/'.$ext[1]}}" type="button" class="btn btn-primary">Download</a>
                                                                </div>
                                                                        <?php 
                                                                     } else {
                                                                     ?>
                                                                <div class="form-group">

                                                                    <a class="fancybox" rel="ligthbox" href="{{ $user_list->aesthetic_training_certificate ?

                                                                URL::asset('uploads/providers/'.$user_list->aesthetic_training_certificate) :

                                                                URL::asset('images/photo_not.png') }}">

                                                                        <img src="{{ $user_list->aesthetic_training_certificate ?

                                                                URL::asset('uploads/providers/'.$user_list->aesthetic_training_certificate) :

                                                                URL::asset('images/photo_not.png') }}" class="img-responsive img-squer">

                                                                    </a>

                                                                </div>
 <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->aesthetic_training_certificate ? asset('uploads/providers/'.$user_list->aesthetic_training_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->aesthetic_training_certificate ? asset('uploads/providers/'.$user_list->aesthetic_training_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label>(vi) Insurance Policy Certificates</label>

                                                            </div>

                                                            <div class="col-md-3">
  <?php if($user_list->insurance_certificate != ''){ $file_info  = new finfo(FILEINFO_MIME_TYPE);
                                                                     $check = $file_info->buffer(file_get_contents( asset('uploads/providers/'.$user_list->insurance_certificate) ));
                                                                     $ext = explode('/', $check);

                                                                     if($ext[0] != 'image'){ ?> 
                                                                     <div class="form-group"/>
                                                                    <a href="{{url('downloadF').'/'.$user_list->insurance_certificate.'/'.$ext[1]}}" type="button" class="btn btn-primary">Download</a>
                                                                </div>
                                                                        <?php 
                                                                     } else {
                                                                     ?>
                                                                <div class="form-group">

                                                                    <a class="fancybox" rel="ligthbox" href="{{ $user_list->insurance_certificate ?

                                                                URL::asset('uploads/providers/'.$user_list->insurance_certificate) :

                                                                URL::asset('images/photo_not.png') }}">

                                                                        <img src="{{ $user_list->insurance_certificate ?

                                                                URL::asset('uploads/providers/'.$user_list->insurance_certificate) :

                                                                URL::asset('images/photo_not.png') }}" class="img-responsive img-squer">

                                                                    </a>

                                                                </div>
    <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->insurance_certificate ? asset('uploads/providers/'.$user_list->insurance_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->insurance_certificate ? asset('uploads/providers/'.$user_list->insurance_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <label>(vii) Other(s)</label>

                                                            </div>

                                                            <div class="col-md-3">
     <?php if($user_list->other_certificate != ''){ $file_info  = new finfo(FILEINFO_MIME_TYPE);
                                                                     $check = $file_info->buffer(file_get_contents( asset('uploads/providers/'.$user_list->other_certificate) ));
                                                                     $ext = explode('/', $check);

                                                                     if($ext[0] != 'image'){ ?> 
                                                                     <div class="form-group"/>
                                                                    <a href="{{url('downloadF').'/'.$user_list->other_certificate.'/'.$ext[1]}}" type="button" class="btn btn-primary">Download</a>
                                                                </div>
                                                                        <?php 
                                                                     } else {
                                                                     ?>
                                                                <div class="form-group">

                                                                    <a class="fancybox" rel="ligthbox" href="{{ $user_list->other_certificate ?

                                                    URL::asset('uploads/providers/'.$user_list->other_certificate) :

                                                    URL::asset('images/photo_not.png') }}">

                                                                        <img src="{{ $user_list->other_certificate ?

                                                    URL::asset('uploads/providers/'.$user_list->other_certificate) :

                                                    URL::asset('images/photo_not.png') }}" class="img-responsive img-squer">

                                                                    </a>

                                                                </div>
  <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->other_certificate ? asset('uploads/providers/'.$user_list->other_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->other_certificate ? asset('uploads/providers/'.$user_list->other_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6"></div>

                                                            <div class="col-md-6">

                                                                <div class="">

                                                                    <span><a class="btn btn-info approve_provider" href="javascript:void(0)" data-service="{{$user_list->user_id}}">Approve </a>

                            </span>

                                                                    <span><a class="btn btn-danger reject_provider" href="javascript:void(0)" data-service="{{$user_list->user_id}}">Reject</a>

                            </span> {!! Form::open(['url' => 'admin/approve','files' => true , 'method' => 'get' ,'id' => 'approve-form-'.$user_list->user_id]) !!} {{ Form::hidden('admin_status_text',null, array('class' => 'admin_status_text')) }} {{ Form::hidden('user_id',$user_list->user_id, array('class' => 'provider_id')) }} {!! Form::close() !!} {!! Form::open(['url' => 'admin/reject','files' => true , 'method' => 'GET' ,'id' => 'delete-form-'.$user_list->user_id]) !!} {{ Form::hidden('admin_status_text',null, array('class' => 'admin_status_text')) }} {{ Form::hidden('user_id',$user_list->user_id, array('class' => 'provider_id')) }} {!! Form::close() !!}

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

                </div>

            </div>

        </div>

        @endforeach

    </section>

    <!-- /.content -->

</div>

<!-- Content Wrapper. Contains page content -->

<!-- /.content-wrapper -->

<!-- /.control-sidebar -->

<!-- Add the sidebar's background. This div must be placed

   immediately after the control sidebar -->

<div class="control-sidebar-bg"></div>

<!-- </div> -->

<!-- ./wrapper -->

@endsection