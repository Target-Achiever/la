@if ($feedback!=null)
@if ($type == 'user_account')

    @forelse ($feedback as $user_feedback )

    <div class="row">

        <div class="col-md-2 text-center">

            @if( $user_feedback['photo'] )

            <img alt="" src="{{ asset('uploads/profile_photos/'.$user_feedback['photo'] )}}" class=" img-circle" width="70%"/>

            @else

            <h2>{{ substr(ucfirst($user_feedback['name']), 0, 1)  }}</h2>

            @endif

            <h5>{{ ucfirst( $user_feedback['name'] ) }}</h5>

        </div>

        <div class="col-md-10 comment-box">

            <p>{{ $user_feedback['feedback'] }}</p>

            <h6 align="right">
                                  <span class="text-info" >
                                      {!! App\Feedback::timeAgo($user_feedback['created_at'])  !!}</span></h6>

        </div>

    </div>

    @empty

    @endforelse

    <div align="center" id="remove-row">
        <button class="btn btn-primary"  data-type="user_account" data-id="{{ empty($user_feedback -> fb_id ) ? '' : $user_feedback -> fb_id }}" id="load_more_feedback"><i class="fa fa-refresh"></i> Load more </button>
    </div>

@elseif ($type == 'provider_overview')
<div id="load-data">
    @foreach ($feedback as $feedback_list)

    <div class="col-md-12 col-sm-12 feedback-list">

        <div class="com-md-2 col-sm-2 text-center">

            @if( $feedback_list['photo'] )

            <img class="img-circle" alt="" src="{{ asset('uploads/profile_photos/'.$feedback_list['photo']) }}" />

            @else

            <h2>{{ substr(ucfirst($feedback_list['name']), 0, 1)  }}</h2>

            @endif

            <h5>{{ $feedback_list['name'] }} </h5>

            <h6> {!! App\Feedback::timeAgo($feedback_list['created_at'])  !!}  </h6>

        </div>

        <div class="com-md-10 col-sm-10">

            <div class="feed-msg">

                <p>{{ $feedback_list['feedback'] }}</p>

            </div>

        </div>

    </div>

    @endforeach

    <!--Comment End-->

</div>

<div align="center" id="remove-row">
    <button class="btn btn-primary"  data-type="provider_overview" data-id="{{ empty($feedback_list -> fb_id ) ? '' : $feedback_list -> fb_id }}" id="load_more_feedback"><i class="fa fa-refresh"></i> Load more </button>
</div>
@endif

    <script>
        $("#load_more_feedback").on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var type = $(this).data('type');
            var provider_id = "";
            if(type == 'provider_overview'){
                provider_id = $('#provider_id').val();
            }
            $("#load_more_feedback").html("Loading....");
            $.ajax({
                url: APP_URL + '/load_more_feedback',
                method: "POST",
                data: {id: id,type:type,provider_id:provider_id},
                dataType: "text",
                success: function (data) {
                    if (data != '') {
                        $('#remove-row').remove();
                        $('#load-data').append(data);
                    }
                    else {
                        $('#load_more_feedback').html("No Data");
                    }
                }
            });
        });

    </script>
@endif
