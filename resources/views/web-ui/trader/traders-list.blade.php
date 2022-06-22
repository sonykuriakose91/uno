@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Traders</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Traders </p>
            </div>
        </div>
    </div>
</div>

<!-- inner area -->
<div class="inner-area">
    <div class="traders-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="filter">
                        <div class="filter-sec">
                            <h5>Filter</h5>
                            <button class="filter-nav"></button>
                        </div>
                    </div>
                    <div class="trader-search">
                        <div class="trader-sec">
                            <div class="box-title">Trader Search</div>
                        <div class="search-section">
                            <div class="box-content">
                                <h4>Search by Name or Username</h4>
                                <input type="text" class="txt-box" placeholder="Search by Name or Username">
                            </div>
                        </div>
                        <div class="category-search">
                            <h4>Traders Category</h4>
                            <div class="box-content">
                                <div class="raing-sec scroll">
                                    @if(count($categories) > 0)
                                    @foreach($categories as $key => $category)
                                    <label class="check_sec">{{ $category->category }}
                                        <input type="checkbox" class="filter-category" {{ (Request::segment(3) == $category->id)?"checked":"" }} value="{{ $category->id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                    @endforeach
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <div class="rating-search">
                            <h4>Traders Rating</h4>
                            <div class="box-content">
                                <div class="raing-sec">
                                    <label class="check_sec">4★ & above
                                        <input type="checkbox" class="filter-rating" value="4">
                                        <span class="checkmark"></span>
                                      </label>
                                      <label class="check_sec">3★ & above
                                        <input type="checkbox" class="filter-rating" value="3">
                                        <span class="checkmark"></span>
                                      </label>
                                      <label class="check_sec">2★ & above
                                        <input type="checkbox" class="filter-rating" value="2">
                                        <span class="checkmark"></span>
                                      </label>
                                      <label class="check_sec">1★ & above
                                        <input type="checkbox" class="filter-rating" value="1">
                                        <span class="checkmark"></span>
                                      </label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="top-toolbar">
                        <div class="filter-section">
                            <div class="showing-result">
                                <h4>Showing Result : <span>{{ (count($providers) > 1) ? count($providers)." Traders" : count($providers)." Trader" }}</span></h4>
                            </div>
                            <div class="sort-section">
                                <div class="sort-txt">SORT BY</div>
                                <div class="btn-group">
                                    <select class="filter-sort-by">
                                        <option value="1">Latest</option>
                                        <option value="2">A-Z</option>
                                        <option value="3">Z-A</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $url = url()->current(); ?>
                    <div class="traderlist-section search-result">
                        @if(count($providers) > 0)
                        <ul>
                            @foreach($providers as $key => $value) 
                            <?php 
                            $total_reviews = count($value->providerreviews);
                            $avg_score = 0;
                            foreach($value->providerreviews as $key => $review) {
                                $avg_score = $avg_score+(($review->reliability+$review->response+$review->tidiness+$review->accuracy+$review->pricing)*2);
                            }
                            ?>
                            <li>
                                <a href="{{ route('traderdetails', $value->username) }}">
                                    <div class="result">
                                        <div class="pic-profile">
                                            <img src="{{ asset('uploads/providers/profile/'.$value->profile_pic) }}" alt="{{ $value->name }}">
                                        </div>
                                        <h3>{{ $value->name }}</h3>
                                        <h4>{{ isset($value->providercategories[0]->getcategory->category)?$value->providercategories[0]->getcategory->category:"" }}</h4>
                                        <h5>{{ (count($value->providerreviews) > 0)?number_format(($avg_score/$total_reviews)/5,2):"0" }} <span>({{ (count($value->providerreviews) <= 1)?count($value->providerreviews)." Review":count($value->providerreviews)." Reviews" }})</span></h5>
                                        <p>{!! substr(html_entity_decode($value->completed_works),0,360) !!}</p>
                                    </div>
                                </a>
                                <div class="result-contact">
                                    <div class="result-contact1">
                                        <img class="sp-icon" src="{{ asset('ui/images/quotation.svg') }}" alt="Email">
                                        <a href="{{ route('traderdetails', $value->username) }}">Get a quote</a>
                                    </div>
                                    <div class="result-contact1">
                                        <img class="sp-icon" src="{{ asset('ui/images/phone-alt.svg') }}" alt="address">@if(Auth::guard('web')->check())
                                        {{ $value->mobile }}
                                        @else
                                        XXXXXXXXXX
                                        @endif
                                    </div>
                                    @if(Auth::guard('web')->check())
                                    <div class="result-message message_to_trader_from_list" data-trader-id="{{ $value->id }}">
                                        <img class="sp-icon" src="{{ asset('ui/images/comment.svg') }}" alt="Email">Message
                                    </div>
                                    @else
                                    <div class="result-message" onclick="openLoginModal('<?php echo $url; ?>');">
                                        <img class="sp-icon" src="{{ asset('ui/images/comment.svg') }}" alt="Email">Message
                                    </div>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>No traders.!!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<form style="display:none;" class="form-horizontal" autocomplete="off" id="message_trader_list" method="POST" action="{{ route('messages.store') }}">
    @csrf
    <input type="hidden" name="from_user_type" value="{{ (Auth::guard('web')->user()->user_type == 'provider')?'trader':'customer' }}" >
    <input type="hidden" name="from_user_id" value="{{ Auth::guard('web')->user()->user_id }}" >
    <input type="hidden" name="to_user_type" value="trader" >
    <input type="hidden" name="to_user_id" value="" id="to_user_id">
    <input type="hidden" name="is_trader" value="1" >
    <input type="hidden" name="trader_id" value="" id="trader_id">
    <textarea name="message" placeholder="Message" required></textarea>
    <button>Send</button>
</form>
@endsection