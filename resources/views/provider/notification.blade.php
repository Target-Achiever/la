@extends('layouts.provider_temp')

<style>
    .pointer {
        cursor: pointer;
    }
</style>

@section('content')

      <div class="wrapper">

         <div class="content-wrapper">

            <!-- Main content -->

            <section class="content">

               <!-- SELECT2 EXAMPLE -->

               {!! displayAlert() !!}

               <div class="notification">

                  <div class="box-header with-border">

                     <h3 class="box-title">Notifications</h3>        

                      

                     <div class="notification_box">

                        @forelse($notifications as $notify)

                          <div class="pointer {{($notify->notify_status == 1) ? 'notification-1' : 'notification-2'}} alert {{($notify->notify_status == 2) ? 'alert-info' : 'alert-default'}} alert-dismissible notification_bar" data-noti-id="{{$notify->id}}" data-noti-type="{{$notify->notify_action_type}}" id="notification_box_{{$notify->id}}">

                            <button type="button" data-noti-id="{{$notify->id}}" class="close remove-notification" data-dismiss="alert-" aria-hidden="true">&times;</button>

                            <h4 data-toggle="modal-" data-target="">

                                {{$notify->notification_message}}

                            </h4>
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

               <!-- /.box -->

            </section>

            <!-- /.content -->

         </div>

         <!-- /.content-wrapper -->         

         <!-- /.control-sidebar -->

         <!-- Add the sidebar's background. This div must be placed

            immediately after the control sidebar -->

         <div class="control-sidebar-bg"></div>

      </div>

      <!-- ./wrapper -->

      <!-- jQuery 3 -->

      <!--.modal -->

      <div class="modal fade" id="modal-default">

          <div class="modal-dialog">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span></button>               

              </div>

              <div class="modal-body">

                 

              </div>     <!-- /.modal-body-closed -->         

            </div>

            <!-- /.modal-content -->

          </div>

          <!-- /.modal-dialog -->

        </div>

      <!-- /.modal -->

<script> $('#badge').hide();</script>



 @endsection    