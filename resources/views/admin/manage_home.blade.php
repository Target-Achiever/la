@extends('layouts.admin_temp')@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box create_edit_service">
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <h3 class="box-title">Manage Home</h3>
                </div>
            </div>
            <div class="alert alert-success set-updated" style="display: none"></div>
            {!! displayAlert() !!}

            <div class="" align="right">
                <a href="{{ url('admin/manage_home/create') }}" class="btn btn-primary">Add</a>
            </div>

                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th> Header </th>
                            <th> Banner image</th>
                            <th> Type</th>
                            <th> Action </th>

                        </tr>
                        </thead>
                        @foreach($screen as $key => $screen_list)

                        <tr>

                            <td>{{ $key+1}}</td>

                            <td>{!! $screen_list->header_text != '' ? ucfirst($screen_list->header_text) : '---' !!}</td>
                            <td>
                                @if($screen_list->home_banner != '')
                                <img src="{{ asset('uploads/home_banner/'.$screen_list->home_banner) }}" class="img-square" width="50%">
                                @else
                                    ---
                                @endif
                           </td>
                            <td>{{ ucfirst($screen_list->type) }}</td>
                            <td class="">

                                <span><a href="{{url('/admin/manage_home/'.$screen_list->id).'/'.'edit'}}"><i class="fa fa-edit"> Edit</i></a></span>

                                <span> <a href="javascript:void(0)" class="destroy-element" data-service="{{$screen_list->id}}">
                                        <i class="fa fa-trash " data-service=""> Delete</i></a>  </span>

                                {!! Form::open(['url' => 'admin/manage_home/destroy/'.$screen_list->id,'files' => true ,  'method' => 'DELETE' ,'id' => 'delete-form-'.$screen_list->id]) !!}

                                {!! Form::close() !!}

                            </td>

                        </tr>

                        @endforeach
                    </table>
                </div>

            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed            immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- </div> -->
<!-- ./wrapper -->@endsection