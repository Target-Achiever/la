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

                     <h3 class="box-title">Create advertisement</h3>



                    {!! displayAlert() !!}



                      <div class="service-form-sec">

                          @if(isset($advertisement))

                          {!! Form::model($advertisement, ['method' => 'PATCH','url' => ['provider/advertisement/update', $advertisement->id],'files' => true]) !!}

                          @else

                          {!! Form::open(['url' => 'provider/advertisement/store','files' => true,'method' => 'post']) !!}

                          @endif

                          <div class="col-md-6 ">

                            <div class="form-group {{ $errors->has('service') ? 'has-error' : '' }}">

                                {!!Form::label('Services', 'Services')!!}

                                {!!Form::select('service',$service_array,null,['class'=>'form-control',(isset($advertisement)) ? 'disabled' : '','id' => 'ad_service'])!!}

                                <span class="text-danger">{{ $errors->first('service') }}</span>

                            </div>

                          </div>
                          <div class="col-md-6">
                            <div class="form-group {{ $errors->has('ad_offer') ? 'has-error' : '' }}">
                                
                                {!!Form::label('offer_check', 'Offer applied')!!}

                                {{ Form::checkbox('ad_offer', 1, (!isset($advertisement)) ? false : (($advertisement->ad_offer == '1')) ? true : false,['class' => '','id' => 'ad_offer',(isset($advertisement)) ? 'disabled' : '']) }}

                                <span class="text-danger">{{ $errors->first('ad_offer') }}</span>

                            </div>
                          </div>

                          <div class="col-md-6 off_percentage" style='{{isset($advertisement) && $advertisement->ad_offer == "1" ? '' : "display:none"}}'>

                            <div class="form-group {{ $errors->has('offer') ? 'has-error' : '' }}">

                                {!!Form::label('offer', 'Offer')!!}

                                {!!Form::text('ad_offer_percentage',null,['class'=>'form-control',(isset($advertisement)) ? 'disabled' : ''])!!}
                                <span class="text-danger">{{ $errors->first('ad_offer_percentage') }}</span>

                            </div>

                          </div>

                          @if($ad_types)

                              @if($ad_types->ad_days=='1')

                              <div class="col-md-6 ">

                                <div class="form-group ">

                                    {!!Form::label('days_slots', 'Days')!!}

                                    {!!Form::select('days_slots',array('1' => '1','2' => '2','3' => '3' ,'4' => '4','5' => '5','6' => '6' ),null,

                                    ['class'=>'form-control','id' => 'days_slots',(isset($advertisement)) ? 'disabled' : ''])!!}

                                    <span class="text-danger">{{ $errors->first('days_slots') }}</span>

                                </div>

                              </div>

                              @elseif($ad_types->ad_days=='2')

                              <div class="col-md-6 ">

                                <div class="form-group ">

                                    {!!Form::label('time_slot', 'Weeks')!!}

                                    {!!Form::select('time_slot',array('1' => 'One week','2' => 'Two weeks','3' => 'Three weeks' ),null,

                                    ['class'=>'form-control','id' => 'time_slot',(isset($advertisement)) ? 'disabled' : ''])!!}

                                    <span class="text-danger">{{ $errors->first('time_slot') }}</span>

                                </div>

                              </div>

                              @endif

                          @else



                          <div class="col-md-6 ">

                              <div class="form-group ">

                                  {!!Form::label('days_slots', 'Days')!!}

                                  {!!Form::select('days_slots',array('1' => '1','2' => '2','3' => '3' ,'4' => '4','5' => '5','6' => '6' ),null,

                                  ['class'=>'form-control','id' => 'days_slots',(isset($advertisement)) ? 'disabled' : ''])!!}

                                  <span class="text-danger">{{ $errors->first('days_slots') }}</span>

                              </div>

                          </div>



                          @endif

                          <div class="col-md-6 ">

                            <div class="form-group {{ $errors->has('ad_header') ? 'has-error' : '' }}">

                                {!!Form::label('ad_header', 'Header')!!}

                                {!!Form::text('ad_header',null,['class'=>'form-control ad_header', 'placeholder'=>'Advertisement header'])!!}

                                <span class="text-danger">{{ $errors->first('ad_header') }}</span>

                            </div>

                        </div>

                        

                        <div class="col-md-6 ">  

                          <div class="form-group {{ $errors->has('period_from') ? 'has-error' : '' }}">

                              {!!Form::label('period_from', 'Period start date')!!}

                              {!!Form::text('period_from',isset($advertisement) ? Carbon\Carbon::parse($advertisement->period_from)->format('d/m/Y') : null,

                              ['readonly', 'class'=>'form-control time-slots','id' => 'period_from','placeholder' => 'DD/MM/YYYY',(isset($advertisement)) ? 'disabled' : ''])!!}

                              <span class="text-danger not_available">{{ $errors->first('period_from') }}</span>

                          </div>

                        </div>

                        <div class="col-md-12 ">

                          <div class="form-group {{ $errors->has('ad_description') ? 'has-error' : '' }}">

                              {!!Form::label('ad_description', 'Description')!!}

                              {!!Form::textarea('ad_description',null,['class'=>'form-control', 'placeholder'=>'Advertisement description','rows'=>'5'])!!}

                              <span class="text-danger">{{ $errors->first('ad_description') }}</span>

                          </div>

                        </div>

                          <div class="col-md-12 ">
                              <div class="form-group {{ $errors->has('ad_banner') ? 'has-error' : '' }}">
                                  {!!Form::label('ad_banner', 'Banner')!!}
                                  @if(isset($advertisement))
                                  <img class="img-squer" width="10%" src="{{asset('uploads/ad_banner/'.$advertisement->ad_banner)}}">
                                  {!!Form::hidden('banner_image',$advertisement->ad_banner,[ 'class'=>'form-control '])!!}

                                  @endif

                                  <br>

                                  <div id="upload-demo-banner" class="upload-demo"
                                       style="width:350px;display:none"></div>

                                  <br/>
                                  <div id="banner_image"></div>
                                  <label class="btn-bs-file btn btn-sm btn-success">
                                      Browse
                                      {!!Form::file('ad_banner',null,array('id' => 'ad_banner'))!!}
                                      {!!Form::hidden('ad_banner_text',null,array('id' => 'ad_banner_text'))!!}
                                  </label>
                                  <span class="text-danger">{{ $errors->first('ad_banner') }}</span>
                                  <button class="btn btn-success btn-sm upload-result-banner upload-demo"  data-type="banner" type="button"
                                          style="display: none">
                                     Crop </button>
                              </div>


                          </div>

                         <!--  <div class="form-group {{ $errors->has('ad_status') ? 'has-error' : '' }}">

                              {!!Form::label('status', 'Status')!!}

                              {!!Form::select('ad_status',$status,null,['class'=>'form-control'])!!}

                              <span class="text-danger">{{ $errors->first('ad_status') }}</span>

                          </div> -->

                          <div class="col-md-12 ">

                            <div class="form-group">

                                {!!Form::hidden('declaration',1,[ 'class'=>'form-control ' ])!!}

                                @if(!isset($advertisement))
                                
                                <div class="ad_price"></div>
                                <script
                                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                      data-key="{{env('STRIPE_KEY')}}"
                                      data-name="Stripe Demo"
                                      data-description="Appointment payment"
                                      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                      data-locale="auto"
                                      data-currency="GBP">
                              </script>
                              @else
                              {!!Form::submit('Save',array('class' => 'btn btn-primary'))!!} 
                              @endif

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

