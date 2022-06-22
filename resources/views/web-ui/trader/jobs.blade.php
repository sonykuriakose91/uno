@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>{{ $title }}</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> {{ $title }} </p>
            </div>
        </div>
    </div>
</div>

<div class="inner-area">
    <div class="traders-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="filter">
                        <div class="filter-sec">
                            <h5>{{ $title }}</h5>
                            <button class="filter-nav"></button>
                        </div>
                    </div>
                    <div class="trader-search">
                        <div class="need-help">
                            <h5>Need Help?</h5>
                            <p><a href="{{ route('contact-us') }}">Contact us here</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="result">
                        <h4>Showing Result : <span>{{ count($jobs)}} Jobs</span></h4>
                    </div>
                    <div class="search-result">
                        <ul>
                            @if(count($jobs) > 0)
                            @foreach($jobs as $key => $job)
                            <?php
                            $jobQuote = new App\Models\JobQuotes;
                            $quoteCount = $jobQuote::where(['job_id' => $job->id,"trader_id" => Auth::guard('web')->user()->user_id,"give_quote" => 1,"status" => "Accepted"])->count();
                            ?>
                            <li>
                                <div class="result job-box">

                                    <div class="box-job-sec">
                                        <div class="job-area">
                                            <h3>{{ $job->title }}</h3>
                                            <div class="pd-sec">
                                                <div class="price" style="display:block;">${{ $job->budget }}</div>
                                                <div class="date">{{ date('H:i d F Y',strtotime($job->created_at)) }}</div>
                                            </div>
                                            <div class="cont-sec001" style="height:auto;margin-bottom: 0px;">
                                                <p>{{ $job->description }} </p>
                                                <div class="more-sec">
                                                    
                                                </div>
                                            </div>
                                            <?php 
                                    $blockdetails = 0;
                                        if(Auth::guard('web')->check()) {
                                            if(Auth::guard('web')->user()->user_type == "provider") {
                                                $block = new App\Models\Block;
                                                $blockdetails = $block::where(['trader_id' => Auth::guard('web')->user()->user_id,'customer_id' => $job->customer_id])->count();
                                            }
                                        }
                                    ?>
                            @if(Auth::check() && Auth::guard('web')->user()->user_type == "provider" && $blockdetails == 0 && $quoteCount == 0)
                            <a href="#" style="float:left;" class="get-quote trader-quote-job" data-job-id="{{ $job->id }}" data-job-title="{{ $job->title }}">Quote Job</a>
                            @endif
                            <a href="{{ route('job-details', $job->id) }}" style="float: left;" class="get-quote">More Details</a>
                                        </div>
                                        <div class="job-img">
                                            <ul id="" class="owl-carousel owl-theme job-scroll2">
                                                @if(count($job->jobimages) > 0)
                                                @foreach($job->jobimages as $key => $image)
                                                <li class="item">
                                                    <img src="{{ asset('uploads/jobs/'.$image->job_image) }}" alt="">
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif  
                            
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
                    @endif                         
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection