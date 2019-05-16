<table id="example1" class="table table-bordered table-hover">

    <thead>

    <tr>

        <th> S.no</th>

        <th> Advertisement amount</th>

        <th> Type</th>

        <th> Updated at</th>

        <th> Action</th>


    </tr>

    </thead>

    <tbody>

    @foreach ($amount as $key => $amount_list )

    <tr>

        <td>{{ $key +1 }}</td>

        <td>{{ conversion_to_pound($amount_list->ad_amount) }}</td>

        <td>{{ $amount_list->ad_type == 2 ? 'Days' : 'Weeks' }}</td>

        <td>{{ $amount_list->updated_at }}</td>

        <td><span class=""><a href="javascript:void(0)"
                              data-toggle="modal"
                              data-target="#myModal"
                              class="edit_ad_amount"
                              data-id="{{  $amount_list->id }}"><i
                            class="fa fa-edit"> Edit</i></a></span>
            <span
                    class="destroy-element" data-service="{{$amount_list->id}}"> <a
                        href="javascript:void(0)" class="destroy-element"><i class="fa fa-trash"> Delete</i></a> </span>

            {!! Form::open(['url' => 'admin/advertisements_amount/destroy/'.$amount_list->id,'files' => true ,  'method' => 'get' ,'id' => 'delete-form-'.$amount_list->id]) !!}

            {!! Form::close() !!}
        </td>

    </tr>

    @endforeach

    </tbody>

</table>
<script> $('.edit_ad_amount').click(function () {

        var amount_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: APP_URL + '/admin/advertisements_update/' + amount_id,
            success: function (data) {
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });

    });
    $(".destroy-element").click(function(){
        var form_id = $(this).attr("data-service");
        swal({
                title: "Are you sure you want to delete?",
                text: "This data will be delete permanently.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete it.",
                cancelButtonText: "No, Cancel please.",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $("#delete-form-"+form_id).submit();        // submitting the form when user press yes
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            });
    });
    </script>