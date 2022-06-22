@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>{{ $provider->name }}</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> {{ $provider->name }} </p>
            </div>
        </div>
    </div>
</div>

<!-- inner area -->
<div class="inner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- profile area -->
                <div class="profile-sec">
                    <div class="profile-head">
                        <div class="profile-img"><img src="{{ asset('uploads/providers/profile/'.$provider->profile_pic) }}" alt="profile"></div>
                        <div class="barcode"><img src="{{ asset('uploads/providers/qrcode/'.$provider->qrcode) }} " alt="barcode"></div>
                    </div>
                    <div class="profile-details">
                        <div class="name-sec">
                            <h5>{{ $provider->name }}</h5>
                            <p>{{ $provider->providercategories[0]->getcategory->category }} <span>ID : {{ $provider->username }}</span></p>
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                            <a href="{{ route('edit-trader-profile',$provider->id) }}">Edit Profile</a>
                            @endif
                        </div>
                        <!-- <div class="star-rating">
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star"></i>
                        </div> -->
                        <div class="contact-details">
                            <ul>
                                <li><img src="{{ asset('ui/images/icon-whatsapp.svg') }}" alt="whatsapp">+{{ $provider->country_code }} {{ $provider->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-phone.svg') }}" alt="phone">+{{ $provider->country_code }} {{ $provider->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-email.svg') }}" alt="email">{{ $provider->email }}</li>
                                <li><img src="{{ asset('ui/images/icon-web.svg') }}" alt="website">{{ $provider->web_url }}</li>
                                <li><img src="{{ asset('ui/images/icon-time.svg') }}" alt="time">{{ date('h:i A',$provider->available_time_from) .' - '. date('h:i A',$provider->available_time_to) }}</li>
                                <li><img src="{{ asset('ui/images/icon-map.svg') }}" alt="map"><a href="https://maps.google.com/maps?q={{ $provider->location.'&sll'.$provider->loc_latitude.','.$provider->loc_longitude }}" target="_blank">{{ $provider->location }}</a></li>
                                <li><img src="{{ asset('ui/images/landmark.svg') }}" alt="map"><a href="#">{{ $provider->landmark }}</a></li>
                            </ul>
                            <div class="landmark">
                                <p>{{ $provider->landmark_data }}</p>
                            </div>
                        </div>
                        <!-- <div class="details-btn">
                            <button class="get-quote">Quotes</button>
                        </div> -->
                    </div>
                </div>
                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                @include('web-ui.trader.trader-menu')
                @endif
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="trader-dashboard">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding4">
                            <a href="{{ route('traderdetails', $provider->username) }}">
                                <div class="cmn-box bg1">
                                    <div class="box-image">
                                        <img src="{{ asset('ui/images/account.svg') }}" alt="image">
                                    </div>
                                    <h5>Account Manager</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding4">
                            <a href="{{ route('edit-trader-profile',$provider->id) }}">
                                <div class="cmn-box bg2">
                                    <div class="box-image">
                                        <img src="{{ asset('ui/images/profile.svg') }}" alt="image">
                                    </div>
                                    <h5>My Profile</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding4">
                            <a href="{{ route('trader-appointments') }}">
                                <div class="cmn-box bg3">
                                    <div class="box-image">
                                        <img src="{{ asset('ui/images/appointment.svg') }}" alt="image">
                                    </div>
                                    <h5>Appointments</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding4">
                            <a href="">
                                <div class="cmn-box bg4">
                                    <div class="box-image">
                                        <img src="{{ asset('ui/images/history.svg') }}" alt="image">
                                    </div>
                                    <h5>Service History</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding4">
                            <a href="">
                                <div class="cmn-box bg5">
                                    <div class="box-image">
                                        <img src="{{ asset('ui/images/comments.svg') }}" alt="image">
                                    </div>
                                    <h5>Service Comments</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding4">
                            <a href="{{ route('userlogout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('userlogout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <div class="cmn-box bg6">
                                    <div class="box-image">
                                        <img src="{{ asset('ui/images/logout.svg') }}" alt="image">
                                    </div>
                                    <h5>Logout</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection