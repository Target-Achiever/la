@extends('layouts.admin_temp')@section('content')<?php //alert()->success('You have been logged out.', 'Good bye!');?>         <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">            <!-- Main content -->
    <section class="content">               <!-- SELECT2 EXAMPLE -->
        <div class="box paymeny_history">
            <div class="box-header with-border"><h3 class="box-title">Manage About</h3>
                <div class="" align="right"><a class="btn btn-info" href="{{ url('admin/about/create') }}"> Add</a>
                </div>
                <br><br> {!! displayAlert() !!}
                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Header</th>
                            <th>Content</th>
                            <th>Bannet image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> @foreach ($about as $key => $about_list)
                        <tr>
                            <td>{{ $key +1}}</td>
                            <td>{{ ucfirst( $about_list->about_header ) }}</td>
                            <td> {!! $about_list->about_content !!}</td>
                            <td><img src="{{ asset('uploads/about_banner/'.$about_list->about_banner) }}" class="img-square" width="50%"></td>
                            <td><span><a class="" href="{{url('/admin/about/edit/'.$about_list->id)}}"><i
                                                class="fa fa-edit"> Edit</i></a></span></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>                     <!-- table box end -->               </div>               <!-- /.box -->
    </section>            <!-- /.content -->
</div>         <!-- /.content-wrapper -->                  <!-- /.control-sidebar -->         <!-- Add the sidebar's background. This div must be placed            immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>      <!-- </div> -->      <!-- ./wrapper -->      @endsection