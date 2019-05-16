@extends('layouts.frontend_temp')@section('content')
<style>       #map {
        height: 400px;
        width: 100%;
    }

    .time {
        border: 1px solid #fff;
        padding: 5px;
        border-radius: 3px;
        margin: 10px 5px;
        cursor: pointer;
    }

    .time:hover {
        background-color: #10afec;
        border-color: transparent;
        color: #fff;
    }

    .select_time {
        padding: 0 30px;
    }

    .btn.active {
        box-shadow: none;
    }

    .select_time label {
        font-weight: normal;
    }           </style>
<div class="container book_now">
    <section class="book_now_cols">
        <div class="row book_now_list">
            <div class="book_now_col">
                <div class="col-sm-7 col-md-7 booknow_img"><img
                            src="{{($providerData['photo'] !='' && File::exists(public_path('uploads').'/profile_photos/'.$providerData['photo'])) ? asset('uploads').'/profile_photos/'.$providerData['photo'] : asset('uploads').'/profile_photos/user_profile.png'}}">
                    <div class="col-sm-12 col-md-12 booknow_info">
                        <div class="row booknow_info_col">
                            <div class="col-md-12 col-sm-12"><h4>{{$providerData['name']}}</h4>
                                <h4>{{$providerData['registered_with']}}</h4><h4>
                                    {{isset($providerData['service_location_preference']) ?
                                    'Location: '.$locationPreference[$providerData['service_location_preference']] : ''}}</h4>
                                <!-- <p>{{$providerData['address_line_2']}}</p> -->
                            </div>
                            <!-- <div class="col-md-12 col-sm-12">
                                <iframe width="250" height="150" frameborder="0" style="border:0"
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBvaaxywWXshbniT-3esG1kBT-rDtujj20                                                &q={{$providerData['latitude']}},{{$providerData['longitude']}}"
                                        allowfullscreen></iframe>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-md-5 booknow_info">
                    <div class="book_now_form"> {!! Form::open(['url' => 'appointment/book','method' => 'post']) !!}
                        <div class="book_now_inner">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group"><input type="text" name="user_name" class="form-control"
                                                                   placeholder="Name*" value="{{old('user_name')}}">
                                        <input type="hidden" name="provider_id" id="provider_id"
                                               value="{{$providerData['user_id']}}"> <input type="hidden" name="user_id"
                                                                                            value="{{Auth::user()->id}}">
                                    </div>
                                    @if ($errors->has('user_name'))
                                    <div class="error">{{ $errors->first('user_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group"><input type="text" name="user_contact" class="form-control bfh-phone" data-format="ddd ddd dddd dd"
                                                                   placeholder="Contact Number*"
                                                                   value="{{old('user_contact')}}"></div>
                                    @if ($errors->has('user_contact'))
                                    <div class="error">{{ $errors->first('user_contact') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- bfh-phone data-format="0 ddd ddd dddd"-->
                            <!-- <div class="row">                                                    <div class="col-md-12 col-sm-12">                                                                                        <div class="form-group">                                                            <input type="text" name="user_email" class="form-control" placeholder="Email*" value="{{old('user_email')}}">                                                        </div>                                                        @if ($errors->has('user_email'))                                                           <div class="error">{{ $errors->first('user_email') }}</div>                                                       @endif                                                    </div>                                                </div> -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <select name="service_needed" id="service_needed"
                                                                    class="form-control ">
                                            <option value="">Select a Service*</option>
                                            @foreach ($providerData['provider_services'] as $key => $value)
                                            <optgroup label="{{$key}}"> @foreach($value as $sub)
                                                <option value="{{$sub['service_id']}}">
                                                    {{$sub['service']}}{{($sub['type'] == '1') ? '
                                                    ('.$sub['volume'].'ml)' : ''}} -
                                                    {{conversion_to_pound($sub['amount'])}}
                                                </option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach </select> @if ($errors->has('service_needed'))
                                        <div class="error">{{ $errors->first('service_needed') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="preferred_date"
                                                                   class="form-control load-time-slots"
                                                                   placeholder="Preferred Date*" id="preferred_date"
                                                                   value="{{old('preferred_date')}}">
                                        <span class="error_message text-danger"></span>
                                    </div>
                                    @if ($errors->has('preferred_date'))
                                    <div class="error">{{ $errors->first('preferred_date') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- load availabel time slots here -->
                            <div id="check-load"></div>                                                <!-- end -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 disclaimer-policy"><h4>Disclaimer Policy:</h4>
                <p>{!! $providerData['disclaimer'] !!}</p></div>
        </div>
    </section>
</div>              <!--  <div class="booknow_support">            <img src="{{asset('images/booknow.png')}}" alt="Book now">        </div> -->
<div class="contact">
    <div class="container">
        <div class="contact_col">
            <div class="text-center"><h3>Contact</h3>
                <div class="divider1"></div>
            </div>
            <div class="row">
                <div class="contact_col_list">
                    <div class="contact_list_inner">
                        <div class="col-md-6 col-sm-6 contact_list">
                            <div class="row">
                                <div class="col-xs-2 col-md-2 col-sm-2"><img
                                            src="{{asset('images/contact_icon1.png')}}"></div>
                                <div class="col-xs-10 col-md-10 col-sm-10"><h4>Address</h4>
                                    <p>Lovell House, 4 Skinner Lane, Leeds, Ls7 1AR, UK </p></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 contact_list">
                            <div class="row">
                                <div class="col-xs-2 col-md-2 col-sm-2"><img
                                            src="{{asset('images/contact_icon3.png')}}"></div>
                                <div class="col-xs-10 col-md-10 col-sm-10"><h4>Email</h4>
                                    <p><a href="mailto:info@linkaesthetics.com"> info@linkaesthetics.com</a></p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>          <!--.modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>     <!-- /.modal-body-closed -->                     </div>
        <!-- /.modal-content -->          </div>          <!-- /.modal-dialog -->
</div>      <!-- /.modal -->          @endsection