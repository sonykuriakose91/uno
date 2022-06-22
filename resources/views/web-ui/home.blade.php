@extends('web-ui.layouts.app')

@section('content')
    <!-- banner area -->
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
<!-- banner area close-->
<!-- Service area -->
<div class="services">
    <div class="container">
        <h2><span>Most popular</span><br> Advertisement</h2>
        @if(count($ads) > 0)
        <ul  id="service" class="owl-carousel owl-theme">
            @foreach($ads as $key => $ad)
            <li class="item">
                <a href="">
                    <div class="offers-scroll">
                        <img src="{{ asset('uploads/ads/'.$ad->ad_image) }}" alt="advertisement">
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</div>
<!-- Service area close-->
<!-- signup area -->
<div class="main-signup-area">
    <div class="container">
        <div class="row flx-box">
            <div class="col-md-3 col-sm-6 col-xs-6 mrg-btm">
                <div class="customer">
                    <div class="customerImg">
                        <img src="{{ asset('ui/images/customer-signup.svg') }}" alt="customer">
                    </div>
                    <div class="customer-content">
                        <div class="cmn-title">
                            <h4>Customer sign up</h4>
                        </div>
                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer')
                        <a href="javascript:void(0)" onclick="alert('You are already logged in as a customer');">Sign up</a>
                        @elseif((Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider'))
                        <a href="javascript:void(0)" onclick="alert('You are already logged in as a trader');">Sign up</a>
                        @else
                        <a href="javascript:void(0)" onclick="openRegisterModal();">Sign up</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 mrg-btm">
                <div class="tradeperson">
                    <div class="customerImg">
                        <img src="{{ asset('ui/images/trader-signup.svg') }}" alt="trader">
                    </div>
                    <div class="customer-content">
                        <div class="cmn-title">
                            <h4>Tradesperson sign up</h4>
                        </div>
                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer')
                        <a href="javascript:void(0)" onclick="alert('You are already logged in as a customer');">Join for free</a>
                        @elseif((Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider'))
                        <a href="javascript:void(0)" onclick="alert('You are already logged in as a trader');">Join for free</a>
                        @else
                        <a href="javascript:void(0)" onclick="openRegisterModal();">Join for free</a>
                        @endif
                    </div>
                </div>
            </div>
            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer')
            <div class="col-md-3 col-sm-6 col-xs-6 mrg-btm">
                <div class="trade-review">
                    <div class="customerImg">
                        <img src="{{ asset('ui/images/review-trader.svg') }}" alt="review">
                    </div>
                    <div class="customer-content">
                        <div class="cmn-title">
                            <h4>Post a job</h4>
                        </div>
                        <a href="{{ route('post-job') }}" >View more</a>
                    </div>
                </div>
            </div>
            @elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider')
            <div class="col-md-3 col-sm-6 col-xs-6 mrg-btm">
                <div class="trade-review">
                    <div class="customerImg">
                        <img src="{{ asset('ui/images/review-trader.svg') }}" alt="review">
                    </div>
                    <div class="customer-content">
                        <div class="cmn-title">
                            <h4>Post a job</h4>
                        </div>
                        <a href="javascript:void(0)" onclick="alert('Please login as a customer to post jobs.!')">View more</a>
                    </div>
                </div>
            </div>
            @else
            <?php $url = url()->current(); ?>
            <div class="col-md-3 col-sm-6 col-xs-6 mrg-btm">
                <div class="trade-review">
                    <div class="customerImg">
                        <img src="{{ asset('ui/images/review-trader.svg') }}" alt="review">
                    </div>
                    <div class="customer-content">
                        <div class="cmn-title">
                            <h4>Post a job</h4>
                        </div>
                        <a href="javascript:void(0)" onclick="openLoginModal('<?php echo $url; ?>');">View more</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-3 col-sm-6 col-xs-6 mrg-btm">
                <div class="request-quote">
                    <div class="customerImg">
                        <img src="{{ asset('ui/images/request-quote.svg') }}" alt="quote">
                    </div>
                    <div class="customer-content">
                        <div class="cmn-title">
                            <h4>Sell for free at Bazaar</h4>
                        </div>
                        <a href="{{ route('bazaarhome') }}">View more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- signup area close-->
<!-- featured list -->
<?php
$service_cat_count = count($servicecategories);
$sales_cat_count = count($salescategories);
$servicetabs = ($service_cat_count % 2 == 0)?$service_cat_count/2:ceil($service_cat_count/2);
$salestabs = ($sales_cat_count % 2 == 0)?$sales_cat_count/2:ceil($sales_cat_count/2);
?>
<div class="featured-list">
    <div class="container">
        <h4><span>Traders Category</span></h4>
        <ul id="myTab" class="nav nav-tabs">
            @if(count($servicecategories) > 0)
            <li class="traderscat active"><a href="#services" data-toggle="tab">Services</a></li>
            @endif
            @if(count($salescategories) > 0)
            <li class="traderscat"><a href="#sales" data-toggle="tab">Sales</a></li>
            @endif
        </ul>
        <div id="myTabContent" class="tab-content" >
            @if(count($servicecategories) > 0)
            <div class="tab-pane fade in active" id="services">
                <div class="row">
                    <?php $l = 0; ?>
                    @for($k=0;$k<$servicetabs;$k++)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="main-sec-category">
                            @for($i=$l;$i<=$l+1;$i++)
                            <?php if($i == count($servicecategories)) { break; } ?>
                            <div class="hm-category">
                                <div class="category-head color1{{ $k+1 }}">{{ $servicecategories[$i]->category }}</div>
                                @if(count($servicecategories[$i]->subcategories) > 0)
                                <?php $subcount = (count($servicecategories[$i]->subcategories) > 4)?4:count($servicecategories[$i]->subcategories); ?>
                                <ul>
                                   @for($j=0;$j<$subcount;$j++)
                                    <li>
                                        <a href="{{ route('tradersbysubcategory',[$servicecategories[$i]->id,$servicecategories[$i]->subcategories[$j]->id]) }}">{{ $servicecategories[$i]->subcategories[$j]->category }}</a>
                                    </li>
                                    @endfor 
                                </ul>
                                @endif
                                @if(count($servicecategories[$i]->subcategories) > 4)
                                <div class="links">
                                    <a href="{{ route('tradersbycategory',$servicecategories[$i]->id) }}">View All</a>
                                </div>
                                @endif
                            </div>
                            @endfor
                            <?php $l = $i ?>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            @endif
            @if(count($salescategories) > 0)
            <div class="tab-pane fade" id="sales">
                <div class="row">
                    <?php $l = 0; ?>
                    @for($k=0;$k<$salestabs;$k++)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="main-sec-category">
                            @for($i=$l;$i<=$l+1;$i++)
                            <?php if($i == count($salescategories)) { break; } ?>
                            <div class="hm-category">
                                <div class="category-head color1{{ $k+1 }}">{{ $salescategories[$i]->category }}</div>
                                @if(count($salescategories[$i]->subcategories) > 0)
                                <?php $subcount = (count($salescategories[$i]->subcategories) > 4)?4:count($salescategories[$i]->subcategories); ?>
                                <ul>
                                   @for($j=0;$j<$subcount;$j++)
                                    <li>
                                        <a href="#">{{ $salescategories[$i]->subcategories[$j]->category }}</a>
                                    </li>
                                    @endfor 
                                </ul>
                                @endif
                                @if(count($salescategories[$i]->subcategories) > 4)
                                <div class="links">
                                    <a href="#">View All</a>
                                </div>
                                @endif
                            </div>
                            @endfor
                            <?php $l = $i ?>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            @endif
        </div>
        
    </div>
</div>
<!-- featured list close-->
@endsection