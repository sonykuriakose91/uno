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
<div class="inner-area">
    <div class="container">
        <div class="row">
            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
            <div class="col-lg-12" id="printprofile" style="display:none">
                <div style="width: 100%; background: #FFF; margin-bottom: 15px;">
                    <div style="width: 96%; padding: 2%; background-color: #55AA47; -webkit-border-top-left-radius: 6px; -webkit-border-top-right-radius: 6px; -moz-border-radius-topleft: 6px; -moz-border-radius-topright: 6px; border-top-left-radius: 6px; border-top-right-radius: 6px; position: relative; overflow: hidden;">
                        <div style="width: 85px; height: 85px; float: left; border-radius: 50%; overflow: hidden; border: 10px solid #8AC580; position: relative; z-index: 1;">
                            <img src="{{ asset('uploads/providers/profile/'.$provider->profile_pic) }}" alt="profile" style="width: 100%;">
                        </div>
                        <div style="width: 85px; height: 85px; float: right; background: #C7F173; padding: 9px; position: relative; z-index: 1;">
                            <img src="{{ asset('uploads/providers/qrcode/'.$provider->qrcode) }}" alt="barcode" style="width: 100%;">
                        </div>
                    </div>
                    <div style="width: 96%; padding: 2%;">
                        <div style="width: 100%; border-bottom: 1px solid #E7E7E7;padding-bottom: 10px; margin-bottom: 10px;">
                            <div style="font-size: 16px; font-weight: 700; color: #212121; margin: 0;">{{ $provider->name }}</div>
                            <div style="font-size: 14px; color: #616161;">{{ isset($provider->providercategories[0]->getcategory->category)?$provider->providercategories[0]->getcategory->category:"" }} <span style="float: right; color: #373737;">ID : {{ $provider->username }}</span></div>
                        </div>
                        <div style="width: 100%;">
                            <div style="width: 100%; margin-bottom: 15px; font-size: 14px; color: #616161; font-weight: 400;">
                                <img src="{{ asset('ui/images/icon-whatsapp.svg') }}" alt="whatsapp" style="margin-right: 10px;float: left;">+{{ $provider->country_code }} {{ $provider->mobile }}
                            </div>
                            <div style="width: 100%; margin-bottom: 15px; font-size: 14px; color: #616161; font-weight: 400;">
                                <img src="{{ asset('ui/images/icon-phone.svg') }}" alt="phone" style="margin-right: 10px;float: left;">+{{ $provider->country_code }} {{ $provider->mobile }}
                            </div>
                            <div style="width: 100%; margin-bottom: 15px; font-size: 14px; color: #616161; font-weight: 400;">
                                <img src="{{ asset('ui/images/icon-email.svg') }}" alt="email" style="margin-right: 10px;float: left;">{{ $provider->email }}
                            </div>
                            @if($provider->web_url != "")
                            <div style="width: 100%; margin-bottom: 15px; font-size: 14px; color: #616161; font-weight: 400;">
                                <img src="{{ asset('ui/images/icon-web.svg') }}" alt="website" style="margin-right: 10px;float: left;">{{ $provider->web_url }}
                            </div>
                            @endif
                            <div style="width: 100%; margin-bottom: 15px; font-size: 14px; color: #616161; font-weight: 400;">
                                <img src="{{ asset('ui/images/icon-time.svg') }}" alt="time" style="margin-right: 10px;float: left;">{{ date('h:i A',$provider->available_time_from) .' - '. date('h:i A',$provider->available_time_to) }}
                            </div>
                            <div style="width: 100%; margin-bottom: 15px; font-size: 14px; color: #616161; font-weight: 400;">
                                <img src="{{ asset('ui/images/icon-map.svg') }}" alt="map" style="margin-right: 10px;float: left;"><a href="https://maps.google.com/maps?q={{ $provider->location.'&sll'.$provider->loc_latitude.','.$provider->loc_longitude }}" target="_blank">{{ $provider->location }}</a>
                            </div>
                            <div style="width: 100%; margin-bottom: 15px; font-size: 14px; color: #616161; font-weight: 400;">
                                <img src="{{ asset('ui/images/landmark.svg') }}" alt="map" style="margin-right: 10px;float: left;">{{ $provider->landmark }}
                            </div>
                            <div style="width: 100%; padding: 10px; border: 1px solid #cdf5c7; border-radius: 6px; background: #dbffd5; margin-bottom: 10px;">{{ $provider->landmark_data }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- profile area -->
                <div class="profile-sec">
                        <div class="profile-head">
                            <div class="profile-img"><img src="{{ asset('uploads/providers/profile/'.$provider->profile_pic) }}" alt="profile"></div>
                            <div class="barcode"><img src="{{ asset('uploads/providers/qrcode/'.$provider->qrcode) }}" alt="barcode"></div>
                        </div>
                        <div class="profile-details">
                            <div class="name-sec">
                                <h5>{{ $provider->name }}</h5>
                                <p>{{ isset($provider->providercategories[0]->getcategory->category)?$provider->providercategories[0]->getcategory->category:"" }} <span>ID : {{ $provider->username }}</span></p>
                                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                                <a href="{{ route('edit-trader-profile',$provider->id) }}">Edit Profile</a>
                                <a class="pull-right printprofile" href="#">Print</a>
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
                                    <li><img src="{{ asset('ui/images/icon-whatsapp.svg') }}" alt="whatsapp">+{{ $provider->country_code }} {{ (Auth::guard('web')->check())?$provider->mobile:"XXXXXXXXXX" }}</li>
                                    <li><img src="{{ asset('ui/images/icon-phone.svg') }}" alt="phone">+{{ $provider->country_code }} {{ (Auth::guard('web')->check())?$provider->mobile:"XXXXXXXXXX" }}</li>
                                    <li><img src="{{ asset('ui/images/icon-email.svg') }}" alt="email">{{ (Auth::guard('web')->check())?$provider->email:"xxxxxx@xxxx.com" }}</li>
                                    <li><img src="{{ asset('ui/images/icon-web.svg') }}" alt="website">{{ (Auth::guard('web')->check())?$provider->web_url:"www.xxxxxxxxx.com" }}</li>
                                    <li><img src="{{ asset('ui/images/icon-time.svg') }}" alt="time">{{ date('h:i A',$provider->available_time_from) .' - '. date('h:i A',$provider->available_time_to) }}</li>
                                    <li><img src="{{ asset('ui/images/icon-map.svg') }}" alt="map"><a href="https://maps.google.com/maps?q={{ $provider->location.'&sll'.$provider->loc_latitude.','.$provider->loc_longitude }}" target="_blank">{{ $provider->location }}</a></li>
                                    <li><img src="{{ asset('ui/images/landmark.svg') }}" alt="map">{{ $provider->landmark }}</li>
                                </ul>
                                <div class="landmark">
                                    <p>{{ $provider->landmark_data }}</p>
                                </div>
                            </div>
                        <?php 
                        $blockdetails = 0;
                            if(Auth::guard('web')->check()) {
                                if(Auth::guard('web')->user()->user_type == "customer") {
                                    $block = new App\Models\Block;
                                    $blockdetails = $block::where(['trader_id' => $provider->id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
                                }
                            }
                        ?>
                        <?php $url = url()->current(); ?>
                        <div class="details-btn">
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer" && $blockdetails == 0)
                            
                            @if(Request::segment(4) != "" && Request::segment(4) == "seek-quote" && Request::segment(5) != "")
                            <a href="{{ route('traderrequestquote', [Request::segment(5),$provider->id]) }}" class="get-quote">Seek Quote</a>
                            @else
                            <a href="#" class="get-quote" data-toggle="modal" data-target="#quote">Get a Quote</a>
                            @endif
                            @endif
                            @if(Auth::guard('web')->check() && $blockdetails == 0 && Auth::guard('web')->user()->user_id != $provider->id)
                            <button class="message messagetrader">Message</button>
                            @endif
                            @if(Auth::guard('web')->check())
                            <form style="display:none;" class="form-horizontal" autocomplete="off" id="message_trader" method="POST" action="{{ route('trader.messages.store') }}">
                                @csrf
                                <input type="hidden" name="from_user_type" value="{{ (Auth::guard('web')->user()->user_type == 'provider')?'trader':'customer' }} ">
                                <input type="hidden" name="from_user_id" value="{{ Auth::guard('web')->user()->user_id }}" >
                                <input type="hidden" name="to_user_type" value="trader" >
                                <input type="hidden" name="to_user_id" value="{{ $provider->id }}">
                                <textarea name="message" placeholder="Message" required></textarea>
                                <button>Send</button>
                            </form>
                        @endif
                        </div>
                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer")
                        <div class="details-btn">
                            @if($blockdetails == 0)
                            <a href="{{ route('block-user',$provider->id) }}" class="get-quote" style="float: none;">Block</a>
                            @else
                            <a href="{{ route('unblock-user',$provider->id) }}" class="get-quote" style="float: none;">UnBlock</a>
                            @endif
                        </div>
                        @endif
                        <div class="follow-sec">
                        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "provider" && Auth::guard('web')->user()->user_id == $provider->id) { ?>
                            <button class="follow" id="view-follow-trader" data-id="{{ $provider->id }}" title="Follow">
                                <img src="{{ asset('ui/images/follow.svg') }}" alt="follow"> 
                                <span> Follow: {{ count($provider->providerfollows) }}</span>
                            </button>
                        <?php } elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->user_id != $provider->id) { ?>
                            <button class="follow" id="follow-trader" data-id="{{ $provider->id }}" title="Follow">
                                <img src="{{ asset('ui/images/follow.svg') }}" alt="follow"> 
                                <span> Follow: {{ count($provider->providerfollows) }}</span>
                            </button>
                            <?php } else { ?>
                                <button class="follow" onclick="openLoginModal('<?php echo $url; ?>');" data-id="{{ $provider->id }}" title="Follow">
                                <img src="{{ asset('ui/images/follow.svg') }}" alt="follow"> 
                                <span> Follow: {{ count($provider->providerfollows) }}</span>
                            </button>
                            <?php } ?>
                            <div id="view-trader-followers"></div>

                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "provider" && Auth::guard('web')->user()->user_id == $provider->id) { ?>
                                <button class="like" title="Like" id="view-favourite-trader" data-id="{{ $provider->id }}">
                                    <img src="{{ asset('ui/images/heart.svg') }}" alt="heart">
                                    <span>{{ count($provider->providerfavourites) }}</span>
                                </button>
                            <?php } elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->user_id != $provider->id) { ?>
                                <button class="like" title="Like" id="favourite-trader" data-id="{{ $provider->id }}">
                                    <img src="{{ asset('ui/images/heart.svg') }}" alt="heart">
                                    <span>{{ count($provider->providerfavourites) }}</span>
                            </button>
                            <?php } else { ?>
                                <button class="like" title="Like" onclick="openLoginModal('<?php echo $url; ?>');" data-id="{{ $provider->id }}">
                                    <img src="{{ asset('ui/images/heart.svg') }}" alt="heart">
                                    <span>{{ count($provider->providerfavourites) }}</span>
                            </button>
                            <?php } ?>

                            <div id="view-trader-favourites"></div>
                        </div>
                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer")
                        <!-- Get a Quote -->
                        <div class="modal fade" id="quote" role="dialog">
                            <div class="modal-dialog" style="width: 60%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Seek Quote</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="review-box" style="float:none;">
                                        <form class="form-horizontal" autocomplete="off" action="{{ route('trader-profile-postjob',$provider->username) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <?php
                                                $user = new App\Models\Customers;
                                                $category = new App\Models\Categories;
                                                if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {
                                                    $userdetails = $user::where(['status' => 1, 'id' => Auth::guard('web')->user()->user_id])->first();

                                                $categories = $category::where(['parent_category' => 0, 'status' => 1])->get();
                                                }
                                                
                                            ?>
                                        <input type="hidden" name="user_id" value="{{ $userdetails->id }}" >
                                        <input type="hidden" name="trader_id" value="{{ $provider->id }}" >
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label>Name</label>
                                                <input type="text" name="name" value="{{ $userdetails->name }}" placeholder="Name" required readonly>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label>Phone</label>
                                                <input type="text" name="phone" value="{{ '+'.$userdetails->country_code. ' '.$userdetails->mobile }}" placeholder="Phone" required readonly>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label>Category</label>
                                                <select name="category_id" class="category" required>
                                                    <option>Select Category</option>
                                                    @if(count($categories) > 0)
                                                    @foreach($categories as $key => $category)
                                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label>Sub Category</label>
                                                <select name="sub_category_id" required class="sub_category">
                                                    <option>Select Sub Category</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Title</label>
                                                <input type="text" name="title" placeholder="Title" required>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Description</label>
                                                <textarea name="description" required placeholder="Description about work"></textarea>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label>Budget</label>
                                                <input type="text" name="budget" placeholder="Budget/Price" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label>Time for Completion</label>
                                                <select name="job_completion" required>
                                                    <option value="">Select</option>
                                                    <option value="Urgent">Urgent</option>
                                                    <option value="In 2 Days">In 2 Days</option>
                                                    <option value="In 1 Week">In 1 Week</option>
                                                    <option value="In 1 Month">In 1 Month</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Location</label>
                                                <input type="text" required name="job_location" placeholder="Location" id="job-location">
                                                  <input type="hidden" name="loc_latitude" value="" id="loc_latitude" />
                                                  <input type="hidden" name="loc_longitude" value="" id="loc_longitude" />
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label>&nbsp;</label>
                                                <label class="checkbox-inline" style="padding-left:0px;">
                                                  <input type="checkbox" style="height: 16px;" name="material_purchased">Materials Purchased
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label>Photos</label>
                                                <input type="file" class="image-files" required name="job_images[]" multiple>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                <button type="submit" name="postjob" value="Seek Quote">Seek Quote</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                            <!-- Get a Quote close -->
                            @endif
                        <div class="share">
                            <div class="sharetitle">Share Post</div>
                            <div class="shareimg">
                                <a href="javascript:;" id="shareBtn" data-url="{{ $url }}"><img src="{{ asset('ui/images/facebook.png') }}" alt="media"></a>
                                <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="{{ asset('ui/images/linkdin.png') }}" alt="media"></a>
                                <!-- <a target="_blank" href="https://twitter.com/intent/tweet?url={{ $url }}"></a> -->
                                <a target=_blank href="https://twitter.com/share?url={{ $url }}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="{{ asset('ui/images/twitter.png') }}" alt="media"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- skills -->
                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                @include('web-ui.trader.trader-menu')
                @endif
                <div class="skills-area">
                    <h5>Skills & Services</h5>
                    @if($provider->providerservices)
                    <ul>
                        @foreach($provider->providerservices as $key => $service)
                        <li>{{ $service->getservice->service }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
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
                <div class="trader-details">
                    <ul>
                        <li><img src="{{ asset('ui/images/user.svg') }}" alt="user"> {{ $provider->type }}</li>
                        <li>Since : {{ date('Y', strtotime($provider->created_at)) }}</li>
                        <li>ID : <span class="{{ ($provider->providerdocuments[0]->proof_type == "ID Proof" && $provider->providerdocuments[0]->verified == 1)?"verified":"pending" }}">{{ ($provider->providerdocuments[0]->proof_type == "ID Proof" && $provider->providerdocuments[0]->verified == 1)?"Verified":"Pending" }}</span></li>
                        <li>Address : <span class="{{ ($provider->providerdocuments[1]->proof_type == "Address Proof" && $provider->providerdocuments[1]->verified == 1)?"verified":"pending" }}">{{ ($provider->providerdocuments[1]->proof_type == "Address Proof" && $provider->providerdocuments[1]->verified == 1)?"Verified":"Pending" }}</span></li>
                        <li>Reference : <span class="{{ ($provider->reference == 1)?"verified":"pending" }}">{{ ($provider->reference == 1)?"Verified":"Pending" }}</span></li>
                    </ul>
                </div>
                <div class="completed-works">
                    <h6>Completed Works</h6>
                    @if($provider->providerworks)
                    <ul>
                        @foreach($provider->providerworks as $key => $work)
                        <li>
                            <a href="{{ asset('uploads/providers/works/'.$work->image) }}" data-fancybox="images" data-caption="works">
                                <img src="{{ asset('uploads/providers/works/'.$work->image) }}" alt="works">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="company-profile">
                        <!-- <h6>Completed Works</h6> -->
                        <p>{!! html_entity_decode($provider->completed_works) !!}</p>
                            <!-- <button>Show More</button> -->
                    </div>
                    <div class="score-sec" style="display: none;">
                        <ul>
                            <li>Reliability</li>
                            <li>Courtesy</li>
                            <li>Tidiness</li>
                            <li>Workmanship</li>
                        </ul>
                    </div>
                    
                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer' && $provider->appointment == 1 && $blockdetails == 0)
                    <div class="book-appointment">
                        <a href="#" data-toggle="modal" data-target="#appointment">Book an Appointment</a>
                    </div>
                    <div class="modal fade" id="appointment" role="dialog">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Book an Appointment</h4>
                            </div>
                            <?php
                            $user = new App\Models\Customers;
                            $userdetails = $user::where(['status' => 1, 'id' => Auth::guard('web')->user()->user_id])->first();
                            ?>
                            <div class="modal-body">
                                <div class="appointment-sec">
                                    <form class="form-horizontal" autocomplete="off" action="{{ route('book-appointment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $userdetails->id }}" >
                                    <input type="hidden" name="trader_id" value="{{ $provider->id }}" >
                                    <label>Name</label>
                                    <input type="text" value="{{ $userdetails->name }}" readonly>
                                    <label>Email ID</label>
                                    <input type="email" value="{{ $userdetails->email }}" readonly>
                                    <label>Phone</label>
                                    <input type="text" value="{{ '+'.$userdetails->country_code. ' '.$userdetails->mobile }}" readonly>
                                    <label>Date</label>
                                    <input type="date" required  name="appointment_date" placeholder="Select Date">
                                    <label>Available Time</label>
                                    <input type="time" required  name="appointment_time" placeholder="Select Time">
                                    <button type="submit">Send Appointment</button>
                                </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif
                </div>
                @if(count($provider->providerreviews) > 0)
                <?php 
                $total_reviews = count($provider->providerreviews);
                $avg_score = 0;
                $reli_score = 0;
                $cour_score = 0;
                $tidi_score = 0;
                $work_score = 0;
                $pric_score = 0;
                foreach($provider->providerreviews as $key => $review) {
                    $reli_score = $reli_score + $review->reliability;
                    $cour_score = $cour_score + $review->response;
                    $tidi_score = $tidi_score + $review->tidiness;
                    $work_score = $work_score + $review->accuracy;
                    $pric_score = $pric_score + $review->pricing;
                    $avg_score = $avg_score+(($review->reliability+$review->response+$review->tidiness+$review->accuracy+$review->pricing)*2);
                }
                ?>
                <div class="review-area">
                    <h5>Reviews Summary</h5>
                    <div class="summary-sec trademark">
                        <div class="cmn-summary">
                            <ul>
                                <li>
                                    <div class="rating color5"><span>{{ number_format(($avg_score/$total_reviews)/5,2) }}</span></div>
                                    <p>Average score</p>
                                </li>
                                <li>
                                    <div class="rating color1"><span>{{ number_format(($reli_score*2)/$total_reviews,2) }}</span></div>
                                    <p>Reliability</p>
                                </li>
                                <li>
                                    <div class="rating color2"><span>{{ number_format(($cour_score*2)/$total_reviews,2) }}</span></div>
                                    <p>Courtesy</p>
                                </li>
                                <li>
                                    <div class="rating color3"><span>{{ number_format(($tidi_score*2)/$total_reviews,2) }}</span></div>
                                    <p>Tidiness</p>
                                </li>
                                <li>
                                    <div class="rating color4"><span>{{ number_format(($work_score*2)/$total_reviews,2) }}</span></div>
                                    <p>Workmanship</p>
                                </li>
                                <li>
                                    <div class="rating color6"><span>{{ number_format(($pric_score*2)/$total_reviews,2) }}</span></div>
                                    <p>Pricing</p>
                                </li>
                            </ul>
                            
                        </div>

                    </div>
                    
                </div>
                @endif
                <div class="main-tab">
                    <div id="horizontalTab">
                        <ul>
                            <li><a href="#tab-1">View Post</a></li>
                            <li><a href="#tab-2">View Offers</a></li>
                            <li class="review-view"><a href="#tab-3">View Reviews</a></li>
                        </ul>
                
                        <div id="tab-1">
                            <div class="post-sec">
                                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                                <form class="form-horizontal" autocomplete="off" action="{{ route('traderpost') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="trader_id" value="{{ $provider->id }}">
                                <div class="share-sec">
                                    <input type="text" class="form-control" name="post_title" required placeholder="Post Title">
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="share-sec">
                                    <textarea name="post_content" required placeholder="Want share something?"></textarea>
                                </div>
                                <div class="imoji-sec">
                                    <div class="cmn-imoji">
                                        <i class="fa fa-image"></i>
                                        Add photos
                                        <input type="file" class="image-files" required name="post_images[]" multiple>
                                    </div>
                                    <!-- <div class="cmn-imoji">
                                        <i class="fa fa-smile-o"></i>
                                        Emoji
                                    </div> -->
                                    <button type="submit">Post</button>
                                </div>
                            </form>
                            @endif
                                <!-- post sec -->
                                @if(count($provider->providerposts) > 0)
                                @foreach($provider->providerposts as $key => $post)
                                <div class="posts-view">
                                    <h5>{!! html_entity_decode($post->title) !!}</h5>
                                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                                    <div class="edit edittraderpost" data-post-id="{{ $post->id }}"><i class="fa fa-edit"></i></div>
                                    @endif
                                    <div class="date-time">
                                        <div class="cmn-d"><i class="fa fa-calendar"></i>{{ date('d/m/Y', strtotime($post->created_at)) }}</div>
                                        <div class="cmn-d"><i class="fa fa-clock-o"></i>{{ date('h:i A', strtotime($post->created_at)) }}</div>
                                    </div>
                                    <p>{!! html_entity_decode($post->post_content) !!}</p>
                                    <div class="img-p">
                                        <ul class="owl-carousel owl-theme trader-offer">
                                            @if(count($post->traderpostimages) > 0)
                                            @foreach($post->traderpostimages as $key => $postimage)
                                            <li class="item">
                                                <div class="img-p1">
                                                    <a href="{{ asset('uploads/providers/traderposts/'.$postimage->post_image) }}" data-fancybox="images" data-caption="works">
                                                        <img src="{{ asset('uploads/providers/traderposts/'.$postimage->post_image) }}" alt="works">
                                                    </a>
                                                </div>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <?php
                                    $post_like = new App\Models\TraderPostsLikes;
                                    if(Auth::guard('web')->check()) {
                                        if(Auth::guard('web')->user()->user_type == 'provider') {
                                            $user_id = Auth::guard('web')->user()->user_id;
                                            $user_type = Auth::guard('web')->user()->user_type;
                                        } else if(Auth::guard('web')->user()->user_type == 'customer') {
                                            $user_id = Auth::guard('web')->user()->user_id;
                                            $user_type = Auth::guard('web')->user()->user_type;
                                        }
                                        $postlikedetails = $post_like::where(['trader_post_id' => $post->id,'user_type' => $user_type, 'user_id' => $user_id])->first();
                                    } else {
                                        $postlikedetails = "";
                                    }
                                    
                                ?>
                                    @if(count($post->traderpostlikes) > 0)
                                    <?php 
                                    $post_likeuser = new App\Models\TraderPostsLikes;
                                    $postlikeuserdetails = $post_likeuser::where(['trader_post_id' => $post->id])->orderBy('id','DESC')->first();
                                    $currentuserdetails = 0;
                                    if(Auth::guard('web')->check()) {
                                        $currentuserdetails = $post_likeuser::where(['trader_post_id' => $post->id,'user_type' => Auth::guard('web')->user()->user_type,'user_id' => Auth::guard('web')->user()->user_id])->count();
                                    }
                                    $postlikeusercount = $post_likeuser::where(['trader_post_id' => $post->id])->count();
                                    if($postlikeuserdetails->user_type == "provider") {
                                        $likeduser = $postlikeuserdetails->getprovider;
                                    } elseif($postlikeuserdetails->user_type == "customer") {
                                        $likeduser = $postlikeuserdetails->getuser;
                                    }
                                    ?>
                                    <div class="like-list">
                                        <span class="span-icon" <?php if(Auth::check() && $postlikeusercount > 1) { ?>  class="postlikes" data-post-id="{{ $post->id }}" <?php } ?>>
                                            <img src="{{ asset('ui/images/thumbs-up.svg') }}" alt="">
                                        </span> 
                                        @if($postlikeusercount == 1)
                                        <span>{{ $likeduser->name }}</span>
                                        @elseif($postlikeusercount > 1)
                                        <span <?php if(Auth::check()) { ?>class="postlikes" data-post-id="{{ $post->id }}"<?php } ?>>{{ ($currentuserdetails == 1)?"You":$likeduser->name }} and {{ $postlikeusercount-1 }} others</span>
                                        @endif
                                    </div>                                    
                                    @endif
                                    <div class="post-sec5">
                                        @if(Auth::guard('web')->check())
                                        <div class="cmn-p reaction-btn">
                                        @else
                                        <div class="cmn-p reaction-btn" onclick="openLoginModal('<?php echo $url; ?>');" >
                                        @endif
                                        <span class="reaction-btn-emo like-btn-<?= (isset($postlikedetails->id))?strtolower($postlikedetails->reaction):"default"?>"> </span>

                                        <div class="reaction-btn-text {{ (isset($postlikedetails->id))?"active reaction-btn-text-".strtolower($postlikedetails->reaction):"" }}">{{ (isset($postlikedetails->id))?$postlikedetails->reaction:"Like" }}</div>

                                        <ul class="emojies-box"> <!-- Reaction buttons container-->
                                            <li class="emoji emo-like" data-postid="{{ $post->id }}" data-reaction="Like"></li>
                                            <li class="emoji emo-love" data-postid="{{ $post->id }}" data-reaction="Love"></li>
                                            <li class="emoji emo-haha" data-postid="{{ $post->id }}" data-reaction="HaHa"></li>
                                            <li class="emoji emo-wow" data-postid="{{ $post->id }}" data-reaction="Wow"></li>
                                            <li class="emoji emo-sad" data-postid="{{ $post->id }}" data-reaction="Sad"></li>
                                            <li class="emoji emo-angry" data-postid="{{ $post->id }}" data-reaction="Angry"></li>
                                        </ul>
                                        </div>
                                        <!-- <div class="like-stat">
                                            <span class="like-emo">
                                                <span class="like-btn-like"></span>
                                            </span>
                                            <span class="like-details">{{ (count($post->traderpostlikes)>0)?"(".count($post->traderpostlikes).")":"" }}</span>
                                        </div> -->
                                        <div class="cmn-p postcommentscount">Comments {{ (count($post->traderpostcommentsall) > 0)?"(".count($post->traderpostcommentsall).")":"" }}</div>
                                        <!-- <div class="cmn-p socialShare">Share</div> -->
                                    </div>
                                    <div class="post-first-comment"></div> 
                                    @if(count($post->traderpostfirstcomments) > 0)
                                    <div class="box-review" style="background-color: #f5f5f5;margin-top: 10px;">
                                        <div class="post-has-comments"></div>
                                        @foreach($post->traderpostfirstcomments as $k => $postcomment)
                                        <?php 
                                        if($k == 1) { break; }
                                            if($postcomment->user_type == "provider") {
                                                $folder = "providers";
                                                $user = $postcomment->getprovider;
                                            } else if($postcomment->user_type == "customer") {
                                                $folder = "customers";
                                                $user = $postcomment->getuser;
                                            }

                                        ?>
                                        <div class="replay-sec">
                                            <div class="replay-sec-box">
                                                <div class="q-profile"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile"></div>
                                                <div class="q-comment">
                                                    <h3>{{ $user->name }}</h3>
                                                    <h4>{{ \Carbon\Carbon::parse($postcomment->created_at)->diffForHumans() }}</h4>
                                                    <p>{!! html_entity_decode($postcomment->comment) !!}</p>
                                                </div>
                                            </div>
                                            <?php
                                            $nestedcomments = new App\Models\TraderPostsComments;
                                            $comments = $nestedcomments::where(['status' => 1, 'post_comment_id' => $postcomment->id])->count();
                                            ?>
                                            <div class="view-postcomment-reply"></div>
                                            @if($comments > 0)
                                            <div class="replay-comment">
                                                <div class="view-more-rply postcomment-reply" data-commentcount="{{ $comments }}" data-post-id="{{ $post->id }}" data-post-comment-id="{{ $postcomment->id }}">
                                                    <span>
                                                        <i class="fa fa-mail-forward"></i>
                                                        {{ ($comments > 1)?$comments." Replies":$comments." Reply" }}
                                                    </span>
                                                </div>
                                            </div>
                                            @endif
                                            @if($blockdetails == 0)
                                            <div class="cmn-replay-sec">
                                            <div class="box2" style="display:block;padding: 10px;">
                                                <div class="reply-cmt">
                                                    <form autocomplete="off" class="trader-post-comment-reply" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="trader_post_id" value="{{ $post->id }}">
                                                    <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                                    <input type="hidden" name="post_comment_id" value="{{ $postcomment->id }}">
                                                    <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                                    <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                                    <input type="hidden" name="allcomments" value="{{ count($post->traderpostcommentsall) }}">
                                                    <input type="text" name="post_comment" required placeholder="Write something">
                                                    @if(Auth::guard('web')->check())
                                                    <button type="submit">Reply</button>
                                                    @else
                                                    <button onclick="openLoginModal('<?php echo $url; ?>');">Reply</button>
                                                    @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        </div>
                                        @endforeach
                                        @if(count($post->traderpostfirstcomments) > 1)
                                        <div class="view-all-post-comments"></div>
                                        <div class="view-comment show-all-post-comments" data-post-id="{{ $post->id }}">
                                            <span>View all Comments</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                    
                                    @if($blockdetails == 0)
                                    <div class="reply-cmt">
                                        <form autocomplete="off" class="trader-post-comment" method="POST">
                                            @csrf
                                            <input type="hidden" name="trader_post_id" value="{{ $post->id }}">
                                            <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                            <input type="hidden" name="post_comment_id" value="0">
                                            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                            <input type="hidden" name="allcomments" value="{{ count($post->traderpostcommentsall) }}">
                                            <input type="text" name="post_comment" required placeholder="Write something">
                                            @if(Auth::guard('web')->check())
                                            <button type="submit">Reply</button>
                                            @else
                                            <button onclick="openLoginModal('<?php echo $url; ?>');">Reply</button>
                                            @endif
                                        </form>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                                @endif
                                <div id="edit-trader-post"></div>
                                 <!-- post sec close-->
                                 <!-- @if(count($provider->providerposts) > 2)
                                <div class="load-more">
                                    <button>Load More</button>
                                </div>
                                @endif -->
                            </div>
                        </div>
                        <div id="view-trader-postlikes"></div>
                        <div id="tab-2">
                        <div class="offer-sec">
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                            <div class="offer-btn-sec">
                                <button class="" id="post_an_offer">Post an offer</button>
                            </div>

                            <div class="post-offer" style="display:none;">
                                <h6>Post an discount offer</h6>
                                <form autocomplete="off" action="{{ route('traderoffers') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="trader_id" value="{{ $provider->id }}">
                                    <div class="form-group">
                                      <label for="title">Product Title:</label>
                                      <input type="text" class="form-control" placeholder="Product Title" id="title" required name="product_title">
                                    </div>
                                    <div class="form-group">
                                      <label for="description">Description:</label>
                                      <textarea class="form-control" cols="5" placeholder="Description" required name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="txt">Full Price:</label>
                                      <input type="text" name="full_price" required placeholder="Full Price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="txt">Discount Price:</label>
                                        <input type="text" name="discount_price" placeholder="Discount Price" required class="form-control">
                                    </div>
                                    <h3>Photo</h3>
                                    <div class="photo-sec">
                                        <div class="upload-pic">
                                            <i class="fa fa-photo"></i>
                                            <p>Photo</p>
                                            <input type="file" class="image-files" required name="offer_images[]" multiple>
                                        </div>
                                    </div>
                                    <h3>Valid from</h3>
                                    <div class="form2">
                                        <div class="form-group">
                                            <label for="birthdaytime1">Date:</label>
                                            <input type="date" name="valid_from_date" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt">Time:</label>
                                            <input type="time" name="valid_from_time" required class="form-control">
                                        </div>
                                    </div>
                                    <h3>Valid to</h3>
                                    <div class="form2">
                                        <div class="form-group">
                                            <label for="date">Date:</label>
                                            <input type="date" name="valid_to_date" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt">Time:</label>
                                            <input type="time" name="valid_to_time" required class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-s">Submit</button>
                                </form>
                            </div>
                            @endif
                            <div class="post-product" style="display: block;">
                                <!-- product sec -->
                                @if(count($provider->provideroffers) > 0)
                                @foreach($provider->provideroffers as $key => $offer)
                                <div class="product-sec1">
                                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                                <div class="edit edittraderoffer" data-offer-id="{{ $offer->id }}"><i class="fa fa-edit"></i></div>
                                @endif
                                    <div class="productimg-sec">
                                        <div class="p-sec1">
                                            <h4>{{ $offer->title }}</h4>
                                            <div class="img-p">
                                                <ul class="owl-carousel owl-theme trader-offer">
                                                    @if(count($offer->traderofferimages) > 0)
                                                    @foreach($offer->traderofferimages as $key => $offerimage)
                                                    <li class="item">
                                                        <div class="img-p1">
                                                            <a href="{{ asset('uploads/providers/traderoffers/'.$offerimage->offer_image) }}" data-fancybox="images" data-caption="works">
                                                                <img src="{{ asset('uploads/providers/traderoffers/'.$offerimage->offer_image) }}" alt="works">
                                                            </a>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="p-sec2">
                                            <div class="price-sec">
                                                <p>Price</p>
                                                <h5>{{ "$".$offer->full_price }}</h5>
                                                <p>Discount Price</p>
                                                <h6>{{ "$".$offer->discount_price }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="date-sec5">
                                        <div class="valid-sec">Valid From: {{ $offer->valid_from }}</div>
                                        <div class="valid-sec">Expire: {{ $offer->valid_to }}</div>
                                    </div>
                                    <?php
                                        $offer_like = new App\Models\TraderOfferLikes;
                                        if(Auth::guard('web')->check()) {
                                            if(Auth::guard('web')->user()->user_type == 'provider') {
                                                $user_id = Auth::guard('web')->user()->user_id;
                                                $user_type = Auth::guard('web')->user()->user_type;
                                            } else if(Auth::guard('web')->user()->user_type == 'customer') {
                                                $user_id = Auth::guard('web')->user()->user_id;
                                                $user_type = Auth::guard('web')->user()->user_type;
                                            }
                                            $offerlikedetails = $offer_like::where(['trader_offer_id' => $offer->id,'user_type' => $user_type,'user_id' => $user_id])->first();
                                        } else {
                                            $offerlikedetails = "";
                                        }
                                        
                                    ?>
                                    @if(count($offer->traderofferlikes) > 0)
                                    <?php 
                                    $offer_likeuser = new App\Models\TraderOfferLikes;
                                    $offerlikeuserdetails = $offer_likeuser::where(['trader_offer_id' => $offer->id])->orderBy('id','DESC')->first();
                                    $currentuserdetailss = 0;
                                    if(Auth::guard('web')->check()) {
                                        $currentuserdetailss = $offer_likeuser::where(['trader_offer_id' => $offer->id,'user_type' => Auth::guard('web')->user()->user_type,'user_id' => Auth::guard('web')->user()->user_id])->count();
                                    }
                                    $offerlikeusercount = $offer_likeuser::where(['trader_offer_id' => $offer->id])->count();
                                    if($offerlikeuserdetails->user_type == "provider") {
                                        $offerlikeduser = $offerlikeuserdetails->getprovider;
                                    } elseif($offerlikeuserdetails->user_type == "customer") {
                                        $offerlikeduser = $offerlikeuserdetails->getuser;
                                    }
                                    ?>
                                    <div class="like-list">
                                        <span class="span-icon" <?php if(Auth::check() && $offerlikeusercount > 1) { ?>  class="offerlikes" data-offer-id="{{ $offer->id }}" <?php } ?>>
                                            <img src="{{ asset('ui/images/thumbs-up.svg') }}" alt="">
                                        </span> 
                                        @if($offerlikeusercount == 1)
                                        <span>{{ $offerlikeduser->name }}</span>
                                        @elseif($offerlikeusercount > 1)
                                        <span <?php if(Auth::check()) { ?> class="offerlikes" data-offer-id="{{ $offer->id }}" <?php } ?>>{{ ($currentuserdetailss == 1)?"You":$offerlikeduser->name }} and {{ $offerlikeusercount-1 }} others</span>
                                        @endif
                                    </div>                                    
                                    @endif
                                    <div class="link-post">
                                        <div class="post-sec5">
                                            @if(Auth::guard('web')->check())
                                            <div class="cmn-p reaction-btn">
                                                @else
                                                <div class="cmn-p reaction-btn" onclick="openLoginModal('<?php echo $url; ?>');">
                                                @endif
                                                <span class="reaction-btn-emo like-btn-<?= (isset($offerlikedetails->id))?strtolower($offerlikedetails->reaction):"default"?>"> </span>

                                                <div class="reaction-btn-text {{ (isset($offerlikedetails->id))?"active reaction-btn-text-".strtolower($offerlikedetails->reaction):"" }}">{{ (isset($offerlikedetails->id))?$offerlikedetails->reaction:"Like" }}</div>

                                                <ul class="emojies-box"> <!-- Reaction buttons container-->
                                                    <li class=" emoji-offer emo-like" data-offerid="{{ $offer->id }}" data-reaction="Like"></li>
                                                    <li class=" emoji-offer emo-love" data-offerid="{{ $offer->id }}" data-reaction="Love"></li>
                                                    <li class=" emoji-offer emo-haha" data-offerid="{{ $offer->id }}" data-reaction="HaHa"></li>
                                                    <li class=" emoji-offer emo-wow" data-offerid="{{ $offer->id }}" data-reaction="Wow"></li>
                                                    <li class=" emoji-offer emo-sad" data-offerid="{{ $offer->id }}" data-reaction="Sad"></li>
                                                    <li class=" emoji-offer emo-angry" data-offerid="{{ $offer->id }}" data-reaction="Angry"></li>
                                                </ul>
                                            </div>
                                            <div class="cmn-p offercommentscount">Comments{{ (count($offer->traderoffercommentsall) > 0)?"(".count($offer->traderoffercommentsall).")":"" }}</div>
                                            <!-- <div class="cmn-p socialShare">Share</div> -->
                                        </div>
                                        <div class="offer-first-comment"></div>
                                        @if(count($offer->traderofferfirstcomments) > 0)
                                        <div class="box-review" style="background-color: #f5f5f5;margin-top: 10px;">
                                            <div class="offer-has-comments"></div>
                                            @foreach($offer->traderofferfirstcomments as $k => $offercomment)
                                            <?php 
                                                if($k == 1) { break; }
                                                if($offercomment->user_type == "provider") {
                                                    $folder = "providers";
                                                    $user = $offercomment->getprovider;
                                                } else if($offercomment->user_type == "customer") {
                                                    $folder = "customers";
                                                    $user = $offercomment->getuser;
                                                }

                                            ?>
                                            <div class="replay-sec">
                                                <div class="replay-sec-box">
                                                    <div class="q-profile"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile"></div>
                                                    <div class="q-comment">
                                                        <h3>{{ $user->name }}</h3>
                                                        <h4>{{ \Carbon\Carbon::parse($offercomment->created_at)->diffForHumans() }}</h4>
                                                        <p>{!! html_entity_decode($offercomment->comment) !!}</p>
                                                    </div>
                                                </div>
                                        <?php
                                        $nestedoffercomments = new App\Models\TraderOffersComments;
                                        $offercomments = $nestedoffercomments::where(['status' => 1, 'offer_comment_id' => $offercomment->id])->count();
                                        ?>
                                        <div class="view-offercomment-reply"></div>
                                        @if($offercomments > 0)
                                        <div class="replay-comment">
                                            <div class="view-more-rply offercomment-reply" data-offercommentcount="{{ $offercomments }}" data-offer-id="{{ $offer->id }}" data-offer-comment-id="{{ $offercomment->id }}">
                                                <span>
                                                    <i class="fa fa-mail-forward"></i>
                                                    {{ ($offercomments > 1)?$offercomments." Replies":$offercomments." Reply" }}
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if($blockdetails == 0)
                                        <div class="cmn-replay-sec">
                                            <div class="box2" style="display:block;padding: 10px;">
                                                <div class="reply-cmt">
                                                    <form autocomplete="off" class="trader-offer-comment-reply" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="trader_offer_id" value="{{ $offer->id }}">
                                                    <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                                    <input type="hidden" name="offer_comment_id" value="{{ $offercomment->id }}">
                                                    <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                                    <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                                    <input type="hidden" name="allcomments" value="{{ count($offer->traderoffercommentsall) }}">
                                                    <input type="text" name="offer_comment" required placeholder="Write something">
                                                    @if(Auth::guard('web')->check())
                                                    <button type="submit">Reply</button>
                                                    @else
                                                    <button onclick="openLoginModal('<?php echo $url; ?>');">Reply</button>
                                                    @endif
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                            @endforeach
                                            @if(count($offer->traderofferfirstcomments) > 1)
                                            <div class="view-all-offer-comments"></div>
                                            <div class="view-comment show-all-offer-comments" data-offer-id="{{ $offer->id }}">
                                                <span>View all Comments</span>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                        @if($blockdetails == 0)
                                        <div class="reply-cmt">
                                            <form autocomplete="off" class="trader-offer-comment" method="POST">
                                                @csrf
                                                <input type="hidden" name="trader_offer_id" value="{{ $offer->id }}">
                                                <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                                <input type="hidden" name="offer_comment_id" value="0">
                                                <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                                <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                                <input type="hidden" name="allcomments" value="{{ count($offer->traderoffercommentsall) }}">
                                                <input type="text" name="offer_comment" required placeholder="Write something">
                                                @if(Auth::guard('web')->check())
                                                <button type="submit">Reply</button>
                                                @else
                                                <button onclick="openLoginModal('<?php echo $url; ?>');">Reply</button>
                                                @endif
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                <div id="view-trader-offerlikes"></div>
                                <!-- product sec -->
                                <div id="edit-trader-offer"></div>
                            </div>
                        </div>
                    </div>
                    <!-- tab 3 start -->
                    <div id="tab-3">
                        <div class="reviews-sec">
                            <div class="review-links">
                                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer')
                                <button class="add-review-post">Add a Review</button>
                                @else

                                @endif
                                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                                <button>Review Notification ({{ count($provider->providerreviews) }})</button>
                                @endif
                                <button class="bad-review" data-trader-id="{{ $provider->id }}">Bad Review</button>
                            </div>
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer')
                            <div class="add-review-box">
                                <div class="add-review5">
                                    <h5>Traders Review</h5>
                                    <div class="review-sec">
                                        <form action="{{ route('traderreviews') }}" method="POST" id="wizard">
                                            @csrf
                                            <input type="hidden" name="trader_id" value="{{ $provider->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->user_id }}">
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>Was any work completed?</h6>
                                                    <label class="work">Yes
                                                        <input type="radio" name="work_completed" required value="Yes">
                                                        <span class="checkmark"></span>
                                                      </label>
                                                      <label class="work">No
                                                        <input type="radio" name="work_completed" required value="No">
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </fieldset>
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>What was the service provided</h6>
                                                    <div class="txt-sec">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <select name="service_provided">
                                                                    <option>Select Service</option>
                                                                    @foreach($provider->providerservices as $key => $serv)
                                                                    <option value="{{ $serv->service_id}}">{{ $serv->getservice->service }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <input type="date" name="service_date" placeholder="Choose Date">
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <textarea maxlength="150" required name="review" placeholder="Review (150 character)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>Rate of work</h6>
                                                    <div class="sec-rate">
                                                        <div class="rate-work">Reliability</div>
                                                        <label class="work">Very Bad
                                                            <input type="radio" name="reliability" required value="1">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Bad
                                                            <input type="radio" name="reliability" required value="2">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Average
                                                            <input type="radio" name="reliability" required value="3">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Good
                                                            <input type="radio" name="reliability" required value="4">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Very Good
                                                            <input type="radio" name="reliability" required value="5">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>Rate of work</h6>
                                                    <div class="sec-rate">
                                                        <div class="rate-work">Tidiness or cleanliness</div>
                                                        <label class="work">Very Bad
                                                            <input type="radio" required name="cleanliness" value="1">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Bad
                                                            <input type="radio" name="cleanliness" required value="2">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Average
                                                            <input type="radio" name="cleanliness" required value="3">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Good
                                                            <input type="radio" name="cleanliness" required value="4">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Very Good
                                                            <input type="radio" name="cleanliness" required value="5">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>Rate of work</h6>
                                                    <div class="sec-rate">
                                                        <div class="rate-work">Response</div>
                                                        <label class="work">Very Bad
                                                            <input type="radio" required value="1" name="response">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Bad
                                                            <input type="radio" name="response" required value="2">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Average
                                                            <input type="radio" name="response" required value="3">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Good
                                                            <input type="radio" name="response" required value="4">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Very Good
                                                            <input type="radio" name="response" required value="5">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>Rate of work</h6>
                                                    <div class="sec-rate">
                                                        <div class="rate-work">Accuracy</div>
                                                        <label class="work">Very Bad
                                                            <input type="radio" name="accuracy" required value="1">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Bad
                                                            <input type="radio" name="accuracy" required value="2">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Average
                                                            <input type="radio" name="accuracy" required value="3">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Good
                                                            <input type="radio" name="accuracy" required value="4">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Very Good
                                                            <input type="radio" name="accuracy" required value="5">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>Rate of work</h6>
                                                <div class="sec-rate">
                                                    <div class="rate-work">Pricing and quotation</div>
                                                    <label class="work">Very Bad
                                                        <input type="radio"  required value="1" name="quotation">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="work">Bad
                                                        <input type="radio" name="quotation" required value="2">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="work">Average
                                                        <input type="radio" name="quotation" required value="3">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="work">Good
                                                        <input type="radio" name="quotation" required value="4">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="work">Very Good
                                                        <input type="radio" name="quotation" required value="5">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                </div>
                                            </fieldset>
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>Rate of work</h6>
                                                    <div class="sec-rate">
                                                        <div class="rate-work">Overall Experience</div>
                                                        <label class="work">Very Bad
                                                            <input type="radio" name="overall_experience" required value="1">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Bad
                                                            <input type="radio" name="overall_experience" required value="2">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Average
                                                            <input type="radio" name="overall_experience" required value="3">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Good
                                                            <input type="radio" name="overall_experience" required value="4">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="work">Very Good
                                                            <input type="radio" name="overall_experience" required value="5">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3 style="display:none;"></h3>
                                            <fieldset>
                                                <div class="review-post5">
                                                    <h6>Do you recommend this trader to others?</h6>
                                                    <label class="work">Yes
                                                        <input type="radio" checked="checked" required name="recommend" value="Yes">
                                                        <span class="checkmark"></span>
                                                      </label>
                                                      <label class="work">No
                                                        <input type="radio" name="recommend" required value="No">
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="reviews-list">
                            @if(count($provider->providerreviews) > 0)
                            <div class="review-box-sec">
                                <!-- Review area -->
                            @foreach($provider->providerreviews as $key => $review)
                            <?php 
                                $score = 0;
                                $score = $review->reliability+$review->tidiness+$review->response+$review->accuracy+$review->pricing;
                            ?>
                            <div class="box-review" style="background-color: #f5f5f5;margin-top: 10px;">
                                <h4>{!! html_entity_decode($review->review) !!}</h4>
                                <div class="score">{{ number_format(($score*2)/5,2) }} </div>
                                <span class="h">
                                    <img src="{{ ($review->getuser->profile_pic != '') ? asset('uploads/customers/profile/'.$review->getuser->profile_pic):asset('ui/images/profile.png') }}" alt="profile">
                                </span>
                                <h5>{{ $review->getuser->name}} </h5>
                                <h6>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</h6>
                                <div class="review-first-comment"></div> 
                                @if(count($review->traderreviewfirstcomments) > 0)
                                <div class="review-has-comments"></div>
                                @foreach($review->traderreviewfirstcomments as $k => $reviewcomment)
                                <?php 
                                if($k == 1) { break; }
                                    if($reviewcomment->user_type == "provider") {
                                        $folder3 = "providers";
                                        $user3 = $reviewcomment->getprovider;
                                    } else if($reviewcomment->user_type == "customer") {
                                        $folder3 = "customers";
                                        $user3 = $reviewcomment->getuser;
                                    }

                                ?>
                                <div class="replay-sec">
                                    <div class="replay-sec-box">
                                        <div class="q-profile"><img src="{{ asset('uploads/'.$folder3.'/profile/'.$user3->profile_pic) }}" alt="profile"></div>
                                        <div class="q-comment">
                                            <h3>{{ $user3->name }}</h3>
                                            <h4>{{ \Carbon\Carbon::parse($reviewcomment->created_at)->diffForHumans() }}</h4>
                                            <p>{!! html_entity_decode($reviewcomment->comment) !!}</p>
                                        </div>
                                    </div>
                                <?php
                                $nestedreviewcomments = new App\Models\TraderReviewComments;
                                $reviewcomments = $nestedreviewcomments::where(['status' => 1, 'review_comment_id' => $reviewcomment->id])->count();
                                ?>
                                <div class="view-reviewcomment-reply"></div>
                                @if($reviewcomments > 0)
                                <div class="replay-comment">
                                    <div class="view-more-rply reviewcomment-reply" data-commentcount="{{ $reviewcomments }}" data-review-id="{{ $review->id }}" data-review-comment-id="{{ $reviewcomment->id }}">
                                        <span>
                                            <i class="fa fa-mail-forward"></i>
                                            {{ ($reviewcomments > 1)?$reviewcomments." Replies":$reviewcomments." Reply" }}
                                        </span>
                                    </div>
                                </div>
                                @endif
                                @if($blockdetails == 0)
                                <div class="cmn-replay-sec">
                                    <div class="box2" style="display:block;padding: 10px;">
                                        <div class="reply-cmt">
                                            <form autocomplete="off" class="trader-review-comment-reply" method="POST">
                                                @csrf
                                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                                            <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                            <input type="hidden" name="review_comment_id" value="{{ $reviewcomment->id }}">
                                            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                            <input type="hidden" name="allcomments" value="{{ count($review->traderreviewcommentsall) }}">
                                            <input type="text" name="review_comment" required placeholder="Write something">
                                            @if(Auth::guard('web')->check())
                                            <button type="submit">Reply</button>
                                            @else
                                            <button onclick="openLoginModal('<?php echo $url; ?>');">Reply</button>
                                            @endif
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            @if(count($review->traderreviewfirstcomments) > 1)
                            <div class="view-all-review-comments"></div>
                            <div class="view-comment show-all-review-comments" data-review-id="{{ $review->id }}">
                                <span>View all Comments</span>
                            </div>
                            @endif
                            @endif
                            @if($blockdetails == 0)
                            <div class="cmn-replay-sec">
                                    <div class="box2" style="display:block;">
                                        <div class="reply-cmt">
                                            <form autocomplete="off" class="trader-review-comment" method="POST">
                                                @csrf
                                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                                            <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                                <input type="hidden" name="review_comment_id" value="0">
                                            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                            <input type="hidden" name="allcomments" value="{{ count($review->traderreviewcommentsall) }}">
                                            <input type="text" name="review_comment" required placeholder="Write something">
                                            @if(Auth::guard('web')->check())
                                            <button type="submit">Reply</button>
                                            @else
                                            <button onclick="openLoginModal('<?php echo $url; ?>');">Reply</button>
                                            @endif
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                        </div>
                        @endforeach
                        </div>
                            @endif
                        </div>
                    </div>
                    </div>

                    <!-- tab 3 end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection