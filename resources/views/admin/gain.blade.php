@extends('layouts.admin_temp')@section('content')<!-- Content Wrapper. Contains page content --><div class="content-wrapper">   <!-- Main content -->   <section class="content">      <!-- SELECT2 EXAMPLE -->      <div class="notification">         <div class="box-header with-border">            <div class="row">               <div class="col-md-9 col-sm-9">                  <h3 class="box-title">Manage Gain</h3>               </div>            </div>               <div class="alert alert-success set-updated" style="display: none"></div>               {!! displayAlert() !!}             <div class="" align="right">                 <a href="{{ url('admin/gain/create') }}" class="btn btn-primary">Add</a>             </div>             <div class="table_box">                 <table  id="example1" class="table table-bordered table-hover">                     <thead>                     <tr>                         <th>S.no</th>                         <th>Title</th>                         <th>Content</th>                         <th>Forward URL</th>                         <th>Banner</th>                         <th>Action</th>                     </tr>                     </thead>                     <tbody>                     @foreach ($gain as $key => $gain_list)                     <tr>                         <td>{{ $key +1}}</td>                         <td>{{ ucfirst( $gain_list->header ) }} </td>                         <td>{!! str_limit($gain_list->content,250) !!}</td>                         <td><a href="{!! $gain_list->forward_link !!}" target="_blank">{!! str_limit($gain_list->forward_link,50) !!}</td>                         <td><img src="{{ asset('uploads/gain_banner/'.$gain_list->gain_banner) }}" class="img-square" width="40%">                         <td> <span><a href="{{url('/admin/gain/'.$gain_list->id.'/edit')}}"><i class="fa fa-edit"> Edit</i></a></span>                         </td>                     </tr>                     @endforeach                     </tbody>                 </table>             </div>         </div>      </div>      <!-- /.box -->   </section>   <!-- /.content --></div><!-- /.content-wrapper -->         @endsection