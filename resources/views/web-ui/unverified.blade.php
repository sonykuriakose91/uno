<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('site_settings')->site_title }}</title>
    <link rel="canonical" href="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('ui/images/favicon.ico') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('ui/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('ui/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/css/jquery.fancybox.min.css') }}" />

    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('ui/css/jquery-ui.css') }}" /> -->
    <link type="text/css" rel="stylesheet" href="{{ asset('ui/css/responsive-tabs.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('ui/css/plugin.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('ui/css/reaction.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/aos.css"> -->

</head>
<body>
<header>
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="{{ route('ui-home') }}"><img src="{{ asset('ui/images/logo.svg') }}" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            
              <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">DIY Forum
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('diy-help') }}">DIY Help</a></li>
                      <!-- <li><a href="#">DIY Inspirations</a></li> -->
                    </ul>
                  </li>
                <li><a href="{{ route('jobs') }}">Jobs</a></li>
                <li><a href="{{ route('bazaarhome') }}">Bazaar</a></li>
                <li><a href="{{ route('packages') }}">Packages</a></li>
              </ul>
            </div>
            </nav>
    </div>
</header>
<div class="banner" id="bannerImg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Find a recommended tradesperson</h1>
                <p>The UK’s number one website for finding tradespeople</p>
            </div>
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                <form method="GET" action="./search">
                    <div class="search-area">
                        <div class="trade-search">
                            <input type="text" name="trade" placeholder="Trade (e.g. Electrician)">
                        </div>
                        <div class="postcode">
                            <button type="button" class="postcode-button">
                                <img src="{{ asset('ui/images/postcode.svg') }}">
                            </button>
                            <input type="text" required id="postcode" placeholder="Postcode">
                        </div>
                        <div class="distance">
                            <input type="number" required name="distance" placeholder="Distance in Kms">
                        </div>
                        <input type="hidden" name="lat" id="search_latitude" value="">
                        <input type="hidden" name="long" id="search_longitude" value="">
                        <button class="search-btn" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="services">
    <div class="container">
        <h2>Verify your account.!!</h2>
        <p class="text-center">Your account seems unverified. Please check you email for account verification.!</p>
    </div>
</div>

<!-- trader profile scroll close-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 f-address">
                <div class="f-logo">
                    <img src="{{ asset('ui/images/logo-footer.svg') }}" alt="logo">
                </div>
                <p>{!! substr(config('site_settings')->description,0,209) !!}</p>
                <div class="f-media">
                    <a href="{{ config('site_settings')->facebook_url }}" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="{{ config('site_settings')->twitter_url }}" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="{{ config('site_settings')->instagram_url }}" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="{{ config('site_settings')->google_plus_url }}" target="_blank"><i class="fa fa-google"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 f-nav">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                    <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 f-nav">
                <h4>&nbsp;</h4>
                <ul>
                    <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 f-newsletter">
                <h4>Newsletter</h4>
                <div class="text-field">
                    <input type="text" placeholder="Enter your mail">
                    <button><i class="fa fa-send"></i></button>
                </div>
                <div class="f-contact">
                    <ul>
                        <li><a href="tel:{{ config('site_settings')->phone_number }}"><img src="{{ asset('ui/images/phone-alt.svg') }}" alt="phone">{{ config('site_settings')->phone_number }}</a></li>
                        <li><a href="//{{ config('site_settings')->url }}" target="_blank"><img src="{{ asset('ui/images/globe.svg') }}" alt="url">{{ config('site_settings')->url }}</a></li>
                        <li><a href="mailto:{{ config('site_settings')->email }}"><img src="{{ asset('ui/images/email.svg') }}" alt="email">{{ config('site_settings')->email }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="copyright">
                    <p>Copyright © 2021 All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.3.1/parallax.min.js"></script>
<script type="text/javascript"  src="{{ asset('ui/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/js/login-register.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('ui/js/jquery.responsiveTabs.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/js/plugin.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/js/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/js/jquery.steps.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#bannerImg').parallax({
        imageSrc: '{{ isset($banner->banner_image)?asset("uploads/banners/".$banner->banner_image):asset("ui/images/banner.jpg") }}'
    });
    $('#bannerImgInner').parallax({
        imageSrc: '{{ asset("ui/images/about-banner.jpg") }}'
    });
});
    </script>
</body>
</html>