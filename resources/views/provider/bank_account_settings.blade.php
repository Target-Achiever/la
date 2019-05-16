@extends('layouts.provider_temp')







@section('content')



<?php



//alert()->success('You have been logged out.', 'Good bye!');



?>



<!-- Content Wrapper. Contains page content -->
<style type="text/css">
    @media(max-width: 767px)
    {
        .dob
        {
            margin-bottom: 15px;
        }
    }
</style>


<div class="content-wrapper">



    <!-- Main content -->



    <section class="content">



        <div class="alert alert-info">



            <p>Note : You can only create one payment account</p>



        </div>





        {!! displayAlert() !!}



        <div id="error_msg_sort"></div>

        <h3 class="box-title">Create/Manage bank account</h3>







        <div class='row'>


            <div class="col-md-12 col-sm-12">


            <script src='https://js.stripe.com/v2/' type='text/javascript'></script>

            @if(!empty($info))

            <!-- <div class="remove_account"><a href="{{url('provider/remove-stripe-bank-account').'/'.$info['user_id']}}" class="remove_bank_account">Remove account and create new</a></div>   -->

            {!! Form::model($info, ['method' => 'PATCH','url' => ['provider/bank-account', Auth::user()->id]]) !!}



            @else

            {!! Form::open(['url' => 'provider/bank-account','method' => 'post','class' => 'form-horizontal']) !!}

            @endif



            <div class="form-group required">

                <label class="control-label col-sm-2" for="email">Banking Society name</label>

                <div class="col-sm-8">

                    <input class='form-control'  size='20' type='text' name="bank_name" value="{{(isset($info['bank_name'])) ? $info['bank_name'] : old('bank_name')}}">



                    @if ($errors->has('bank_name'))



                    <div class="text-danger" id="">{{ $errors->first('bank_name') }}</div>



                    @endif

                </div>

            </div>

            <div class="form-group required">

                <label class="control-label col-sm-2" for="email">Account number</label>

                <div class="col-sm-8">

                    <input class='form-control' id="Banking" size='20' type='text'

                           name="account_number" value="{{(isset($info['account_number'])) ? $info['account_number'] : old('account_number')}}">



                    @if ($errors->has('account_number'))



                    <div class="text-danger" id="">{{ $errors->first('account_number') }}</div>



                    @endif

                </div>

            </div>

            <div class="form-group required">

                <label class="control-label col-sm-2" for="email">Sort code</label>

                <div class="col-sm-8">



                    <input class='form-control' id="Sort" size='20' type='text' name="sort_code"

                           value="{{(isset($info['sort_code'])) ? $info['sort_code'] : old('sort_code')}}">
                    <span id="error_msg_span"></span>



                    @if ($errors->has('sort_code'))



                    <div class="text-danger" >{{ $errors->first('sort_code') }}</div>



                    @endif

                </div>

            </div>

            <div class="form-group required">

                <label class="control-label col-sm-2" for="email">Account type</label>

                <div class="col-sm-8">

                    <select class="form-control" name="entity_type">



                        <option value="individual">Individual</option>



                        <option value="company">Company</option>



                    </select>



                    @if ($errors->has('entity_type'))



                    <div class="text-danger">{{ $errors->first('entity_type') }}</div>



                    @endif

                </div>

            </div>

            <div class="form-group required">

                <label class="control-label col-sm-2" for="email">First name</label>

                <div class="col-sm-8">

                    <input autocomplete='off' class='form-control' size='4' type='text' name="entity_first_name" value="{{(isset($info['entity_first_name'])) ? $info['entity_first_name'] : old('entity_first_name')}}">



                    @if ($errors->has('entity_first_name'))



                    <div class="text-danger">{{ $errors->first('entity_first_name') }}</div>



                    @endif

                </div>

            </div>

            <div class="form-group required">

                <label class="control-label col-sm-2" for="email">Last name</label>

                <div class="col-sm-8">

                    <input class='form-control' size='4' type='text' name="entity_last_name" value="{{(isset($info['entity_last_name'])) ? $info['entity_last_name'] : old('entity_last_name')}}">



                    @if ($errors->has('entity_last_name'))



                    <div class="text-danger">{{ $errors->first('entity_last_name') }}</div>



                    @endif



                </div>

            </div>

            <div class="form-group required">

                <label class="control-label col-sm-2" for="email">Date of birth</label>

                <div class="col-sm-2">
                    <div class="dob">
                    <input placeholder="Day" autocomplete='off' class='form-control' size='4' type='text' name="entity_dob_day" value="{{(isset($info['entity_dob_day'])) ? $info['entity_dob_day'] : old('entity_dob_day')}}">



                    @if ($errors->has('entity_dob_day'))



                    <div class="text-danger ">{{ $errors->first('entity_dob_day') }}</div>



                    @endif


                    </div>
                </div>

                <div class="col-sm-2">
                     <div class="dob">
                    <input placeholder="Month" class='form-control card-expiry-month' size='2' type='text' name="entity_dob_month" value="{{(isset($info['entity_dob_month'])) ? $info['entity_dob_month'] : old('entity_dob_month')}}">



                    @if ($errors->has('entity_dob_month'))



                    <div class="text-danger">{{ $errors->first('entity_dob_month') }}</div>



                    @endif


                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="dob">
                    <input placeholder="Year" class='form-control card-expiry-year' size='4' type='text' name="entity_dob_year" value="{{(isset($info['entity_dob_year'])) ? $info['entity_dob_year'] : old('entity_dob_year')}}">



                    @if ($errors->has('entity_dob_year'))



                    <div class="text-danger">{{ $errors->first('entity_dob_year') }}</div>



                    @endif
                </div>
                </div>

            </div>

            @if(empty($info))

            <div class="form-group">

                <div class="col-sm-offset-2 col-sm-10">

                    <button class='btn btn-primary submit-button' type='submit'>Submit </button>

                </div>

            </div>

            @else

            <div class="form-group">

                <div class='alert-danger alert'>

                    Please correct the errors and try again.



                </div>

            </div>



            @endif



            <!-- <div class='form-row'>



              <div class='col-xs-12 form-group card required'>



                <label class='control-label'>Country</label>



                <input autocomplete='off' class='form-control' size='4' type='text' name="country" value="{{(isset($info['country'])) ? $info['country'] : old('country')}}">



                @if ($errors->has('country'))



                 <div class="error">{{ $errors->first('country') }}</div>



                @endif



              </div>



            </div> -->



            <!-- <div class='form-row'>



              <div class='col-xs-12 form-group card required'>



                <label class='control-label'>State</label>



                <input autocomplete='off' class='form-control' size='4' type='text' name="entity_state" value="{{(isset($info['entity_state'])) ? $info['entity_state'] : old('entity_state')}}">



                @if ($errors->has('entity_state'))



                 <div class="error">{{ $errors->first('entity_state') }}</div>



                @endif



              </div>



            </div>



            <div class='form-row'>



              <div class='col-xs-12 form-group card required'>



                <label class='control-label'>City</label>



                <input autocomplete='off' class='form-control' size='4' type='text' name="entity_city" value="{{(isset($info['entity_city'])) ? $info['entity_city'] : old('entity_city')}}">



                @if ($errors->has('entity_city'))



                 <div class="error">{{ $errors->first('entity_city') }}</div>



                @endif



              </div>



            </div>



            <div class='form-row'>



              <div class='col-xs-12 form-group card required'>



                <label class='control-label'>Zip code</label>



                <input autocomplete='off' class='form-control' size='4' type='text' name="entity_postal_code" value="{{(isset($info['entity_postal_code'])) ? $info['entity_postal_code'] : old('entity_postal_code')}}">



                @if ($errors->has('entity_postal_code'))



                 <div class="error">{{ $errors->first('entity_postal_code') }}</div>



                @endif



              </div>



            </div>  -->







            <!-- legal entity end-->









            </form>






           </div> 
        </div>



    </section>



    <!-- /.content -->



</div>



<!-- /.content-wrapper -->



<!-- /.control-sidebar -->



<!-- Add the sidebar's background. This div must be placed



   immediately after the control sidebar -->



<div class="control-sidebar-bg"></div>



<!-- </div> -->



<!-- ./wrapper -->



@endsection



