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
                     <h3 class="box-title">Manage Professional</h3>
                      <div class="" align="right">
                          <a class="btn btn-info" href="{{ url('admin/professional/create') }}"> Add</a>
                      </div>
                      <br><br>
                     
                     {!! displayAlert() !!}

                     <div class="table_box">
                        <table  id="example1" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>S.no</th>
                                <th>Professional Title</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($professional as $key => $professional_list)
                                <tr>
                                    <td>{{ $key +1}}</td>
                                    <td>{{ ucfirst( $professional_list->professional_title ) }} </td>
                                    <td>{{ $professional_list->status == '1' ? 'Active' : 'Deactivate' }}</td>
                                    <td>
                                        <span><a href="{{url('/admin/professional/edit/'.$professional_list->id)}}"><i class="fa fa-edit"> Edit</i></a></span>

                                    </td>

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
