@extends('web-ui.layouts.app')

@section('content')
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>DIY-Help</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> DIY-Help </p>
            </div>
        </div>
    </div>
</div>

<!-- inner area -->
<div class="inner-area">
    <div class="review-section">
        <div class="container">
            <div class="row">
                @if(Session::get('success'))
                    <div class="alert alert-success" role="alert">
                      {{ Session::get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    @if(Session::get('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('danger') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    <?php $url = url()->current(); ?>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="main-review main-tab">
                        @if(count($diyhelp) > 0)
                        @foreach($diyhelp as $key => $diy)
                        <?php 
                            if($diy->user_type == "trader") {
                                $folder = "providers";
                                $user = $diy->getprovider;
                            } else if($diy->user_type == "customer") {
                                $folder = "customers";
                                $user = $diy->getuser;
                            }

                        ?>
                        <div class="diy-hep-sec">
                            <div class="post-sec">
                                <div class="posts-view">
                                    <div class="q">
                                        <h4>{{ $diy->title }}</h4>
                                        <p>{!! html_entity_decode($diy->comment) !!}</p>
                                        <span class="h"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile"></span>
                                        <h5>{{ $user->name }}</h5>
                                        <h6>Posted: {{ date('F d,Y',strtotime($diy->created_at)) }}</h6>
                                    </div>
                                    <div class="img-p">
                                        <ul class="owl-carousel owl-theme trader-offer">
                                            @if(count($diy->diyhelpimages) > 0)
                                            @foreach($diy->diyhelpimages as $key => $image)
                                            <li class="item">
                                                <div class="img-p1">
                                                    <a href="{{ asset('uploads/diy-help/'.$image->diy_help_image) }}" data-fancybox="images" data-caption="works">
                                                        <img src="{{ asset('uploads/diy-help/'.$image->diy_help_image) }}" alt="works">
                                                    </a>
                                                </div>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="post-sec5">
                                        <div class="cmn-p diyhelpcommentscount">{{ (count($diy->diyhelpcomments) > 0)?"Comments (".count($diy->diyhelpcomments).")":"" }}</div>
                                    </div>
                                    <?php 
                                    $blockdetails = 0;
                                        if(Auth::guard('web')->check()) {
                                            $block = new App\Models\Block;
                                            if(Auth::guard('web')->user()->user_type == "customer" && $diy->user_type == "trader") {
                                                $blockdetails = $block::where(['trader_id' => $diy->user_id,'customer_id' => Auth::guard('web')->user()->user_id])->count();
                                            } elseif (Auth::guard('web')->user()->user_type == "provider" && $diy->user_type == "customer") {
                                                $blockdetails = $block::where(['trader_id' => Auth::guard('web')->user()->user_id,'customer_id' => $diy->user_id])->count();
                                            }
                                        }
                                    ?>
                                    <div class="diyhelp-first-comment"></div> 
                                    @if(count($diy->diyhelpfirstcomments) > 0)
                                    <div class="box-review" style="background-color: #f5f5f5;margin-top: 10px;">
                                        <div class="diyhelp-has-comments"></div>
                                        @foreach($diy->diyhelpfirstcomments as $k => $comment)
                                        <?php 
                                            if($k == 1) { break; }
                                            if($comment->user_type == "trader") {
                                                $folder = "providers";
                                                $user = $comment->getprovider;
                                            } else if($comment->user_type == "customer") {
                                                $folder = "customers";
                                                $user = $comment->getuser;
                                            }

                                        ?>
                                        <div class="replay-sec">
                                            <div class="replay-sec-box">
                                                <div class="q-profile"><img src="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" alt="profile"></div>
                                                <div class="q-comment">
                                                    <h3>{{ $user->name }}</h3>
                                                    <h4>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</h4>
                                                    <p>{!! html_entity_decode($comment->comment) !!}</p>
                                                </div>
                                            </div>
                                            <?php
                                            $nestedcomments = new App\Models\DiyHelpComments;
                                            $comments = $nestedcomments::where(['status' => 1, 'diy_help_comment_id' => $comment->id])->count();
                                            ?>
                                            <div class="view-diyhelpcomment-reply"></div>
                                            @if($comments > 0)
                                            <div class="replay-comment">
                                                <div class="view-more-rply diyhelpcomment-reply" data-commentcount="{{ $comments }}" data-diyhelp-id="{{ $diy->id }}" data-diyhelp-comment-id="{{ $comment->id }}">
                                                    <span>
                                                        <i class="fa fa-mail-forward"></i>
                                                        {{ ($comments > 1)?$comments." Replies":$comments." Reply" }}
                                                    </span>
                                                </div>
                                            </div>
                                            @endif    
                                            @if($blockdetails == 0)                                          
                                    <div class="cmn-replay-sec">
                                    <div class="box2" style="display:block;padding: 10px;">
                                        <div class="reply-cmt">
                                            <form  autocomplete="off" class="diyhelp-comment-reply" method="POST">
                                            @csrf
                                            <input type="hidden" name="diy_help_id" value="{{ $diy->id }}">
                                            <input type="hidden" name="diy_help_comment_id" value="{{ $comment->id }}">
                                            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                            <input type="hidden" name="allcomments" value="{{ count($diy->diyhelpcomments) }}">
                                            <input type="text" name="diy_help_comment" required placeholder="Write something">
                                            <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                </div>
                                @endforeach
                                @if(count($diy->diyhelpfirstcomments) > 1)
                                <div class="view-all-diyhelp-comments"></div>
                                <div class="view-comment show-all-diyhelp-comments" data-diyhelp-id="{{ $diy->id }}">
                                    <span>View all Comments</span>
                                </div>
                                @endif
                                    </div>
                                    @endif
                                    @if($blockdetails == 0)
                                    <div class="cmn-replay-sec">
                                    <!-- <div class="box1"><i class="fa fa-comments"></i>Replay</div> -->
                                    <div class="box2" style="display:block;">
                                        <div class="reply-cmt">
                                            <form  autocomplete="off" class="diyhelp-comment" method="POST">
                                            @csrf
                                            <input type="hidden" name="diy_help_id" value="{{ $diy->id }}">
                                            <input type="hidden" name="diy_help_comment_id" value="0">
                                            <input type="hidden" name="user_id" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:"" }}">
                                            <input type="hidden" name="user_type" value="{{ (Auth::guard('web')->check())?Auth::guard('web')->user()->user_type:"" }}">
                                            <input type="hidden" name="allcomments" value="{{ count($diy->diyhelpcomments) }}">
                                            <input type="text" name="diy_help_comment" required placeholder="Write something">
                                            <button {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Reply</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>No data found.!!</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="cmd-help">
                        <div class="review-profile">
                            <h5>DIY Help</h5>
                        </div>
                        <div class="review-box">
                            <div class="row">
                                <form autocomplete="off" action="{{ route('adddiyhelp') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Title</label>
                                        <input type="text" name="title" required placeholder="Title">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Comment</label>
                                        <textarea name="diy_help" required placeholder="Comment"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Images</label>
                                        <input type="file" class="image-files" name="diy_help_images[]" multiple>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button  {{ (Auth::guard('web')->check())?"type=submit":"onclick=openLoginModal('$url');" }}>Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

@endsection