@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>{{ $customer->name }}</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> {{ $customer->name }} </p>
            </div>
        </div>
    </div>
</div>
<div class="inner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- profile area -->
                <div class="profile-sec">
                    <div class="profile-head">
                        <div class="profile-img"><img src="{{ asset('uploads/customers/profile/'.$customer->profile_pic) }}" alt="profile"></div>
                        <!-- <div class="barcode"><img src="images/chart.png" alt="barcode"></div> -->
                    </div>
                    <div class="profile-details">
                        <div class="name-sec">
                            <h5>{{ $customer->name }}</h5>
                            <p>ID : {{ $customer->username }}</p>
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer' && Auth::guard('web')->user()->user_id == $customer->id)
                            <a href="{{ route('edit-customer-profile') }}">Edit Profile</a>
                            @endif
                        </div>
                        <div class="star-rating">
                            <!-- <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star"></i> -->
                        </div>
                        <div class="contact-details">
                            <ul>
                                <li><img src="{{ asset('ui/images/icon-whatsapp.svg') }}" alt="whatsapp">+{{ $customer->country_code." ".$customer->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-phone.svg') }}" alt="phone">+{{ $customer->country_code." ".$customer->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-email.svg') }}" alt="email">{{ $customer->email }}</li>
                                <li><img src="{{ asset('ui/images/icon-map.svg') }}" alt="map">{{ $customer->location }}</li>
                            </ul>
                        </div>
                        
                        <div class="follow-sec">
                            <button class="follow" id="follow-customer" data-id="{{ $customer->id }}" title="Follow"><img src="{{ asset('ui/images/follow.svg') }}" alt="follow"> <span> Following: {{ $following }}</span></button>
                            <div id="view-customer-followers"></div>
                            <button class="like" id="favourite-customer" data-id="{{ $customer->id }}" title="Like"><img src="{{ asset('ui/images/heart.svg') }}" alt="heart"><span>{{ $favorites }}</span></button>
                            <div id="view-customer-favourites"></div>
                        </div>
                        
                    </div>
                </div>
                <!-- skills -->
                <div class="skills-area">
                    <h5>Customer Links</h5>
                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer' && Auth::guard('web')->user()->user_id == $customer->id)
                @include('web-ui.customer.customer-menu')
                @endif
                </div>

                <div class="modal fade" id="sellatbazaar" role="dialog">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sell at Bazaar</h4>
                        </div>
                        <div class="modal-body">
                            <div class="appointment-sec">
                                <form class="form-horizontal" autocomplete="off" action="{{ route('sell-at-bazaar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_type" value="customer" >
                                <input type="hidden" name="user_id" value="{{ $customer->id }}" >
                                <label>Category</label>
                                <select name="category_id" required id="bazaar_parent_category">
                                    <option value="">Select</option>
                                    @if(count($categories) > 0)
                                    @foreach($categories as $key => $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <label>Sub Category</label>
                                <select name="sub_category_id" id="bazaar-sub-category">
                                    <option value="">Select</option>
                                </select>
                                <label>Product</label>
                                <input type="text" name="product" placeholder="Product" required>
                                <label>Price</label>
                                <input type="text" name="price" placeholder="Price" required>
                                <label>Description</label>
                                <textarea name="description" placeholder="Description" required></textarea>
                                <label>Location</label>
                                <input type="text" required name="product_location" placeholder="Location" id="job-location">
                                <input type="hidden" name="loc_latitude" value="" id="loc_latitude" />
                                <input type="hidden" name="loc_longitude" value="" id="loc_longitude" />
                                <label>Product Images</label>
                                <input type="file" class="image-files" required  name="product_images[]" multiple>
                                <button type="submit">Sell at Bazaar</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal fade" id="report" role="dialog">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Report</h4>
                        </div>
                        <div class="modal-body">
                            <div class="appointment-sec">
                                <form class="form-horizontal" id="report-post-form1" action="{{ route('addpostreport') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $customer->id }}" >
                                <input type="hidden" name="trader_post_id" id="trader_post_id" value="" >
                                <textarea name="reason" placeholder="Describe reason to report.!" required></textarea>
                                <button type="submit" id="report-post-form">Report</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    </div>
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
                    
                <div class="customer-link">
                    <!-- <a href="#">Home Page</a> -->
                    <button class="feeds-area active">Feeds</button>
                    <button class="offer">Offers</button>
                    <button class="bazaar">Market or Bazaar</button>
                </div>
                <div class="customer-sec">
                    <div class="feeds">
                        <h5>Feeds</h5>
                        <!-- feed sec -->
                        @if(count($posts) > 0)
                            @foreach($posts as $key => $post)
                            <?php
                            $report = new App\Models\TraderPostsReports;
                            $reportdata = $report::where(['trader_post_id' => $post->id,'customer_id' => $customer->id])->first();

                            ?>
                        <div class="product-sec1">
                            <div class="productimg-sec">
                                <div class="p-sec1">
                                    <div class="trader">
                                        <div class="h"><img src="{{ asset('uploads/providers/profile/'.$post->getprovider->profile_pic) }}" alt="profile"></div>
                                        <h3>{{ $post->getprovider->name }}</h3>
                                        <h6>Posted: {{ date('F d,Y',strtotime($post->created_at)) }}</h6>
                                    </div>
                                    @if($reportdata == "")
                                    <span class="report-post" data-id="{{ $post->id }}" data-toggle="modal" data-target="#report">Report</span>
                                    @else
                                    <span style="background-color: #55aa47;color: #FFF;">Reported</span>
                                    @endif
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
                                    <div class="c-p">
                                        <p>{!! html_entity_decode($post->post_content) !!}</p>
                                    </div>
                                </div>
                            </div>
                           <?php
                                    $post_like = new App\Models\TraderPostsLikes;
                                    if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer') {

                                        $user_id = Auth::guard('web')->user()->user_id;
                                        $user_type = Auth::guard('web')->user()->user_type;

                                        $postlikedetails = $post_like::where(['trader_post_id' => $post->id,'user_type' => $user_type, 'user_id' => $user_id])->first();
                                    } else {
                                        $postlikedetails = "";
                                    }
                                    
                                ?>
                                @if(count($post->traderpostlikes) > 0)
                                    <?php 
                                    $post_likeuser = new App\Models\TraderPostsLikes;
                                    $postlikeuserdetails = $post_likeuser::where(['trader_post_id' => $post->id])->orderBy('id','DESC')->first();

                                    $currentuserdetails = $post_likeuser::where(['trader_post_id' => $post->id,'user_type' => 'customer','user_id' => Auth::guard('web')->user()->user_id])->count();

                                    $postlikeusercount = $post_likeuser::where(['trader_post_id' => $post->id])->count();
                                    if($postlikeuserdetails->user_type == "provider") {
                                        $likeduser = $postlikeuserdetails->getprovider;
                                    } elseif($postlikeuserdetails->user_type == "customer") {
                                        $likeduser = $postlikeuserdetails->getuser;
                                    }
                                    ?>
                                    <div class="like-list">
                                        <span class="span-icon" <?php if($postlikeusercount > 1) { ?>  class="postlikes" data-post-id="{{ $post->id }}" <?php } ?>>
                                            <img src="{{ asset('ui/images/thumbs-up.svg') }}" alt="">
                                        </span> 
                                        @if($postlikeusercount == 1)
                                        <span>{{ $likeduser->name }}</span>
                                        @elseif($postlikeusercount > 1)
                                        <span class="postlikes" data-post-id="{{ $post->id }}">{{ ($currentuserdetails == 1)?"You":"" }} and {{ $postlikeusercount-1 }} others</span>
                                        @endif
                                    </div>                                    
                                    @endif
                            <div class="link-post">
                                <div class="post-sec5">
                                    <div class="cmn-p reaction-btn">
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
                                    <div class="cmn-p postcommentscount">Comments{{ (count($post->traderpostcommentsall) > 0)?"(".count($post->traderpostcommentsall).")":"" }}</div>
                                    <!-- <div class="cmn-p">Share</div> -->

                                </div>
                            </div>
                            <?php 
                            $blockdetails = 0;
                                if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {
                                        $block = new App\Models\Block;
                                        $blockdetails = $block::where(['trader_id' => $post->trader_id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
                                }
                            ?>
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
                                                <div class="q-profile">
                                                    @if($user->profile_pic != "")
                                                    <img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile">
                                                    @else
                                                    <img src="{{ asset('ui/images/noimage.png') }}" alt="profile">
                                                    @endif
                                                </div>
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
                                                        <form autocomplete="off" class="customer-post-comment-reply" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="trader_post_id" value="{{ $post->id }}">
                                                        <input type="hidden" name="provider_id" value="{{ $post->trader_id }}">
                                                        <input type="hidden" name="post_comment_id" value="{{ $postcomment->id }}">
                                                        <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                                        <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                                        <input type="hidden" name="allcomments" value="{{ count($post->traderpostcommentsall) }}">
                                                        <input type="text" name="post_comment" required placeholder="Write something"><button type="submit">Reply</button>
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
                                <form autocomplete="off" class="customer-post-comment" method="POST">
                                    @csrf
                                    <input type="hidden" name="trader_post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="provider_id" value="{{ $post->trader_id }}">
                                    <input type="hidden" name="post_comment_id" value="0">
                                    <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                    <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                    <input type="hidden" name="allcomments" value="{{ count($post->traderpostcommentsall) }}">
                                    <input type="text" name="post_comment" required placeholder="Write something">
                                    <button type="submit">Reply</button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @endforeach
                        @else
                        <p>No posts found.!!</p>
                        @endif
                        <!-- feed sec -->
                    </div>
                    <div id="view-trader-postlikes"></div>
                    <div class="offer-area">
                        <h5>Offers</h5>
                        <!-- Offer sec -->
                        @if(count($offers) > 0)
                            @foreach($offers as $key => $offer)
                        <div class="product-sec1">
                            <div class="productimg-sec">
                                <div class="p-sec1">
                                    <div class="trader">
                                        <div class="h"><img src="{{ asset('uploads/providers/profile/'.$offer->getprovider->profile_pic) }}" alt="profile"></div>
                                        <h3>{{ $offer->getprovider->name }}</h3>
                                        <h6>Posted: {{ date('F d,Y',strtotime($offer->created_at)) }}</h6>
                                    </div>
                                    <div class="offer-price">
                                        <div class="cmn-offer offer-color">
                                            Offer Price: {{ "$".$offer->discount_price }}
                                        </div>
                                        <div class="cmn-offer">
                                            Full Price: {{ "$".$offer->full_price }}
                                        </div>
                                    </div>
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
                                    <div class="c-p">
                                        <p>{{ $offer->title }}</p>
                                    </div>
                                </div>
                            </div>
                           <?php
                                $offer_like = new App\Models\TraderOfferLikes;
                                if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer') {
                                    
                                    $user_id = Auth::guard('web')->user()->user_id;
                                    $user_type = Auth::guard('web')->user()->user_type;
                                    $offerlikedetails = $offer_like::where(['trader_offer_id' => $offer->id,'user_type' => $user_type,'user_id' => $user_id])->first();
                                    
                                } else {
                                    $offerlikedetails = "";
                                }
                                
                            ?>
                            @if(count($offer->traderofferlikes) > 0)
                                        <?php 
                                        $offer_likeuser = new App\Models\TraderOfferLikes;
                                        $offerlikeuserdetails = $offer_likeuser::where(['trader_offer_id' => $offer->id])->orderBy('id','DESC')->first();

                                        $currentuserdetailss = $offer_likeuser::where(['trader_offer_id' => $offer->id,'user_type' => 'customer','user_id' => Auth::guard('web')->user()->user_id])->count();

                                        $offerlikeusercount = $offer_likeuser::where(['trader_offer_id' => $offer->id])->count();
                                        if($offerlikeuserdetails->user_type == "provider") {
                                            $offerlikeduser = $offerlikeuserdetails->getprovider;
                                        } elseif($offerlikeuserdetails->user_type == "customer") {
                                            $offerlikeduser = $offerlikeuserdetails->getuser;
                                        }
                                        ?>
                                        <div class="like-list">
                                            <span class="span-icon" <?php if($offerlikeusercount > 1) { ?>  class="offerlikes" data-offer-id="{{ $offer->id }}" <?php } ?>>
                                                <img src="{{ asset('ui/images/thumbs-up.svg') }}" alt="">
                                            </span> 
                                            @if($offerlikeusercount == 1)
                                            <span>{{ $offerlikeduser->name }}</span>
                                            @elseif($offerlikeusercount > 1)
                                            <span class="offerlikes" data-offer-id="{{ $offer->id }}" >{{ ($currentuserdetailss == 1)?"You":$offerlikeduser->name }} and {{ $offerlikeusercount-1 }} others</span>
                                            @endif
                                        </div>                                    
                                        @endif
                            <div class="link-post">
                                <div class="post-sec5">
                                    <div class="cmn-p reaction-btn">
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
                                    <!-- <div class="cmn-p">Share</div> -->
                                </div>
                            </div>

                            <?php 
                            $blockdetails = 0;
                                if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {
                                        $block = new App\Models\Block;
                                        $blockdetails = $block::where(['trader_id' => $offer->trader_id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
                                }
                            ?>
                                        <div class="offer-first-comment"></div>
                            @if(count($offer->traderofferfirstcomments) > 0)
                                        <div class="box-review" style="background-color: #f5f5f5;margin-top: 10px;">
                                            <div class="offer-has-comments"></div>
                                                @foreach($offer->traderofferfirstcomments as $k => $offercomment)
                                                <?php 
                                                if($k == 1) { break; }
                                                    if($offercomment->user_type == "provider") {
                                                        $folder2 = "providers";
                                                        $user2 = $offercomment->getprovider;
                                                    } else if($offercomment->user_type == "customer") {
                                                        $folder2 = "customers";
                                                        $user2 = $offercomment->getuser;
                                                    }

                                                ?>
                                                <div class="replay-sec">
                                                    <div class="replay-sec-box">
                                                        <div class="q-profile"><img src="{{ asset('uploads/'.$folder2.'/profile/'.$user2->profile_pic) }}" alt="profile"></div>
                                                        <div class="q-comment">
                                                            <h3>{{ $user2->name }}</h3>
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
                                                        <form autocomplete="off" class="customer-offer-comment-reply" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="trader_offer_id" value="{{ $offer->id }}">
                                                        <input type="hidden" name="provider_id" value="{{ $offer->trader_id }}">
                                                        <input type="hidden" name="offer_comment_id" value="{{ $offercomment->id }}">
                                                        <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                                        <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                                        <input type="hidden" name="allcomments" value="{{ count($offer->traderoffercommentsall) }}">
                                                        <input type="text" name="offer_comment" required placeholder="Write something">
                                                        <button type="submit">Reply</button>
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
                                <form autocomplete="off" class="customer-offer-comment" method="POST">
                                    @csrf
                                    <input type="hidden" name="trader_offer_id" value="{{ $offer->id }}">
                                    <input type="hidden" name="provider_id" value="{{ $offer->trader_id }}">
                                    <input type="hidden" name="offer_comment_id" value="0">
                                    <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                    <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                    <input type="hidden" name="allcomments" value="{{ count($offer->traderoffercommentsall) }}">
                                    <input type="text" name="offer_comment" required placeholder="Write something">
                                    <button type="submit">Reply</button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @endforeach
                        @else
                        <p>No offers found.!!</p>
                        @endif
                        <div id="view-trader-offerlikes"></div>
                        <!-- Offer sec -->
                    </div>
                    <div class="market">
                        <h5>Market or Bazaar</h5>
                        <div class="product-listing">
                             @if(count($bazaar) > 0)
                            <ul>
                                @foreach($bazaar as $key => $product)
                                <li>
                                    <div class="products">
                                        <div class="product-title">
                                            <h3>{{ $product->product }}</h3>
                                            <p>Posted : {{ date('d F Y, h:i A',strtotime($product->created_at)) }} </p>
                                        </div>
                                        <div class="productImg">
                                            <a href="{{ route('product-details', $product->id) }}"><img src="{{ asset('uploads/bazaar/products/'.$product->bazaarimages[0]->product_image) }}" alt=""></a>
                                        </div>
                                        <?php 
                                            if($product->added_usertype == "provider") {
                                                $usertype = "Trader";
                                                $user = $product->getprovider;
                                            } else if($product->added_usertype == "customer") {
                                                $usertype = "Customer";
                                                $user = $product->getuser;
                                            } else {
                                                $usertype = "Admin";
                                                $user = "";
                                            }

                                        ?>
                                        <?php
                                            $wishlist = new App\Models\ProductsWishlist;
                                            $wishlistdetails = $wishlist::where(['product_id' => $product->id, 'user_id' => (Auth::guard("web")->check())?Auth::guard("web")->user()->user_id:"0",'user_type' => (Auth::guard("web")->check())?Auth::guard("web")->user()->user_type:""])->first();
                                        ?>
                                        <div class="product-button">
                                            <div class="watch-list">
                                                @if($wishlistdetails != "")
                                                <a href="javascript:" data-id="{{ $product->id }}" class="shortlisted" style="background-color:#303030;"><i class="fa fa-check-square"></i> Shortlisted</a>
                                                @else
                                                <a href="javascript:" data-id="{{ $product->id }}" class="shortlist"><i class="fa fa-plus-circle"></i> Shortlist</a>
                                                @endif
                                            </div>
                                            <div class="product-id">{{ ($user != "")?ucfirst($usertype).":".$user->name:"Admin" }}</div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p>No products found.!!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection