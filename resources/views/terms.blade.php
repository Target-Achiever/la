@extends('layouts.frontend_temp')

@section('content')
<!--/javascript:void(0)main-slider-->
        <div class="blog">
            <div class="container">
                <h3>Terms and Conditions </h3>
                <div class="divider"></div>
                <hr>
                <div class="blog_content">
                 {!! isset($terms->disclaimer) ? $terms->disclaimer : "" !!}
                </div>

            </div>
        </div>

@endsection
