@extends('layouts.frontend_temp')

@section('content')
        <div class="container feedback">   
            {!! displayAlert() !!}         
            <section class="feedback_cols">
                <div class="feedback_title text-center">
                    <h3>Feedback</h3>
                    <div class="feed_divide"></div>
                </div>
                <!-- feedback list -->
                @forelse($feedbacks as $feedback)
                <div class="row feedback_list">
                    <div class="feedback_col">
                        <div class="col-sm-3 col-md-3 feedback_img">
                            <img src="{{($feedback['photo'] !='' && File::exists(public_path('uploads').'/profile_photos/'.$feedback['photo'])) ? asset('uploads').'/profile_photos/'.$feedback['photo'] : asset('uploads').'/profile_photos/user_profile.png'}}" class="img-circle" width="150" height="150">  
                           <div class="title text-center">
                                <h3>{{$feedback->name}}</h3>
                                <h3>{{date('Y-m-d H:i',strtotime($feedback->created_at))}}</h3>
                            </div>
                        </div>
                        <div class="col-sm-9 col-md-9 feedback_info">
                            <p>
                                {{$feedback->feedback}}
                            </p>                               
                        </div>
                    </div>
                </div>                              
                <hr>
                @empty
                <p class="no-collection">no feedback</p>
                @endforelse
                {{$feedbacks->links()}}
                 <!--feedback list end-->
                           <!-- user feedback -->
                           <div class="user-feedback">
                            {!! Form::open(['url' => 'user_feedback_save','method' => 'post']) !!}
                               <textarea id="user-feedback-frm" name="feedback" class="form-control"></textarea>
                               {!!Form::submit('Submit',array('class' => 'btn btn-primary'))!!}
                            {!! Form::close() !!}
                           </div>
                           <!--  -->
                }
            </section>
        </div>       
@endsection    
        