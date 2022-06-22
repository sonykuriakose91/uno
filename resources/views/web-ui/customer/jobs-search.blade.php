@if(count($jobs) > 0)
<ul>
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
                <?php 
                $jobsimages = new App\Models\JobsImages;
                $images = $jobsimages::where(['job_id' => $job->id])->get();
                ?>
                <div class="job-img">
                    <ul id="" class="owl-carousel owl-theme job-scroll2">
                        @if(count($images) > 0)
                        @foreach($images as $key => $image)
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
</ul>
@else
<p>No jobs.!!</p>
@endif 