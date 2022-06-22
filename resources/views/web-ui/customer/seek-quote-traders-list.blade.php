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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                    <div class="top-toolbar">
                        <div class="filter-section">
                            <div class="showing-result">
                                <h4>Showing Result : <span>{{ (count($providers) > 1) ? count($providers)." Traders" : count($providers)." Trader" }}</span></h4>
                            </div>
                            <!-- <div class="sort-section">
                                <div class="sort-txt">SORT BY</div>
                                <div class="btn-group">
                                    <select class="filter-sort-by">
                                        <option value="1">Latest</option>
                                        <option value="2">A-Z</option>
                                        <option value="3">Z-A</option>
                                    </select>
                                    
                                </div>
                            </div> -->
                        </div>
                    </div>
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

                            <?php 
                            $blockdetails = 0;
                                if(Auth::guard('web')->check()) {
                                    if(Auth::guard('web')->user()->user_type == "customer") {
                                        $block = new App\Models\Block;
                                        $blockdetails = $block::where(['trader_id' => $value->id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
                                    }
                                }
                            ?>
                            <li>
                                <a href="{{ route('traderdetails-seekquote', [$value->username,$job->id]) }}">
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
                                <?php
                                $jobQuote = new App\Models\JobQuotes;
                                $quoteDetails = $jobQuote::where(['status' => 'Requested', 'job_id' => $job->id,'trader_id' => $value->id, 'customer_id' => Auth::guard('web')->user()->user_id])->count();
                                ?>
                                @if($blockdetails == 0)
                                <div class="result-contact">
                                    <div class="result-contact1">
                                        <img class="sp-icon" src="{{ asset('ui/images/quotation.svg') }}" alt="Email">
                                        @if($quoteDetails == 0)
                                        <a href="{{ route('traderrequestquote', [$job->id,$value->id]) }}">Get a quote</a>
                                        @else
                                        <a href="javascript:;" onclick="alert('You have already requested a quote from this customer.!')">Quote Requested</a>
                                        @endif
                                    </div>
                                    <div class="result-contact1">
                                        <img class="sp-icon" src="{{ asset('ui/images/phone-alt.svg') }}" alt="address">@if(Auth::guard('web')->check())
                                        {{ $value->mobile }}
                                        @else
                                        XXXXXXXXXX
                                        @endif
                                    </div>
                                    <div class="result-contact1">
                                        <img class="sp-icon" src="{{ asset('ui/images/comment.svg') }}" alt="Email">
                                        <a href="#" data-trader-id="{{ $value->id }}" class="message_to_trader">Message</a>
                                    </div>
                                </div>
                                @endif
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
<form style="display:none;" class="form-horizontal" autocomplete="off" id="message_trader" method="POST" action="{{ route('customer.messages.store') }}">
    @csrf
    <input type="hidden" name="from_user_type" value="customer" >
    <input type="hidden" name="from_user_id" value="{{ Auth::guard('web')->user()->user_id }}" >
    <input type="hidden" name="to_user_type" value="trader" >
    <input type="hidden" name="to_user_id" value="" id="to_user_id">
    <input type="hidden" name="is_job" value="1" >
    <input type="hidden" name="job_id" value="{{ $job->id }}">
    <textarea name="message" placeholder="Message" required></textarea>
    <button>Send</button>
</form>
@endsection