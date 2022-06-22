@if(count($jobs) > 0)
<ul>
@foreach($jobs as $key => $job)
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
                            $jobimages = new App\Models\JobsImages;
                            $images = $jobimages::where(['job_id' => $job->id])->get();
                        ?>
                @if(Auth::check() && Auth::guard('web')->user()->user_type == "provider" && $blockdetails == 0)
                <a href="#" style="float:left;" class="get-quote trader-quote-job" data-job-id="{{ $job->id }}" data-job-title="{{ $job->title }}">Quote Job</a>
                @endif
                <a href="{{ route('job-details', $job->id) }}" style="float:left;" class="get-quote">More Details</a>
            </div>
            <div class="job-img">
                <ul id="" class="owl-carousel owl-theme job-scroll2" style="display:block;">
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
<p>No jobs found.!!</p>
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