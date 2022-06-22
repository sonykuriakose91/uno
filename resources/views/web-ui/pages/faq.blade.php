@extends('web-ui.layouts.app')

@section('content')
    <!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>FAQ</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> FAQ </p>
            </div>
        </div>
    </div>
</div>
<div class="inner-area">
    <div class="contact-first pl-72 faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 terms">
                    <h4>FAQ</h4>
                    @if($faqs != "")
                    <div class="panel-group" id="accordion">
                        @foreach($faqs as $key => $faq)
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}">{{ $faq->question }}</a>
                            </h4>
                          </div>
                          <div id="collapse{{ $key }}" class="panel-collapse collapse">
                            <div class="panel-body">{!! html_entity_decode($faq->answer) !!}</div>
                          </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p>Nothing found.!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection