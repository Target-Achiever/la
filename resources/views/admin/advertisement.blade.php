@extends('layouts.admin_temp')@section('content')<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">   <!-- Main content -->
    <section class="content">      <!-- SELECT2 EXAMPLE -->
        <div class="notification">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-9 col-sm-9"><h3 class="box-title">Advertisements</h3></div>
                </div>
                <div class="alert alert-success set-updated" style="display: none"></div>
                {!! displayAlert() !!}
                <div class="advertisment">
                    <div class="col-md-12">                  <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <div class="tab-content- ads-tab">                        <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">                               <!-- foreach -->
                                        @forelse($ads as $ad)
                                        <div class="col-md-6">
                                            <div class="hover ehover2">
                                                <div class="info-box">
                                                    <div class="ads-box-content">
                                                        <div class="ad-banner"><img
                                                                    src="{{($ad->ad_banner !='' && File::exists(public_path('uploads').'/ad_banner/'.$ad->ad_banner)) ? asset('uploads').'/ad_banner/'.$ad->ad_banner : asset('uploads').'/ad_banner/no_banner.png'}}"
                                                                    width="100%" >
                                                            <div class="overlay"><h2>{{$ad->ad_header}}</h2>
                                                                <a href="javascript:void(0)" class="modal-view-ad"
                                                                   data-ad="{{$ad->id}}">
                                                                    <button class="info" data-toggle="modal"
                                                                            data-target="#modal-default">View
                                                                    </button>
                                                                </a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="alert alert-warning alert-white rounded notify">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                                                ×
                                            </button>
                                            <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
                                            No advertisement created
                                        </div>
                                        @endforelse                                 <!-- endforeach -->
                                    </div>
                                </div>                        <!-- /.tab-pane -->                     </div>
                            <!-- /.tab-content -->                  </div>                  <!-- nav-tabs-custom -->
                    </div>
                </div>
            </div>
        </div>      <!-- /.box -->   </section>   <!-- /.content --></div><!-- /.content-wrapper -->         @endsection