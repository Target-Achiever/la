@extends('layouts.provider_temp')
<style type="text/css">
  .service_radio
  {
    margin-left: 30px !important;
    margin-right: 30px !important;
  }
  .radio label
  {
    padding-left: 0px !important;
  }
  input[type="number"] {
    -moz-appearance: textfield;
  }
  input[type="number"]:hover,
  input[type="number"]:focus {
      -moz-appearance: number-input;
  }
</style>
@section('content')

          <style type="text/css">
            .service-form-sec
            {
              margin-top: 15px;
            }
          </style>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
               <!-- SELECT2 EXAMPLE -->
               <div class="box create_edit_service">
                  <div class="box-header with-border">
                     <h3 class="box-title">Manage services</h3> 

                    {!! displayAlert() !!}
                    <div class="row service_radio">
                    @if(isset($service) && $service->service_type == 1)
                        <div class="col-md-2">  
                          <div class="form-group radio {{ $errors->has('service_type') ? 'has-error' : '' }}">
                              {{ Form::radio('service_type', 1,1,['class' => '','id' => 'service_type_regular']) }}
                              {!!Form::label('Regular', 'Regular')!!}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      
                      @elseif(!isset($service))
                      
                        <div class="col-md-2">  
                          <div class="form-group radio {{ $errors->has('service_type') ? 'has-error' : '' }}">
                              {{ Form::radio('service_type', 1,1,['class' => '','id' => 'service_type_regular']) }}
                              {!!Form::label('Regular', 'Regular')!!}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      
                      @endif
                      @if(isset($service) && $service->service_type == '2')

                      
                        <div class="col-md-2">  
                          <div class="form-group radio {{ $errors->has('service_type') ? 'has-error' : '' }}">
                              {{ Form::radio('service_type', 2,($service->service_type == '2' ? true : ''),['class' => '','id' => 'service_type_combo']) }}
                              {!!Form::label('combo', 'Combination deals')!!}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      
                      @elseif(!isset($service))
                      
                        <div class="col-md-2">  
                          <div class="form-group radio {{ $errors->has('service_type') ? 'has-error' : '' }}">
                              {{ Form::radio('service_type', 2,null,['class' => '','id' => 'service_type_combo']) }}
                              {!!Form::label('combo', 'Combination deals')!!}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      @endif
                      <!-- prescription service -->
                        @if(Auth::user()->user_type == 'prescriber')
                        <div class="col-md-2">  
                          <div class="form-group radio {{ $errors->has('service_type') ? 'has-error' : '' }}">
                              {{ Form::radio('service_type', 3,null,['class' => '','id' => 'service_type_prescription']) }}
                              {!!Form::label('prescription', 'Prescription amount')!!}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      @endif
                      <!--  -->
                      </div>

                    <div class="service-form-sec"> 
                    @if(isset($service))
                      {!! Form::model($service, ['method' => 'PATCH','url' => ['provider/services', $service->provider_services_id],'class' => 'manage_services_form','id' => 'manage_service_frm']) !!}
                    @else              
                       {!! Form::open(['url' => 'provider/services','files' => true,'method' => 'post','id' => 'manage_service_frm','class' => 'manage_services_form']) !!}
                    @endif   

                    
                      @if(isset($service) && $service->service_type == 1)
                      <div class="row select_regular" class="">
                        <div class="col-md-6">  
                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                              {!!Form::label('Services', 'Services')!!}
                              {!!Form::select('services_id',$service_array,$service->category,['class'=>'form-control',(isset($service)) ? 'disabled' : ''])!!}
                              <span class="text-danger">{{ $errors->first('services_id') }}</span>
                          </div>
                        </div>
                      </div>
                      @elseif(!isset($service))
                      <div class="row select_regular" class="">
                        <div class="col-md-6">  
                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                              {!!Form::label('Services', 'Services')!!}
                              {!!Form::select('services_id',$service_array,null,['class'=>'form-control',(isset($service)) ? 'disabled' : ''])!!}
                              <span class="text-danger">{{ $errors->first('services_id') }}</span>
                          </div>
                        </div>
                      </div>
                      @endif
                      <!-- service type hidden -->
                      {!! Form::hidden('service_type',(!isset($service)) ? '1' : ((isset($service) && $service->service_type == '1')) ? '1' : '2', array('id' => 'service_type_hidden')) !!}

                      <div class="row select_combo" style="display: {{(isset($service) && $service->service_type == 2) ? '' : 'none'}}">
                       <div class="col-md-6"> 
                         <div class="form-group {{ $errors->has('service') ? 'has-error' : '' }}">
                              {!!Form::label('comboservice', 'Combination deals')!!}
                              {!!Form::text('combo_service',(isset($service)) ? $service->service : null,['class'=>'form-control', 'placeholder'=>'Enter the name of combination deals','id' => 'comboservice'])!!}
                              <span class="text-danger">{{ $errors->first('service') }}</span>
                         </div>
                       </div>
                      </div>
                      <div class="row select_regular" style="display: {{(isset($service) && $service->service_type == 2) ? 'none' : ''}}">
                       <div class="col-md-6"> 
                         <div class="form-group {{ $errors->has('service') ? 'has-error' : '' }}">
                              {!!Form::label('material', 'Brand required')!!}
                              {!!Form::text('service',null,['class'=>'form-control', 'placeholder'=>'Enter the brand','id' => 'material',isset($service) ? '' : ''])!!}
                              <span class="text-danger">{{ $errors->first('service') }}</span>
                         </div>
                       </div>
                      </div> 
                      <div class="row select_regular" style="display: {{(isset($service) && $service->service_type == 2) ? 'none' : ''}}">
                       <div class="col-md-6"> 
                         <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                              {!!Form::label('volume', 'Volume(ml)')!!}
                              {!!Form::text('quantity',null,['class'=>'form-control', 'placeholder'=>'Enter the volume','id' => ''])!!}
                              <span class="text-danger">{{ $errors->first('quantity') }}</span>
                         </div>
                       </div>
                      </div> 
                      <div class="row">
                       <div class="col-md-6"> 
                         <div class="form-group {{ $errors->has('service_amount') ? 'has-error' : '' }}">
                              {!!Form::label('amount', 'Amount'.'('.\Config::get('constants.currency').')')!!}
                              {!!Form::number('service_amount',(isset($service)) ? conversion_pound_without_format($service->service_amount) : null,['class'=>'form-control', 'placeholder'=>'Enter the amount','id' => 'value_format_maker_amount','step' => 'any','min'=>100])!!}
                              <span class="text-danger" id="error-less-100">{{ $errors->first('service_amount') }}</span>
                         </div>
                       </div>
                      </div> 
                      <!-- @if(Auth::user()->user_type == 'prescriber') 
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group {{ $errors->has('prescription_amount') ? 'has-error' : '' }}">
                                {!!Form::label('amount', 'Prescription amount'.'('.\Config::get('constants.currency').')')!!}
                                {!!Form::text('prescription_amount',(isset($service)) ? conversion_to_pound($service->prescription_amount) : null,['class'=>'form-control', 'placeholder'=>'100','id' => 'value_format_maker_pre_amount'])!!}
                                <span class="text-danger">{{ $errors->first('prescription_amount') }}</span>
                           </div>
                          </div> 
                        </div>
                       @endif -->
                       <div class="row">
                        <div class="col-md-6">
                          <div class="form-group {{ $errors->has('time_needed') ? 'has-error' : '' }}">
                              {!!Form::label('time', 'Surgery time (in hrs)')!!}
                              {!!Form::text('time_needed',null,['class'=>'form-control', 'placeholder'=>'Enter the surgery time'])!!}
                              <span class="text-danger">{{ $errors->first('time_needed') }}</span>
                         </div>
                        </div>
                       </div>
                       <div class="row"> 
                          <div class="col-md-6"> 
                           <div class="form-group {{ $errors->has('service_status') ? 'has-error' : '' }}">
                                {!!Form::label('status', 'Status')!!}
                                {!!Form::select('service_status',$status,null,['class'=>'form-control'])!!}
                                <span class="text-danger">{{ $errors->first('service_status') }}</span>
                           </div>
                          </div>
                        </div>
                      <div class="row">                          
                        <div class="col-md-6"> 
                          <div class="form-group">   
                              {!!Form::submit('Save',array('class' => 'btn btn-primary'))!!}  
                          </div> 
                        </div>  
                      </div>           
                        {!! Form::close() !!}
                        <!-- prescription service form -->
                        <div class="prescription_frm" style="display: none"> 
                        @if(isset($service))
                        {!! Form::model($service, ['method' => 'post','url' => ['provider/prescription_service'],'id' => 'prescription_service_frm']) !!}
                        @else              
                          {!! Form::open(['url' => 'provider/prescription_service','method' => 'post','id' => 'prescription_service_frm']) !!}
                        @endif
                        <div class="row" class="">
                        <div class="col-md-6">  
                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                              {!!Form::label('Services', 'Services')!!}
                              {!!Form::select('services_id',$procombos,isset($edit_prescription) ? $edit_prescription : null,['class'=>'form-control',(isset($service)) ? 'disabled' : ''])!!}
                              <!-- service type hidden -->
                              {!! Form::hidden('service_type',(!isset($service)) ? '1' : ((isset($service) && $service->service_type == '1')) ? '1' : '2', array('id' => 'service_type_hidden')) !!}
                              @if(isset($service))
                              {!! Form::hidden('services_id',$service->services_id, array('id' => '')) !!}
                              @endif
                              <span class="text-danger">{{ $errors->first('services_id') }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group {{ $errors->has('prescription_amount') ? 'has-error' : '' }}">
                                {!!Form::label('amount', 'Prescription amount'.'('.\Config::get('constants.currency').')')!!}
                                {!!Form::number('prescription_amount',(isset($service)) ? conversion_pound_without_format($service->prescription_amount) : null,['class'=>'form-control', 'placeholder'=>'Enter the prescription amount','id' => 'value_format_maker_presamount','step'=>'any','min' => 30])!!}
                                <span class="text-danger" id="error-less-30">{{ $errors->first('prescription_amount') }}</span>
                           </div>
                          </div> 
                        </div> 

                        <div class="row">                          
                        <div class="col-md-6"> 
                          <div class="form-group">   
                              {!!Form::submit('Save',array('class' => 'btn btn-primary'))!!}  
                          </div> 
                        </div>  
                      </div>

                      {!! Form::close() !!}
                      </div>
                        <!-- prescription service form end -->
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
      <!-- validation -->
      @section('inline-scripts')
    
  $(document).ready(function()
{
  $("#manage_service_frm").validate({
        rules: {
            "service": {
                required: true
            },
            "quantity": {
                required: true
            },
            "service_amount": {
                required: true
            },
            "time_needed": {
                required: true
            },
            "combo_service" :{
                required: true
          }
        },
        messages: {
            "service": {
                required: "Please enter the brand"
            },
            "quantity": {
                required: "Please enter the volume"
            },
            "service_amount": {
                required: "Please enter the amount"
            },
            "time_needed": {
                required: "Please enter the surgery time"
            },
            "combo_service": {
                required: "Please enter the combination deals"
            }
        },
        submitHandler: function (form) { 
            $("#manage_service_frm").submit();
        }
    });
    //---------------------------------prescription amount form
    $("#prescription_service_frm").validate({
        rules: {
            "prescription_amount": {
                required: true
            }
        },
        messages: {
            "prescription_amount": {
                required: "Please enter the amount"
            }
        },
        submitHandler: function (form) { 
            
            $("#prescription_service_frm").submit();
        }
    });

});

@endsection