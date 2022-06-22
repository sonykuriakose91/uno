@if(count($users) > 0)
<ul>
    <?php  ?>
    @foreach($users as $key => $usr)
    <li class="chat-sec5" data-user-type="{{ ($usr->user_type == 'provider')?'trader':'customer' }}" data-user-id="{{ $usr->user_id }}">
        <div class="chat-person">
            <?php
            if($usr->user_type == "provider") { 
                $folder = "providers";
                $user = new App\Models\Providers;
                $userdetails = $user::where(['id' => $usr->user_id,'status' => 1])->first();
            } else if($usr->user_type == "customer") {
                $folder = "customers";
                $user = new App\Models\Customers;
                $userdetails = $user::where(['id' => $usr->user_id,'status' => 1])->first();
            } ?>
            <div class="chat-profile">
                @if($userdetails->profile_pic != "")
                <img src="{{ asset('uploads/'.$folder.'/profile/'.$userdetails->profile_pic) }}" alt="">
                @else
                <img src="{{ asset('ui/images/noimage.png') }}" alt="">
                @endif
            </div>
            <div class="chat-person-details">
                <div class="person-name">{{ $userdetails->name }}</div>
            </div>
        </div>
    </li>
    @endforeach
</ul>
@else
<p>No Users.!!</p>
@endif