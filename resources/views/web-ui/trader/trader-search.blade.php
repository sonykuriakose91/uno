<?php $url = url()->previous(); ?>
@if(count($providers)>0)
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
                    <img class="sp-icon" src="{{ asset('ui/images/phone-alt.svg') }}" alt="address">
                    @if(Auth::guard('web')->check())
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