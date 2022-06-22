@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Packages</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Packages </p>
            </div>
        </div>
    </div>
</div>

<!-- inner area -->

<div class="inner-area over-flow">
    <div class="container">
        <div class="pricing-sec">
            <div class="row">
                @if(count($packages) > 0)
                @foreach($packages as $key=> $package)
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="box-sec">
                        <div class="pricing-header">
                            <h3>{{ $package->package_name }}</h3>
                            <h4>${{ $package->price }}<span>/{{ ($package->price_type == "Monthly")?"Month":"Year" }}</span></h4>
                        </div>
                        <div class="pricing-feature-list">
                            {!! html_entity_decode($package->description) !!}
                        </div>
                        <div class="link">
                            <a href="javascript:;">Buy Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>No packages found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection