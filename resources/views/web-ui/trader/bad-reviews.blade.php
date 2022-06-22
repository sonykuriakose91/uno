<?php $url = url()->previous(); ?>
@if(count($reviews) > 0)
<div class="review-box-sec">
        <!-- Review area -->
    @foreach($reviews as $key => $review)
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
                    <input type="hidden" name="provider_id" value="{{ $review->trader_id }}">
                    <input type="hidden" name="review_comment_id" value="{{ $reviewcomment->id }}">
                    <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                    <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                    <input type="hidden" name="allcomments" value="{{ count($review->traderreviewcommentsall) }}">
                    <input type="text" name="review_comment" required placeholder="Write something">
                    <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
                </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endforeach
    @if(count($post->traderpostfirstcomments) > 1)
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
                    <input type="hidden" name="provider_id" value="{{ $review->trader_id }}">
                        <input type="hidden" name="review_comment_id" value="0">
                    <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                    <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                    <input type="hidden" name="allcomments" value="{{ count($review->traderreviewcommentsall) }}">
                    <input type="text" name="review_comment" required placeholder="Write something">
                    <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
                </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endforeach
    </div>
    @endif