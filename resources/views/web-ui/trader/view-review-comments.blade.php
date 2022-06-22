<?php $url = url()->previous(); ?>
@foreach($traderReviewcomments as $k => $reviewcomment)
<?php 
    if($reviewcomment->user_type == "provider") {
        $folder = "providers";
        $user = $reviewcomment->getprovider;
    } else if($reviewcomment->user_type == "customer") {
        $folder = "customers";
        $user = $reviewcomment->getuser;
    }

?>
<div class="replay-sec">
    <div class="replay-sec-box">
        <div class="q-profile"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile"></div>
        <div class="q-comment">
            <h3>{{ $user->name }}</h3>
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
        <div class="view-more-rply reviewcomment-reply" data-commentcount="{{ $reviewcomments }}" data-review-id="{{ $reviewcomment->review_id }}" data-review-comment-id="{{ $reviewcomment->id }}">
            <span>
                <i class="fa fa-mail-forward"></i>
                {{ ($reviewcomments > 1)?$reviewcomments." Replies":$reviewcomments." Reply" }}
            </span>
        </div>
    </div>
    @endif
    <?php 
    $blockdetails = 0;
        if(Auth::guard('web')->check()) {
            if(Auth::guard('web')->user()->user_type == "customer") {
                $block = new App\Models\Block;
                $blockdetails = $block::where(['trader_id' => $reviewcomment->gettraderreview->trader_id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
            }
        }
    ?>
    @if($blockdetails == 0)
    <div class="cmn-replay-sec">
    <div class="box2" style="display:block;padding: 10px;">
        <div class="reply-cmt">
            <form autocomplete="off" class="trader-review-comment-reply" method="POST">
                @csrf
            <input type="hidden" name="review_id" value="{{ $reviewcomment->review_id }}">
            <input type="hidden" name="provider_id" value="{{ $reviewcomment->gettraderreview->trader_id }}">
            <input type="hidden" name="review_comment_id" value="{{ $reviewcomment->id }}">
            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
            <input type="hidden" name="allcomments" value="{{ count($reviewcomment->gettraderreview->traderreviewcommentsall) }}">
            <input type="text" name="review_comment" required placeholder="Write something">
            <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
        </form>
        </div>
    </div>
</div>
@endif
</div>
@endforeach