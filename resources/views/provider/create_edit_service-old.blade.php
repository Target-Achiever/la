@extends('layouts.provider_temp')



@section('content')

         <!-- Content Wrapper. Contains page content -->

         <div class="content-wrapper">

            <!-- Main content -->

            <section class="content">

               <!-- SELECT2 EXAMPLE -->

               <div class="box create_edit_service">

                  <div class="box-header with-border">

                     <h3 class="box-title">Manage services</h3> 



                    {!! displayAlert() !!}



                    <div class="service-form-sec"> 

                    @if(isset($service))

                      {!! Form::model($service, ['method' => 'PATCH','url' => ['provider/services', $service->provider_services_id]]) !!}

                    @else              

                       {!! Form::open(['url' => 'provider/services','files' => true,'method' => 'post','id' => 'manage_service_frm']) !!}

                    @endif   



                    <div class="row">
                    @if(isset($service) && $service->service_type == 1)
                        <div class="col-md-2">  
                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                              {!!Form::label('Regular', 'Regular')!!}
                              {{ Form::radio('service_type', 1,1,['class' => '','id' => 'service_type_regular']) }}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      
                      @elseif(!isset($service))
                      
                        <div class="col-md-2">  
                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                              {!!Form::label('Regular', 'Regular')!!}
                              {{ Form::radio('service_type', 1,1,['class' => '','id' => 'service_type_regular']) }}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      
                      @endif
                      @if(isset($service) && $service->service_type == 2)
                      
                        <div class="col-md-2">  
                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                              {!!Form::label('Combo', 'Combo')!!}
                              {{ Form::radio('service_type', 2,null,['class' => '','id' => 'service_type_combo']) }}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      
                      @elseif(!isset($service))
                      
                        <div class="col-md-2">  
                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                              {!!Form::label('Combo', 'Combo')!!}
                              {{ Form::radio('service_type', 2,null,['class' => '','id' => 'service_type_combo']) }}
                              <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          </div>
                        </div>
                      @endif
                      </div>

                      @if(isset($service) && $service->service_type == 1)

                      <div class="row select_regular" class="">

                        <div class="col-md-6">  

                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">

                              {!!Form::label('Services', 'Services')!!}

                              {!!Form::select('services_id',$service_array,null,['class'=>'form-control',(isset($service)) ? 'disabled' : ''])!!}

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

                      <!-- <div class="row select_combo" class="" style="display: {{(isset($service) && $service->service_type == 2) ? '' : 'none'}}">

                        <div class="col-md-6">  

                          <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">

                              {!!Form::label('Services', 'Services')!!}

                              {!!Form::select('services_id[]',$procombos,(isset($service)) ? $combo : null,['class'=>'form-control','id' => 'multiselect_service_combo','multiple' => 'multiple'])!!}

                              <span class="text-danger">{{ $errors->first('services_id') }}</span>

                          </div>

                        </div>

                      </div> -->

                      <div class="row select_combo" style="display: {{(isset($service) && $service->service_type == 2) ? '' : 'none'}}">

                       <div class="col-md-6"> 

                         <div class="form-group {{ $errors->has('service') ? 'has-error' : '' }}">

                              {!!Form::label('comboservice', 'Combo services')!!}

                              {!!Form::text('combo_service',(isset($service)) ? $service->service : null,['class'=>'form-control', 'placeholder'=>'Hyaluronic Acid & Hyaluronic Acid Fillers','id' => 'comboservice'])!!}

                              <span class="text-danger">{{ $errors->first('service') }}</span>

                         </div>

                       </div>

                      </div>

                      <div class="row select_regular" style="display: {{(isset($service) && $service->service_type == 2) ? 'none' : ''}}">

                       <div class="col-md-6"> 

                         <div class="form-group {{ $errors->has('service_amount') ? 'has-error' : '' }}">

                              {!!Form::label('material', 'Material required')!!}

                              {!!Form::text('service',null,['class'=>'form-control', 'placeholder'=>'Hyaluronic Acid','id' => 'material'])!!}

                              <span class="text-danger">{{ $errors->first('service') }}</span>

                         </div>

                       </div>

                      </div> 

                      <div class="row select_regular" style="display: {{(isset($service) && $service->service_type == 2) ? 'none' : ''}}">

                       <div class="col-md-6"> 

                         <div class="form-group {{ $errors->has('service_amount') ? 'has-error' : '' }}">

                              {!!Form::label('volume', 'Volume(ml)')!!}

                              {!!Form::text('quantity',null,['class'=>'form-control', 'placeholder'=>'2','id' => 'material'])!!}

                              <span class="text-danger">{{ $errors->first('quantity') }}</span>

                         </div>

                       </div>

                      </div> 

                      <div class="row">

                       <div class="col-md-6"> 

                         <div class="form-group {{ $errors->has('service_amount') ? 'has-error' : '' }}">

                              {!!Form::label('amount', 'Amount'.'('.\Config::get('constants.currency').')')!!}

                              {!!Form::text('service_amount',(isset($service)) ? conversion_to_pound($service->service_amount) : null,['class'=>'form-control', 'placeholder'=>'100','id' => 'value_format_maker_amount'])!!}

                              <span class="text-danger">{{ $errors->first('service_amount') }}</span>

                         </div>

                       </div>

                      </div> 

                      @if(Auth::user()->user_type == 'prescriber') 

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group {{ $errors->has('prescription_amount') ? 'has-error' : '' }}">

                                {!!Form::label('amount', 'Prescription amount'.'('.\Config::get('constants.currency').')')!!}

                                {!!Form::text('prescription_amount',(isset($service)) ? conversion_to_pound($service->prescription_amount) : null,['class'=>'form-control', 'placeholder'=>'100','id' => 'value_format_maker_pre_amount'])!!}

                                <span class="text-danger">{{ $errors->first('prescription_amount') }}</span>

                           </div>

                          </div> 

                        </div>

                       @endif

                       <div class="row">

                        <div class="col-md-6">

                          <div class="form-group {{ $errors->has('time_needed') ? 'has-error' : '' }}">

                              {!!Form::label('time', 'Procedure time (in hrs)')!!}

                              {!!Form::text('time_needed',null,['class'=>'form-control', 'placeholder'=>'3'])!!}

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

