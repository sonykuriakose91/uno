@extends('web-ui.layouts.app')

@section('content')
<div class="inner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="chat-main-sec">
                    <div class="chat-left">
                        <div class="chat-search-sec">
                            <input type="text" placeholder="Search chats" id="search-chat-user">
                        </div>
                        <div class="chat-list">
                            @if(count($msg) > 0)
                            <ul>
                                @foreach($msg as $key => $message)
                                <?php
                                $userdetails = "";
                                $mess = new App\Models\Messages;
                                if($message['user_type'] == "trader") {
                                    $folder = "providers";
                                    $user = new App\Models\Providers;
                                    $userdetails = $user::where(['id' => $message['user_id'],'status' => 1])->first();
                                    $messages = $mess::where([['from_user_type', '=', 'trader'],['from_user_id', '=', $message['user_id']]])->orWhere([['to_user_type', '=', 'trader'],['to_user_id', '=', $message['user_id']]])->orderBy('id','desc')->first();
                                } else if($message['user_type'] == "customer") {
                                    $folder = "customers";
                                    $user = new App\Models\Customers;
                                    $userdetails = $user::where(['id' => $message['user_id'],'status' => 1])->first();
                                    $messages = $mess::where([['from_user_type', '=', 'customer'],['from_user_id', '=', $message['user_id']]])->orWhere([['to_user_type', '=', 'customer'],['to_user_id', '=', $message['user_id']]])->orderBy('id','desc')->first();
                                } ?>
                                <li class="chat-sec5" data-user-type="{{ $message['user_type'] }}" data-user-id="{{ $message['user_id'] }}">
                                    <div class="chat-person">
                                        <div class="chat-profile">
                                            @if($userdetails->profile_pic != "")
                                            <img src="{{ asset('uploads/'.$folder.'/profile/'.$userdetails->profile_pic) }}" alt="">
                                            @else
                                            <img src="{{ asset('ui/images/noimage.png') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="chat-person-details">
                                            <div class="person-name">{{ $userdetails->name }}</div>
                                            <div class="last-chat">{{ (strlen($messages->message) > 30)?substr($messages->message,0,27)."...":$messages->message }}</div>
                                        </div>
                                    </div>
                                    <div class="chat-date">
                                        <div class="chat-time">{{ date('h:i A',strtotime($messages->created_at)) }}</div>
                                        <!-- <div class="receive-chat"><span></span></div> -->
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p>No messages.!!</p>
                            @endif
                        </div>
                    </div>
                    <div class="chat-right">
                        @if(Session::get('to_user_type') != "" && Session::get('to_user_id') != "")
                        <?php
                            if(Session::get('to_user_type') == "trader") {
                                $trader = new App\Models\Providers;
                                $user = $trader::where(['id' => Session::get('to_user_id')])->first();
                                $folder = "providers";
                            } elseif(Session::get('to_user_type') == "customer") {
                                $customer = new App\Models\Customers;
                                $user = $customer::where(['id' => Session::get('to_user_id')])->first();
                                $folder = "customers";
                            }
                            $user_type = "trader";
                            $user_id = Auth::guard('web')->user()->user_id;
                            $msg = new App\Models\Messages;
                            $messages = $msg::where([['from_user_type', '=', Session::get('to_user_type')],['from_user_id', '=', Session::get('to_user_id')],['to_user_type', '=', $user_type],['to_user_id', '=', $user_id]])->orWhere([['to_user_type', '=', Session::get('to_user_type')],['to_user_id', '=', Session::get('to_user_id')],['from_user_type', '=', $user_type],['from_user_id', '=', $user_id]])->orderBy('id','asc')->get();
                        ?>
                        <div class="chat-person-area1">
                            <div class="back-view"><i class="fa fa-arrow-left"></i></div>
                            <div class="chat-person">
                                <div class="chat-profile"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt=""></div>
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
                                    <input type="hidden" name="to_user_type" value="{{ Session::get('to_user_type') }}" >
                                    <input type="hidden" name="to_user_id" value="{{ Session::get('to_user_id') }}">
                                    <textarea required placeholder="Write Somthing" name="message" class="typing-sec"></textarea>
                                    <button class="send-chat"><i class="fa fa-send"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection