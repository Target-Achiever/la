@extends('../layouts.admin_temp')



@section('content')

<div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

        <!-- SELECT2 EXAMPLE -->

        <div class="box paymeny_history">

            <div class="box-header with-border">

                <h3 class="box-title">Notifications</h3>



                {!! displayAlert() !!}

                <div class="notification_box">

                    @forelse($notifications as $notify)

                    <div class="alert {{($notify->notify_status == 2) ? 'alert-info' : 'alert-default'}} " id="notif-id-{{$notify->id}}"
                    >

                        <button type="button" data-noti-id="{{$notify->id}}" class="close remove-notification" data-dismiss="alert-" aria-hidden="true">x</button>

                        <a href="javascript:void(0)" style="text-decoration: none" data-noti-from="{{$notify->notify_action_from}}"

                           data-noti-id="{{$notify->id}}"


                           data-noti-type="{{$notify->notify_action_type}}" class="notification_bar"><h4>

                                {{$notify->notification_message}}

                            </h4></a>
                        <h6 style="color: #5c6a6c"><i class="fa fa-clock-o"></i> {!! App\Feedback::timeAgo($notify->created_at)  !!}</h6>


                    </div>

                    @empty

                    <div class="alert alert-warning alert-white rounded notify"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> <div class="icon"> <i class="fa fa-exclamation-triangle"></i> </div>No notification found</div>

                    @endforelse

                    {{$notifications->links()}}

                    <!-- <div class="row">

                     <div class="col-md-8 col-md-offset-2">

                         <div class="form-group text-center">

                           <button class="btn btn-primary"> Load more</button>

                        </div>

                     </div>

                    </div> -->

                </div>



            </div>

        </div>

        <input type="hidden" value="{{ csrf_token() }}" name="_token">

        <!-- /.box -->

    </section>

    <!-- /.content -->

</div>

<script> $('#badge').hide();</script>



@endsection

