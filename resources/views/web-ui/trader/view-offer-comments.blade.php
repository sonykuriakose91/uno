<?php $url = url()->previous(); ?>
@foreach($traderOffercomments as $k => $offercomment)
<?php 
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
    $nestedcomments = new App\Models\TraderOffersComments;
    $comments = $nestedcomments::where(['status' => 1, 'offer_comment_id' => $offercomment->id])->count();
    ?>
    <div class="view-offercomment-reply"></div>
    @if($comments > 0)
    <div class="replay-comment">
        <div class="view-more-rply offercomment-reply" data-commentcount="{{ $comments }}" data-offer-id="{{ $offercomment->trader_offer_id }}" data-offer-comment-id="{{ $offercomment->id }}">
            <span>
                <i class="fa fa-mail-forward"></i>
                {{ ($comments > 1)?$comments." Replies":$comments." Reply" }}
            </span>
        </div>
    </div>
    @endif
    <?php 
    $blockdetails = 0;
        if(Auth::guard('web')->check()) {
            if(Auth::guard('web')->user()->user_type == "customer") {
                $block = new App\Models\Block;
                $blockdetails = $block::where(['trader_id' => $offercomment->gettraderoffer->getprovider->id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
            }
        }
    ?>
    @if($blockdetails == 0)
    <div class="cmn-replay-sec">
    <div class="box2" style="display:block;padding: 10px;">
        <div class="reply-cmt">
            <form autocomplete="off" class="trader-offer-comment-reply" method="POST">
            @csrf
            <input type="hidden" name="trader_offer_id" value="{{ $offercomment->trader_offer_id }}">
            <input type="hidden" name="provider_id" value="{{ $offercomment->gettraderoffer->getprovider->id }}">
            <input type="hidden" name="offer_comment_id" value="{{ $offercomment->id }}">
            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
            <input type="hidden" name="allcomments" value="{{ count($offercomment->gettraderoffer->traderoffercommentsall) }}">
            <input type="text" name="offer_comment" required placeholder="Write something">
            <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
        </form>
        </div>
    </div>
</div>
@endif
</div>
@endforeach