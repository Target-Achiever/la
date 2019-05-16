<div>
    <div class="ad-banner modal-view-ad col-md-6"><img
                src="{{($ad->ad_banner !='' && File::exists(public_path('uploads').'/ad_banner/'.$ad->ad_banner)) ? asset('uploads').'/ad_banner/'.$ad->ad_banner : asset('uploads').'/ad_banner/no_banner.png'}}"
                width="100%"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"><label>Ad payment status</label> <input class="form-control" readonly
                                                                            value=" {{($ad->ad_payment_status) ? 'Paid' : 'Not-paid'}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group"><label>Username</label> <input class="form-control" readonly value="{{$ad->name}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"><label>Ad header</label> <input class="form-control" readonly
                                                                    value=" {{$ad->ad_header}}"></div>
        </div>
        <div class="col-md-6">
            <div class="form-group"><label>Ad description</label> <input class="form-control" readonly
                                                                         value=" {{$ad->ad_description}}"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"><label>Service</label> <input class="form-control" readonly
                                                                  value=" {{$ad->ad_service}} "></div>
        </div>
        <div class="col-md-6">
            <div class="form-group"><label>Period from and to </label> <input class="form-control" readonly
                                                                  value="{{date('Y-m-d H:i',strtotime($ad->period_from))}} to {{date('Y-m-d H:i',strtotime($ad->period_to))}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group"> @if($ad->ad_status == 4) <a
                        href="{{url('admin/advertisements/change_ad_status').'/'.$ad->id.'/1'}}"
                        class="change_row_status">
                    <button class="btn btn-primary">Activate</button>
                </a> @elseif($ad->ad_status == 1) <a
                        href="{{url('admin/advertisements/change_ad_status').'/'.$ad->id.'/4'}}"
                        class="change_row_status">
                    <button class="btn btn-primary">De-activate</button>
                </a> @endif
            </div>
        </div>
    </div>
</div>