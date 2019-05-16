@extends('layouts.admin_temp')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="notification">
         <div class="box-header with-border">
            <div class="row">
               <div class="col-md-9 col-sm-9">
                  <h3 class="box-title">Business Info</h3>
               </div>

            </div>
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
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">End users</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Providers</a></li>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                           <div class="table_box">
                            <table id="mailchimp_endusers" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>S.no</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Account status</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                $i = 1;
                              @endphp
                              <!-- foreach -->
                             @foreach($users_list['end_user'] as $key => $user)           
                             <tr class="">
                                <td>{{$i++}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user_status[$user->user_status]}}</td>
                             </tr> 
                             @endforeach  
                              <!-- foreach end-->
                           </tbody>
                        </table>
                     </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                           <div class="table_box">
                            <table id="mailchimp_providers" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>S.no</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Account status</th>
                                <th>Admin approval</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                $i = 1;
                              @endphp
                            <!-- foreach -->
                             @foreach($users_list['provider'] as $key => $user)           
                             <tr class="">
                                <td>{{$i++}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user_status[$user->user_status]}}</td>
                                <td>{{$user_status[$user->administrator_approval]}}</td>
                             </tr> 
                             @endforeach  
                              <!-- foreach end-->
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