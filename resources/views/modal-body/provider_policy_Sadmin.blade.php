<style>
    .policy-head {
        color: #fff;
        display: block;
        padding: 10px;
        position: relative;
        background: #10afec;
    }
    
    .box {
        position: relative;
        border-radius: 0px;
        background: #ffffff;
        border-top: 0;
        margin-bottom: 3px !important;
        width: 100%;
        box-shadow: none;
    }
    .policy-header
    {
    	background-color: #10afec !important;    	
    }
    .policy-header a {
        color: #fff !important;    	
    }
    
    .policy_box h3 {
        margin: 0;
    }
</style>@if(!empty($policies))
<div class="policy_box">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <!-- cancel -->@if(isset($policies['cancel']))
                    <h3>Cancel</h3>
                    <hr>
                    <div class="box-group" id="accordion">
                        <?php $i=0;?> @foreach($policies['cancel'] as $policy)
                            <?php            $i++;            ?>
                                <div class="panel box box-default">
                                    <div class="box-header policy-head with-border policy-header">
                                        <h4 class="box-title">                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse_cancel{{$i}}">                    [{{$policy->created_at}}]                  </a>                </h4>
                                        <!-- <div class="edit_policy" data-toggle="modal" data-target="#edit_policy{{$i}}"><i class="fa fa-pencil"></i></div> --></div>
                                    <div id="collapse_cancel{{$i}}" class="panel-collapse collapse <?php if($i==1) echo 'in';?>">
                                        <div class="box-body"> {!! $policy->policy !!} </div>
                                    </div>
                                </div> @endforeach </div> @endif
                    <!-- end -->
                    <!-- reschedule -->@if(isset($policies['reschedule']))
                    <h3>Reschedule</h3>
                    <hr>
                    <div class="box-group" id="accordion">
                        <?php $i=0;?> @foreach($policies['reschedule'] as $policy)
                            <?php            $i++;            ?>
                                <div class="panel box box-default">
                                    <div class="box-header with-border policy-header">
                                        <h4 class="box-title">                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse_reschedule{{$i}}">                    [{{$policy->created_at}}]                  </a>                </h4>
                                        <!-- <div class="edit_policy" data-toggle="modal" data-target="#edit_policy{{$i}}"><i class="fa fa-pencil"></i></div> --></div>
                                    <div id="collapse_reschedule{{$i}}" class="panel-collapse collapse <?php if($i==1) echo 'in';?>">
                                        <div class="box-body"> {!! $policy->policy !!} </div>
                                    </div>
                                </div> @endforeach </div> @endif
                    <!-- end -->
                    <!-- dissatisfaction -->@if(isset($policies['dissatisfaction']))
                    <h3>Dissatisfaction</h3>
                    <hr>
                    <div class="box-group" id="accordion">
                        <?php $i=0;?> @foreach($policies['dissatisfaction'] as $policy)
                            <?php            $i++;            ?>
                                <div class="panel box box-default">
                                    <div class="box-header with-border policy-header">
                                        <h4 class="box-title">                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse_dissatisfaction{{$i}}">                    [{{$policy->created_at}}]                  </a>                </h4>
                                        <!-- <div class="edit_policy" data-toggle="modal" data-target="#edit_policy{{$i}}"><i class="fa fa-pencil"></i></div> --></div>
                                    <div id="collapse_dissatisfaction{{$i}}" class="panel-collapse collapse <?php if($i==1) echo 'in';?>">
                                        <div class="box-body"> {!! $policy->policy !!} </div>
                                    </div>
                                </div> @endforeach </div> @endif
                    <!-- end -->
                </div>
            </div>
        </div>
    </div>
</div>@endif