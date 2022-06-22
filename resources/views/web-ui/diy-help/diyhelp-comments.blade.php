<?php $url = url()->previous(); ?>
@if($commentsCount > 0)
<?php 
if($diyhelpcomment->user_type == "trader") {
    $folder = "providers";
    $user = $diyhelpcomment->getprovider;
} else if($diyhelpcomment->user_type == "customer") {
    $folder = "customers";
    $user = $diyhelpcomment->getuser;
}

?>
<div class="replay-sec">
<div class="replay-sec-box">
    <div class="q-profile"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile"></div>
    <div class="q-comment">
        <h3>{{ $user->name }}</h3>
        <h4>{{ \Carbon\Carbon::parse($diyhelpcomment->created_at)->diffForHumans() }}</h4>
        <p>{!! html_entity_decode($diyhelpcomment->comment) !!}</p>
    </div>
</div>
<?php
$nestedcomments = new App\Models\DiyHelpComments;
$comments = $nestedcomments::where(['status' => 1, 'diy_help_comment_id' => $diyhelpcomment->id])->count();
?>
<div class="view-diyhelpcomment-reply"></div>
@if($comments > 0)
<div class="replay-comment">
    <div class="view-more-rply diyhelpcomment-reply" data-commentcount="{{ $comments }}" data-diyhelp-id="{{ $diyhelpcomment->diy_help_id }}" data-diyhelp-comment-id="{{ $diyhelpcomment->id }}">
        <span>
            <i class="fa fa-mail-forward"></i>
            {{ ($comments > 1)?$comments." Replies":$comments." Reply" }}
        </span>
    </div>
</div>
@endif 
<div class="cmn-replay-sec">
<div class="box2" style="display:block;padding: 10px;">
    <div class="reply-cmt">
        <form  autocomplete="off" class="diyhelp-comment-reply" method="POST">
        @csrf
        <input type="hidden" name="diy_help_id" value="{{ $diyhelpcomment->diy_help_id }}">
        <input type="hidden" name="diy_help_comment_id" value="{{ $diyhelpcomment->id }}">
        <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
        <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
        <input type="hidden" name="allcomments" value="{{ count($diyhelpcomment->diyhelp->diyhelpcomments) }}">
        <input type="text" name="diy_help_comment" required placeholder="Write something">
        <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
    </form>
    </div>
</div>
</div>
</div>
@else
<div class="box-review" style="background-color: #f5f5f5;margin-top: 10px;">
    <div class="diyhelp-has-comments"></div>
    <?php 
        if($diyhelpcomment->user_type == "trader") {
            $folder = "providers";
            $user = $diyhelpcomment->getprovider;
        } else if($diyhelpcomment->user_type == "customer") {
            $folder = "customers";
            $user = $diyhelpcomment->getuser;
        }

    ?>
    <div class="replay-sec">
        <div class="replay-sec-box">
            <div class="q-profile"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile"></div>
            <div class="q-comment">
                <h3>{{ $user->name }}</h3>
                <h4>{{ \Carbon\Carbon::parse($diyhelpcomment->created_at)->diffForHumans() }}</h4>
                <p>{!! html_entity_decode($diyhelpcomment->comment) !!}</p>
            </div>
        </div>
        <div class="view-diyhelpcomment-reply"></div>
        <div class="cmn-replay-sec">
        <div class="box2" style="display:block;padding: 10px;">
            <div class="reply-cmt">
                <form  autocomplete="off" class="diyhelp-comment-reply" method="POST">
                @csrf
                <input type="hidden" name="diy_help_id" value="{{ $diyhelpcomment->diy_help_id }}">
                <input type="hidden" name="diy_help_comment_id" value="{{ $diyhelpcomment->id }}">
                <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                <input type="hidden" name="allcomments" value="{{ count($diyhelpcomment->diyhelp->diyhelpcomments) }}">
                <input type="text" name="diy_help_comment" required placeholder="Write something">
                <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endif