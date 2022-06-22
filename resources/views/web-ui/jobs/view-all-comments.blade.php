@foreach($jobquotedetails as $k => $comment)
<?php 
    if($k == 1) { break; }
    if($comment->user_type == "provider") {
        $folder = "providers";
        $user = $comment->getprovider;
    } else if($comment->user_type == "customer") {
        $folder = "customers";
        $user = $comment->getcustomer;
    }

?>
<div class="replay-sec">
    <div class="replay-sec-box">
        <div class="q-profile">
            <img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile">
        </div>
        <div class="q-comment">
            <h3>{{ $user->name }}</h3>
            <h4>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</h4>
            <p>{!! html_entity_decode($comment->details) !!}</p>
        </div>
    </div>
    <?php
    $nestedcomments = new App\Models\JobQuoteDetails;
    $comments = $nestedcomments::where(['job_quote_details_id' => $comment->id])->count();
    ?>
    <div class="view-jobquotecomment-reply"></div>
    @if($comments > 0)
    <div class="replay-comment">
        <div class="view-more-rply jobquotecomment-reply" data-commentcount="{{ $comments }}" data-job-id="{{ $comment->job_id }}" data-job-quote-id="{{ $comment->job_quote_id }}" data-jobquote-details-id="{{ $comment->id }}">
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
            <form autocomplete="off" class="job-quote-reply" method="POST">
            @csrf                                            
            <input type="hidden" name="job_id" value="{{ $comment->job_id }}">
            <input type="hidden" name="job_quote_id" value="{{ $comment->job_quote_id }}">
            <input type="hidden" name="job_quote_details_id" value="{{ $comment->id }}">
            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
            <input type="text" name="job_quote_details" required="" placeholder="Write something">
            <button type="submit">Reply</button>
        </form>
        </div>
    </div>
</div>
</div>
@endforeach