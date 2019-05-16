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

    .user-pro {
        border: 1px solid #ddd;
        border-collapse: collapse;
    }

    .manage_user_view {
        margin-left: 6px;
    }</style><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">    <!-- Main content -->
    <section class="content">              <!-- SELECT2 EXAMPLE -->
        <div class="policy">
            <div class="">
                <div class="row">
                    <div class="col-md-12 col-12 text-justify"><h3 class="box-title">{{ $users[0]['name'] }}</h3></div>
                </div>
                <div class="policy_box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseOne">
                                                <div class="box-header with-border"><h4 class="box-title"> Profile </h4>
                                                </div>
                                            </a>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="box-body">
                                                    <div class="manage_user_view"> @foreach ($users as $user_list)
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6  text-center user-pro">
                                                                <div class="form-group" align="center"><img
                                                                            src="{{ $user_list->photo ? asset('uploads/profile_photos/'.$user_list->photo) : asset('uploads/profile_photos/user_profile.png') }}"
                                                                            class="img-circle img-responsive"
                                                                            width="20%"></img></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Title</label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->title) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Forename</label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->name) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Surname</label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->surname) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Date Of
                                                                        Birth</label></div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->date_of_birth) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <label>Nationality</label></div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->nationality) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Address
                                                                        Line</label></div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->address_line_2) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>City</label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->city) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>State</label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->state) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Country</label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->country) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Post
                                                                        Code</label></div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->post_code) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Phone</label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->phone) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Business</label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->business) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 user-pro">
                                                                <div class="col-md-12 col-sm-12"><label>Business
                                                                        Address</label></div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-group"> {{
                                                                        ucfirst($user_list->business_address) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseSix">
                                                <div class="box-header with-border"><h4 class="box-title">
                                                        Documents </h4></div>
                                            </a>
                                            <div id="collapseSix" class="panel-collapse collapse">
                                                <div class="box-body"> @foreach ($users as $user_documet)
                                                    <div class="manage_user_view">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-4">

                                                                <!-- proof of identity -->
                                                                <div class="col-md-12 col-sm-12"><label>(i) Proof of
                                                                        identity </label></div>
                                                                <div class="col-md-12 col-sm-12">
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
                                                                    <div class="form-group"><a class="fancybox"                  rel="ligthbox"                  href="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->identity) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->identity) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->identity) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->identity) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <!-- Proof of address -->
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="col-md-12 col-sm-12"><label>(ii) Proof of
                                                                        address </label></div>
                                                                <div class="col-md-12 col-sm-12">
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
                                                                    <div class="form-group"><a class="fancybox"                  rel="ligthbox"                 href="{{ $user_list->address_proof ? asset('uploads/providers/'.$user_list->address_proof) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->address_proof ? asset('uploads/providers/'.$user_list->address_proof) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->address_proof ? asset('uploads/providers/'.$user_list->address_proof) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->address_proof) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                                </div>
                                                            </div>

                                                            <!-- Certificate of medical qualification -->
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="col-md-12 col-sm-12"><label>(iii)
                                                                        Certificate of Medical Qualification </label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
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
                                                                    <div class="form-group"><a class="fancybox"                rel="ligthbox"                href="{{ $user_list->medical_qualification ? asset('uploads/providers/'.$user_list->medical_qualification) :asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->medical_qualification ? asset('uploads/providers/'.$user_list->medical_qualification) :asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->identity ? asset('uploads/providers/'.$user_list->medical_qualification) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->medical_qualification ? asset('uploads/providers/'.$user_list->medical_qualification) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="col-md-12 col-sm-12"><label>(iv) Certificate
                                                                        of your rights to prescribe </label></div>
                                                                <div class="col-md-12 col-sm-12">
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
                                                                    <div class="form-group"><a class="fancybox"                rel="ligthbox"                  href="{{ $user_list->rights_prescribe ? asset('uploads/providers/'.$user_list->rights_prescribe) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->rights_prescribe ? asset('uploads/providers/'.$user_list->rights_prescribe) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>
                                                                     <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->rights_prescribe ? asset('uploads/providers/'.$user_list->rights_prescribe) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->rights_prescribe ? asset('uploads/providers/'.$user_list->rights_prescribe) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="col-md-12 col-sm-12"><label>(v)
                                                                        Certificate(s) of aesthetic training </label>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
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
                                                                    <div class="form-group"><a class="fancybox"                 rel="ligthbox"                   href="{{ $user_list->aesthetic_training_certificate ? asset('uploads/providers/'.$user_list->aesthetic_training_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->aesthetic_training_certificate ? asset('uploads/providers/'.$user_list->aesthetic_training_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>
                                                                       <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->aesthetic_training_certificate ? asset('uploads/providers/'.$user_list->aesthetic_training_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->aesthetic_training_certificate ? asset('uploads/providers/'.$user_list->aesthetic_training_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="col-md-12 col-sm-12"><label>(vi) Insurance
                                                                        Policy Certificates </label></div>
                                                                <div class="col-md-12 col-sm-12">
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
                                                                    <div class="form-group"><a class="fancybox"                 rel="ligthbox"                href="{{ $user_list->insurance_certificate ? asset('uploads/providers/'.$user_list->insurance_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->insurance_certificate ? asset('uploads/providers/'.$user_list->insurance_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>
                                                                     <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->insurance_certificate ? asset('uploads/providers/'.$user_list->insurance_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->insurance_certificate ? asset('uploads/providers/'.$user_list->insurance_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="col-md-12 col-sm-12"><label>(vii)
                                                                        Other(s) </label></div>
                                                                <div class="col-md-12 col-sm-12">
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
                                                                    <div class="form-group"><a class="fancybox"                                                                                               rel="ligthbox"                                                                                               href="{{ $user_list->other_certificate ? asset('uploads/providers/'.$user_list->other_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->other_certificate ? asset('uploads/providers/'.$user_list->other_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>
                                                                      <?php }} else { ?>
 <div class="form-group"><a class="fancybox" rel="ligthbox"  href="{{ $user_list->other_certificate ? asset('uploads/providers/'.$user_list->other_certificate) : asset('images/photo_not.png') }}">
                                                                            <img src="{{ $user_list->other_certificate ? asset('uploads/providers/'.$user_list->other_certificate) : asset('images/photo_not.png') }}"
                                                                                 class="img-responsive img-squer"> </a>
                                                                    </div>

                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseTwo">
                                                <div class="box-header with-border"><h4 class="box-title"> Policy ( {{
                                                        count($policy) }} ) </h4></div>
                                            </a>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <div class="table_box">
                                                        <table id="example1" class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th> S.no</th>
                                                                <th> Policy</th>
                                                                <th> Policy type</th>
                                                                <th> Updated at</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody> @foreach($policy as $key => $policy_list)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{!! ucfirst($policy_list->policy) !!}</td>
                                                                <td> {{ ucfirst($policy_list->policy_type) }}</td>
                                                                <td>{{ $policy_list->updated_at }}</td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseThree">
                                                <div class="box-header with-border"><h4 class="box-title"> Services ( {{
                                                        count($services) }} ) </h4></div>
                                            </a>
                                            <div id="collapseThree" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <div class="table_box">
                                                        <table id="example2" class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>S.no</th>
                                                                <th>Service</th>
                                                                <th>Brand</th>
                                                                <th>Status</th>
                                                                <th>Service amount</th>
                                                                <th>Prescription amount</th>
                                                                <th>Procedure time</th>
                                                                <th>Service type</th>
                                                                <th>Updated at</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody> @foreach($services as $key => $service)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$service->category}}</td>
                                                                <td>{{$service->materialName}}</td>
                                                                <td> {{ $service->service_status == 1 ? 'Active' : 'In-active' }}</td>
                                                                <td> {{conversion_to_pound($service->service_amount)}}</td>
                                                                <td> {{conversion_to_pound($service->prescription_amount)}}</td>
                                                                <td>{{$service->time_needed}}</td>
                                                                <td>{{$service_type[$service->service_type]}}</td>
                                                                <td class="">
                                                                    {{ $service->updated_at }}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                        <!--<table id="example2" class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th> S.no</th>
                                                                <th> Service</th>
                                                                <th> Service Amount</th>
                                                                <th> Prescription Amount</th>
                                                                <th> Time</th>
                                                                <th> Updated at</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody> @foreach($services as $key => $services_list)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{ ucfirst($services_list->service) }}</td>
                                                                <td>{{ $services_list->service_amount }}</td>
                                                                <td>{{ $services_list->prescription_amount }}</td>
                                                                <td>{{ $services_list->time_needed }}hr</td>
                                                                <td>{{ $services_list->updated_at }}</td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseFour">
                                                <div class="box-header with-border"><h4 class="box-title"> Appointment (
                                                        {{ count($appointment) }} ) </h4></div>
                                            </a>
                                            <div id="collapseFour" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <div class="table_box">
                                                        <table id="example3" class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th> S.no</th>
                                                                <th> User name</th>
                                                                <th> Phone number</th>
                                                                <th> Email address</th>
                                                                <th> Appointment date</th>
                                                                <th> Appointment time</th>
                                                                <th> Updated at</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody> @foreach($appointment as $key => $appointment_list)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{ ucfirst($appointment_list->user_name) }}</td>
                                                                <td>{{ $appointment_list->user_contact }}</td>
                                                                <td>{{ $appointment_list->user_email }}</td>
                                                                <td>{{ $appointment_list->preferred_date }}</td>
                                                                <td>{{ $appointment_list->appointment_time_from }}hr -
                                                                    {{ $appointment_list->appointment_time_to }}hr
                                                                </td>
                                                                <td>{{ $appointment_list->updated_at }}</td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-default"><a data-toggle="collapse"
                                                                              data-parent="#accordion"
                                                                              href="#collapseFive">
                                                <div class="box-header with-border"><h4 class="box-title"> Advertisement
                                                        ( {{ count($advertisement) }} ) </h4></div>
                                            </a>
                                            <div id="collapseFive" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <div class="table_box">
                                                        <table id="example4" class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th> S.no</th>
                                                                <th> Services</th>
                                                                <th> Header</th>
                                                                <th> Description</th>
                                                                <th> Banner Image</th>
                                                                <th> Slots type</th>
                                                                <th> Period from and to</th>
                                                                <th> Payment status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody> @foreach($advertisement as $key =>
                                                            $advertisement_list)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{ ucfirst($advertisement_list->service) }}</td>
                                                                <td>{{ $advertisement_list->ad_header }}</td>
                                                                <td>{{ $advertisement_list->ad_description }}</td>
                                                                <td>
                                                                    <a href="{{ asset('uploads/ad_banner/'.$advertisement_list->ad_banner) }}"
                                                                       target="_blank"> {{
                                                                        $advertisement_list->ad_banner }} </a></td>
                                                                <td>{{ $advertisement_list->time_slot ?
                                                                    $advertisement_list->time_slot :
                                                                    $advertisement_list->days_slots." days" }}
                                                                </td>
                                                                <td>{{
                                                                    Carbon\Carbon::parse($advertisement_list->period_from)->format('d-m-Y')
                                                                    }} - {{
                                                                    Carbon\Carbon::parse($advertisement_list->period_to)->format('d-m-Y')
                                                                    }}
                                                                </td>
                                                                <td>{!! $advertisement_list->ad_payment_status=='1' ?
                                                                    '<span class="badge badge-success">Paid</span>' :
                                                                    '<span class="badge badge-warning">Pending</span>'
                                                                    !!}
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
<script type="text/javascript">        function toggleIcon(e) {
        $(e.target).prev('.panel-heading').find(".more-less").toggleClass('glyphicon-plus glyphicon-minus');
    }

    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);</script>
@endsection