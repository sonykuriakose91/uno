@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Trader Post - ') }} {{ $data->title }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<a class="btn btn-sm btn-info" href="{{ route('traderposts.edit',$data->id) }}">Update</a>
            @if($data->status == 0 || $data->status == -1)
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to enable this post?');" href="{{ route('traderposts.approve',$data->id) }}">Enable</a>
            @elseif($data->status == 1)
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to disable this post?');" href="{{ route('traderposts.reject',$data->id) }}">Disable</a>
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
                <h3 class="card-title">{{ __('Trader Post - ') }} {{ $data->title }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                  <tr>
                  	<td>ID</td>
                  	<td>{{ $data->id }}</td>
                  </tr>
                  <tr>
                    <td>Trader</td>
                    <td>{{ $data->getprovider->name }}</td>
                  </tr>
                  <tr>
                  	<td>Title</td>
                  	<td>{{ $data->title }}</td>
                  </tr>
                  <tr>
                  	<td>Post Description</td>
                  	<td>{{ $data->post_content }}</td>
                  </tr>
                  <tr>
                  	<td>Status</td>
                  	<td>{{ ($data->status == 1)?"Approved":(($data->status == -1)?"Rejected":"Pending") }}</td>
                  </tr>
                  <tr>
                    <td>Reported by Customers</td>
                    <td>{{ (count($data->traderpostreports) > 0)?"Yes (".count($data->traderpostreports).")":"No" }}</td>
                  </tr>
	              </tbody>
                </table>
                <h5>Images</h5>
                <table class="table table-bordered table-hover">
                  <tbody>
                    @if($data->traderpostimages)
                      <tr>
                        <div class="row">
                        @foreach($data->traderpostimages as $ke => $images)
                          <div class="col-md-2">
                            <a href="{{ asset('uploads/providers/traderposts/'.$images->post_image) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
                                <img src="{{ asset('uploads/providers/traderposts/'.$images->post_image) }}" class="img-fluid mb-2" alt="Image"/>
                            </a>
                          </div>
                        @endforeach
                        </div>
                      </tr>
                    @endif
                  </tbody>
                </table>
                @if(count($data->traderpostcommentsall) > 0)
                <h5>Comments</h5>
                <table class="table table-bordered table-hover">
                  <thead>
                    <th>Sl.No</th>
                    <th>User Type</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>#</th>
                  </thead>
                  <tbody>
                    @if($data->traderpostcommentsall)
                    @foreach ($data->traderpostcommentsall as $k => $comment)
                    <tr>
                      <td> {{ ++$k }} </td>
                      <td>{{ ucfirst(($comment->user_type == "provider")?"trader":"customer") }}</td>
                      <td>{{ ($comment->user_type == "provider")?$comment->getprovider->name:$comment->getuser->name }}</td>
                      <td>{{ $comment->comment }}</td>
                      <td>
                        @if($comment->status == 0)
                        <a class="btn btn-xs btn-primary" href="{{ route('trader-post-comment.approve',$comment->id) }}">Approve</a>
                        @elseif($comment->status == 1)
                        <a class="btn btn-xs btn-danger" href="{{ route('trader-post-comment.reject',$comment->id) }}">Reject</a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
                @endif
                <?php if(count($data->traderpostreports) > 0) { ?>
                <h5>Reported by Customers</h5>
                <table class="table table-bordered table-hover">
                  <thead>
                    <th>Sl.No</th>
                    <th>Customer</th>
                    <th>Description</th>
                  </thead>
                  <tbody>
                    @foreach ($data->traderpostreports as $k => $report)
                    <tr>
                      <td> {{ ++$k }} </td>
                      <td>{{ $report->getcustomer->name }}</td>
                      <td>{{ $report->description }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection