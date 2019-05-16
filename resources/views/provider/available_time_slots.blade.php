<style type="text/css">    .time {
        border: 1px solid #fff;
        padding: 5px;
        border-radius: 3px;
        margin: 10px 5px;
        cursor: pointer;
    }

    .time:hover {
        background-color: #10afec;
        border-color: transparent;
        color: #fff;
    }

    .select_time {
        padding: 0 30px;
    }

    .btn.active {
        box-shadow: none;
    }

    .select_time label {
        font-weight: normal;
    }
    .time-notify
    {
        margin-left: 15px;
    }
</style>



<!-- time slots -->
<div class="row" id="session">
    <div class="col-md-12 col-sm-12 col-xs-12 time-cols">
            {!! isset($serviceSettings) ? '' : '<h5>Select a time slot to book an appointment: </h5>' !!}

            @if(!empty($serviceSettings))
            <div class="alert alert-warning time-notify">
                {{$serviceSettings}}
            </div>
            @else
                @if(!empty($slots))
                    @foreach($slots as $key => $slot)
                    <div class="col-xs-3 col-md-3 col-lg-2 col-sm-6 time_list" align="center">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn time">
                                <input type="radio"
                                       name="appointment_time_from"
                                       class="option1"
                                       value="{{$slot}}"
                                       autocomplete="off">
                                {{$slot}} </label>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="alert alert-warning time-notify">No time slots available for this day.</div>
                @endif
            @endif
    </div>
</div>
                               <!-- time slot end -->