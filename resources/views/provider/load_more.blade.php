@if ($feedback != null)
                    @foreach ($feedback as $feedback_list)
                    <div class="row">
                        <div class="col-sm-1 col-lg-offset-1">
                            <div class="thumbnail">
                                @if( $feedback_list['photo'] )
                                <img class="img-responsive user-photo" src="{{ asset('uploads/profile_photos/'.$feedback_list['photo']) }}" />                                      @else
                                <h2 class="text-center">{{ substr(ucfirst($feedback_list['name']), 0, 1)  }}</h2>
                                @endif
                            </div>
                            <!-- /thumbnail -->
                        </div>
                        <!-- /col-sm-1 -->
                        <div class="col-sm-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ ucfirst($feedback_list['name']) }}</strong>
                                    <span class="text-muted">commented
                                        {!! App\Feedback::timeAgo($feedback_list['created_at'])  !!}
                                    </span>
                                </div>
                                <div class="panel-body">
                                    {{ $feedback_list['feedback'] }}
                                </div>
                                <!-- /panel-body -->
                            </div>
                            <!-- /panel panel-default -->
                        </div>
                        <!-- /col-sm-5 -->
                    </div>
                    <!-- /row -->
                    @endforeach


<script>
    $('#feedback_id').val('{{$feedback_list["fb_id"]}}');
</script>

@endif