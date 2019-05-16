@extends('layouts.provider_temp')@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="notification">
                <div class="box-header with-border">
                    <h3 class="box-title">User Feedback</h3>
                    {!! displayAlert() !!}

                    @foreach ($feedback as $feedback_list)

                    <div class="row" >

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
                    <input type="hidden" id="feedback_id" value="@if ($feedback!=null) {{$feedback_list['id']}} @endif">
                    <div id="load_more"></div>
                    <div id="load_more_null"></div>
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<script>
    $(window).scroll(function() {

        if($(window).scrollTop() == $(document).height() - $(window).height()) {
            var id = $('#feedback_id').val();
            $.ajax({
                url: 'load_feedback',
                type: 'post',
                data: {id:id},
                success: function(response){
                    if(response) {
                        $('#load_more').append(response);
                    }else {
                        $('#load_more_null').html("<div class='text-danger' align='center'><p>No more feedback's available.</p><div>");
                    }
                }
            });
        }
    });
</script>
@endsection