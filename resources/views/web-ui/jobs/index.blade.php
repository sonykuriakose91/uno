@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Jobs</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Jobs </p>
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
                            <h5>Trades</h5>
                            <button class="filter-nav"></button>
                        </div>
                    </div>
                    <div class="trader-search">
                        <div class="trader-sec">
                            <div class="box-title">Trades</div>
                        
                        <div class="category-search">
                            <div class="box-content">
                                <div class="raing-sec scroll">
                                    @if(count($categories) > 0)
                                    @foreach($categories as $key => $category)
                                    <label class="check_sec">{{ $category->category }}
                                        <input type="checkbox" class="jobs-category-filter" value="{{ $category->id }}" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        </div>
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
                        <div class="job-search">
                            <div class="category-head">
                                The latest jobs
                                @if(Auth::check() && Auth::guard('web')->user()->user_type == "customer")
                                <a href="{{ route('post-job') }}">Post Job</a>
                                @elseif(Auth::check() && Auth::guard('web')->user()->user_type == "provider")
                                {{ '' }}
                                @else
                                <?php $url = url()->current(); ?>
                                <a onclick="openLoginModal('<?php echo $url; ?>');">Post Job</a>
                                @endif
                            </div>                            
                            <div class="search-field">
                                <form id="jobs-search" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <input id="keyword" type="text" name="keyword" required placeholder="Keyword">
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <select name="category" required class="jobscategory">
                                                <option value="">Select Category</option>
                                                @if(count($categories) > 0)
                                                @foreach($categories as $key => $category)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <select name="subcategory" required class="jobssubcategory">
                                                <option value="">Sub Category</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <input id="distance" type="number" name="distance" required placeholder="Distance">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="search-result jobs-listing">
                        <ul>
                            @if(count($jobs) > 0)
                            @foreach($jobs as $key => $job)
                            @if($job->job_status != "Completed")
                            <li>
                                <div class="result job-box">

                                    <div class="box-job-sec">
                                        <div class="job-area">
                                            <h3>{{ $job->title }}</h3>
                                            <div class="pd-sec">
                                                <div class="price" style="display:block;">${{ $job->budget }}</div>
                                                <div class="date">{{ date('d F Y H:i A',strtotime($job->created_at)) }}</div>
                                            </div>
                                            <div class="cont-sec001" style="height:auto;margin-bottom: 0px;">
                                                <p>{{ $job->description }} </p>
                                            </div>
                        <?php 
                        $blockdetails = 0;
                            if(Auth::guard('web')->check()) {
                                if(Auth::guard('web')->user()->user_type == "provider") {
                                    $block = new App\Models\Block;
                                    $blockdetails = $block::where(['trader_id' => Auth::guard('web')->user()->user_id,'customer_id' => $job->user_id])->count();
                                }
                            }
                        ?>
                        <div class="links-sec">
                            <a href="{{ route('job-details', $job->id) }}" class="get-quote" style="float:left;">More Details</a>
                        @if(Auth::check() && Auth::guard('web')->user()->user_type == "provider" && $blockdetails == 0)
                        <a href="#"  class="get-quote trader-quote-job" data-job-id="{{ $job->id }}" data-job-title="{{ $job->title }}">Quote Job</a>
                        <?php 
                        $jobquote = new App\Models\JobQuotes;
                        $quotedetails = $jobquote::where(['job_id' => $job->id,'trader_id' => Auth::guard('web')->user()->user_id,'customer_id' => $job->user_id])->first();
                        ?>
                        <a href="#" class="get-quote request-more-details" data-id="{{ $job->id }}" data-job-quote-id="{{ ($quotedetails != '')?$quotedetails->id:0 }}" data-toggle="modal" data-target="#requestmoredetails">Request More Details</a>
                        @endif
                                        </div>
                                        </div>
                                        <div class="job-img">
                                            <ul id="" class="owl-carousel owl-theme job-scroll2">
                                                <!-- @if(count($job->jobimages) > 0) -->
                                                    @foreach($job->jobimages as $key => $image)
                                                    <li class="item">
                                                        <img src="{{ asset('uploads/jobs/'.$image->job_image) }}" alt="">
                                                    </li>
                                                    @endforeach
                                                <!-- @endif -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                            @endif                           
                        </ul>
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
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection