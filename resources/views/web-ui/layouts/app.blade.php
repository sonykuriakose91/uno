<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('site_settings')->site_title }}</title>
    <link rel="canonical" href="">
    <meta name="description" content="UnoTraders">
    <meta name="keywords" content="UnoTraders">
    <meta name="author" content="UnoTraders">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('ui/images/favicon.ico') }}">
    @if(request()->is('trader/profile/*'))
    <meta property="og:image" content="{{ asset('uploads/providers/profile/'.$provider->profile_pic) }}"/>
    <meta property="og:title" content="{{ $provider->name }}"/>
    <meta property="og:url" content="{{ route('traderdetails',$provider->username) }}"/>
    <meta property="og:description" content="{{ $provider->completed_works }}"/>
    @endif
    @if(request()->is('product/details/*'))
    <meta property="og:image" content="{{ asset('uploads/bazaar/products/'.$product->bazaarimages[0]->product_image) }}"/>
    <meta property="og:title" content="{{ $product->product }}"/>
    <meta property="og:url" content="{{ route('product-details', $product->id) }}"/>
    <meta property="og:description" content="{!! html_entity_decode($product->description) !!}"/>
    @endif
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
<style type="text/css">
    .error { 
        color: #f20606; 
    } 
</style>
<style type="text/css">
    input[type="file"] {
  display: block;
}
</style>
</head>
<body>
<div id="fb-root"></div>
<script src="https://connect.facebook.net/en_US/sdk.js" nonce="XLB44uyG"></script>
<script nonce="XLB44uyG">
  FB.init({
    appId   : 969102167101347,
    status  : true,
    xfbml   : true,
    version : 'v2.9'
  });
  FB.AppEvents.logPageView();
</script>
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
            <div class="location">
                <button id="current_location" onclick="getcurrentLocation()"><img src="{{ asset('ui/images/location.svg') }}" /></button>
                <input type="text" placeholder="Current Location" id="currentPosition">
                <input type="hidden" id="currentLatitude">
                <input type="hidden" id="currentLongitude">
            </div>

              @if(Auth::guard('web')->check())
            <div class="my-profile">
                  <div class="profile-view">
                    <div class="user-profile">
                        <div class="user-image">
                            <?php
                                if(Auth::guard('web')->user()->user_type == 'provider') {
                                $folder = "providers";
                                $user = new App\Models\Providers;
                                $userdetails = $user::where(['status' => 1, 'id' => Auth::guard('web')->user()->user_id])->first();
                            } elseif(Auth::guard('web')->user()->user_type == 'customer') {
                                $folder = "customers";
                                $user = new App\Models\Customers;
                                $userdetails = $user::where(['status' => 1, 'id' => Auth::guard('web')->user()->user_id])->first();
                            } ?>
                            @if($userdetails->profile_pic != "")
                            <img src="{{ asset('uploads/'.$folder.'/profile/'.$userdetails->profile_pic) }}" alt="user">
                            @else
                            <img src="{{ asset('ui/images/noimage.png') }}" alt="user">
                            @endif
                        </div>
                    </div>
                    <div class="username">{{ Auth::user()->name }}</div>
                  </div>
                  <div class="profile-dropdown">
                      <ul>
                        @if(Auth::guard('web')->user()->user_type == 'provider')
                          <li><a href="{{ route('traderdetails',Auth::guard('web')->user()->username) }}">My Account</a></li>
                          @else
                          <li><a href="{{ route('customerhome') }}">My Profile</a></li>
                          @endif
                          @if(Auth::guard('web')->check())
                          <li><a href="{{ route('change-password') }}">Change Password</a></li>
                          @endif
                          <li><a href="{{ route('userlogout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                          <form id="logout-form" action="{{ route('userlogout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                      </ul>
                  </div>
              </div>
            <?php 
            $notification = new App\Models\Notifications;
            $notifications = $notification::where(['user_type' => (Auth::guard('web')->user()->user_type == "provider")?"trader":Auth::guard('web')->user()->user_type, 'user_id' => Auth::guard('web')->user()->user_id])->orderBy('id','DESC')->get();
            ?>
            @if(count($notifications) > 0)
            <div class="notification">
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span></span>
                      <i class="fa fa-bell-o"></i>
                    </button>
                    <div class="dropdown-menu">
                    @foreach($notifications as $key => $not)
                    <?php 
                        if($not->from_user_type == "provider") {
                            $folder = "providers";
                            $user = $not->getfromtrader;
                        } else if($not->from_user_type == "customer") {
                            $folder = "customers";
                            $user = $not->getfromcustomer;
                        }

                    ?>
                      <a class="dropdown-item" href="{{ $not->reference_url }}">
                        <div class="img-user">
                            @if($user->profile_pic != "")
                            <img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="user">
                            @else
                            <img src="{{ asset('ui/images/noimage.png') }}" alt="user">
                            @endif
                        </div>
                        <div class="action-description">
                            <div class="action-user">{{ $user->name }}</div>
                            <div class="action-text">{{ $not->notification }}</div>
                            <div class="n-date">{{ \Carbon\Carbon::parse($not->created_at)->diffForHumans() }}</div>
                        </div>
                      </a>
                    @endforeach
                    </div>
                  </div>
            </div>
            @endif
            @else
            <?php $url = url()->current(); ?>
              <div class="login">
                <a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal('<?php echo $url; ?>');">Register/Login</a>
              </div>              
              @endif
              <ul class="nav navbar-nav">
                <!-- <li><a href="{{ route('traders') }}">Trader</a></li>
                <li><a href="{{ route('handyman') }}">Handy man</a></li> -->
                <li><a href="{{ route('diy-help') }}">DIY Help</a></li>
                <li><a href="{{ route('jobs') }}">Jobs</a></li>
                <li><a href="{{ route('bazaarhome') }}">Bazaar</a></li>
                <li><a href="{{ route('packages') }}">Packages</a></li>
              </ul>
            </div>
            </nav>
    </div>
    <!-- popup -->
    <div class="modal fade login" id="loginModal">
        <div class="modal-dialog login animated">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Login with</h4>
              </div>
              <div class="modal-body">
                  <div class="box">
                       <div class="content">
                          <div class="error text-center" style="color: #f20505;"></div>
                          <div class="form loginBox" style="display: block;">
                              <form method="POST" id="user-login-form">
                                  <input class="form-control login-email" type="text" placeholder="Email" name="email" required>
                                  <input class="form-control login-password" type="password" placeholder="Password" name="password" required>
                                  <input type="hidden" class="login-page" name="login_page" value="">
                                  <p>
                                    <a href="{{ route('login-with-otp') }}" style="float: left;">Login with OTP</a>
                                    <a href="{{ route('forgot-password') }}">Forgot Password?</a>
                                  </p>
                                  <button class="btn btn-default btn-login" type="submit">Login</button>
                              </form>
                          </div>
                       </div>
                  </div>
                  <div class="box">
                      <div class="content registerBox" style="display: none;">
                       <div class="form">
                          <form method="POST" class="register-form" autocomplete="off">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="form-box-sec">
                                        <label class="custm-check">Customer
                                          <input type="radio" class="user_type" name="user_type" value="customer" checked="checked" required>
                                          <span class="checkmark"></span>
                                        </label>
                                        <label class="custm-check">Trader
                                          <input type="radio" class="user_type" name="user_type" value="trader" required>
                                          <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="trader-type-select" style="display: none;">
                            <div class="row">
                              <div class="col-md-12 text-center">
                                <div class="form-box-sec">
                                    <label class="custm-check">Individual
                                      <input type="radio" class="trader_type" name="trader_type" value="Individual" checked="checked" required>
                                      <span class="checkmark"></span>
                                    </label>
                                    <label class="custm-check">Company
                                      <input type="radio" class="trader_type" name="trader_type" value="Company" required>
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                              </div>
                            </div>
                            <br/>
                          </div>
                          <input class="form-control register-name" type="text" placeholder="Name" name="name" required>
                          <div class="email-error" style="color: #f20505;"></div>
                          <input class="form-control register-email" type="text" placeholder="Email" name="email" required>
                          <div class="username-error" style="color: #f20505;"></div>
                          <div class="username-success" style="color: #49b138;"></div>
                          <input class="form-control register-username" type="text" placeholder="Username" name="username" required>
                          <div class="mobile-error" style="color: #f20505;"></div>
                          <div class="row">
                            <div class="col-md-4">
                              <select class="form-control register-code" name="country_code" required>
                              <option value="">Select</option>
                              @foreach($countries as $k => $country)
                              <option value="{{ $country->isd_code }}">{{ $country->name }} (+{{ $country->isd_code }})</option>
                              @endforeach
                            </select>
                            </div>
                            <div class="col-md-8">
                              <input class="form-control register-mobile" required type="text" placeholder="Mobile" name="mobile">
                            </div>
                          </div>
                          <div class="password-error" style="color: #f20505;"></div>
                          <input class="form-control register-pass" type="password" required placeholder="Password" name="password" aria-autocomplete="list">
                          <input class="form-control register-confirm" type="password" required placeholder="Repeat Password" name="password_confirmation">
                          <input class="btn btn-default btn-register" type="submit" value="Create account">
                          </form>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <div class="forgot login-footer" style="display: block;">
                      <span>Looking to
                           <a href="javascript: showRegisterForm();">Create an account</a>
                      ?</span>
                  </div>
                  <div class="forgot register-footer" style="display: none;">
                       <span>Already have an account?</span>
                       <a href="javascript: showLoginForm();">Login</a>
                  </div>
              </div>
            </div>
        </div>
    </div>
</header>

@yield('content')
<?php $url = url()->current(); ?>
@if(count($online_providers) > 0)
<!-- online profile -->
<div class="online-profile">
    <div class="toggle-button"><img src="{{ asset('ui/images/online-profile.svg') }}" alt="profile"> Online Profiles <i class="fa fa-angle-down"></i></div>
    <div class="toggle-profile">
        <ul>
            @foreach($online_providers as $key => $onlineprovider)
            <li>
                @if(Auth::guard('web')->check())
                <a href="javascript:;" class="message_to_trader_from_list" data-trader-id="{{ $onlineprovider->user_id }}">
                    @else
                    <a href="javascript:;" onclick="openLoginModal('<?php echo $url; ?>');">
                    @endif
                    <div class="online-p">
                        @if($onlineprovider->profile_pic != "")
                        <img src="{{ asset('uploads/providers/profile/'.$onlineprovider->profile_pic) }}" alt="photo">
                        @else
                        <img src="{{ asset('ui/images/noimage.png') }}" alt="photo">
                        @endif
                    </div>
                    <h5>{{ $onlineprovider->name }}</h5>
                    <p>{{ isset($onlineprovider->providercategories[0]->getcategory->category)?$onlineprovider->providercategories[0]->getcategory->category:"" }}</p>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<form style="display:none;" class="form-horizontal" autocomplete="off" id="message_trader_list" method="POST" action="{{ route('messages.store') }}">
    @csrf
    <input type="hidden" name="from_user_type" value="{{ (Auth::check() && Auth::guard('web')->user()->user_type == 'provider')?'trader':'customer' }}" >
    <input type="hidden" name="from_user_id" value="{{ (Auth::check())?Auth::guard('web')->user()->user_id:'' }}" >
    <input type="hidden" name="to_user_type" value="trader" >
    <input type="hidden" name="to_user_id" value="" id="to_user_id">
    <input type="hidden" name="is_trader" value="1" >
    <input type="hidden" name="trader_id" value="" id="trader_id">
    <textarea name="message" placeholder="Message" required></textarea>
    <button>Send</button>
</form>
@endif
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
                    @if(Auth::check() && Auth::guard('web')->user()->user_type == "customer")
                    <li><a href="{{ route('post-job') }}">Post a Job</a></li>
                    @endif
                    <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 f-newsletter">
                <h4>Newsletter</h4>
                <span id="newsletter-message"></span>
                <div class="text-field">
                    <form class="form-horizontal" id="newsletter-form">
                        <input type="email" id="newsletter-email" style="color: #000;" name="email" placeholder="Enter your email" required>
                        <button type="submit"><i class="fa fa-send"></i></button>
                    </form>
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
<!-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script> -->
<script type="text/javascript">
    // $('button').on('click', function(){
    //     alert('preserve attached java script data!');
    // });
    // $('#myTab').tabCollapse();
</script>


<script>
    $(document).ready( function () {
        $('.datatable').DataTable();

        $(".traderscat").click(function(){
            $(".traderscat").removeClass("active");
            $(this).addClass("active");
            if($(this).find('a').attr("href") == "#sales") {
                $("#services").removeClass("in active");
                $("#sales").addClass("in active");
            } else if($(this).find('a').attr("href") == "#services") {
                $("#sales").removeClass("in active");
                $("#services").addClass("in active");
            }
            
        });
    });

    $(document).ready(function(){
        $(".register-username").change(function(){
            var username = $(this).val();
            $.post("{{ route('check-username') }}", {"_token": "{{ csrf_token() }}", "username": username}, function (data) {
                $(".username-error").text('');
                $(".username-success").text('Username is available');
            }).fail(function(data) {
                $(".username-success").text('');
                $(".username-error").text(jQuery.parseJSON(data.responseText).errors.username);
            });
        });
    });
    

  $( function() {
    $( ".datepicker" ).datepicker();

    $("#wizard").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex)
            {
                // To remove error styles
                $(this).find(".body:eq(" + newIndex + ") label.error").remove();
                $(this).find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            $(this).validate().settings.ignore = ":disabled,:hidden";
            return $(this).valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3)
            {
                $(this).steps("previous");
            }
        },
        onFinishing: function (event, currentIndex)
        {
            $(this).validate().settings.ignore = ":disabled";
            return $(this).valid();
        },
        onFinished: function (event, currentIndex)
        {
            $(this).submit();
        }
    }).validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
});



    $("#edit-profile-wizard").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        onInit: function()
        {
            $('.js-example-basic-multiple').select2();

            rowhtml = $('#service_locations').find('tbody tr:last-child()').html();
            $('body').on('click', '.add_row_location', function() {
                $(this).closest("tr").find(".add_row_location").addClass("remove_row_location").removeClass("add_row_location");
                $(this).closest("tr").find(".remove_row_location").addClass("btn-danger").removeClass("btn-primary");
                $(this).closest("tr").find(".remove_row_location").text("Remove");
                row = $('#lasttr_location').after('<tr class="newtr_location">' + rowhtml + '</tr>');
                $('#service_locations').find('#lasttr_location').attr("id","");
                $(".newtr_location").attr("id","lasttr_location");
                $(".newtr_location").attr("class","");
            });
            $('body').on('click', '.remove_row_location', function() {
                $(this).closest("tr").remove();
            });

            $(".upload-later").click(function(){
                if($(this).is(":checked")) {
                    $(this).parent().parent().parent().prev().find('.id_type').removeAttr("required");
                } else {
                    $(this).parent().parent().parent().prev().find('.id_type').attr("required","true");
                }
            });

            $(".main_category").click(function(){
              var maincategory = $(this).val();
              $(".parent_category").html('');
              $(".multiple-sub-category").html('');
              $(".services").html('');
              $.post("{{ route('getcategory') }}", {"_token": "{{ csrf_token() }}","maincategory":maincategory}, function (data) {
                $(".parent_category").html(data);
              });
            });

            $(".parent_category").change(function(){
              var category = $(this).val();
              $(".multiple-sub-category").html('');
              $.post("{{ route('getsubcategorytrader') }}", {"_token": "{{ csrf_token() }}","category":category}, function (data) {
                $(".multiple-sub-category").html(data);
              });
            });

            $(".multiple-sub-category").change(function(){
                var url = "{{ route('category_servicetrader') }}";
                var category = $(this).val();
                $.post(url, {"_token": "{{ csrf_token() }}","categories":category}, function (data) {
                    $(".services").html(data);
                });
            });

            $(".delete-completed-works").click(function(){
                var work = $(this);
                var image_id = $(this).attr("data-id");
                var url = "{{ route('remove-completed-work') }}";
                $.post(url, {"_token": "{{ csrf_token() }}","image_id":image_id}, function (data) {
                    if(data == 1) {
                        work.parent().parent().remove();
                    }
                });
            });
              
            
        },
        onStepChanging: function (event, currentIndex, newIndex)
        { 
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex)
            {
                // To remove error styles
                $(this).find(".body:eq(" + newIndex + ") label.error").remove();
                $(this).find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            $(this).validate().settings.ignore = ":disabled,:hidden";
            return $(this).valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        { 
            // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3)
            {
                $(this).steps("previous");
            }
            $(".update-profile-step").val(currentIndex);

            if(currentIndex < 5) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('trader-profile-update') }}",
                    data: $(this).serializeArray(),
                    success: function (data) {
                        
                    }
                })
            }
            
        },
        onFinishing: function (event, currentIndex)
        { 
            $(this).validate().settings.ignore = ":disabled";
            return $(this).valid();
        },
        onFinished: function (event, currentIndex)
        {
            $(this).submit();
        }
    }).validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
});
  });
</script>  

<script type="text/javascript">
    $(document).ready(function () {
        var $tabs = $('#horizontalTab');
        $tabs.responsiveTabs({
            rotate: false,
            startCollapsed: 'accordion',
            collapsible: 'accordion',
            setHash: true,
        });
    });
</script>
<script>
$(document).ready(function() {
    // $("#currentPosition").change(function(){
    //     alert("Position changed");
    // });
    $('#bannerImg').parallax({
        imageSrc: '{{ isset($banner->banner_image)?asset("uploads/banners/".$banner->banner_image):asset("ui/images/banner.jpg") }}'
    });
    $('#bannerImgInner').parallax({
        imageSrc: '{{ asset("ui/images/about-banner.jpg") }}'
    });
    $('.dropdown-menu a').on('click', function(){    
        $('.dropdown-toggle').html($(this).html() + '<span class="caret"></span>');    
    });
    $(".filter-nav").click(function(){
        $(".trader-search").toggle();
    });
    const $menu = $('.my-profile');
        $(document).mouseup(e => {
        if (!$menu.is(e.target) 
        && $menu.has(e.target).length === 0)
        {
            $menu.removeClass('is-active');
        }
        });

        $('.profile-view').on('click', () => {
        $menu.toggleClass('is-active');
        });
    $("#service").owlCarousel({
                autoplay:true,
            autoPlay : 2000,
            autoplayHoverPause:true, 
            navigation:true,
            stopOnHover : false,  
            items : 2,
            pagination:true,
            margin:10,  
            lazyLoad : true,
            navigation : true,
            itemsDesktop : [1199, 2],
            itemsDesktopSmall : [991,2],
            itemsTablet : [600, 1],
            itemsMobile : [300, 1]
          });
    $(".trader-offer").owlCarousel({
                autoplay:true,
            autoPlay : 2000,
            autoplayHoverPause:true, 
            navigation:true,
            stopOnHover : false,  
            items : 2,
            pagination:false,
            margin:10,  
            lazyLoad : true,
            itemsDesktop : [1199, 2],
            itemsDesktopSmall : [991,2],
            itemsTablet : [600, 1],
            itemsMobile : [300, 1]
          });
    $("#bazaar").owlCarousel({
                autoplay:true,
            autoPlay : 2000,
            autoplayHoverPause:true, 
            nav:true,
            stopOnHover : false,  
            items : 1,
            pagination:true,
            margin:10,  
            lazyLoad : true,
            itemsDesktop : [1199, 1],
            itemsDesktopSmall : [991,1],
            itemsTablet : [600, 1],
            itemsMobile : [300, 1],
          });
    $(".job-scroll2").owlCarousel({
                autoplay:true,
            autoPlay : 3000,
            autoplayHoverPause:true, 
            nav:true,
            stopOnHover : false,  
            items : 1,
            pagination:true,
            margin:10,  
            lazyLoad : true,
            itemsDesktop : [1199, 1],
            itemsDesktopSmall : [991,1],
            itemsTablet : [600, 1],
            itemsMobile : [300, 1],
          });
    $("#related").owlCarousel({
                autoplay:true,
            autoPlay : 2000,
            autoplayHoverPause:true, 
            navigation:true,
            stopOnHover : true,  
            items : 4,
            pagination:true,
            margin:10,  
            lazyLoad : true,
            itemsDesktop : [1199, 3],
            itemsDesktopSmall : [991,2],
            itemsTablet : [600, 1],
            itemsMobile : [300, 1]
          });
    $(".toggle-button").click(function(){
        $(".toggle-profile").toggle(500);
    });

    $(".scroll-head").click(function(){
        $(".scroll-profile").toggle(500);
    });

    $(".view-review").click(function(){
                $(".view-all").toggle(500);
    });
    $(".btn-s").click(function(){
        // $(".post-offer").hide();
        $(".post-product").show();
    });
    $(".add-review-post").click(function(){
        $(".add-review-box").show(); 
        $(".reviews-list").hide();
    });
    $(".review-view").click(function(){
        $(".reviews-list").show();
        $(".add-review-box").hide();
    });
    $(".box1").click(function(){
        $(".box2").show();
        $(".box1").hide();
    });
            
    $('[data-fancybox]').fancybox({
      protect: true,
      buttons : [
        'zoom',
        'thumbs',
        'close'
      ]
    });    
    $("#post_an_offer").click(function(){
        $(".post-offer").toggle();
    });

            $(".feeds-area").click(function(){
                $(this).addClass('active');
                $(".offer,.bazaar").removeClass('active');
                $(".feeds").show();
                $(".offer-area").hide();
                $(".market").hide();
            });
            $(".offer").click(function(){
                $(this).addClass('active');
                $(".feeds-area,.bazaar").removeClass('active');
                $(".offer-area").show();
                $(".feeds").hide();
                $(".market").hide();
            });
            $(".bazaar").click(function(){
                $(this).addClass('active');
                $(".feeds-area,.offer").removeClass('active');
                $(".market").show();
                $(".feeds").hide();
                $(".offer-area").hide();
            });
});

</script> 
<script src = "https://maps.googleapis.com/maps/api/js?key={{ config('site_settings')->google_map_api }}&libraries=places&callback=initMap" async defer></script>

<script>
    function initMap() {
        var autocomplete = new google.maps.places.Autocomplete($("#currentPosition")[0], {}); 
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var long = place.geometry.location.lng();
            $('#currentLatitude').val(lat);
            $('#currentLongitude').val(long);

        });
    }
</script>
<script>
$(document).ready(function(){
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
  } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
  }

  function showPosition(position) { 
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    displayLocation(latitude,longitude);
  }

  function displayLocation(latitude,longitude){
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);

    geocoder.geocode(
        {'latLng': latlng}, 
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");

                    count=value.length;
                    country=value[count-1];
                    state=value[count-2];
                    city=value[count-3];
                    $('#currentPosition').val(add);
                    $('#currentLatitude').val(latitude);
                    $('#currentLongitude').val(longitude);
                }
                else  {
                    x.innerHTML = "Address not found";
                }
            }
            else {
                x.innerHTML = "Geocoder failed due to: " + status;
            }
        }
    );
  }
});
</script>
<script>
$(document).ready(function(){
    $(".postcode-button").click(function(e){
        e.preventDefault();
        getcurrentLocation1();
    });
});
</script>
<script type="text/javascript">
    var x = document.getElementById("postcode");

    function getcurrentLocation1() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showcurrent_Position1);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showcurrent_Position1(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        displaycurrent_Location1(latitude,longitude);
    }

    function displaycurrent_Location1(latitude,longitude){
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);

    geocoder.geocode(
        {'latLng': latlng}, 
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");

                    count=value.length;
                    country=value[count-1];
                    state=value[count-2];
                    city=value[count-3];
                    $('#postcode').val(add);
                    $('#search_latitude').val(latitude);
                    $('#search_longitude').val(longitude);
                }
                else  {
                    x.innerHTML = "Address not found";
                }
            }
            else {
                x.innerHTML = "Geocoder failed due to: " + status;
            }
        }
    );
  }
</script>
<script>
$(document).ready(function(){

    //traders filter

    $(".txt-box").change(function(){
        var user_id = $(this).val();
        $.post("{{ route('get_provider') }}", {"_token": "{{ csrf_token() }}","user_id":user_id}, function (data) {
            $(".traderlist-section").html(data);
        });
    });
    function filter_traders() {
        var category = [];
        var rating = [];
        var sort_by = $(".filter-sort-by").val();
        $.each($(".filter-category:checked"), function(){
            category.push($(this).val());
        });
        $.each($(".filter-rating:checked"), function(){
            rating.push($(this).val());
        });

        $.post("{{ route('get_provider_list') }}", {"_token": "{{ csrf_token() }}","category":category.join(","),"rating":rating.sort(),"sort_by":sort_by}, function (data) {
            $(".traderlist-section").html(data);
        });
    }
    $(".filter-category,.filter-rating").click(function() {
        filter_traders();
    });
    $(".filter-sort-by").change(function() {
        filter_traders();
    });

    //handyman filter

    function filter_handyman() {
        var category = [];
        var rating = [];
        var sort_by = $(".handyman-filter-sort-by").val();
        $.each($(".handyman-filter-category:checked"), function(){
            category.push($(this).val());
        });
        $.each($(".handyman-filter-rating:checked"), function(){
            rating.push($(this).val());
        });

        $.post("{{ route('get_handyman_list') }}", {"_token": "{{ csrf_token() }}","category":category.join(","),"rating":rating.sort(),"sort_by":sort_by}, function (data) {
            $(".handymanlist-section").html(data);
        });
    }
    $(".handyman-filter-category,.handyman-filter-rating").click(function() {
        filter_handyman();
    });
    $(".handyman-filter-sort-by").change(function() {
        filter_handyman();
    });


//jobs filter

    $(".jobs-category-filter").click(function() {
        var category = [];

        $.each($(".jobs-category-filter:checked"), function(){
            category.push($(this).val());
        });

        $.post("{{ route('get_jobs_list_category') }}", {"_token": "{{ csrf_token() }}","category":category.join(",")}, function (data) {
            $(".jobs-listing").html(data);
            $(".job-scroll2").owlCarousel({
                autoplay:true,
                autoPlay : 3000,
                autoplayHoverPause:true, 
                nav:true,
                stopOnHover : false,  
                items : 1,
                pagination:true,
                margin:10,  
                lazyLoad : true,
                itemsDesktop : [1199, 1],
                itemsDesktopSmall : [991,1],
                itemsTablet : [600, 1],
                itemsMobile : [300, 1],
              });
        });
    });

    $(".jobscategory").change(function(){
        var category = $(this).val();
          $(".jobssubcategory").html('');
          $.post("{{ route('jobs-sub-category') }}", {"_token": "{{ csrf_token() }}","category":category}, function (data) {
            $(".jobssubcategory").html(data);
          });
    });

    $("#jobs-search").submit(function(e){
      e.preventDefault();
      var data = $(this).serializeArray();
      var lat = $("#currentLatitude").val();
      var long = $("#currentLongitude").val();
      data.push({name: 'latitude', value: lat},{name: 'longitude', value: long});
      $.ajax({
        type: "POST",
        url: "{{ route('jobs-search') }}",
        data: data,
        success: function (data) {
            $("#jobs-search input,select").val('');
            $(".jobs-listing").html(data);
            $(".job-scroll2").owlCarousel({
                autoplay:true,
                autoPlay : 3000,
                autoplayHoverPause:true, 
                nav:true,
                stopOnHover : false,  
                items : 1,
                pagination:true,
                margin:10,  
                lazyLoad : true,
                itemsDesktop : [1199, 1],
                itemsDesktopSmall : [991,1],
                itemsTablet : [600, 1],
                itemsMobile : [300, 1],
              });
        }
    })
    });

    //customer jobs search

    $(".cust-jobs-category-filter").click(function() {
        var category = [];

        $.each($(".cust-jobs-category-filter:checked"), function(){
            category.push($(this).val());
        });

        $.post("{{ route('jobsbystatuscat') }}", {"_token": "{{ csrf_token() }}","job_status": "{{ Request::segment(3) }}","category":category.join(",")}, function (data) {
            $(".cust-jobs-listing").html(data);
            $(".job-scroll2").owlCarousel({
                autoplay:true,
                autoPlay : 3000,
                autoplayHoverPause:true, 
                nav:true,
                stopOnHover : false,  
                items : 1,
                pagination:true,
                margin:10,  
                lazyLoad : true,
                itemsDesktop : [1199, 1],
                itemsDesktopSmall : [991,1],
                itemsTablet : [600, 1],
                itemsMobile : [300, 1],
              });
        });
    });

    $("#cust-jobs-search").submit(function(e){
      e.preventDefault();
      var data = $(this).serializeArray();
      var lat = $("#currentLatitude").val();
      var long = $("#currentLongitude").val();
      data.push({name: 'latitude', value: lat},{name: 'longitude', value: long});
      $.ajax({
        type: "POST",
        url: "{{ route('cust-jobs-search') }}",
        data: data,
        success: function (data) {
            $("#cust-jobs-search #keyword,select").val('');
            $(".cust-jobs-listing").html(data);
            $(".job-scroll2").owlCarousel({
                autoplay:true,
                autoPlay : 3000,
                autoplayHoverPause:true, 
                nav:true,
                stopOnHover : false,  
                items : 1,
                pagination:true,
                margin:10,  
                lazyLoad : true,
                itemsDesktop : [1199, 1],
                itemsDesktopSmall : [991,1],
                itemsTablet : [600, 1],
                itemsMobile : [300, 1],
              });
        }
    })
    });

    //bazaar search

    $(".bazaarcategory").change(function(){
      var category = $(this).val();
      $(".bazaarsubcategory").html('');
      $.post("{{ route('bazaar-sub-category') }}", {"_token": "{{ csrf_token() }}","category":category}, function (data) {
        $(".bazaarsubcategory").html(data);
      });
    });

    $("#bazaar-search").submit(function(e){
      e.preventDefault();
      var data = $(this).serializeArray();
      var lat = $("#currentLatitude").val();
      var long = $("#currentLongitude").val();
      data.push({name: 'latitude', value: lat},{name: 'longitude', value: long});
      $.ajax({
        type: "POST",
        url: "{{ route('bazaar-search') }}",
        data: data,
        success: function (data) {
            $("#bazaar-search #product,.bazaarcategory,.bazaarsubcategory").val('');
            $(".bazaar-product-sort").val(1);
            $(".bazaar-list").html(data);
            $('.product-added-user').popover({
              html: true,
              trigger: 'hover',
              placement: 'top',
              content: function(){
                return '<div class="popover-sec"><div class="pic"><img src="'+$(this).data('img') + '" /></div><div class="pic-details"><h5>'+$(this).data('name') + '</h5><p>Since '+$(this).data('joined')+'<p><div></div>';
                }
            });
        }
    })
    });

    $(".bazaar-product-sort").change(function(){
        var sort_by = $(this).val();
        var search_product = $("#bazaar-search-product").val();
        var search_cat = $("#bazaar-search-cat-id").val();
        var search_sub_cat = $("#bazaar-search-sub-cat-id").val();
        $.ajax({
            type: "POST",
            url: "{{ route('bazaar-sort-search') }}",
            data: {"_token": "{{ csrf_token() }}","sort_by":sort_by,"search_product":search_product,"search_cat":search_cat,"search_sub_cat":search_sub_cat},
            success: function (data) {
                $(".bazaar-list").html(data);
            }
        })
    });

    $("#user-bazaar-search").submit(function(e){
      e.preventDefault();
      var data = $(this).serializeArray();
      var lat = $("#currentLatitude").val();
      var long = $("#currentLongitude").val();
      data.push({name: 'latitude', value: lat},{name: 'longitude', value: long});
      $.ajax({
        type: "POST",
        url: "{{ route('user-bazaar-search') }}",
        data: data,
        success: function (data) {
            $("#user-bazaar-search #product,.bazaarcategory,.bazaarsubcategory").val('');
            $(".user-bazaar-product-sort").val(1);
            $(".bazaar-list").html(data);
            $('.product-added-user').popover({
              html: true,
              trigger: 'hover',
              placement: 'top',
              content: function(){
                return '<div class="popover-sec"><div class="pic"><img src="'+$(this).data('img') + '" /></div><div class="pic-details"><h5>'+$(this).data('name') + '</h5><p>Since '+$(this).data('joined')+'<p><div></div>';
                }
            });
        }
    })
    });

    $(".user-bazaar-product-sort").change(function(){
        var sort_by = $(this).val();
        var search_product = $("#bazaar-search-product").val();
        var search_cat = $("#bazaar-search-cat-id").val();
        var search_sub_cat = $("#bazaar-search-sub-cat-id").val();
        $.ajax({
            type: "POST",
            url: "{{ route('user-bazaar-sort-search') }}",
            data: {"_token": "{{ csrf_token() }}","sort_by":sort_by,"search_product":search_product,"search_cat":search_cat,"search_sub_cat":search_sub_cat},
            success: function (data) {
                $(".bazaar-list").html(data);
            }
        })
    });

    $(".bad-review").click(function(){
        var old_data = $(".reviews-list").html();
        var trader_id = $(this).attr("data-trader-id");

        $.ajax({
            type: "POST",
            url: "{{ route('bad-reviews') }}",
            data: {"_token": "{{ csrf_token() }}","trader_id":trader_id},
            success: function (data) {
                if(data != "") {
                    $(".reviews-list").html(data);
                } else {
                    alert("No bad reviews..");
                    $(".reviews-list").html(old_data);
                }
            }
        })
    });

    $(".btn-login").click(function(e){
        e.preventDefault();
        var email = $(".login-email").val();
        var password = $(".login-password").val();
        var page = $(".login-page").val();

        $.post("{{ route('login') }}", {"_token": "{{ csrf_token() }}","email":email, "password":password}, function (data) {
            if (data.status == 1 && page != "") {
                location.replace(page);
            } else if(data.status == 0) {
                location.replace("{{ route('verify-user') }}");
            }
            // if(data.status == 1 && data.user_type == "provider" && page == "home") {
            //     location.replace("./trader/"+data.username);
            // } else if (data.status == 1 && data.user_type == "customer" && page == "home") {
            //     location.replace("{{ route('customerhome') }}");
            // } else if (data.status == 1 && data.user_type == "customer" && page == "postajob") {
            //     location.replace("{{ route('post-job') }}");
            // } else if (data.status == 1 && data.user_type == "provider" && page == "postajob") {
            //     location.replace("{{ route('jobs') }}");
            // } else if (data.status == 1 && page != "") {
            //     location.replace(page);
            // } else if(data.status == 0) {
            //     location.replace("{{ route('verify-user') }}");
            // }
        }).fail(function(data) { 
          $(".error").text("Invalid username or password.!");
          $("#user-login-form").reset();
        });
    });

    // $(".register-form").submit(function(e){
    //   e.preventDefault();
    //   var user_type = $(".user_type:checked").val();
    //   var trader_type = $(".trader_type:checked").val();
    //   var name = $(".register-name").val();
    //   var email = $(".register-email").val();
    //   var country_code = $(".register-code").val();
    //   var mobile = $(".register-mobile").val();
    //   var password = $(".register-pass").val();
    //   var password_confirmation = $(".register-confirm").val();
    //   $.post("{{ route('register') }}", {"_token": "{{ csrf_token() }}", "trader_type":trader_type, "user_type": user_type, "name": name, "email": email, "country_code": country_code, "mobile": mobile, "password": password, "password_confirmation": password_confirmation}, function (data) {
    //       location.replace("verify-user");
    //   }).fail(function(data) { 
    //     $(".error").text(JSON.parse(data.responseText).message);
    //   });
    // });

    $(".register-form").submit(function(e) {
        e.preventDefault();
        // $(".error").css('color','red');
    }).validate({
        errorElement: 'p',
        rules: {
            user_type: "required",
            trader_type: "required",
            name: "required",
            email: {
                            required: true,
                            email: true
                          },
            username: "required",
            country_code: "required",
            mobile: {
                            required: true,
                            number: true
                          },
            password: {
                            required: true,
                            minlength: 8
                          },
            password_confirmation: {
                            required: true,
                            minlength: 8,
                            equalTo: ".register-pass"
                          },
        },
        messages: {
          user_type: "Please select user type",
          trader_type: "Please select trader type",
          name: "Please enter name",
          email: "Please enter a valid email address",
          username: "Please enter a valid username.",
          country_code: "Please select country code",
          mobile: "Please enter correct mobile number",
          password: "Password should be minimum 8 characters in length.",
          password_confirmation: "Passwords should match.!"
        },

        submitHandler: function(form) { 
            var user_type = $(".user_type:checked").val();
            var trader_type = $(".trader_type:checked").val();
            var name = $(".register-name").val();
            var email = $(".register-email").val();
            var username = $(".register-username").val();
            var country_code = $(".register-code").val();
            var mobile = $(".register-mobile").val();
            var password = $(".register-pass").val();
            var password_confirmation = $(".register-confirm").val();
            $.post("{{ route('register') }}", {"_token": "{{ csrf_token() }}", "trader_type":trader_type, "user_type": user_type, "name": name, "email": email, "username": username, "country_code": country_code, "mobile": mobile, "password": password, "password_confirmation": password_confirmation}, function (data) {
              location.replace("verify-user");
            }).fail(function(data) { 
              $(".mobile-error").text(jQuery.parseJSON(data.responseText).errors.mobile);
              $(".email-error").text(jQuery.parseJSON(data.responseText).errors.email);
              $(".username-error").text(jQuery.parseJSON(data.responseText).errors.username);
              $(".password-error").text(jQuery.parseJSON(data.responseText).errors.password);
              $(".register-form").reset(); 
            });
            return false;
        }
    });

    $("#newsletter-form").submit(function(e) {
        e.preventDefault();
    }).validate({
        errorElement: 'p',
        rules: {
            email: {
                            required: true,
                            email: true
                          },
        },
        messages: {
          email: "Please enter a valid email address.",
        },

        submitHandler: function(form) { 
            var email = $("#newsletter-email").val();
            $.post("{{ route('newsletter') }}", {"_token": "{{ csrf_token() }}", "email":email}, function (data) {
              $("#newsletter-message").text("Newsletter subscribed.!!");
              $("#newsletter-form")[0].reset();                 
            }).fail(function(data) { 
              $("#newsletter-message").text('Already subscribed.!!');
              $("#newsletter-form")[0].reset(); 
            });
            return false;
        }
    });


    $(".user_type").click(function(){
      var user_type = $(this).val();
      if(user_type == "trader") {
        $(".trader-type-select").show();
      } else {
        $(".trader-type-select").hide();
      }
    });
});
$(function() {
    $("#bazaar_parent_category").change(function(){
      var category = $(this).val();
      $("#bazaar-sub-category").html('');
      $.post("{{ route('bazaar-subcategory') }}", {"_token": "{{ csrf_token() }}","category":category}, function (data) {
        $("#bazaar-sub-category").html(data);
      });
    });
  });
$(function() {
    $(".category").change(function(){
      var category = $(this).val();
      $(".sub_category").html('');
      $.post("{{ route('sub-category') }}", {"_token": "{{ csrf_token() }}","category":category}, function (data) {
        $(".sub_category").html(data);
      });
    });
  });
</script>
@if(request()->is('/'))

<script>
  function initMap() {
    var autocomplete = new google.maps.places.Autocomplete($("#postcode")[0], {}); 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#search_latitude').val(lat);
        $('#search_longitude').val(long);

    });

    var autocomplete1 = new google.maps.places.Autocomplete($("#currentPosition")[0], {}); 
    google.maps.event.addListener(autocomplete1, 'place_changed', function() {
        var place1 = autocomplete1.getPlace();
        var lat1 = place1.geometry.location.lat();
        var long1 = place1.geometry.location.lng();
        $('#currentLatitude').val(lat1);
        $('#currentLongitude').val(long1);

    });
}
</script>
@endif
@if(request()->is('trader/edit-profile'))

<script>
  function initMap() { 
    // var autocomplete = new google.maps.places.Autocomplete($("#postcode")[0], {}); 
    // google.maps.event.addListener(autocomplete, 'place_changed', function() {
    //     var place = autocomplete.getPlace();
    //     var lat = place.geometry.location.lat();
    //     var long = place.geometry.location.lng();
    //     $('#search_latitude').val(lat);
    //     $('#search_longitude').val(long);

    // });

    var autocomplete1 = new google.maps.places.Autocomplete($("#provider-location")[0], {}); 
    google.maps.event.addListener(autocomplete1, 'place_changed', function() {
        var place = autocomplete1.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#loc_latitude').val(lat);
        $('#loc_longitude').val(long);

    });

    var autocomplete2 = new google.maps.places.Autocomplete($("#provider-landmark")[0], {}); 
    google.maps.event.addListener(autocomplete2, 'place_changed', function() {
        var place = autocomplete2.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#land_latitude').val(lat);
        $('#land_longitude').val(long);

    });


} 
</script>
@endif
@if(request()->is('customer/post-job') || request()->is('customer/edit-job/*') || request()->is('trader/profile/*') || request()->is('bazaar') || request()->is('product/details/*') || request()->is('customer/bazaar') || request()->is('customer/appointments') || request()->is('customer/blocked-traders') || request()->is('customer/clarification-requests') || request()->is('customer/edit-profile') || request()->is('customer/profile') || request()->is('customer/receipts') || request()->is('customer/wishlist') || request()->is('trader/bazaar')) 
<script>
  function initMap() { 
    var autocomplete = new google.maps.places.Autocomplete($("#job-location")[0], {}); 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#loc_latitude').val(lat);
        $('#loc_longitude').val(long);

    });

} 
</script>
@endif
<script>
    $('body').on('keyup', '.service_location', function() {
      var thisele = $(this);
      var autocomplete3 = new google.maps.places.Autocomplete($(this)[0], {}); 
      google.maps.event.addListener(autocomplete3, 'place_changed', function() {
          var place = autocomplete3.getPlace();
          var lat = place.geometry.location.lat();
          var long = place.geometry.location.lng();
          thisele.next('.service_loc_latitude').val(lat);
          thisele.next().next('.service_loc_longitude').val(long);
      });
    });
</script>
<script>
    $(document).ready(function () {
    $(".emoji").on("click", function () {
        var emoji = $(this);
        var trader_post_id = $(this).attr("data-postid");
        var user_type = "{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:""}}";
        var user_id = "{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:""}}";
        var data_reaction = $(this).attr("data-reaction");

        $.ajax({
            type: "POST",
            url: "{{ route('traderpostreaction') }}",
            data: {"_token": "{{ csrf_token() }}","data_reaction":data_reaction,"trader_post_id":trader_post_id,"user_type":user_type,"user_id":user_id},
            success: function (response) { 

                emoji.parent().prev().prev(".reaction-btn-emo").removeClass().addClass('reaction-btn-emo').addClass('like-btn-' + data_reaction.toLowerCase());
                emoji.parent().prev(".reaction-btn-text").text(data_reaction+'('+response+')').removeClass().addClass('reaction-btn-text').addClass('reaction-btn-text-' + data_reaction.toLowerCase()).addClass("active");
            }
        })
    });
    $(".emoji-offer").on("click", function () {
        var emoji = $(this);
        var trader_offer_id = $(this).attr("data-offerid");
        var user_type = "{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:""}}";
        var user_id = "{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:""}}";
        var data_reaction = $(this).attr("data-reaction");

        $.ajax({
            type: "POST",
            url: "{{ route('traderofferreaction') }}",
            data: {"_token": "{{ csrf_token() }}","data_reaction":data_reaction,"trader_offer_id":trader_offer_id,"user_type":user_type,"user_id":user_id},
            success: function (response) { 
                
                emoji.parent().prev().prev(".reaction-btn-emo").removeClass().addClass('reaction-btn-emo').addClass('like-btn-' + data_reaction.toLowerCase());
                emoji.parent().prev(".reaction-btn-text").text(data_reaction+'('+response+')').removeClass().addClass('reaction-btn-text').addClass('reaction-btn-text-' + data_reaction.toLowerCase()).addClass("active");
            }
        })
    });

    // $(".reaction-btn-text").on("click", function () { 
    //     if ($(this).hasClass("active")) {

    //         $.ajax({
    //             type: "POST",
    //             url: "php/undo_like.php",
    //             data: "",
    //             success: function (response) {

    //                 $(".reaction-btn-text").text("Like").removeClass().addClass('reaction-btn-text');
    //                 $(".reaction-btn-emo").removeClass().addClass('reaction-btn-emo').addClass("like-btn-default");
    //                 $(".like-emo").html('<span class="like-btn-like"></span>');
    //                 $(".like-details").html("Knowband and 1k others");
    //             }
    //         })
    //     }
    // });
});

    $('body').on('click', '.shortlist', function() {
        var product = $(this);
        var product_id = $(this).attr("data-id");
        var user_type = "{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:""}}";
        var user_id = "{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:""}}";

        $.ajax({
            type: "POST",
            url: "{{ route('shortlist-product') }}",
            data: {"_token": "{{ csrf_token() }}","product_id":product_id,"user_type":user_type,"user_id":user_id},
            success: function (response) { 
                product.addClass("shortlisted");
                product.removeClass("shortlist");
                product.css('background-color','#303030');
                product.html('<i class="fa fa-check-square"></i> Shortlisted');
            }
        })
    });

    $('body').on('click', '.shortlisted', function() { 
        var product = $(this);
        var product_id = $(this).attr("data-id");
        var user_type = "{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:""}}";
        var user_id = "{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:""}}";

        $.ajax({
            type: "POST",
            url: "{{ route('remove-shortlist-product') }}",
            data: {"_token": "{{ csrf_token() }}","product_id":product_id,"user_type":user_type,"user_id":user_id},
            success: function (response) { 
                product.addClass("shortlist");
                product.removeClass("shortlisted");
                product.css('background-color','#55AA47');
                product.html('<i class="fa fa-plus-circle"></i> Shortlist');
                // product.closest('li').remove();
            }
        })
    });
    $(document).ready(function(){
        $(".report-post").click(function(){
            var post_id = $(this).attr("data-id");
            $("#report").find("#trader_post_id").val(post_id);
        });
    });
    $("#report-post-form").click(function(e){
      e.preventDefault();
      var postdata = $("#report-post-form1").serializeArray();
      if(postdata[1].value != "" && postdata[2].value != "" && postdata[3].value != "") {
        $("#report-post-form1").submit();
      } else {
        alert("Something went wrong.Please try again later.!");
      }
    });
    $(document).ready(function(){
        $(".request-more-details").click(function(){
            var job_id = $(this).attr("data-id");
            var job_quote_id = $(this).attr("data-job-quote-id");
            $("#requestmoredetails").find("#job_id").val(job_id);
            $("#requestmoredetails").find("#job_quote_id").val(job_quote_id);
        });
    });
    $("#request-details-form").click(function(e){
      e.preventDefault();
      var postdata = $("#request-details-form1").serializeArray();
      if(postdata[1].value != "" && postdata[2].value != "" && postdata[6].value != "") {
        $("#request-details-form1").submit();
      } else {
        alert("Please enter a message!");
      }
    });
    $(document).ready(function(){
        $('body').on('change', '.change-appointment-status', function() {
            var status = $(this).val();
            var app_id = $(this).find(':selected').attr('data-id');
            if(status == "Rescheduled") {
                $("#rescheduleappointment").find("#appointment_id").val(app_id);
                $("#rescheduleappointment").modal();
            } else if(status == "Cancelled") {
                $("#cancelappointment").find("#appointment_id").val(app_id);
                $("#cancelappointment").modal();
            } else {
                alert("Please select.!")
            }
        });
    });
    $("#rescheduleappointment-form").click(function(e){
      e.preventDefault();
      var postdata = $("#rescheduleappointment-form1").serializeArray();
      if(postdata[1].value != "" && postdata[2].value != "" && postdata[3].value != "") {
        $("#rescheduleappointment-form1").submit();
      } else {
        alert("Something went wrong.Please try again later.!");
      }
    });
    $("#cancelappointment-form").click(function(e){
      e.preventDefault();
      var postdata = $("#cancelappointment-form1").serializeArray();
      if(postdata[1].value != "" && postdata[2].value != "" && postdata[3].value != "") {
        $("#cancelappointment-form1").submit();
      } else {
        alert("Something went wrong.Please try again later.!");
      }
    });
    $(document).ready(function(){
        $('body').on('change', '.change-appointment-status-trader', function() {
            var status = $(this).val();
            var app_id = $(this).find(':selected').attr('data-id');
            if(status == "Rejected") {
                $("#changeappointmentstatustrader").find("#appointment_id").val(app_id);
                $("#changeappointmentstatustrader").find("#status").val(status);
                $("#changeappointmentstatustrader").modal();
            } else if(status == "Cancelled") {
                $("#changeappointmentstatustrader").find("#appointment_id").val(app_id);
                $("#changeappointmentstatustrader").find("#status").val(status);
                $("#changeappointmentstatustrader").modal();
            } else if(status == "Accepted") {
                $("#changeappointmentstatustrader").find("#appointment_id").val(app_id);
                $("#changeappointmentstatustrader").find("#status").val(status);
                $("#changeappointmentstatustrader").modal();
            } else {
                alert("Please select.!")
            }
        });
    });
    $("#changeappointment-trader-form").click(function(e){
      e.preventDefault();
      var postdata = $("#changeappointment-trader-form1").serializeArray();
      if(postdata[1].value != "" && postdata[2].value != "" && postdata[3].value != "") {
        $("#changeappointment-trader-form1").submit();
      } else {
        alert("Something went wrong.Please try again later.!");
      }
    });
    $(document).ready(function(){
            $('body').on('click', '.receipt-image', function(e) {
            e.preventDefault();
            var receipt_title = $(this).attr("data-title");
            var receipt = $(this).attr("href");
            $("#receiptsimage").find(".modal-title").text(receipt_title);
            $("#receiptsimage").find(".modal-body").html("<img style='width:100%;' src="+receipt+">");
            $("#receiptsimage").find("a").attr("href",receipt);
            $("#receiptsimage").modal();
        });
    });
    $(document).ready(function(){
        $(".edittraderpost").click(function(){
              var trader_post_id = $(this).attr("data-post-id");
              var url = '{{ route("edit-trader-post", ":trader_post_id") }}';
              url = url.replace(':trader_post_id', trader_post_id );
              $.ajax({
                type: "GET",
                url:url,
                success: function (response) { 
                    if(response != 0) {
                        $("#edit-trader-post").html(response);
                        $("#changetraderpost").modal();
                    } else {
                        alert("Post data not found.!");
                    }
                }
            })
        });

        $(".edittraderoffer").click(function(){
              var trader_offer_id = $(this).attr("data-offer-id");
              var url = '{{ route("edit-trader-offer", ":trader_offer_id") }}';
              url = url.replace(':trader_offer_id', trader_offer_id );
              $.ajax({
                type: "GET",
                url:url,
                success: function (response) { 
                    if(response != 0) {
                        $("#edit-trader-offer").html(response);
                        $("#changetraderoffer").modal();
                    } else {
                        alert("Offer data not found.!");
                    }
                }
            })
        });

        $(".clar_req_details").click(function(){
            $("#viewdetailscontent").html("");
              var job_quote = $(this).attr('data-id');
              var url = '{{ route("view-clarification-request", ":job_quote") }}';
              url = url.replace(':job_quote', job_quote );
              $("#viewdetails").find("#job_quote_id").val(job_quote);
              $.ajax({
                type: "GET",
                url:url,
                success: function (response) { 
                    if(response != 0) {
                        $("#viewdetailscontent").html(response.detail_req_details);
                    } else {
                        alert("Requested Details not found.!");
                    }
                }
            })
        });
    });

    $(document).ready(function(){

        $('body').on('submit', '#job-quote-request-reply', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('update-job-request-details') }}",
                data: $(this).serializeArray(),
                success: function (response) {
                    $("#job-quote-request-reply textarea").val('');
                    $("#viewdetails").modal('hide');
                }
            })
        });
        
        // $("#message_trader").submit(function(e){
        // $('body').on('submit', '#message_trader', function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('customer.messages.store') }}",
        //         data: $(this).serializeArray(),
        //         success: function (response) {
        //             $("#message_trader textarea").val('');
        //             $("#messagetrader").modal('hide');
        //         }
        //     })
        // });

        $('body').on('submit', '#message_from_message', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('messagesreply.store') }}",
                data: $(this).serializeArray(),
                success: function (response) {
                    $("#message_from_message textarea").val('');
                    $(".view-chat-reply").append('<div class="myself"><div class="chating-txt-area"><div class="chat-txt">'+response+'</div></div></div>');
                }
            })
        });

        <?php if((request()->is('trader/messages') || request()->is('customer/messages')) && Session::get('to_user_type') != "") { ?>
            $('.chating-sec').scrollTop($('.chating-sec')[0].scrollHeight);
        <?php } ?>

        $(".messagetrader").click(function(){
            $("#message_trader").submit();
        });
        $("#bazaarchatuser").click(function(){
            $("#bazaar-chat-user").submit();
        });
        $('body').on('click', '.message_to_trader', function() {
            var trader_id = $(this).attr("data-trader-id");
            $("#message_trader").find("#to_user_id").val(trader_id);
            $("#message_trader").submit();
        });
        $('body').on('click', '.message_to_trader_from_list', function() {
            var trader_id = $(this).attr("data-trader-id");
            $("#message_trader_list").find("#to_user_id").val(trader_id);
            $("#message_trader_list").find("#trader_id").val(trader_id);
            $("#message_trader_list").submit();
        });

        
        $('body').on('click', '.chat-sec5', function() {
            $(".chat-sec5").removeClass('active');
            $(this).addClass("active");
            var user_type = $(this).attr('data-user-type');
            var user_id = $(this).attr('data-user-id');
            $.ajax({
                type: "POST",
                url: "{{ route('trader.messages.view-message') }}",
                data: {"_token": "{{ csrf_token() }}","user_type":user_type,"user_id":user_id},
                success: function (response) {
                    $(".chat-right").html(response);
                    $('.chating-sec').scrollTop($('.chating-sec')[0].scrollHeight);
                }
            })
        });


        $("#follow-trader").click(function(){
            var trader_id = $(this).attr("data-id");

            $.ajax({
                type: "POST",
                url: "{{ route('trader.addfollow') }}",
                data: {"_token": "{{ csrf_token() }}","trader_id":trader_id},
                success: function (response) { 
                    if(response == 0) {
                        alert("You are already following this trader.!!");
                    } else {
                        $("#follow-trader").find("span").text("Follow: " + response);
                        alert("You are now following this trader.!!");
                    }
                }
            })
        });
        $("#favourite-trader").click(function(){
            var trader_id = $(this).attr("data-id");

            $.ajax({
                type: "POST",
                url: "{{ route('trader.addfavourite') }}",
                data: {"_token": "{{ csrf_token() }}","trader_id":trader_id},
                success: function (response) { 
                    if(response == 0) {
                        alert("You have already made this trader favourite.!!");
                    } else {
                        $("#favourite-trader").find("span").text(response);
                        alert("You have made this trader favourite.!!");
                    }
                }
            })
        });
        
        $('#view-follow-trader').click(function() {
            var trader_id = $(this).attr("data-id");
            var url = '{{ route("trader-follows", ":trader_id") }}';
            url = url.replace(':trader_id', trader_id );
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    $("#view-trader-followers").html(response);
                    $("#view_followers").modal();
                }
            })
        });
        
        $('#view-favourite-trader').click(function() {
            var trader_id = $(this).attr("data-id");
            var url = '{{ route("trader-favourites", ":trader_id") }}';
            url = url.replace(':trader_id', trader_id );
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    $("#view-trader-favourites").html(response);
                    $("#view_favourites").modal();
                }
            })
        });
        
        $('#follow-customer').click(function() {
            var customer_id = $(this).attr("data-id");
            var url = '{{ route("customer-follows", ":customer_id") }}';
            url = url.replace(':customer_id', customer_id );
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    $("#view-customer-followers").html(response);
                    $("#view_custfollowers").modal();
                }
            })
        });
        
        $('#favourite-customer').click(function() {
            var customer_id = $(this).attr("data-id");
            var url = '{{ route("customer-favourites", ":customer_id") }}';
            url = url.replace(':customer_id', customer_id );
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    $("#view-customer-favourites").html(response);
                    $("#view_custfavourites").modal();
                }
            })
        });
    });
</script>
@if(request()->is('customer/edit-profile'))

<script>
  function initMap() {
    var autocomplete = new google.maps.places.Autocomplete($("#customer-location")[0], {}); 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#loc_latitude').val(lat);
        $('#loc_longitude').val(long);

    });
}
</script>
@endif

@if(request()->is('trader/edit-profile'))
<script type="text/javascript">
    var x = document.getElementById("current-location");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showcurrentPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showcurrentPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        displaycurrentLocation(latitude,longitude);
    }

    function displaycurrentLocation(latitude,longitude){
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);

    geocoder.geocode(
        {'latLng': latlng}, 
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");

                    count=value.length;
                    country=value[count-1];
                    state=value[count-2];
                    city=value[count-3];
                    $('#provider-location').val(add);
                    $('#loc_latitude').val(latitude);
                    $('#loc_longitude').val(longitude);
                }
                else  {
                    x.innerHTML = "Address not found";
                }
            }
            else {
                x.innerHTML = "Geocoder failed due to: " + status;
            }
        }
    );
  }
</script>
@endif
<script type="text/javascript">
    var x = document.getElementById("current_location");

    function getcurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showcurrent_Position);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showcurrent_Position(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        displaycurrent_Location(latitude,longitude);
    }

    function displaycurrent_Location(latitude,longitude){
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);

    geocoder.geocode(
        {'latLng': latlng}, 
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");

                    count=value.length;
                    country=value[count-1];
                    state=value[count-2];
                    city=value[count-3];
                    $('#currentPosition').val(add);
                    $('#currentLatitude').val(latitude);
                    $('#currentLongitude').val(longitude);
                }
                else  {
                    x.innerHTML = "Address not found";
                }
            }
            else {
                x.innerHTML = "Geocoder failed due to: " + status;
            }
        }
    );
  }
</script>
<script>
    $(document).ready(function() {
      if (window.File && window.FileList && window.FileReader) {
        $(".image-files").on("change", function(e) {
          var files = e.target.files,
            filesLength = files.length;
          for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
              var file = e.target;
              $("<span class=\"pip\">" +
                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/><span class=\"remove\"><i class=\"fa fa-close\"></i></span>" +
                "</span>").insertAfter(".image-files");

              $(".remove").click(function(){
                $(this).parent(".pip").remove();
              });
                        
            });
            fileReader.readAsDataURL(f);
          }
        });
      } else {
        alert("Your browser doesn't support to File API")
      }
      if (window.File && window.FileList && window.FileReader) {
        $(".image-files1").on("change", function(e) {
          var files = e.target.files,
            filesLength = files.length;
          for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
              var file = e.target;
              $("#completed-works").append("<span class=\"pip\">" +
                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/><span class=\"remove\"><i class=\"fa fa-close\"></i></span>" +
                "</span>");

              $(".remove").click(function(){
                $(this).parent(".pip").remove();
              });
                        
            });
            fileReader.readAsDataURL(f);
          }
        });
      } else {
        alert("Your browser doesn't support to File API")
      }
      if (window.File && window.FileList && window.FileReader) {
        $(".change-profile").on("change", function(e) {
          var files = e.target.files,
            filesLength = files.length;
          for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
              var file = e.target;
              $(".change-img").find("img").attr("src",e.target.result);
              $(".remove").click(function(){
                $(this).parent(".pip").remove();
              });
                        
            });
            fileReader.readAsDataURL(f);
          }
        });
      } else {
        alert("Your browser doesn't support to File API")
      }
});
</script>
<script>
    $(document).ready(function(){
        $(".postlikes").click(function(){
              var trader_post_id = $(this).attr("data-post-id");
              var url = '{{ route("get-trader-post-likes", ":trader_post_id") }}';
              url = url.replace(':trader_post_id', trader_post_id );
              $.ajax({
                type: "GET",
                url:url,
                success: function (response) { 
                    if(response != 0) {
                        $("#view-trader-postlikes").html(response);
                        $("#postlikes").modal();
                    } else {
                        alert("No data found.!");
                    }
                }
            })
        });

        $(".offerlikes").click(function(){ 
              var trader_offer_id = $(this).attr("data-offer-id");
              var url = '{{ route("get-trader-offer-likes", ":trader_offer_id") }}';
              url = url.replace(':trader_offer_id', trader_offer_id );
              $.ajax({
                type: "GET",
                url:url,
                success: function (response) { 
                    if(response != 0) {
                        $("#view-trader-offerlikes").html(response);
                        $("#offerlikes").modal();
                    } else {
                        alert("No data found.!");
                    }
                }
            })
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('body').on('click', '.postcomment-reply', function() {
            var currentdiv = $(this);
            var post_id = $(this).attr("data-post-id");
            var post_comment_id = $(this).attr("data-post-comment-id");
            var commentcount = $(this).attr("data-commentcount");

            $.ajax({
                type: "POST",
                url: "{{ route('trader.get-trader-post-comment-replies') }}",
                data: {"_token": "{{ csrf_token() }}","post_id":post_id,"post_comment_id":post_comment_id},
                success: function (response) { 
                    if(response != 0) {
                        currentdiv.parent().prev(".view-postcomment-reply").html(response);
                        currentdiv.addClass("remove-postcomment-reply");
                        currentdiv.removeClass("postcomment-reply");
                        if(commentcount > 1) {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide " +commentcount+ " Replies</span>");
                        } else {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide Reply</span>");
                        }
                        
                    } else {
                        alert("No replies.!");
                    }
                }
            })
        });
        $('body').on('click', '.remove-postcomment-reply', function() {
            var commentcount = $(this).attr("data-commentcount");
            $(this).addClass("postcomment-reply");
            $(this).removeClass("remove-postcomment-reply");
            if(commentcount > 1) {
                $(this).html("<span><i class='fa fa-mail-forward'></i>" +commentcount+ " Replies</span>");
            } else {
                $(this).html("<span><i class='fa fa-mail-forward'></i>1 Reply</span>");
            }
            $(this).parent().prev(".view-postcomment-reply").html('');
        });

        $('body').on('click', '.offercomment-reply', function() {
            var currentdiv = $(this);
            var offer_id = $(this).attr("data-offer-id");
            var offer_comment_id = $(this).attr("data-offer-comment-id");
            var offercommentcount = $(this).attr("data-offercommentcount");

            $.ajax({
                type: "POST",
                url: "{{ route('trader.get-trader-offer-comment-replies') }}",
                data: {"_token": "{{ csrf_token() }}","offer_id":offer_id,"offer_comment_id":offer_comment_id},
                success: function (response) { 
                    if(response != 0) {
                        currentdiv.parent().prev(".view-offercomment-reply").html(response);
                        currentdiv.addClass("remove-offercomment-reply");
                        currentdiv.removeClass("offercomment-reply");
                        if(offercommentcount > 1) {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide " +offercommentcount+ " Replies</span>");
                        } else {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide Reply</span>");
                        }
                        
                    } else {
                        alert("No replies.!");
                    }
                }
            })
        });

        $('body').on('click', '.remove-offercomment-reply', function() {
            var offercommentcount = $(this).attr("data-offercommentcount");
            $(this).addClass("offercomment-reply");
            $(this).removeClass("remove-offercomment-reply");
            if(offercommentcount > 1) {
                $(this).html("<span><i class='fa fa-mail-forward'></i>" +offercommentcount+ " Replies</span>");
            } else {
                $(this).html("<span><i class='fa fa-mail-forward'></i>1 Reply</span>");
            }
            $(this).parent().prev(".view-offercomment-reply").html('');
        });

        $('body').on('click', '.reviewcomment-reply', function() {
            var currentdiv = $(this);
            var review_id = $(this).attr("data-review-id");
            var review_comment_id = $(this).attr("data-review-comment-id");
            var commentcount = $(this).attr("data-commentcount");

            $.ajax({
                type: "POST",
                url: "{{ route('trader.get-trader-review-comment-replies') }}",
                data: {"_token": "{{ csrf_token() }}","review_id":review_id,"review_comment_id":review_comment_id},
                success: function (response) { 
                    if(response != 0) {
                        currentdiv.parent().prev(".view-reviewcomment-reply").html(response);
                        currentdiv.addClass("remove-reviewcomment-reply");
                        currentdiv.removeClass("reviewcomment-reply");
                        if(commentcount > 1) {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide " +commentcount+ " Replies</span>");
                        } else {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide Reply</span>");
                        }
                        
                    } else {
                        alert("No replies.!");
                    }
                }
            })
        });
        $('body').on('click', '.remove-reviewcomment-reply', function() {
            var commentcount = $(this).attr("data-commentcount");
            $(this).addClass("reviewcomment-reply");
            $(this).removeClass("remove-reviewcomment-reply");
            if(commentcount > 1) {
                $(this).html("<span><i class='fa fa-mail-forward'></i>" +commentcount+ " Replies</span>");
            } else {
                $(this).html("<span><i class='fa fa-mail-forward'></i>1 Reply</span>");
            }
            $(this).parent().prev(".view-reviewcomment-reply").html('');
        });
    });
</script>

<script>
$(document).ready(function(){
    $(".trader-post-comment").submit(function(e){
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addpostcomment') }}",
            data: postData,
            success: function (data) {
                currentdiv.find("input[name=post_comment]").val('');
                currentdiv.parent().parent().find(".postcommentscount").text("Comments ("+(parseInt(commentsCount)+1)+")");
                if(commentsCount > 0) {
                    currentdiv.parent().prev().find('.post-has-comments').append(data);
                    currentdiv.find("input[name=allcomments]").val(parseInt(commentsCount)+1);
                } else {
                    currentdiv.find("input[name=allcomments]").val(1);
                    currentdiv.parent().prev(".post-first-comment").html(data);
                }
            }
        })      
    });

    $('body').on('submit', '.trader-post-comment-reply', function(e) {
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addpostcommentreply') }}",
            data: postData,
            success: function (response) {
                currentdiv.find("input[name=post_comment]").val('');
                currentdiv.parent().parent().parent().parent().parent().find(".view-postcomment-reply").html(response);
            }
        })      
    });


    $('body').on('click', '.show-all-post-comments', function() {
        var post_id = $(this).attr("data-post-id");
        var currentdiv = $(this);
        var url = '{{ route("trader.view-all-post-comments", ":post_id") }}';
        url = url.replace(':post_id', post_id );
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) { 
                if(response != 0) {
                    currentdiv.prev(".view-all-post-comments").html(response);
                    currentdiv.addClass("remove-all-post-comments");
                    currentdiv.removeClass("show-all-post-comments");
                    currentdiv.html("<span>Hide Comments</span>");
                    
                } else {
                    alert("No comments.!");
                }
            }
        })
    });

    $('body').on('click', '.remove-all-post-comments', function() {
        $(this).addClass("show-all-post-comments");
        $(this).removeClass("remove-all-post-comments");
        $(this).html("<span>View All Comments</span>");
        $(this).prev(".view-all-post-comments").html('');
    });
});
</script>
<script>
$(document).ready(function(){
    $(".trader-offer-comment").submit(function(e){
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addoffercomment') }}",
            data: postData,
            success: function (data) {
                currentdiv.find("input[name=offer_comment]").val('');
                currentdiv.parent().parent().find(".offercommentscount").text("Comments ("+(parseInt(commentsCount)+1)+")");
                if(commentsCount > 0) {
                    currentdiv.parent().prev().find('.offer-has-comments').append(data);
                    currentdiv.find("input[name=allcomments]").val(parseInt(commentsCount)+1);
                } else {
                    currentdiv.find("input[name=allcomments]").val(1);
                    currentdiv.parent().prev(".offer-first-comment").html(data);
                }
            }
        })      
    });

    $('body').on('submit', '.trader-offer-comment-reply', function(e) {
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addoffercommentreply') }}",
            data: postData,
            success: function (response) {
                currentdiv.find("input[name=offer_comment]").val('');
                currentdiv.parent().parent().parent().parent().parent().find(".view-offercomment-reply").html(response);
            }
        })      
    });


    $('body').on('click', '.show-all-offer-comments', function() {
        var offer_id = $(this).attr("data-offer-id");
        var currentdiv = $(this);
        var url = '{{ route("trader.view-all-offer-comments", ":offer_id") }}';
        url = url.replace(':offer_id', offer_id );
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) { 
                if(response != 0) {
                    currentdiv.prev(".view-all-offer-comments").html(response);
                    currentdiv.addClass("remove-all-offer-comments");
                    currentdiv.removeClass("show-all-offer-comments");
                    currentdiv.html("<span>Hide Comments</span>");
                    
                } else {
                    alert("No comments.!");
                }
            }
        })
    });

    $('body').on('click', '.remove-all-offer-comments', function() {
        $(this).addClass("show-all-offer-comments");
        $(this).removeClass("remove-all-offer-comments");
        $(this).html("<span>View All Comments</span>");
        $(this).prev(".view-all-offer-comments").html('');
    });
});
</script>

<script>
$(document).ready(function(){
    $(".trader-review-comment").submit(function(e){
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addreviewcomment') }}",
            data: postData,
            success: function (data) {
                currentdiv.find("input[name=review_comment]").val('');
                if(commentsCount > 0) { 
                    currentdiv.parent().parent().parent().parent().parent().find('.review-has-comments').append(data);
                    currentdiv.find("input[name=allcomments]").val(parseInt(commentsCount)+1);
                } else {
                    currentdiv.find("input[name=allcomments]").val(1);
                    currentdiv.parent().parent().parent().parent().find(".review-first-comment").html(data);
                }
            }
        })      
    });

    $('body').on('submit', '.trader-review-comment-reply', function(e) {
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addreviewcommentreply') }}",
            data: postData,
            success: function (response) {
                currentdiv.find("input[name=review_comment]").val('');
                currentdiv.parent().parent().parent().parent().find(".view-reviewcomment-reply").html(response);
            }
        })      
    });


    $('body').on('click', '.show-all-review-comments', function() {
        var review_id = $(this).attr("data-review-id");
        var currentdiv = $(this);
        var url = '{{ route("trader.view-all-review-comments", ":review_id") }}';
        url = url.replace(':review_id', review_id );
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) { 
                if(response != 0) {
                    currentdiv.prev(".view-all-review-comments").html(response);
                    currentdiv.addClass("remove-all-review-comments");
                    currentdiv.removeClass("show-all-review-comments");
                    currentdiv.html("<span>Hide Comments</span>");
                    
                } else {
                    alert("No comments.!");
                }
            }
        })
    });

    $('body').on('click', '.remove-all-review-comments', function() {
        $(this).addClass("show-all-review-comments");
        $(this).removeClass("remove-all-review-comments");
        $(this).html("<span>View All Comments</span>");
        $(this).prev(".view-all-review-comments").html('');
    });
});
</script>
<script>
$(document).ready(function(){
    $(".customer-post-comment").submit(function(e){
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addpostcommentcustomer') }}",
            data: postData,
            success: function (data) {
                currentdiv.find("input[name=post_comment]").val('');
                currentdiv.parent().parent().find(".postcommentscount").text("Comments ("+(parseInt(commentsCount)+1)+")");
                if(commentsCount > 0) {
                    currentdiv.parent().prev().find('.post-has-comments').append(data);
                    currentdiv.find("input[name=allcomments]").val(parseInt(commentsCount)+1);
                } else {
                    currentdiv.find("input[name=allcomments]").val(1);
                    currentdiv.parent().prev(".post-first-comment").html(data);
                }
            }
        })      
    });

    $('body').on('submit', '.customer-post-comment-reply', function(e) {
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addpostcommentreplycustomer') }}",
            data: postData,
            success: function (response) {
                currentdiv.find("input[name=post_comment]").val('');
                currentdiv.parent().parent().parent().parent().parent().find(".view-postcomment-reply").html(response);
            }
        })      
    });

    $(".customer-offer-comment").submit(function(e){
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addoffercommentcustomer') }}",
            data: postData,
            success: function (data) {
                currentdiv.find("input[name=offer_comment]").val('');
                currentdiv.parent().parent().find(".offercommentscount").text("Comments ("+(parseInt(commentsCount)+1)+")");
                if(commentsCount > 0) {
                    currentdiv.parent().prev().find('.offer-has-comments').append(data);
                    currentdiv.find("input[name=allcomments]").val(parseInt(commentsCount)+1);
                } else {
                    currentdiv.find("input[name=allcomments]").val(1);
                    currentdiv.parent().prev(".offer-first-comment").html(data);
                }
            }
        })      
    });

    $('body').on('submit', '.customer-offer-comment-reply', function(e) {
        var currentdiv = $(this);
        e.preventDefault();
        var postData = $(this).serializeArray();
        var commentsCount = postData[6].value;
        $.ajax({
            type: "POST",
            url: "{{ route('addoffercommentreplycustomer') }}",
            data: postData,
            success: function (response) {
                currentdiv.find("input[name=offer_comment]").val('');
                currentdiv.parent().parent().parent().parent().parent().find(".view-offercomment-reply").html(response);
            }
        })      
    });
});
</script>

<script>
    $(document).ready(function(){
        $('body').on('click', '.diyhelpcomment-reply', function() {
            var currentdiv = $(this);
            var diyhelp_id = $(this).attr("data-diyhelp-id");
            var diyhelp_comment_id = $(this).attr("data-diyhelp-comment-id");
            var commentcount = $(this).attr("data-commentcount");

            $.ajax({
                type: "POST",
                url: "{{ route('get-diy-help-comment-replies') }}",
                data: {"_token": "{{ csrf_token() }}","diyhelp_id":diyhelp_id,"diyhelp_comment_id":diyhelp_comment_id},
                success: function (response) { 
                    if(response != 0) {
                        currentdiv.parent().prev(".view-diyhelpcomment-reply").html(response);
                        currentdiv.addClass("remove-diyhelpcomment-reply");
                        currentdiv.removeClass("diyhelpcomment-reply");
                        if(commentcount > 1) {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide " +commentcount+ " Replies</span>");
                        } else {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide Reply</span>");
                        }
                        
                    } else {
                        alert("No replies.!");
                    }
                }
            })
        });
        $('body').on('click', '.remove-diyhelpcomment-reply', function() {
            var commentcount = $(this).attr("data-commentcount");
            $(this).addClass("diyhelpcomment-reply");
            $(this).removeClass("remove-diyhelpcomment-reply");
            if(commentcount > 1) {
                $(this).html("<span><i class='fa fa-mail-forward'></i>" +commentcount+ " Replies</span>");
            } else {
                $(this).html("<span><i class='fa fa-mail-forward'></i>1 Reply</span>");
            }
            $(this).parent().prev(".view-diyhelpcomment-reply").html('');
        });

        $(".diyhelp-comment").submit(function(e){
            var currentdiv = $(this);
            e.preventDefault();
            var postData = $(this).serializeArray();
            var commentsCount = postData[5].value; 
            $.ajax({
                type: "POST",
                url: "{{ route('adddiyhelpcomment') }}",
                data: postData,
                success: function (data) {
                    currentdiv.find("input[name=diy_help_comment]").val('');
                    currentdiv.parent().parent().parent().parent().find(".diyhelpcommentscount").text("Comments ("+(parseInt(commentsCount)+1)+")");
                    if(commentsCount > 0) {
                        currentdiv.parent().parent().parent().parent().find('.diyhelp-has-comments').append(data);
                        currentdiv.find("input[name=allcomments]").val(parseInt(commentsCount)+1);
                    } else {
                        currentdiv.find("input[name=allcomments]").val(1);
                        currentdiv.parent().parent().parent().parent().find(".diyhelp-first-comment").html(data);
                    }
                }
            })      
        });

        $('body').on('submit', '.diyhelp-comment-reply', function(e) {
            var currentdiv = $(this);
            e.preventDefault();
            var postData = $(this).serializeArray();
            var commentsCount = postData[5].value;
            $.ajax({
                type: "POST",
                url: "{{ route('adddiyhelpcommentreply') }}",
                data: postData,
                success: function (response) {
                    currentdiv.find("input[name=diy_help_comment]").val('');
                    currentdiv.parent().parent().parent().parent().parent().find(".view-diyhelpcomment-reply").html(response);
                }
            })      
        });


        $('body').on('click', '.show-all-diyhelp-comments', function() {
            var diyhelp_id = $(this).attr("data-diyhelp-id");
            var currentdiv = $(this);
            var url = '{{ route("view-all-diyhelp-comments", ":diyhelp_id") }}';
            url = url.replace(':diyhelp_id', diyhelp_id );
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) { 
                    if(response != 0) {
                        currentdiv.prev(".view-all-diyhelp-comments").html(response);
                        currentdiv.addClass("remove-all-diyhelp-comments");
                        currentdiv.removeClass("show-all-diyhelp-comments");
                        currentdiv.html("<span>Hide Comments</span>");
                        
                    } else {
                        alert("No comments.!");
                    }
                }
            })
        });

        $('body').on('click', '.remove-all-diyhelp-comments', function() {
            $(this).addClass("show-all-diyhelp-comments");
            $(this).removeClass("remove-all-diyhelp-comments");
            $(this).html("<span>View All Comments</span>");
            $(this).prev(".view-all-diyhelp-comments").html('');
        });
    });
</script>
<script>
$(document).ready(function(){
    $(".trader-quote-job").click(function(){
        var job_id = $(this).attr("data-job-id");
        var job_title = $(this).attr("data-job-title");
        $("#traderquotejob").find("#job-id").val(job_id);
        $("#traderquotejob").find(".modal-title").text(job_title);
        $("#traderquotejob").modal();
    });
});
</script>

<script>
    $(document).ready(function(){
        $('body').on('click', '.jobquotecomment-reply', function() {
            var currentdiv = $(this);
            var job_id = $(this).attr("data-job-id");
            var job_quote_id = $(this).attr("data-job-quote-id");
            var job_quote_details_id = $(this).attr("data-jobquote-details-id");
            var commentcount = $(this).attr("data-commentcount");

            $.ajax({
                type: "POST",
                url: "{{ route('get-job-quote-details') }}",
                data: {"_token": "{{ csrf_token() }}","job_id":job_id,"job_quote_id":job_quote_id,"job_quote_details_id":job_quote_details_id},
                success: function (response) { 
                    if(response != 0) {
                        currentdiv.parent().prev(".view-jobquotecomment-reply").html(response);
                        currentdiv.addClass("remove-jobquotecomment-reply");
                        currentdiv.removeClass("jobquotecomment-reply");
                        if(commentcount > 1) {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide " +commentcount+ " Replies</span>");
                        } else {
                            currentdiv.html("<span><i class='fa fa-mail-forward'></i>Hide Reply</span>");
                        }
                        
                    } else {
                        alert("No replies.!");
                    }
                }
            })
        });
        $('body').on('click', '.remove-jobquotecomment-reply', function() {
            var commentcount = $(this).attr("data-commentcount");
            $(this).addClass("jobquotecomment-reply");
            $(this).removeClass("remove-jobquotecomment-reply");
            if(commentcount > 1) {
                $(this).html("<span><i class='fa fa-mail-forward'></i>" +commentcount+ " Replies</span>");
            } else {
                $(this).html("<span><i class='fa fa-mail-forward'></i>1 Reply</span>");
            }
            $(this).parent().prev(".view-jobquotecomment-reply").html('');
        });

        // $(".diyhelp-comment").submit(function(e){
        //     var currentdiv = $(this);
        //     e.preventDefault();
        //     var postData = $(this).serializeArray();
        //     var commentsCount = postData[5].value; 
        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('adddiyhelpcomment') }}",
        //         data: postData,
        //         success: function (data) {
        //             currentdiv.find("input[name=diy_help_comment]").val('');
        //             currentdiv.parent().parent().parent().parent().find(".diyhelpcommentscount").text("Comments ("+(parseInt(commentsCount)+1)+")");
        //             if(commentsCount > 0) {
        //                 currentdiv.parent().parent().parent().parent().find('.diyhelp-has-comments').append(data);
        //                 currentdiv.find("input[name=allcomments]").val(parseInt(commentsCount)+1);
        //             } else {
        //                 currentdiv.find("input[name=allcomments]").val(1);
        //                 currentdiv.parent().parent().parent().parent().find(".diyhelp-first-comment").html(data);
        //             }
        //         }
        //     })      
        // });

        $('body').on('submit', '.job-quote-reply', function(e) {
            var currentdiv = $(this);
            e.preventDefault();
            var postData = $(this).serializeArray();
            var commentsCount = postData[5].value;
            $.ajax({
                type: "POST",
                url: "{{ route('addjobquotedetailsreply') }}",
                data: postData,
                success: function (response) {
                    currentdiv.find("input[name=job_quote_details]").val('');
                    currentdiv.parent().parent().parent().parent().parent().find(".view-jobquotecomment-reply").html(response);
                }
            })      
        });


        $('body').on('click', '.show-all-jobquote-comments', function() {
            var job_quote_id = $(this).attr("data-job-quote-id");
            var currentdiv = $(this);
            var url = '{{ route("view-all-jobquote-details", ":job_quote_id") }}';
            url = url.replace(':job_quote_id', job_quote_id );
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) { 
                    if(response != 0) {
                        currentdiv.prev(".view-all-jobquote-comments").html(response);
                        currentdiv.addClass("remove-all-jobquote-comments");
                        currentdiv.removeClass("show-all-jobquote-comments");
                        currentdiv.html("<span>Hide Comments</span>");
                        
                    } else {
                        alert("No comments.!");
                    }
                }
            })
        });

        $('body').on('click', '.remove-all-jobquote-comments', function() {
            $(this).addClass("show-all-jobquote-comments");
            $(this).removeClass("remove-all-jobquote-comments");
            $(this).html("<span>View All Comments</span>");
            $(this).prev(".view-all-jobquote-comments").html('');
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.product-added-user').popover({
          html: true,
          trigger: 'hover',
          placement: 'top',
          content: function(){
            return '<div class="popover-sec"><div class="pic"><img src="'+$(this).data('img') + '" /></div><div class="pic-details"><h5>'+$(this).data('name') + '</h5><p>Since '+$(this).data('joined')+'<p><div></div>';
            }
        }); 
    });
</script>
@if(request()->is('trader/profile/*'))
<script>
document.getElementById('shareBtn').onclick = function() {
    var url = $(this).attr("data-url");
  FB.ui({
    display: 'popup',
    method: 'share',
    href: url,
  }, function(response){});
}
</script>
@endif
<script>
$(".printprofile").click(function(){
    var divToPrint=document.getElementById('printprofile');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close();},10);
});
</script>
<script>
    $(function() {
        $("#search-chat-user").keyup(function(){
            var user = $(this).val();
            var url = '{{ route("get-chat-user", ":user") }}';
            url = url.replace(':user', user);
            $.get(url, function(data){
              $(".chat-list").html(data);
            });
        });
    });
    </script>
</body>
</html>