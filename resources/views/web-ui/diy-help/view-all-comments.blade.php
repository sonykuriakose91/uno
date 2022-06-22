<?php $url = url()->previous(); ?>
@foreach($diyhelpcomments as $k => $diycomment)
<?php 
    if($diycomment->user_type == "trader") {
        $folder = "providers";
        $user = $diycomment->getprovider;
    } else if($diycomment->user_type == "customer") {
        $folder = "customers";
        $user = $diycomment->getuser;
    }

?>
<div class="replay-sec">
    <div class="replay-sec-box">
        <div class="q-profile"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile"></div>
        <div class="q-comment">
            <h3>{{ $user->name }}</h3>
            <h4>{{ \Carbon\Carbon::parse($diycomment->created_at)->diffForHumans() }}</h4>
            <p>{!! html_entity_decode($diycomment->comment) !!}</p>
        </div>
    </div>
    <?php
    $nestedcomments = new App\Models\DiyHelpComments;
    $comments = $nestedcomments::where(['status' => 1, 'diy_help_comment_id' => $diycomment->id])->count();
    ?>
    <div class="view-diyhelpcomment-reply"></div>
    @if($comments > 0)
    <div class="replay-comment">
        <div class="view-more-rply diyhelpcomment-reply" data-commentcount="{{ $comments }}" data-diyhelp-id="{{ $diycomment->diy_help_id }}" data-diyhelp-comment-id="{{ $diycomment->id }}">
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
            $block = new App\Models\Block;
            if(Auth::guard('web')->user()->user_type == "customer" && $diycomment->diyhelp->user_type == "trader") {
                $blockdetails = $block::where(['trader_id' => $diycomment->diyhelp->user_id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
            } elseif (Auth::guard('web')->user()->user_type == "provider" && $diycomment->diyhelp->user_type == "customer") {
                $blockdetails = $block::where(['trader_id' => Auth::guard('web')->user()->user_id,'customer_id' => $diycomment->diyhelp->user_id])->count();
            }
        }
    ?>
    @if($blockdetails == 0)
    <div class="cmn-replay-sec">
    <div class="box2" style="display:block;padding: 10px;">
        <div class="reply-cmt">
            <form  autocomplete="off" class="diyhelp-comment-reply" method="POST">
                @csrf
                <input type="hidden" name="diy_help_id" value="{{ $diycomment->diy_help_id }}">
                <input type="hidden" name="diy_help_comment_id" value="{{ $diycomment->id }}">
                <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                <input type="hidden" name="allcomments" value="{{ count($diycomment->diyhelp->diyhelpcomments) }}">
                <input type="text" name="diy_help_comment" required placeholder="Write something">
                <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
            </form>
        </div>
    </div>
</div>
@endif
</div>
@endforeach