@extends('layouts.admin_temp')@section('content')<?php   //alert()->success('You have been logged out.', 'Good bye!');?>       
<style>
   #providers_policy_filter
   {
      display: none;
   }  
   .box-title a {
       color: #000 !important;
   }
</style>  
<!-- Content Wrapper. Contains page content -->         
<div class="content-wrapper">
<!-- Main content -->            
<section class="content">
   <!-- SELECT2 EXAMPLE -->               
   <div class="box paymeny_history">
      <div class="box-header with-border">
         <h3 class="box-title">Provider Policies</h3>
         {!! displayAlert() !!}                     <!-- <div class="table_box">                        <table  class="table table-bordered table-hover">                            <thead>                              <tr>                                <th>Select Provider</th>                              </tr>                            </thead>                            <tbody>                              <tr>                                <td>{!! Form::select('user', $users,(isset($id)) ? $id : null, ['id'=>'providerid','class' => 'form-control']) !!}</td>                              </tr>                              <tr>                              </tr>                           </tbody>                        </table>                     </div> -->                     <!-- table box end -->               
      </div>
      <!-- /.box -->               <!-- providers polices list -->               
      <div class="search">
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
               <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-search"></i></span>
                   <input type="text" class="form-control" id="provider_policy_search" placeholder="Search for username and more">                            </div>
            </div>
         </div>
      </div>
      <div class="table_box">
         <table id="providers_policy" class="table table-bordered table-hover">
            <thead>
               <tr>
                  <th>S.no</th>
                  <th>User name</th>
                  <th>Cancellation Policy</th>
                  <th>Reschedule Policy</th>
                  <th>Customer Dissatisfaction</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($users as $key => $user)                        
               <tr>
                  <td>{{$key+1}}</td>
                  <td>{{ ucfirst($user->name) }}</td>
                  <td>{{($user->policy_type == 'cancel') ? $user->created_at : '---'}}</td>
                  <td>{{($user->policy_type == 'reschedule') ? $user->created_at : '---'}}</td>
                  <td>{{($user->policy_type == 'dissatisfaction') ? $user->created_at : '---'}}</td>
                  <td>                                <a class=" view-policy"  href="javascript:void(0)" data-policy="{{$user->user_id}}"><i class="fa fa-book"> View</i></a>                            </td>
               </tr>
               @endforeach                        
            </tbody>
         </table>
      </div>
      <!-- end -->                            
</section>
<!-- /.content -->         </div>         <!-- /.content-wrapper -->                  <!-- /.control-sidebar -->         <!-- Add the sidebar's background. This div must be placed            immediately after the control sidebar -->         
<div class="control-sidebar-bg"></div>
<!-- </div> -->      <!-- ./wrapper -->@endsection