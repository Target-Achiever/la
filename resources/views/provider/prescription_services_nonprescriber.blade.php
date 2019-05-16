@extends('layouts.provider_temp')

@section('content')

<style type="text/css">

  .no-collection

  {

    padding: 0 20px;

  }

</style>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

   <!-- Main content -->

   <section class="content">

      <!-- SELECT2 EXAMPLE -->

      <div class="notification">

         <div class="box-header with-border">

            <div class="row">

               <div class="col-md-9 col-sm-9">

                  <h3 class="box-title">Prescription Services</h3>

               </div>

               <!-- <div class="col-md-3 col-sm-3">

                  <div class="switch pull-right">

                     <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round-flat set-service-availability" data-provider="{{Auth::user()->id}}" type="checkbox" checked>

                     <label for="cmn-toggle-4"></label>

                  </div>

                  

               </div> -->

            </div>

               <div class="alert alert-success set-updated" style="display: none"></div>



               {!! displayAlert() !!}

               

            <div class="search">

               <div class="row">

                  <div class="col-md-6 col-md-offset-3">

                     <!-- <div class="input-group">

                        <span class="input-group-addon"><i cla  ss="fa fa-search"></i></span>

                        <input type="text" class="form-control" placeholder="Search for Treatment type,name">

                     </div> -->

                  </div>

               </div>

            </div>

            <div class="perscription_box">

               <div class="col-md-12">

                  <!-- Custom Tabs -->

                  <div class="nav-tabs-custom">

                     <ul class="nav nav-tabs">

                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">History</a></li>

                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Providers</a></li>

                     </ul>

                     <div class="tab-content">

                        <div class="tab-pane active" id="tab_1">

                           <div class="table_box">

                        <table id="example1" class="table table-bordered table-hover">

                            <thead>

                              <tr>

                                <th>S.no</th>

                                <th>User</th>

                                <th>Appointment date</th>

                                <th>Time</th>

                                <th>Service</th>

                                <th>Material</th>

                                <th>Appointment Status</th>

                                <th>Payment Status</th>

                                <th>Action</th>

                              </tr>

                            </thead>

                            <tbody>

                              

                              @foreach($apphistory as $key => $history)

                             <tr class="{{($history->appointment_status == 1) ? 'app-upcoming' :  ''}} app-details" data-app="{{$history->id}}">
                                
                                <td>{{++$key}}</td>

                                <td>{{$history->name}}</td>

                                <td>{{$history->preferred_date}}</td>

                                <td>{{$history->appointment_time_from}}</td>

                                <td>{{($history->categoryname != '' ? $history->categoryname : 'Combo')}}</td>

                                <td>{{$history->service}}</td>

                                <td><span class="label label-@if($status_array[$history->appointment_status]=='Request')warning
                                                                @elseif($status_array[$history->appointment_status]=='Accepted')success
                                                                @elseif($status_array[$history->appointment_status]=='Cancelled by requester')primary
                                                                @elseif($status_array[$history->appointment_status]=='Cancelled by Prescriber')primary
                                                                @elseif($status_array[$history->appointment_status]=='Declined')danger
                                                                @elseif($status_array[$history->appointment_status]=='Auto cancel due to no payment')info
                                                                @endif">{{ $status_array[$history->appointment_status]}}</span> </td>

                                <td>{{$history->payment_status == '1' ? 'Paid' : 'Not paid'}}</td>

                                <td> 
                                  @if($history->paybutton == 'true' && $history->appointment_status == 2)
                                  {!!Form::open(['url' => 'appointment-payment/'.$history->payment_url,'method' => 'post'])!!}
                                    <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="{{env('STRIPE_KEY')}}"
                                        data-amount="{{$history->service_amount}}"
                                        data-name="Linkaesthetics"
                                        data-description="Appointment payment"
                                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                        data-locale="auto"
                                        data-currency="GBP">
                                    </script>
                                  {!! Form::close()!!}
                                  @endif

                                  @if($history->cancel_button)

                                        <a href="{{url('cancel-appointment').'/'.$history->cancel_url}}" class=" btn btn-info change_accept_status">Cancel</a>

                                      

                                   @endif   

                                </td>

                                    

                             </tr>                

                              @endforeach

                           </tbody>

                        </table>

                     </div>

                        </div>

                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_2">

                           <div class="row">

                            @forelse($prescribers as $prescriber)

                              <a href="{{url('/provider/prescription-request').'/'.$prescriber->id}}"><div class="col-md-6">

                                 <div class="info-box" data-toggle="modal" data-target="#modal-default">

                                    <span class="info-box-icon">

                                    <img src="{{($prescriber->photo !='' && File::exists(public_path('uploads').'/profile_photos/'.$prescriber->photo)) ? asset('uploads').'/profile_photos/'.$prescriber->photo : asset('uploads').'/profile_photos/user_profile.png'}}">

                                    </span>

                                    <div class="info-box-content">

                                       <span class="info-box-text info_head">{{$prescriber->name}}</span>

                                       <span class="info-box-text">{{$prescriber->country}}</span>

                                    </div>

                                    <!-- /.info-box-content -->

                                 </div>

                              </div></a>

                              @empty

                              <p class="no-collection">no provider found</p>

                              @endforelse

                              

                           </div>                        

						            </div>

                        <!-- /.tab-pane -->

                     </div>

                     <!-- /.tab-content -->

                  </div>

                  <!-- nav-tabs-custom -->

               </div>

            </div>

         </div>

      </div>

      <!-- /.box -->

   </section>

   <!-- /.content -->

</div>

<!-- /.content-wrapper -->
<script> $('.close_badge_pre').hide();</script>

@endsection