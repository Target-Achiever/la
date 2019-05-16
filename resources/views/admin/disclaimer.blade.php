@extends('layouts.admin_temp')@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box create_edit_service">
            <div class="box-header with-border">
                <h3 class="box-title">Disclaimer & Terms and Condition </h3>
                <br>
                <br> {!! displayAlert() !!}
                <div class="service-form-sec"> @if(isset($disclaimer_array)) {!! Form::model($disclaimer_array, ['method' => 'PATCH','url' => ['admin/update', $disclaimer_array->id]]) !!} @else {!! Form::open(['url' => 'admin/save','files' => true,'method' => 'post']) !!} @endif
                    <div class="form-group"><label class="form-label">Type </label> {!!Form::select('type',['1' => 'Disclaimer','2' => 'Terms & Condition','3' => 'Privacy & Policy'],null,['class' =>'form-control' ])!!} </div>
                    <div class="form-group"> {!!Form::textarea('disclaimer',null,['id'=>'editor1','rows'=>'10','cols'=>'91'])!!} </div>
                    <div class="form-group"> {!!Form::submit(isset($disclaimer_array) ? 'Update' : 'Save',array('class' => 'btn btn-primary'))!!} </div> {!! Form::close() !!} </div>
                <h3 class="box-title">Disclaimer List</h3>
                <br>
                <br>
                <div class="table_box">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S.no</th>
                            <th> Disclaimer </th>
                            <th> Type </th>
                            <th> Last update</th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody> @foreach($disclaimer as $key => $disclaimer_list)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{!! str_limit($disclaimer_list->disclaimer,250) !!}</td>
                            <td>{{ $types[$disclaimer_list->type] }}</td>
                            <td>{{ $disclaimer_list->updated_at }}</td>
                            <td><span><a href="{{ URL::asset('admin/edit/'.$disclaimer_list->id)}}"><i class="fa fa-edit"> Edit</i></a></span>
                                </td>
                        </tr> @endforeach </tbody>
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