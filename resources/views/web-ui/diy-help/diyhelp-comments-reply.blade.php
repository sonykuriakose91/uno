<?php 
    if($diyhelpcomment->user_type == "trader") {
        $folder1 = "providers";
        $user1 = $diyhelpcomment->getprovider;
    } else if($diyhelpcomment->user_type == "customer") {
        $folder1 = "customers";
        $user1 = $diyhelpcomment->getuser;
    }

?>
<div class="replay-comment">
    <div class="q-profile"><img src="{{ asset('uploads/'.$folder1.'/profile/'.$user1->profile_pic) }}" alt="profile"></div>
    <div class="q-comment">
        <h3>{{ $user1->name }}</h3>
        <h4>{{ \Carbon\Carbon::parse($diyhelpcomment->created_at)->diffForHumans() }}</h4>
        <p>{!! html_entity_decode($diyhelpcomment->comment) !!}</p>
    </div>
</div>