<!-- la-homeheadertext -->
    <div id="la-home-header-text"> 
    {!! Form::open(['url' => 'admin/home_header_text','method' => 'post']) !!}
      <div class="form-group">
        <label>Header Text</label>
        {!!Form::text('header_text',(isset($data->header_text)) ? $data->header_text : null,['class'=>'form-control'])!!}
        {!! Form::hidden('id',(isset($data->id)) ? $data->id : '')!!}
        
      </div>
      <div class="form-group">
        {!!Form::submit('Submit',array('class' => 'btn btn-primary'))!!}  
      </div>
     {!! Form::close() !!}
    </div>
    <!-- la-homeheadertext end -->