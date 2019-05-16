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

                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">All</a></li>

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

                                <th>Treatment</th>

                                <th>Appointment Status</th>

                                <th>Action</th>

                              </tr>

                            </thead>

                            <tbody>

                              <?php

                                $i = 1;

                              ?>

                              @foreach($apphistory as $history)

                             <tr class="{{($history->appointment_status == 1) ? 'app-upcoming' :  ''}} app-details" data-app="{{$history->id}}">

                                <td><?php echo $i ?></td>

                                <td>{{$history->name}}</td>

                                <td>{{$history->preferred_date}}</td>

                                <td>{{$history->appointment_time_from}}</td>

                                <td>{{$history->service}}</td>



                                <!-- <td>{{$history->appointment_status}}</td> -->

                                <td>{{$status_array[$history->appointment_status]}}</td>

                                <td> 

                                  @if($history->cancel_button)

                                        <a href="{{url('cancel-appointment').'/'.$history->cancel_url}}" class=" btn btn-info">Cancel</a>

                                      

                                   @endif   

                                </td>

                                    {{$i++}}

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

@endsection