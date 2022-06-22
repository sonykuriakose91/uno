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
                                        <input type="checkbox" class="cust-jobs-category-filter" value="{{ $category->id }}" checked="checked">
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
                                {{ $title }}
                                @if(Auth::check() && Auth::guard('web')->user()->user_type == "customer")
                                <a href="{{ route('post-job') }}">Post Job</a></li>
                            @endif
                            </div> 
                            
                            <div class="search-field">
                                <form id="cust-jobs-search" method="POST">
                                    @csrf
                                    <input type="hidden" name="job_status" value="{{ Request::segment(3) }}">
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
                    <div class="search-result cust-jobs-listing">
                        <ul>
                            @if(count($jobs) > 0)
                            @foreach($jobs as $key => $job)
                            <?php
                            $jobQuote = new App\Models\JobQuotes;
                            $quoteCount = $jobQuote::where(['job_id' => $job->id])->count();
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
                                                    <a href="{{ route('job-details', $job->id) }}" class="get-quote">More Details</a>
                                                    @if($job_status == "draft")
                                                        @if($quoteCount == 0)
                                                        <a href="{{ route('edit-customer-job',$job->id) }}" onclick="return confirm('Are you sure you want to edit this job?');">Edit</a>
                                                        @endif
                                                        <a href="{{ route('getjobseekquote',$job->id) }}" onclick="return confirm('Are you sure you want to seek quote for this job?');">Seek Quote</a>
                                                        <a href="{{ route('changejobstatus',[$job->id,'postjob']) }}" onclick="return confirm('Are you sure you want to post this job?');">Post Job</a>
                                                        @if($quoteCount == 0)
                                                        <form action="{{ route('customerdeletejob',$job->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')    
                                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this job?');">Delete</button>
                                                        </form>
                                                        @endif
                                                    @elseif($job_status == "published")
                                                        <a href="{{ route('changejobstatus',[$job->id,'unpublish']) }}" onclick="return confirm('Are you sure you want to unpublish this job?');">Unpublish</a>
                                                        <a href="{{ route('getjobseekquote',$job->id) }}" onclick="return confirm('Are you sure you want to seek quote for this job?');">Seek Quote</a>
                                                        <!-- <a href="#">Quote Received</a> -->
                                                        <a href="{{ route('changejobstatus',[$job->id,'completed']) }}" onclick="return confirm('Are you sure you want to complete this job?');">Completed</a>
                                                    @elseif($job_status == "unpublished")
                                                        @if($quoteCount == 0)
                                                        <a href="{{ route('edit-customer-job',$job->id) }}" onclick="return confirm('Are you sure you want to edit this job?');">Edit</a>
                                                        @endif
                                                        <a href="{{ route('getjobseekquote',$job->id) }}" onclick="return confirm('Are you sure you want to seek quote for this job?');">Seek Quote</a>
                                                        <a href="{{ route('changejobstatus',[$job->id,'postjob']) }}" onclick="return confirm('Are you sure you want to post this job?');">Post Job</a>
                                                    @elseif($job_status == "seekquote")
                                                        @if($quoteCount == 0)
                                                        <a href="{{ route('edit-customer-job',$job->id) }}" onclick="return confirm('Are you sure you want to edit this job?');">Edit</a>
                                                        @endif
                                                        <a href="{{ route('getjobseekquote',$job->id) }}" onclick="return confirm('Are you sure you want to seek quote for this job?');">Seek Quote</a>
                                                        <a href="{{ route('changejobstatus',[$job->id,'postjob']) }}" onclick="return confirm('Are you sure you want to post this job?');">Post Job</a>
                                                        <a href="{{ route('changejobstatus',[$job->id,'unpublish']) }}" onclick="return confirm('Are you sure you want to unpublish this job?');">Unpublish</a>
                                                    @elseif($job_status == "completed")

                                                    @endif
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
@endsection