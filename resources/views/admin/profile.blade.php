@extends('layouts.admin_temp')



@section('content')


<div class="content-wrapper">

<div class="container">

  <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">

        {!! displayAlert() !!}

          

          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">

              <!-- flight section -->

              <div class="bhoechie-tab-content active">

                @if (count($errors) > 0)

                         <div class = "alert alert-danger">

                            <ul>

                               @foreach ($errors->all() as $error)

                                  <li>{{ $error }}</li>

                               @endforeach

                            </ul>

                         </div>

                      @endif

                <h4>Profile:</h4>

                <div class="text-center admin-profile">


                          @if(!empty($profile))
                          <img class="img-circle" id="displayImage" src="{{($profile->photo !='' && File::exists(public_path('uploads').'/profile_photos/'.$profile->photo)) ?

                          asset('uploads').'/profile_photos/'.$profile->photo : asset('uploads').'/profile_photos/default_user.png'}}">
                          @endif

                          {!!Form::open(['url' => 'admin/save_profile','method' => 'post','files' => true ,'id' => 'admin_update'])!!}

                       <div class="form-group">

                        <label class="btn-bs-file btn btn-sm btn-success">

                          Choose Profile Image

                          {!!Form::file('profile',array('id' => 'imgInp') )!!}

                        </label>

                       </div>

                </div>

                  <!-- <form class="profile" action="#" method="post"> -->



                      <div class="row">

                        <div class="col-md-6 col-md-offset-3">

                            <div class="form-group">

                              <lable>Name:</lable>

                              <input type="text" name="user_name" placeholder="Name" class="form-control" value="{{isset($profile) ? $profile->name : old('user_name')}}">

                              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                              <span class="text-danger">{{ $errors->first('user_name') }}</span>

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6 col-md-offset-3">

                            <div class="form-group">

                              <lable>Old Password:</lable>

                              <input type="password" name="old_password" placeholder="Old Password" class="form-control">

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6 col-md-offset-3">

                            <div class="form-group">

                              <lable>New Password:</lable>

                              <input type="password" name="new_password" placeholder="New Password" class="form-control">

                            </div>

                        </div>

                      </div>

                      <div class="row">
                        <div class="col-md-6 col-md-offset-3">

                            <div class="form-group">

                              <lable>Confirm Password:</lable>

                              <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">

                            </div>

                        </div>
                      </div>

                      <div class="row">

                        <div class="col-md-8 col-md-offset-2">

                            <div class="form-group text-center">

                              <button type="submit" class="btn btn-primary" id="update_profile">Update</button>

                              <!-- <button class="btn btn-primary" id="cancel"> Cancel</button> -->

                            </div>

                        </div>

                      </div>

                  <!-- </form> -->

                  {!!Form::close()!!}

              </div>

              <!--Feedback-->

          </div>

      </div>

    </div>

  </div>

</div>

@endsection

@section('inline-scripts')
$(document).ready(function()
{
   //------------------------------------profile image preview
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#displayImage').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").on('change', function(){
    
        readURL(this);
    });
    //----------------------------------------------------------
});    
@endsection