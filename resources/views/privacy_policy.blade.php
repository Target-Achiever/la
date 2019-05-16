@extends('layouts.frontend_temp')

@section('content')
<!--/javascript:void(0)main-slider-->
        <div class="blog">
            <div class="container">
                <h3> Privacy and Policy </h3>
                <div class="divider"></div>
                <hr>
                <div class="blog_content">
                 {!! isset($privacy_policy->disclaimer) ? $privacy_policy->disclaimer : "" !!}
                </div>

            </div>
        </div>

@endsection
