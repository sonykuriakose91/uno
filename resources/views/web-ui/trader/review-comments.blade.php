@if($commentsCount > 0)
<?php $url = url()->previous(); ?>
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
</div>
@else
<div class="box-review" style="background-color: #f5f5f5;margin-top: 10px;">
    <div class="review-has-comments"></div>
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
        <div class="view-reviewcomment-reply"></div>
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
    </div>
    <!-- <div class="view-comment">
        <span>view all comments</span>
    </div> -->
</div>
@endif