@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Review') }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<!-- <a class="btn btn-sm btn-info" href="{{ route('reviews.edit',$data->id) }}">Update</a> -->
            @if($data->status == 0 || $data->status == -1)
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to approve this review?');" href="{{ route('reviews.approve',$data->id) }}">Approve</a>
            @elseif($data->status == 1)
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this review?');" href="{{ route('reviews.reject',$data->id) }}">Reject</a>
            @endif
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ __('Review') }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                  <tr>
                  	<td>ID</td>
                  	<td>{{ $data->id }}</td>
                  </tr>
                  <tr>
                  	<td>Customer</td>
                  	<td>{{ isset($data->getuser->name)?$data->getuser->name:"" }}</td>
                  </tr>
                  <tr>
                  	<td>Provider</td>
                  	<td>{{ isset($data->getprovider->name)?$data->getprovider->name:"" }}</td>
                  </tr>
                  <tr>
                  	<td>Service</td>
                  	<td>{{ isset($data->getservice->service)?$data->getservice->service:"" }}</td>
                  </tr>
                  <tr>
                    <td>Work Completed</td>
                    <td>{{ $data->work_completed }}</td>
                  </tr>
                  <tr>
                    <td>Completed Date</td>
                    <td>{{ $data->service_date }}</td>
                  </tr>
                  <tr>
                    <td>Review</td>
                    <td>{{ $data->review }}</td>
                  </tr>
                  <tr>
                    <td>Reliability</td>
                    <td>{{ $data->reliability*2 }}</td>
                  </tr>
                  <tr>
                    <td>Tidiness</td>
                    <td>{{ $data->tidiness*2 }}</td>
                  </tr>
                  <tr>
                  	<td>Response</td>
                  	<td>{{ $data->response*2 }}</td>
                  </tr>
                  <tr>
                  	<td>Accuracy</td>
                  	<td>{{ $data->accuracy*2 }}</td>
                  </tr>
                  <tr>
                    <td>Pricing</td>
                    <td>{{ $data->pricing*2 }}</td>
                  </tr>
                  <tr>
                    <td>Overall Experience</td>
                    <td>{{ $data->overall_exp*2 }}</td>
                  </tr>
                  <tr>
                    <td>Rating</td>
                    <?php
                      $score = 0;
                      $score = $data->reliability+$data->tidiness+$data->response+$data->accuracy+$data->pricing;
                      ?>
                    <td>{{ number_format(($score*2)/5,2) }}</td>
                  </tr>
                  <tr>
                    <td>Recommend to a User</td>
                    <td>{{ $data->recommend }}</td>
                  </tr>
                  <tr>
                  	<td>Status</td>
                  	<td>{{ ($data->status == 1)?"Approved":(($data->status == -1)?"Rejected":"Pending") }}</td>
                  </tr>
	              </tbody>
                </table>
                <h5>Comments</h5>
                <table class="table table-bordered table-hover">
                  <thead>
                    <th>Sl.No</th>
                    <th>User</th>
                    <th>User Type</th>
                    <th>Comment</th>
                    <th>Status</th>
                  </thead>
                  <tbody>
                    @if($data->traderreviewcommentsall)
                    @foreach ($data->traderreviewcommentsall as $k => $comment)
                    <tr>
                      <td> {{ ++$k }} </td>
                      <td>{{ ($comment->user_type == "provider")?$comment->getprovider->name:$comment->getuser->name }}</td>
                      <td>{{ ucfirst($comment->user_type) }}</td>
                      <td>{{ $comment->comment }}</td>
                      <td>
                        @if($comment->status == 0)
                        <a class="btn btn-xs btn-primary" href="{{ route('trader-review-comment.approve',$comment->id) }}">Approve</a>
                        @elseif($comment->status == 1)
                        <a class="btn btn-xs btn-danger" href="{{ route('trader-review-comment.reject',$comment->id) }}">Reject</a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection