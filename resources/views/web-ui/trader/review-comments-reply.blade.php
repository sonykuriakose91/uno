<?php 
    if($reviewcomment->user_type == "provider") {
        $folder1 = "providers";
        $user1 = $reviewcomment->getprovider;
    } else if($reviewcomment->user_type == "customer") {
        $folder1 = "customers";
        $user1 = $reviewcomment->getuser;
    }

?>
<div class="replay-comment">
    <div class="q-profile"><img src="{{ asset('uploads/'.$folder1.'/profile/'.$user1->profile_pic) }}" alt="profile"></div>
    <div class="q-comment">
        <h3>{{ $user1->name }}</h3>
        <h4>{{ \Carbon\Carbon::parse($reviewcomment->created_at)->diffForHumans() }}</h4>
        <p>{!! html_entity_decode($reviewcomment->comment) !!}</p>
    </div>
</div>