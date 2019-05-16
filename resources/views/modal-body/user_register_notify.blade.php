
<div class="box-body" >
    <div class="manage_user_view">
        @foreach ($users as $user_list)
        <div class="row">
            <div class="col-md-4 col-sm-4  text-center user-pro">
                <div class="form-group">
                    <img src="{{ $user_list->photo ? asset('uploads/profile_photos/'.$user_list->photo) : asset('uploads/profile_photos/user_profile.png') }}" class="img-circle"></img>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 user-pro">
                <div class="col-md-12 col-sm-12">
                    <label>Name</label>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {{ ucfirst($user_list->name) }}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 user-pro">
                <div class="col-md-12 col-sm-12">
                    <label>Email</label>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {{ ucfirst($user_list->email) }}
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-3 col-sm-3 user-pro">
                <div class="col-md-12 col-sm-12">
                    <label>User Type</label>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {!! $user_list->user_type == 'end_user' ? "End user" : ucfirst($user_list->user_type) !!}
                    </div>
                </div>
            </div>

        </div>
        </div>



        @endforeach

    </div>
</div>
