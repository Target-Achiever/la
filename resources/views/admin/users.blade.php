@extends('layouts.admin_temp')

@section('content')
<?php
   //alert()->success('You have been logged out.', 'Good bye!');
?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
               <!-- SELECT2 EXAMPLE -->
               <div class="box paymeny_history">
                  <div class="box-header with-border">
                     <h3 class="box-title">Users</h3> 
                     {!! displayAlert() !!}
                     <div class="table_box">
                        <table  class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>S.no</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                              <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{$user->title}} {{$user->surname}}</td> 
                                <td>{{$user->phone}}</td>                               
                              </tr>
                              @endforeach                                     
                           </tbody>
                        </table>                        
                     </div>
                     <!-- table box end -->
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
