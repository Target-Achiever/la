@extends('layouts.admin_temp')@section('content')

<style type="text/css">
    @media(max-width: 767px)
    {
        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
          white-space:pre-line;  
          position:relative;
          top:0px;
          font-size: 12px !important; 
          
        }
        ::-moz-placeholder { /* Firefox 19+ */
             white-space:pre-line;  
          position:relative;
          top:0px;
          font-size: 12px !important; 
        }
        ::-ms-input-placeholder { /* IE 10+ */
            white-space:pre-line;  
          position:relative;
          top:0px;
         font-size: 12px !important; 
        }
        ::-moz-placeholder { /* Firefox 18- */
             white-space:pre-line;  
          position:relative;
          top:0px;
          font-size: 12px !important; 
        }
        #example1 td span a
        {
            font-size: 11px !important;
        }
    }
        .dataTables_filter
        {
            display: none;
        }
</style>
<div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

        <!-- SELECT2 EXAMPLE -->

        <div class="box paymeny_history">

            <div class="box-header with-border">

                <h3 class="box-title">{{ $page_type }}</h3>

                <div class="search">

                    <div class="row">

                        <div class="col-md-6 col-md-offset-3">

                            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-search"></i></span>

                                <input type="text" class="form-control" id="provider_search" data-type='1' placeholder="Search for Provider name, Status and more"> </div>

                        </div>

                    </div>

                </div> {!! displayAlert() !!}

                <div class="table_box">

                    <table id="example1" class="table table-bordered table-hover">

                        <thead>

                        <tr>

                            <th>S.no</th>

                            <th> Forename </th>

                            <th> Country </th>

                            <th>Phone number</th>

                            <th>Prescribing rights</th>

                            <th>Action</th>

                        </tr>

                        </thead>

                        <tbody> @foreach($users as $key => $user_list)

                        <tr>

                            <td>{{$key+1}}</td>

                            <td>{{ ucfirst($user_list->name) }} {{ ucfirst($user_list->surname)}} </td>

                            <td> {{ $user_list->country ? $user_list->country : "-" }} </td>

                            <td>{{ $user_list->phone ? $user_list->phone : "-" }}</td>

                            <td>{{ ucfirst($user_list->prescribing_rights) }}</td>

                            <td>



                                <span><a  href="{{url('/admin/provider_profile/'.$user_list->id)}}"><i class="fa fa-stethoscope"> View &nbsp;</i></a></span>
                                <span><a class="{{ $user_list->user_status=='in_active' ? 'active_provider' : 'deactivate_provider' }}" href="javascript:void(0)" data-service="{{$user_list->id}}"><i class="fa fa-{{ $user_list->user_status=='in_active' ? 'thumbs-up' : 'thumbs-down' }} "> {{ $user_list->user_status=='in_active' ? 'Activate' : 'Deactivate' }}&nbsp;</i> </a>                            </span>
                                <span><a class="delete_provider " href="javascript:void(0)" data-service="{{$user_list->id}}"><i class="fa fa-trash">
                                  Delete</i></a>  </span>
                                {!! Form::open(['url' => $user_list->user_status=="in_active" ? "admin/active" : "admin/deactivate",'files' => true , 'method' => 'get' ,'id' => 'deactivate-form-'.$user_list->id]) !!}
                                {{ Form::hidden('admin_status_text',null, array('class' => 'admin_status_text')) }}
                                {{ Form::hidden('provider_id',$user_list->id, array('class' => 'provider_id')) }}
                                {!! Form::close() !!}
                                {!! Form::open(['url' => 'admin/delete','files' => true , 'method' => 'DELETE' ,'id' => 'delete-form-'.$user_list->id]) !!}
                                {{ Form::hidden('admin_status_text','provider', array('class' => 'admin_status_text')) }}
                                {{ Form::hidden('id',$user_list->id, array('class' => 'provider_id')) }}
                                {!! Form::close() !!} </td>

                        </tr> @endforeach </tbody>

                    </table>

                </div>

            </div>

        </div>

        <input type="hidden" value="{{ csrf_token() }}" name="_token">

        <!-- /.box -->

    </section>

    <!-- /.content -->

</div>

<!-- Content Wrapper. Contains page content -->

<!-- /.content-wrapper -->

<!-- /.control-sidebar -->

<!-- Add the sidebar's background. This div must be placed   immediately after the control sidebar -->

<div class="control-sidebar-bg"></div>

<!-- </div> -->

<!-- ./wrapper -->

<script type="text/javascript"></script>@endsection