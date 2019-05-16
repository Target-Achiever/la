@extends('layouts.provider_temp')@section('content')         <!-- Content Wrapper. Contains page content -->
<style type="text/css">
   .dataTables_filter
        {
            display: none;
        }
</style>
<div class="content-wrapper">            <!-- Main content -->
    <section class="content">               <!-- SELECT2 EXAMPLE -->
        <div class="box provider_gallery">
            <div class="box-header">
                <div class="row">
                    @if($galleryCount <= 15) 
                    <div class="col-md-4"><h3 style="margin: 0 0 20px;">Gallery</h3></div>
                    <div class="col-md-8"> <!-- provider maximum upload limit 15--> <a
                                href="{{ url('provider/gallery/create') }}" class="btn btn-primary pull-right">Add</a>                        
                    </div>
                    @else
                    <div class="alert alert-info"><strong>Info!</strong> Your maximum upload have reached.</div>
                    @endif
                </div>
                {!! displayAlert() !!} @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul> @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> @foreach($gallery as $key => $image)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src="{{ asset('uploads/gallery/'.$image->file_name) }}" class="img-square" width="15%"> </td>
                            <td>{{ $image->status == 1 ? 'Active' : 'In-active' }}</td>
                            <td class=""><span class=""><a href="{{url('/provider/gallery/'.$image->id).'/'.'edit'}}"><i
                                                class="fa fa-edit"> Edit</i></a></span> &nbsp;&nbsp; <span
                                        class="destroy-element" data-service="{{$image->id}}"> <a
                                            href="javascript:void(0)" class="destroy-element"><i class="fa fa-trash">                                  Delete</i></a> </span>
                                {!! Form::open(['url' => 'provider/gallery/'.$image->id,'files' => true , 'method' =>
                                'DELETE' ,'id' => 'delete-form-'.$image->id]) !!} {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
    </section>            <!-- /.content -->
</div>         <!-- /.content-wrapper -->                  <!-- /.control-sidebar -->         <!-- Add the sidebar's background. This div must be placed            immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>      <!-- </div> -->      <!-- ./wrapper -->        <!-- Modal -->      @endsection