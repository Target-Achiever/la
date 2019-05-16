<table id="example1" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>S.no</th>
        <th> User name</th>
        <th>Mobile number</th>
        <th>Email address</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody> @foreach($users as $key => $user_list)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{ ucfirst($user_list->name) }}</td>
        <td> {{ $user_list->phone ? $user_list->phone : "-" }}</td>
        <td>{{$user_list->email}}</td>
        <td><span><a href="{{url('/admin/view/'.$user_list->id)}}"><i class="fa fa-user"> View &nbsp;</i></a></span>
            <span><a class="deactivate_user " href="javascript:void(0)" data-service="{{$user_list->id}}"><i
                            class="fa fa-thumbs-down">                                  Deactivate</i></a>  </span>
            <span><a class="delete_provider " href="javascript:void(0)" data-service="{{$user_list->id}}"><i class="fa fa-trash">
                                  Delete</i></a>  </span>
            {!!
            Form::open(['url' => 'admin/destroy','files' => true , 'method' => 'get' ,'id' =>
            'deactivate-form-'.$user_list->id]) !!} {{ Form::hidden('admin_status_text',null, array('class' =>
            'admin_status_text')) }} {{ Form::hidden('id',$user_list->id, array('class' => 'id')) }} {!! Form::close()
            !!}
            {!! Form::open(['url' => 'admin/delete','files' => true , 'method' => 'DELETE' ,'id' => 'delete-form-'.$user_list->id]) !!}
            {{ Form::hidden('admin_status_text','user', array('class' => 'admin_status_text')) }}
            {{ Form::hidden('id',$user_list->id, array('class' => 'provider_id')) }}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<script>    $(".deactivate_user").click(function () {
        var user_id = $(this).attr("data-service");
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
                $("#deactivate-form-" + user_id).submit();
            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }
        });
    });
    $(".delete_provider").click(function(){
        var provider_id = $(this).attr("data-service");
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Are you sure you want to delete this user?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Delete it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $("#delete-form-"+provider_id).submit();
            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });
</script>