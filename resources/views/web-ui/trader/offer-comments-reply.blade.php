<?php 
    if($offercomment->user_type == "provider") {
        $folder1 = "providers";
        $user1 = $offercomment->getprovider;
    } else if($offercomment->user_type == "customer") {
        $folder1 = "customers";
        $user1 = $offercomment->getuser;
    }

?>
<div class="replay-comment">
    <div class="q-profile"><img src="{{ asset('uploads/'.$folder1.'/profile/'.$user1->profile_pic) }}" alt="profile"></div>
    <div class="q-comment">
        <h3>{{ $user1->name }}</h3>
        <h4>{{ \Carbon\Carbon::parse($offercomment->created_at)->diffForHumans() }}</h4>
        <p>{!! html_entity_decode($offercomment->comment) !!}</p>
    </div>
</div>