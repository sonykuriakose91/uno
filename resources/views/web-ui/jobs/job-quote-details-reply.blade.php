<?php 
    if($jobquotedetails->user_type == "provider") {
        $folder1 = "providers";
        $user1 = $jobquotedetails->getprovider;
    } else if($jobquotedetails->user_type == "customer") {
        $folder1 = "customers";
        $user1 = $jobquotedetails->getcustomer;
    }

?>
<div class="replay-comment">
    <div class="q-profile"><img src="{{ asset('uploads/'.$folder1.'/profile/'.$user1->profile_pic) }}" alt="profile"></div>
    <div class="q-comment">
        <h3>{{ $user1->name }}</h3>
        <h4>{{ \Carbon\Carbon::parse($jobquotedetails->created_at)->diffForHumans() }}</h4>
        <p>{!! html_entity_decode($jobquotedetails->details) !!}</p>
    </div>
</div>