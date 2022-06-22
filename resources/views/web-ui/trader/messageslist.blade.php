@if(count($messages) > 0)
<div class="chat-person-area1">
    <div class="back-view"><i class="fa fa-arrow-left"></i></div>
    <div class="chat-person">
        <div class="chat-profile"><img src="{{ asset('uploads/'.$req_user_type.'/profile/'.$user->profile_pic) }}" alt=""></div>
        <div class="chat-person-details">
            <div class="person-name">{{ $user->name }}</div>
            <div class="status online">{{ ($user->getuser->loggedIN == 1)?"Online":"" }}</div>
        </div>
    </div>
</div>
<div class="chating-sec">
@foreach($messages as $key => $message)
<div class="{{ ($message->from_user_type == 'trader' && $message->from_user_id == Auth::guard('web')->user()->user_id)?"myself":"friend"}}">
    <div class="chating-txt-area">
        <div class="chat-txt">
            @if($message->is_bazaar == 1)
            <?php
            $bazaar = new App\Models\BazaarImages;
            $bazaarimages = $bazaar::where(['bazaar_id' => $message->product_id])->first();
            ?>
            <div class="p-f">
                <a href="{{ route('product-details', $message->product_id) }}">
                    <div class="p-image">
                        <img src="{{ asset('uploads/bazaar/products/'.$bazaarimages->product_image) }}" alt="">
                    </div>
                    <p>{{ $message->message }}</p>
                </a>
            </div>
            @elseif($message->is_trader == 1)
            <?php
            $trader = new App\Models\Providers;
            $traderdetails = $trader::where(['id' => $message->trader_id])->first();
            ?>
            <div class="p-f">
                <a href="{{ route('traderdetails', $traderdetails->username) }}">
                    <div class="p-image">
                        <img src="{{ asset('uploads/providers/profile/'.$traderdetails->profile_pic) }}" alt="">
                    </div>
                    <p>{{ $message->message }}</p>
                </a>
            </div>
            @elseif($message->is_job == 1)
            <?php
            $job = new App\Models\JobsImages;
            $jobimages = $job::where(['job_id' => $message->job_id])->first();
            ?>
            <div class="p-f">
                <a href="{{ route('job-details', $message->job_id) }}">
                    <div class="p-image">
                        <img src="{{ asset('uploads/jobs/'.$jobimages->job_image) }}" alt="">
                    </div>
                    <p>{{ $message->message }}</p>
                </a>
            </div>
            @else
            {{ $message->message }}
            @endif
        </div>
    </div>
</div>
@endforeach
<div class="view-chat-reply"></div>
</div>
<div class="chat-typing">
    <form class="form-horizontal" autocomplete="off" id="message_from_message">
        @csrf
        <input type="hidden" name="from_user_type" value="trader" >
        <input type="hidden" name="from_user_id" value="{{ Auth::guard('web')->user()->user_id }}" >
        <input type="hidden" name="to_user_type" value="{{ ($req_user_type == 'customers')?'customer':'trader' }}" >
        <input type="hidden" name="to_user_id" value="{{ $user->id }}" id="to_user_id">
        <textarea placeholder="Write Somthing" name="message" required class="typing-sec"></textarea>
        <button class="send-chat"><i class="fa fa-send"></i></button>
    </form>
</div>
@else
<p>No messages.!!</p>
@endif