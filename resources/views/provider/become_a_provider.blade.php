@extends('layouts.frontend_temp')@section('content')
<style type="text/css">
    .Stepwizard-Form {
        margin-top: 30px;
        width: 600px;
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

    .stepwizard-step button[disabled] {
        /*opacity: 1 !important;   filter: alpha(opacity=100) !important;*/
    }

    .stepwizard .btn.disabled,
    .stepwizard .btn[disabled],
    .stepwizard fieldset[disabled] .btn {
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

    #photo,
    #other_certificate,
    #identity,
    #address_proof,
    #medical_qualification,
    #rights_prescribe,
    #aesthetic_training_certificate,
    #insurance_certificate {
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

    .abc {
        margin-top: 50px;
    }

    .combo {
        margin-bottom: 10px;
        background: #337ab7;
        width: 100%;
        display: inline-block;
        padding: 10px 30px;
        border-radius: 50px;
        color: #fff;
    }

    .remove_combo {
        float: right;
        margin-top: 0px;
        position: relative;
        margin-right: -16px;
        cursor: pointer;
    }

    .combo-btn {
        padding: 5px 20px;
        margin-top: 0px;
    }

    .err-combo {
        color: red;
    }

    .has-error .multiselect {
        border: 1px solid #a94442 !important;
    }

    .b_agree .checkbox input[type=checkbox] {
        margin-left: 0px;
    }
    @media(max-width:767px)
    {
        .place_long ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
          white-space:pre-line;  
          position:relative;
          top:-9px;
          
        }
        .place_long ::-moz-placeholder { /* Firefox 19+ */
             white-space:pre-line;  
          position:relative;
          top:-9px;
        }
        .place_long :-ms-input-placeholder { /* IE 10+ */
            white-space:pre-line;  
          position:relative;
          top:-9px;
        }
        .place_long :-moz-placeholder { /* Firefox 18- */
             white-space:pre-line;  
          position:relative;
          top:-9px;
        }
    }
</style>
{!! displayAlert() !!}@if($user_reject->administrator_approval == 2 && $user_answer)
<div class="container">
    <br>
    <br>
    <div class="ourvision ">
        <div class="container">
            <div class="row ourvision_col">
                <div class="ourvision_cols text-center">
                    <h3>Waiting for admin approval</h3>
                    <div class="divider1"></div>
                </div>
                <div class="col-md-5 col-md-5 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms"></div>
                <div class="col-sm-7 col-md-7 wow fadeInDown vision_cols" data-wow-duration="1000ms" data-wow-delay="300ms"></div>
            </div>
        </div>
    </div>
</div>@endif
<div class="container Stepwizard-Form" style="display:{{ $user_answer && $user_reject->administrator_approval == 2 ? 'none' : 'block'  }} ">
    <!--<div align="center" style="display: {!! $user_answer ? 'block' : 'none' !!} ">        <h3>Your  </h3>    </div>-->
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"><a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p>
                    <small>Part1</small>
                </p>
            </div>
            <div class="stepwizard-step col-xs-3"><a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>
                    <small>Part2</small>
                </p>
            </div>
            <div class="stepwizard-step col-xs-3"><a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>
                    <small>Part 3</small>
                </p>
            </div>
            <div class="stepwizard-step col-xs-3"><a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p>
                    <small>Part 4</small>
                </p>
            </div>
        </div>
    </div>
    @if(isset($user_detail)) {!! Form::model($user_detail, ['method' => 'post','url' => ['provider/save_become_a_provider'], 'class'=>'form stepsForm', 'id'=>'save_become_a_provider', 'enctype'=>'multipart/form-data']) !!} @else {!! Form::open(['method'=>'post','files' => true, 'url'=>'provider/save_become_a_provider', 'class'=>'form', 'id'=>'save_become_a_provider', 'enctype'=>'multipart/form-data']) !!} @endif
    <div class="panel panel-primary setup-content" id="step-1">
        <div class="panel-heading">
            <h3 class="panel-title">Part1</h3></div>
        <div class="panel-body">
            <div class="form-group"> {!! Form::select('title', array('Mr' => 'Mr', 'Mrs' => 'Mrs', 'Ms' => 'Ms', 'Dr' => 'Dr'),null,['class'=>'form-control', 'required' => 'required',]) !!}
            </div>
            <div class="form-group"> {!! Form::text('forename',ucfirst(Auth::user()->name), array('placeholder'=>'Forenames','id'=>'forename','class'=>'form-control', 'required' => 'required','readonly' ))!!}
            </div>
            <div class="form-group"> {!! Form::text('surname',null, array('placeholder'=>'Surname','id'=>'surname','class'=>'form-control', 'required' => 'required',)) !!}
            </div>
            <div class="form-group error_dob"> {!! Form::text('date_of_birth',null, array('placeholder'=>'Date of Birth ','id'=>'date','class'=>'form-control provider_dob', 'required' => 'required', ))!!}
                <span class="error-message"></span>
            </div>
            <div class="form-group"> {!! Form::text('nationality',null, array('placeholder'=>'Nationality','id'=>'nationality','class'=>'form-control', 'required' => 'required', ))!!}
            </div>
            <div class="form-group"> {!! Form::text('address_line_2',null, array('placeholder'=>'Search Address','id'=>'address','class'=>'form-control', 'required' => 'required', ))!!} {!! Form::hidden('latitude',null,array('id'=>'latitude'))!!} {!! Form::hidden('longitude',null,array('id'=>'longitude'))!!}
            </div>
            <div class="form-group"> {!! Form::text('city',null, array('placeholder'=>'City','id'=>'city','class'=>'form-control', 'required' => 'required', ))!!}
            </div>
            <div class="form-group"> {!! Form::text('state',null, array('placeholder'=>'State','id'=>'state','class'=>'form-control', 'required' => 'required', ))!!}
            </div>
            <div class="form-group"> {!! Form::text('country',null, array('placeholder'=>'Country','id'=>'country','class'=>'form-control', 'required' => 'required', ))!!}
            </div>
            <div class="form-group"> {!! Form::text('post_code',null, array('placeholder'=>'Post code','id'=>'post_code','class'=>'form-control', 'required' => 'required', ))!!}
            </div>
            <div class="form-group"> {!! Form::text('phone',null, array('placeholder'=>'Phone','id'=>'phone','class'=>'form-control bfh-phone', 'required' => 'required','data-format' => 'ddd ddd dddd dd'))!!}
            </div>
            <div class="form-group"> {!! Form::text('business',null, array('placeholder'=>'Business','id'=>'business','class'=>'form-control', 'required' => 'required', ))!!}
            </div>
            <div class="form-group"> {!! Form::text('business_address',null, array('placeholder'=>'Business Address','class'=>'form-control', 'required' => 'required', 'id' => 'business_address'))!!}
            </div>
            <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
        </div>
    </div>
    <div class="panel panel-primary setup-content" id="step-2">
        <div class="panel-heading">
            <h3 class="panel-title">Part 2</h3></div>
        <div class="panel-body">
            <div class="form-group">
                <div class="sf-radio">
                    <p> Do you currently reside in the U.K and have the right to work? </p>
                    <label>{{ Form::radio('uk', 'Y', null,array('required' => 'required',)) }} <span></span> Yes</label>
                    <label>{{ Form::radio('uk', 'N', null,array('required' => 'required',)) }} <span></span> No
                    </label>
                    <br>
                    <input type="text" name="other_uk" class="form-control" placeholder="Others (Please specify)" style="display: {!! $user_detail ? $user_detail->uk =='N' ? 'block' : 'none' :'none' !!}">
                </div>
            </div>
            <div class="form-group place_long">
                <div class="sf-radio">
                    <p> Do you have a U.K based medical qualification? </p>
                    <label>{{ Form::radio('uk_qualification', 'Y', null,array('required' => 'required',)) }} <span></span> Yes</label>
                    <label>{{ Form::radio('uk_qualification', 'N', null,array('required' => 'required',)) }}
                        <span></span> No</label>
                    <br>
                    <input type="text" name="other_uk_qualification" class="form-control" placeholder="If no please state which country your medical qualification was obtained... " style="display: {!! $user_detail ? $user_detail->uk_qualification =='N' ? 'block' : 'none' :'none' !!}">
                </div>
            </div>
            <div class="form-group">
                <p> Please specify which medical professional you are. </p> {!! Form::select('professional', $professional_array['professional_title'], $user_detail ? $user_detail->professional : 'null',array('class'=>'form-control professional', 'required' => 'required', )) !!}
            </div>
            <div class="form-group other_professional" style="display:          {!! $user_detail ? $user_detail->professional ==" Others (Please specify) " ? "block " : "none " : "none " !!}">
            <p>Other medical professional:</p> {!! Form::text('other_professional',null, array('class'=>'form-control'))!!}
        </div>
        <div class="form-group other_input">
            <p>Please specify the regulatory body you are presently registered with.</p> {!! Form::select('professional_pin', array(''=>'Select', 'General Medical Council (GMC)' => 'General Medical Council (GMC)' , 'General Dental Council (GDC)' => 'General Dental Council (GDC)', 'Nursing and Midwifery Council (NMC)' => 'Nursing and Midwifery Council (NMC)', 'others' => 'Others (Please specify)'), $user_detail ? $user_detail->professional_pin : 'null',array('class'=>'form-control professional_pin', 'required' => 'required', )) !!} <span><p  style="margin-top: 10px;">(Please note that the register will be checked to confirm your current status)</p></span>
        </div>
        <div class="form-group other_professional_pin" style="display:          {!! $user_detail ? $user_detail->professional_pin ==" others " ? "block " : "none " : "none " !!}">
        <p>Other professional pin:</p> {!! Form::text('other_professional_pin',null, array('class'=>'form-control'))!!}
    </div>
    <div class="form-group">
        <p>Professional Pin or Registration Number.</p> {!! Form::text('registration_number',null, array('class'=>'form-control', 'required' => 'required', 'placeholder'=> 'Pin or Registration'))!!}
    </div>
    <div class="form-group">
        <div class="sf-radio">
            <p>Have you completed your aesthetic training? </p>
            <label>{{ Form::radio('aesthetic_training', 'Y', null,array('required' => 'required')) }} <span></span> Yes
            </label>
            <label> {{ Form::radio('aesthetic_training', 'N', null,array('required' => 'required')) }}
                <span></span> No</label>
            <br>
            <input type="text" name="other_aesthetic_training" class="form-control" placeholder="Others (Please specify) " style="display: {!! $user_detail ? $user_detail->aesthetic_training =='N' ? 'block' : 'none' :'none' !!}">
        </div>
    </div>
    <div class="form-group aesthetic_training_not">
        <p>What date did you complete your aesthetic training? </p>
        {!! Form::text('aesthetic_training_date',null, array('placeholder'=>'DD/MM/YYYY','class'=>'form-control', 'required' => 'required', ))!!}
    </div>
    <div class="form-group pull-right">
        <div class="col-sm-6">
            <button class="btn btn-primary prevBtn " type="button">Prev</button>
        </div>
        <div class="col-sm-6">
            <button class="btn btn-primary nextBtn " type="button">Next</button>
        </div>
    </div>
</div>
</div>
<div class="panel panel-primary setup-content" id="step-3">
    <div class="panel-heading">
        <h3 class="panel-title">Part 3</h3></div>
    <div class="panel-body">
        <div class="form-group">
            <p>Aesthetic Treatments</p> {!! Form::select('aesthetic_treatment[]',$services,$provider_services, array('class'=>'form-control' ,'required' => 'required','id' => 'provider_aesthetic_services1','multiple' => 'multiple')) !!}
        </div>
        <div class="form-group">
            <p>Combination offers</p>
            <input type="text" class="form-control" id="provider_aesthetic_services" name="aesthetic_combo_treatment" value="">
            <span id="error_comb"></span>
            <button type="button" class="btn btn-primary combo-btn" id="combo_service_frm_submit" name="">Save</button>
        </div>
        <div class="form-group">
            <span id="multiple_select_show">
                @forelse($comboservices as $id => $combo)

                <div class="combo combo_{{$combo->provider_services_id}}">
                    {{$combo->service}}<span class="remove_combo" data-combo="{{$combo->provider_services_id}}">x</span></div>
                @empty
                @endforelse
            </span>
                  <div id="error_combo"></div>
        </div>
        <div class="form-group">
            <p>Insurance Company Name</p> {!! Form::text('insurance_company_name',null, array('class'=>'form-control', 'required' => 'required', ))!!}
        </div>
        <div class="form-group">
            <p>Insurance Policy number</p> {!! Form::text('insurance_policy_number',null, array('class'=>'form-control', 'required' => 'required', ))!!}
        </div>
        <div class="form-group">
            <p>Please indicate your prescribing rights: </p> {!! Form::select('prescribing_rights', array(''=>'Select','doctor' => 'Doctor', 'dentist' => 'Dentist', 'nurse_independent_prescriber' => 'Nurse independent prescriber', 'non_prescriber' => 'Non-prescriber', 'pharmacist_independent_prescriber' => 'Pharmacist independent prescriber', 'others' => 'Others (Please specify)'), $user_detail ? $user_detail->prescribing_rights : 'null', array('class'=>'have_others form-control prescribing_rights' ,'required' => 'required',)) !!}
        </div>
        <div class="form-group other_prescribing_rights" style="display:         {!! $user_detail ? $user_detail->prescribing_rights ==" others " ? "block " : "none " : "none " !!}">
        <p>Other prescribing rights:</p> {!! Form::text('other_prescribing_rights',null, array('class'=>'form-control'))!!}
    </div>
    <div class="form-group">
        <div class="sf-radio">
            <p> Would you provide a refund, if a customer cancels an appointment? </p>
            <label>{{ Form::radio('refund', '1', null,array('required' => 'required',)) }} <span></span> Yes</label>
            <label>{{ Form::radio('refund', '0', null,array('required' => 'required',)) }} <span></span> No</label>
        </div>
    </div>
    <div style="display: {!! $user_detail ? $user_detail->refund ==" 1 " ? "block " : "none " : "none " !!}" id="refund_days">
    <div class="form-group">
        <div class="col-md-6">
            <div class="sf_columns column_3">
                <div class="sf-radio">
                    <p>Refund percentage if cancelled 7 Days and above</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="sf_columns column_3">
                <div class="sf-radio"> {!! Form::select('percentage_week', array(''=>'Select','100'=>'Full Refund', '0' => '0%','10' => '10%','20' => '20%','30' => '30%','40' => '40%','50' => '50%', '60' => '60%','70' => '70%','80' => '80%'), $user_detail ? $user_detail->percentage_week : 'null', array('class'=>'have_others form-control refunds','required' => 'required')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
            <div class="sf_columns column_3">
                <div class="sf-radio">
                    <p>Refund percentage if cancelled bellow 7 Days</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="sf_columns column_3">
                <div class="sf-radio"> {!! Form::select('percentage_days', array(''=>'Select','100'=>'Full Refund', '0' => '0%','10' => '10%','20' => '20%', '30' => '30%','40' => '40%','50' => '50%','60' => '60%','70' => '70%','80' => '80%'), $user_detail ? $user_detail->percentage_days : 'null', array('class'=>'have_others form-control refunds','required' => 'required')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
            <div class="sf_columns column_3">
                <div class="sf-radio">
                    <p>Refund percentage if cancelled within 24hours of your appointment</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="sf_columns column_3">
                <div class="sf-radio"> {!! Form::select('percentage_appointment_day', array(''=>'Select','100'=>'Full Refund', '0' => '0%', '10' => '10%','20' => '20%','30' => '30%', '40' => '40%','50' => '50%','60' => '60%','70' => '70%','80' => '80%'), $user_detail ? $user_detail->percentage_appointment_day : 'null', array('class'=>'have_others form-control refunds','required' => 'required')) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group pull-right">
    <div class="col-sm-6">
        <button class="btn btn-primary prevBtn " type="button">Prev</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-primary nextBtn " type="button">Next</button>
    </div>
</div>
</div>
</div>
<div class="panel panel-primary setup-content" id="step-4">
    <div class="panel-heading">
        <h3 class="panel-title">Part 4</h3></div>
    <div class="panel-body">
        <p> Please upload the following documents:</p>
        <div class="form-group custom-upload">
            <p> (i) Proof of identity (Driving license or a valid passport). </p>
            @if($user_detail and $user_detail->identity) <img width="20%" class="img-circle" src="{{ URL::asset('uploads/providers/'.$user_detail->identity) }}"> @endif
            <label for="identity" class="custom-file-upload error1"> <i class="fa fa-cloud-upload"></i> Upload File
            </label>
            <label id="identity-name" class="file-name"></label> {!! Form::file('identity', array('id' => 'identity', $user_detail ? $user_detail->identity ? "" : "required" : "required" ,)) !!}
            <br>
            <br> <span>(Please note that Proof of identity and address verification cannot be from the same source.)</span>
        </div>
        <div class="form-group custom-upload">
            <p> (ii) Proof of address </p> @if($user_detail and $user_detail->address_proof ) <img width="20%" class="img-circle" src="{{ URL::asset('uploads/providers/'.$user_detail->address_proof) }}"> @endif
            <label for="address_proof" class="custom-file-upload error2"> <i class="fa fa-cloud-upload"></i> Upload File </label>
            <label id="address_proof-name" class="file-name"></label> {!! Form::file('address_proof', array('id' => 'address_proof', $user_detail ? $user_detail->address_proof ? "" : "required" : "required")) !!}
            <br>
            <br> <span>(current utility bill, bank statement, current council tax bill, Valid UK driving license).</span>
        </div>
        <div class="form-group custom-upload">
            <p>(iii) Medical Qualification Certificate</p> @if($user_detail and $user_detail->medical_qualification) <img width="20%" class="img-circle" src="{{ URL::asset('uploads/providers/'.$user_detail->medical_qualification) }}"> @endif
            <label for="medical_qualification" class="custom-file-upload error3"> <i class="fa fa-cloud-upload"></i> Upload File </label>
            <label id="medical_qualification-name" class="file-name"></label> {!! Form::file('medical_qualification', array('id' => 'medical_qualification', $user_detail ? $user_detail->medical_qualification ? "" : "required" : "required")) !!}
        </div>
        <div class="form-group custom-upload">
            <p>(iv) Certificate of your rights to prescribe (if applicable) </p>
            @if($user_detail and $user_detail->rights_prescribe) <img width="20%" class="img-circle" src="{{ URL::asset('uploads/providers/'.$user_detail->rights_prescribe) }}"> @endif
            <label for="rights_prescribe" class="custom-file-upload error4"> <i class="fa fa-cloud-upload"></i> Upload File</label>
            <label id="rights_prescribe-name" class="file-name"></label> {!! Form::file('rights_prescribe', array('id' => 'rights_prescribe', $user_detail ? $user_detail->rights_prescribe ? "" : "required" : "required" ,)) !!}
        </div>
        <div class="form-group custom-upload">
            <p>(v) Certificate(s) of aesthetic training </p> @if($user_detail and $user_detail->aesthetic_training_certificate) <img width="20%" class="img-circle" src="{{ URL::asset('uploads/providers/'.$user_detail->aesthetic_training_certificate) }}"> @endif
            <label for="aesthetic_training_certificate" class="custom-file-upload error5"> <i class="fa fa-cloud-upload"></i> Upload File </label>
            <label id="aesthetic_training_certificate-name" class="file-name"></label> {!! Form::file('aesthetic_training_certificate', array('id' => 'aesthetic_training_certificate', $user_detail ? $user_detail->aesthetic_training_certificate ? "" : "required" : "required" ,)) !!}
        </div>
        <div class="form-group custom-upload">
            <p>(vi) Insurance Policy Certificates </p> @if($user_detail and $user_detail->insurance_certificate) <img width="20%" class="img-circle" src="{{ URL::asset('uploads/providers/'.$user_detail->insurance_certificate) }}"> @endif
            <label for="insurance_certificate" class="custom-file-upload error6"> <i class="fa fa-cloud-upload"></i> Upload File </label>
            <label id="insurance_certificate-name" class="file-name"></label> {!! Form::file('insurance_certificate', array('id' => 'insurance_certificate', $user_detail ? $user_detail->insurance_certificate ? "" : "required" : "required" ,)) !!}
        </div>
        <div class="form-group custom-upload">
            <p>(vii) Other(s) (optional) </p> @if($user_detail and $user_detail->other_certificate) <img width="20%" class="img-circle" src="{{ URL::asset('uploads/providers/'.$user_detail->other_certificate) }}"> @endif
            <label for="other_certificate" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Upload File </label>
            <label id="other_certificate-name" class="file-name error7"></label> {!! Form::file('other_certificate', array('id' => 'other_certificate')) !!}
        </div>
       <!-- <div class="form-group custom-upload">
            <p>Profile Photo </p> @if($user_detail and $user_detail->photo) <img width="20%" class="img-circle" src="{{ URL::asset('uploads/profile_photos/'.$user_detail->photo) }}"> @endif
            <label for="photo" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i> Upload Image </label>
            <label id="photo-name" class="file-name"></label> {!! Form::file('photo', array('id' => 'photo', $user_detail ? $user_detail->photo ? "" : "required" : "required" )) !!}
        </div>-->
        <div class="form-group custom-upload">
            <p>Profile Photo </p>
            @if($user_detail and $user_detail->photo)
            <img width="20%" class="img-circle" src="{{ URL::asset('uploads/profile_photos/'.$user_detail->photo) }}" id="blah">
            @endif

            <div id="upload-demo" class="upload-demo" style="width:300px;display:none">

            </div>
            <img width="20%" class="img-circle" id="profileimg" style="display: none">
            <label for="photo" class="custom-file-upload">
                <i class="fa fa-cloud-upload "></i> Upload Image </label>
            <label id="photo-name" class="file-name"></label>
            {!! Form::file('photo', array('id' => 'photo', $user_detail ? $user_detail->photo ? "" : "required" : "required" ,'accept' => 
            'image/*')) !!}
            {!! Form::hidden('provider_profile',null,array('id'=>'provider_profile')) !!}
        </div>
        <div class="form-group b_agree">
            <div class="sf-check checkbox"> {{ Form::checkbox('declaration', 1,false, array('class' => 'declaration', 'id' => 'checkbox')) }}
                <label for="checkbox"> I hereby declare that the information provided is true and correct. I also understand that any willful dishonesty may lead to refusal onto the platform. </label>
                {{Form::hidden('become_a_prvider_edit',(isset($user_answer) && $user_answer->count() > 0) ? '1' : '0',['id' => 'become_a_prvider_edit'])}}
            </div>
        </div>
        <div class="form-group pull-right">
            <div class="col-sm-6">
                <button class="btn btn-primary prevBtn " type="button">Prev</button>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-primary nextBtn" type="button" id="nextBtn"> {{ $user_reject->administrator_approval == 3 ? 'Update' : 'Submit '}}
                </button>
            </div>
        </div>
    </div>
</div>
</div>{!! Form::close() !!}
<div class="contact">
    <div class="container">
        <div class="contact_col">
            <div class="text-center">
                <h3>Contact</h3>
                <div class="divider1"></div>
            </div>
            <div class="row">
                <div class="contact_col_list">
                    <div class="contact_list_inner">
                        <div class="col-md-6 col-sm-6 contact_list">
                            <div class="row">
                                <div class="col-xs-2 col-md-2 col-sm-2"><img src="{{asset('images/contact_icon1.png')}}"></div>
                                <div class="col-xs-10 col-md-10 col-sm-10">
                                    <h4>Address</h4>
                                    <p>Lovell House, 4 Skinner Lane, Leeds, Ls7 1AR, UK </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 contact_list">
                            <div class="row">
                                <div class="col-xs-2 col-md-2 col-sm-2"><img src="{{asset('images/contact_icon3.png')}}"></div>
                                <div class="col-xs-10 col-md-10 col-sm-10">
                                    <h4>Email</h4>
                                    <p><a href="mailto:info@linkaesthetics.com"> info@linkaesthetics.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection