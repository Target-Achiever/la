@if($status == '1')
<table id="example1" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>S.no</th>
        <th> Forename</th>
        <th> Country</th>
        <th>Phone number</th>
        <th>Prescribing rights</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody> @foreach($users as $key => $user_list)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{ ucfirst($user_list->name) }} {{ ucfirst($user_list->surname)}}</td>
        <td> {{ $user_list->country ? $user_list->country : "-" }}</td>
        <td>{{ $user_list->phone ? $user_list->phone : "-" }}</td>
        <td>{{ ucfirst($user_list->prescribing_rights) }}</td>
        <td><span><a href="{{url('/admin/provider_profile/'.$user_list->user_id)}}"><i
                            class="fa fa-stethoscope"> View &nbsp;</i></a></span> <span><a
                        class="{{ $user_list->user_status=='in_active' ? 'active_provider' : 'deactivate_provider' }}"
                        href="javascript:void(0)" data-service="{{$user_list->id}}"><i
                            class="fa fa-{{ $user_list->user_status=='in_active' ? 'thumbs-up' : 'thumbs-down' }} "> {{ $user_list->user_status=='in_active' ? 'Activate' : 'Deactivate' }}&nbsp;</i> </a>                            </span>
            <span><a class="delete_provider " href="javascript:void(0)" data-service="{{$user_list->id}}"><i
                            class="fa fa-trash"> Delete</i></a>  </span> {!! Form::open(['url' =>
            $user_list->user_status=="in_active" ? "admin/active" : "admin/deactivate",'files' => true , 'method' =>
            'get' ,'id' => 'deactivate-form-'.$user_list->id]) !!} {{ Form::hidden('admin_status_text',null,
            array('class' => 'admin_status_text')) }} {{ Form::hidden('provider_id',$user_list->id, array('class' =>
            'provider_id')) }} {!! Form::close() !!} {!! Form::open(['url' => 'admin/delete','files' => true , 'method'
            => 'DELETE' ,'id' => 'delete-form-'.$user_list->id]) !!} {{ Form::hidden('admin_status_text','provider',
            array('class' => 'admin_status_text')) }} {{ Form::hidden('id',$user_list->id, array('class' =>
            'provider_id')) }} {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<script>
    $(".delete_provider").click(function () {
        var provider_id = $(this).attr("data-service");
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Are you sure you want to delete this provider?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, active it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $("#delete-form-" + provider_id).submit();
            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }
        });
    });
    $(".deactivate_provider").click(function () {
        var provider_id = $(this).attr("data-service");
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Are you sure?",
            text: "<textarea id='editor1' rows='5' cols='50'></textarea>",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, deactivate it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                if ($('#editor1').val() === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                $('.admin_status_text').val($('#editor1').val());
                $("#deactivate-form-" + provider_id).submit();
            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }
        });
    });</script>
@elseif ($status == '2')
<table id="example1" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th> S.no</th>
        <th> Forename</th>
        <th> Country</th>
        <th> Phone number</th>
        <th> Medical professional</th>
        <th> Treatments</th>
        <th> Action</th>
    </tr>
    </thead>
    <tbody> @foreach($users as $key => $user_list)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{ ucfirst($user_list->name) }} {{ ucfirst($user_list->surname) }}</td>
        <td> {{ $user_list->country ? ucfirst($user_list->country) : "-" }}</td>
        <td>{{ $user_list->phone ? $user_list->phone : "-" }}</td>
        <td>{{ ucfirst($user_list->prescribing_rights) }}</td>
        <td>@php $services = \DB::table('services')->whereIn('services_id', explode(',',$user_list->aesthetic_treatment) )->select('services.service')->get(); @endphp
            @foreach ($services as $services_list)  {!!  $services_list->service.'<br>' !!} @endforeach
        </td>
        <td>

            <span><a  href="{{url('/admin/pending_profile/'.$user_list->user_id)}}"><i class="fa fa-check"> View &nbsp;</i></a></span>
            <span><a class="approve_provider" href="javascript:void(0)" data-service="{{$user_list->user_id}}"><i class="fa fa-thumbs-up"> Approve&nbsp;</i> </a></span>
            <span><a class="reject_provider " href="javascript:void(0)" data-service="{{$user_list->user_id}}"><i class="fa fa-times">
                                  Reject</i></a>  </span>

            {!! Form::open(['url' => 'admin/approve','files' => true , 'method' => 'get' ,'id' =>
            'approve-form-'.$user_list->user_id]) !!} {{ Form::hidden('admin_status_text',null,
            array('class' => 'admin_status_text')) }} {{ Form::hidden('user_id',$user_list->user_id,
            array('class' => 'provider_id')) }} {!! Form::close() !!} {!! Form::open(['url' =>
            'admin/reject','files' => true , 'method' => 'GET' ,'id' =>
            'delete-form-'.$user_list->user_id]) !!} {{ Form::hidden('admin_status_text',null,
            array('class' => 'admin_status_text')) }} {{ Form::hidden('user_id',$user_list->user_id,
            array('class' => 'provider_id')) }} {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<script>
    $(".approve_provider").click(function(){
        var provider_id = $(this).attr("data-service");
        swal({
            title: "Are you sure you want to approve this provider?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2c994e",
            confirmButtonText: "Yes, Approve it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $("#approve-form-" + provider_id).submit();

            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });
    $(".reject_provider").click(function(){
        var provider_id = $(this).attr("data-service");
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Are you sure you want to reject this provider?",
            text: "<textarea id='editor1' rows='5' cols='50'></textarea>",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Reject it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                if ($('#editor1').val() === "") {
                    swal.showInputError("You need to write something @mail.");
                    return false
                }
                $('.admin_status_text').val($('#editor1').val());
                $("#delete-form-"+provider_id).submit();
            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });
</script>
@endif