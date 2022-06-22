@extends('web-ui.layouts.app')

@section('content')
    <!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>{{ $page_data->title }}</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> {{ $page_data->title }} </p>
            </div>
        </div>
    </div>
</div>
<div class="inner-area">
    <div class="contact-first pl-72">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 terms">
                    <h4>{{ $page_data->title }}</h4>
                    {!! html_entity_decode($page_data->contents) !!}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection