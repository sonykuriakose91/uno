@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Jobs Quote Requests</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Jobs Quote Requests </p>
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
                            <h5>Jobs Quote Requests</h5>
                            <button class="filter-nav"></button>
                        </div>
                    </div>
                    <div class="trader-search">
                        <!-- <div class="trader-sec">
                            <div class="box-title">Jobs Quote Requests</div>
                        
                        
                        
                        </div> -->
                        <div class="need-help">
                            <h5>Need Help?</h5>
                            <p><a href="{{ route('contact-us') }}">Contact us here</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
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
                    <div class="result">
                        
                    </div>
                    <div class="search-result">
                        <ul>
                            @if(count($jobs) > 0)
                            @foreach($jobs as $key => $job)
                            <?php
                            // $jobQuote = new App\Models\JobQuotes;
                            // $quoteCount = $jobQuote::where(['job_id' => $job->id,'detail_request' => 1])->count();
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
                                                    <a href="#" class="request-more-details" data-id="{{ $job->id }}" data-job-quote-id="{{ $job->job_quote_id }}" data-toggle="modal" data-target="#requestmoredetails">Request More Details</a>
                                                    <a href="#"  class="get-quote trader-quote-job" data-job-id="{{ $job->id }}" data-job-title="{{ $job->title }}">Quote Job</a>
                                                    <a href="{{ route('job-details', $job->id) }}" class="get-quote">More Details</a>

                                                </div>
                                            </div>
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
                        </ul>
                    </div>
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
@endsection