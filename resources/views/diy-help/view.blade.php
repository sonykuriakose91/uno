@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('DIY Help - ') }} {{ $data->id }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<!-- <a class="btn btn-sm btn-info" href="{{ route('faq.edit',$data->id) }}">Update</a> -->
            @if($data->status == 0)
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to approve this DIY?');" href="{{ route('diy-help.approve',$data->id) }}">Approve</a>
            @elseif($data->status == 1)
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this DIY?');" href="{{ route('diy-help.reject',$data->id) }}">Reject</a>
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
                <h3 class="card-title">{{ __('DIY Help - ') }} {{ $data->id }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                  <tr>
                  	<td>ID</td>
                  	<td>{{ $data->id }}</td>
                  </tr>
                  <tr>
                  	<td>User Type</td>
                  	<td>{{ ucfirst($data->user_type) }}</td>
                  </tr>
                  <tr>
                  	<td>User</td>
                  	<td>{{ ($data->user_type == "trader")?$data->getprovider->name:$data->getuser->name }}</td>
                  </tr>
                  <tr>
                    <td>Title</td>
                    <td>{{ $data->title }}</td>
                  </tr>
                  <tr>
                    <td>Comment</td>
                    <td>{{ $data->comment }}</td>
                  </tr>
                  <tr>
                  	<td>Status</td>
                  	<td>{{ ($data->status == 0)?"Inactive":"Active" }}</td>
                  </tr>
	              </tbody>
                </table>
                @if(count($data->diyhelpimages) > 0)
                <h5>Diy Help Images</h5>
                <table class="table table-bordered table-hover">
                  <tbody>
                    @if($data->diyhelpimages)
                      <tr>
                        <div class="row">
                        @foreach($data->diyhelpimages as $ke => $image)
                          <div class="col-md-2">
                            <a href="{{ asset('uploads/diy-help/'.$image->diy_help_image) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
                                <img src="{{ asset('uploads/diy-help/'.$image->diy_help_image) }}" class="img-fluid mb-2" alt="Help"/>
                            </a>
                          </div>
                        @endforeach
                        </div>
                      </tr>
                    @endif
                  </tbody>
                </table>
                @endif
                @if(count($data->diyhelpcommentsall) > 0)
                <h5>Quotes</h5>
                <table class="table table-bordered table-hover">
                  <thead>
                    <th>Sl.No</th>
                    <th>User Type</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>#</th>
                  </thead>
                  <tbody>
                    @if($data->diyhelpcommentsall)
                    @foreach ($data->diyhelpcommentsall as $k => $comment)
                    <tr>
                      <td> {{ ++$k }} </td>
                      <td>{{ ucfirst($comment->user_type) }}</td>
                      <td>{{ ($comment->user_type == "trader")?$comment->getprovider->name:$comment->getuser->name }}</td>
                      <td>{{ $comment->comment }}</td>
                      <td>
                        @if($comment->status == 0)
                        <a class="btn btn-xs btn-primary" href="{{ route('diy-help-comment.approve',$comment->id) }}">Approve</a>
                        @elseif($comment->status == 1)
                        <a class="btn btn-xs btn-danger" href="{{ route('diy-help-comment.reject',$comment->id) }}">Reject</a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection