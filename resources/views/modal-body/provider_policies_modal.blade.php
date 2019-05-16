<div class="modal-body">
    {!! Form::open(['url'=>'provider/policies', 'method'=>'post','id' => 'policy_form']) !!} {!!
    Form::hidden('policy_type',$type) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group error">
                <textarea id="editor1" name="policy" rows="10" cols="70">{{ $policies ? $policies->policy : "" }}</textarea>
                <span class="error_message text-danger"></span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group text-center">
                <button type="button" class="btn btn-primary update_policy">Update</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

</div>
<script>

    $(".update_policy").click(function(){
        var messageLength = CKEDITOR.instances['editor1'].getData().replace(/<[^>]*>/gi, '').length;
        if( !messageLength ) {
            $('.error_message').html('Please enter the policy.');
            return false;
        }
         $("#policy_form").submit();

    });
</script>