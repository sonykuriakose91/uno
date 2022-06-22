@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Jobs</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}">  </p>
            </div>
        </div>
    </div>
</div>

<div class="inner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                <div class="product-details-sec d-flex">
                    <div class="prodect-dp">
                        <ul id="bazaar" class="owl-carousel owl-theme">
                            @if(count($jobdetails->jobimages) > 0)
                            @foreach($jobdetails->jobimages as $key => $image)
                            <li class="item">
                                <img style="width:100%" src="{{ asset('uploads/jobs/'.$image->job_image) }}" alt="">
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <?php 
                    $blockdetails = 0;
                        if(Auth::guard('web')->check()) {
                            if(Auth::guard('web')->user()->user_type == "provider") {
                                $block = new App\Models\Block;
                                $blockdetails = $block::where(['trader_id' => Auth::guard('web')->user()->user_id,'customer_id' => $jobdetails->user_id])->count();
                            }
                        }
                    ?>
                    <div class="details-cont">
                        <h4>{{ $jobdetails->title }}
                        @if(Auth::check() && Auth::guard('web')->user()->user_type == "provider" && $blockdetails == 0)
                        <a href="#" class="btn btn-sm btn-success pull-right get-quote trader-quote-job" data-job-id="{{ $jobdetails->id }}" data-job-title="{{ $jobdetails->title }}">Quote Job</a>
                        <?php 
                        $jobquote = new App\Models\JobQuotes;
                        $quotedetails = $jobquote::where(['job_id' => $jobdetails->id,'trader_id' => Auth::guard('web')->user()->user_id,'customer_id' => $jobdetails->user_id])->first();
                        ?>
                        <a href="#" class="btn btn-sm btn-success pull-right get-quote request-more-details" data-id="{{ $jobdetails->id }}" data-job-quote-id="{{ ($quotedetails != '')?$quotedetails->id:0 }}" data-toggle="modal" data-target="#requestmoredetails">Request More Details</a>
                        @endif
                    </h4>
                        <div class="pd-sec">
                            <div class="price" style="display:block;">${{ $jobdetails->budget }}</div>
                            <div class="date">{{ date('d F Y H:i A',strtotime($jobdetails->created_at)) }}</div>
                        </div>
                        <p>{{ $jobdetails->description }}</p>
                    </div>
                </div>
                @if(Auth::check() && Auth::guard('web')->user()->user_type == "provider")
                <div class="modal fade" id="traderquotejob" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="appointment-sec">
                                    <form class="form-horizontal" autocomplete="off" method="POST" action="{{ route('trader.traderquotejob') }}">
                                        @csrf
                                        <input type="hidden" name="trader_id" value="{{ Auth::guard('web')->user()->user_id }}" >
                                        <input type="hidden" id="job-id" name="job_id" value="" >
                                        <input type="text" placeholder="Quote Price" name="quote_price" required />
                                        <textarea name="quote_reason" placeholder="Reason" required></textarea>
                                        <button>Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="requestmoredetails" role="dialog">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Request More Details</h4>
                        </div>
                        <div class="modal-body">
                            <div class="appointment-sec">
                                <form class="form-horizontal" id="request-details-form1" action="{{ route('job-request-details') }}" method="POST">
                                @csrf
                                <input type="hidden" name="job_id" id="job_id" value="" >
                                <input type="hidden" name="job_quote_id" id="job_quote_id" value="" >
                                <input type="hidden" name="job_quote_details_id" value="0" >
                                <input type="hidden" name="user_type" value="{{ Auth::guard('web')->user()->user_type }}" >
                                <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->user_id }}" >
                                <textarea name="request_details" placeholder="Request More Details" required></textarea>
                                <button type="submit" id="request-details-form">Report</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                @endif
                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer' && Auth::guard('web')->user()->user_id == $jobdetails->user_id)
                @if(count($jobdetails->jobquotes) > 0)
                <div class="cm-sec">
                    <h6>Job Quote Requests</h6>
                    <div class="replay-sec">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach($jobdetails->jobquotes as $key => $quote)
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Trader</th>
                                    <th>Quote Price</th>
                                    <th>Quote Reason</th>
                                    @if($quote->status == "Requested" && $quote->quoted_price != "" && $quote->give_quote == 1)
                                    <th>#</th>
                                    @else
                                    <th>Status</th>
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $quote->gettrader->name }}</td>
                                    <td>{{ $quote->quoted_price }}</td>
                                    <td>{{ $quote->quote_reason }}</td>
                                    @if($quote->status == "Requested" && $quote->quoted_price != "" && $quote->give_quote == 1)
                                    <td>
                                        <a href="{{ route('updatejobquote',[$quote->id,'accept']) }}" onclick="return confirm('Are you sure you want to accept this job quote?');" class="btn btn-xs btn-success">Accept</a>
                                        <a href="{{ route('updatejobquote',[$quote->id,'reject']) }}" onclick="return confirm('Are you sure you want to reject this job quote?');" class="btn btn-xs btn-danger">Reject</a>
                                    </td>
                                    @else
                                    <td>{{ $quote->status }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        @if(count($quote->jobquotesdetailsfirst) > 0)
                                        <div class="cm-sec">
                                            <h6>Communication Details</h6>
                                            <div class="jobquote-first-comment"></div>
                                            <div class="jobquote-has-comments"></div>
                                            @foreach($quote->jobquotesdetailsfirst as $k => $comment)
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
                                                    <div class="view-more-rply jobquotecomment-reply" data-commentcount="{{ $comments }}" data-job-id="{{ $jobdetails->id }}" data-job-quote-id="{{ $comment->job_quote_id }}" data-jobquote-details-id="{{ $comment->id }}">
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
                                                        <input type="hidden" name="job_id" value="{{ $jobdetails->id }}">
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
                                        @endif
                                        @if(count($quote->jobquotesdetailsfirst) > 1)
                                        <div class="view-all-jobquote-comments"></div>
                                        <div class="view-comment show-all-jobquote-comments" data-job-quote-id="{{ $comment->job_quote_id }}">
                                                <span>View all Comments</span>
                                            </div>
                                        </div>              
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>        
                    </div>
                </div>
                @endif
                @endif
                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider')
                @if(count($jobdetails->jobquotes) > 0)
                <div class="cm-sec">
                    <h6>Job Quote Requests</h6>
                    <div class="replay-sec">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach($jobdetails->jobquotes as $key => $quote)
                                @if($quote->trader_id == Auth::guard('web')->user()->user_id)
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Trader</th>
                                    <th>Quote Price</th>
                                    <th>Quote Reason</th>
                                </tr>
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $quote->gettrader->name }}</td>
                                    <td>{{ $quote->quoted_price }}</td>
                                    <td>{{ $quote->quote_reason }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        @if(count($quote->jobquotesdetailsfirst) > 0)
                                        <div class="cm-sec">
                                            <h6>Communication Details</h6>
                                            <div class="jobquote-first-comment"></div>
                                            <div class="jobquote-has-comments"></div>
                                            @foreach($quote->jobquotesdetailsfirst as $k => $comment)
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
                                                    <div class="view-more-rply jobquotecomment-reply" data-commentcount="{{ $comments }}" data-job-id="{{ $jobdetails->id }}" data-job-quote-id="{{ $comment->job_quote_id }}" data-jobquote-details-id="{{ $comment->id }}">
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
                                                        <input type="hidden" name="job_id" value="{{ $jobdetails->id }}">
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
                                        @endif
                                        @if(count($quote->jobquotesdetailsfirst) > 1)
                                        <div class="view-all-jobquote-comments"></div>
                                        <div class="view-comment show-all-jobquote-comments" data-job-quote-id="{{ $comment->job_quote_id }}">
                                                <span>View all Comments</span>
                                            </div>
                                        </div>              
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>        
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection