<?php $url = url()->previous(); ?>
@foreach($traderPostcomments as $k => $postcomment)
<?php 
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
        <div class="view-more-rply postcomment-reply" data-commentcount="{{ $comments }}" data-post-id="{{ $postcomment->trader_post_id }}" data-post-comment-id="{{ $postcomment->id }}">
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
                $blockdetails = $block::where(['trader_id' => $postcomment->gettraderpost->getprovider->id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
            }
        }
    ?>
    @if($blockdetails == 0)
    <div class="cmn-replay-sec">
    <div class="box2" style="display:block;padding: 10px;">
        <div class="reply-cmt">
            <form autocomplete="off" class="trader-post-comment-reply" method="POST">
            @csrf
            <input type="hidden" name="trader_post_id" value="{{ $postcomment->trader_post_id }}">
            <input type="hidden" name="provider_id" value="{{ $postcomment->gettraderpost->getprovider->id }}">
            <input type="hidden" name="post_comment_id" value="{{ $postcomment->id }}">
            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
            <input type="hidden" name="allcomments" value="{{ count($postcomment->gettraderpost->traderpostcommentsall) }}">
            <input type="text" name="post_comment" required placeholder="Write something"><button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
            </form>
        </div>
    </div>
</div>
@endif
</div>
@endforeach