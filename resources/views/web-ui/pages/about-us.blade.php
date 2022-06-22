@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>{{ $about_us->title }}</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> {{ $about_us->title }} </p>
            </div>
        </div>
    </div>
</div>

<!-- inner area -->
<div class="inner-area">
    <div class="about-first pl-72">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="aboutImg">
                        <img src="{{ asset('ui/images/about.jpg') }}" alt="about">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="inner-about-sec pl-45">
                        <h5>{{ $about_us->title }}</h5>
                        <p>{!! html_entity_decode($about_us->contents) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($mission != "" || $vision != "")
    <div class="about-second">
        <div class="container">
            <div class="row">
                @if($mission != "")
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="cmn-sec">
                        <div class="about-txt">
                            <h4>{{ $mission->title }}</h4>
                            <p>{!! html_entity_decode($mission->contents) !!}</p>
                        </div>
                        <div class="mv-img">
                            <img src="{{ asset('ui/images/mission.jpg') }}" alt="mission">
                        </div>
                    </div>
                </div>
                @endif
                @if($vision != "")
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="cmn-sec">
                        <div class="mv-img">
                            <img src="{{ asset('ui/images/vision.jpg') }}" alt="mission">
                        </div>
                        <div class="about-txt">
                            <h4>{{ $vision->title }}</h4>
                            <p>{!! html_entity_decode($vision->contents) !!}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@endsection