<div> @if(isset($amount)) {!! Form::model($amount, ['method' => 'PATCH','url' => ['admin/advertisement/update',
    $amount->id]]) !!} @else {!! Form::open(['url' => 'admin/advertisements/store','files' => true,'method' => 'post'])
    !!} @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group"><label>Advertisement type</label> {!!Form::select('ad_type',array('' =>
                'Select','1'=>'Weeks','2' => 'Days'),null,['id' => 'ad_type', 'class'=>'form-control'])!!} <span
                        class="text-danger ad_type_error"></span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group"><label>Advertisement amount ({{\Config::get('constants.currency')}})</label> {!! Form::text('ad_amount',isset($amount) ?
                conversion_pound_without_currency($amount->ad_amount) : null ,[ 'class'=>'form-control ' ,'placeholder' => 'Advertisement amount','id' => 'ad_amount']) !!} {!! Form::hidden('id',null,[ 'class'=>'form-control ' ,'id' => 'id'])
                !!} <span class="text-danger ad_amount_error"></span></div>
        </div>
    </div>
    <input type="hidden" value="{{ csrf_token() }}" name="_token">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group"> {!!Form::button(isset($amount) ? 'Update' : 'Save' ,array('class' => 'btn
                btn-primary submit_amount','id' => 'submit_amount' ))!!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>    var CSRF_TOKEN = $('input[name="_token"]').val();
    $(".submit_amount").click(function () {
        if ($('#ad_type').val() == "") {
            $('.ad_type_error').html('The ad_type field is null ');
            return false;
        }
        if ($('#ad_amount').val() == '') {
            $('.ad_amount_error').html('The ad_amount field is null ');
            return false;
        }
        $.ajax({
            /* the route pointing to the post function */
            url: APP_URL + '/admin/advertisements/store',
            type: 'POST', /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN,
                ad_amount: $('#ad_amount').val(),
                id: $('#id').val(),
                ad_type: $('#ad_type').val()
            }, /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                $('#dynamicContentLoad').modal('toggle');
                $('#datatable').html(data);
                $('#example1').DataTable();
            }
        });
    });</script>