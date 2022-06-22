@extends('web-ui.layouts.app')

@section('content')
    <!-- banner area -->
<!-- banner area -->
<div class="inner-banner" id="bannerImg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Contact Us</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Contact Us </p>
            </div>
        </div>
    </div>
</div>

<!-- inner area -->
<div class="inner-area">
    <div class="contact-first pl-72">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                   <div class="spacing-6">
                       <h3>We’re Happy to Discuss Your Question and Answer</h3>
                       <ul>
                           <li>
                               <img src="{{ asset('ui/images/location-pin.svg') }}" alt="address">
                               <h6>Address</h6>
                               {!! html_entity_decode(config('site_settings')->address) !!}
                           </li>
                           <li>
                            <img class="sp-icon" src="{{ asset('ui/images/comment.svg') }}" alt="Email">
                            <h6>Email</h6>
                            <p>{{ config('site_settings')->email }}</p>
                        </li>
                        <li>
                            <img class="sp-icon" src="{{ asset('ui/images/phone-alt.svg') }}" alt="address">
                            <h6>Toll Free Number</h6>
                            <p>{{ config('site_settings')->phone_number }}</p>
                        </li>
                       </ul>
                   </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(Session::get('success'))
                    <div class="alert alert-success" role="alert">
                      {{ Session::get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    @if(Session::get('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('danger') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                   <div class="contact-form">
                        <h2>Let’s Start <br> The Conversation.</h2>
                        <form method="POST" action="{{ route('contactus') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xd-12">
                                    <input type="text" name="name" placeholder="Your Name" required="required">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xd-12">
                                    <input type="email" name="email" placeholder="Your Email" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xd-12">
                                    <input type="text" name="phone" placeholder="Your Phone" required="required">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xd-12">
                                    <input type="text" name="subject" placeholder="Subject" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xd-12">
                                    <textarea cols="40" name="message" rows="3" placeholder="Message" required="required"></textarea>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xd-12">
                                    <button type="submit"> MAKE A RESERVATION</button>
                                </div>                                
                            </div>
                        </form>
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15679.313681592805!2d76.18996555!3d10.74770355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1615200721424!5m2!1sen!2sin" height="300" style="border:0; width: 100%;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection