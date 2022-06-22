@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Trader Offer - ') }} {{ $data->title }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<a class="btn btn-sm btn-info" href="{{ route('traderoffers.edit',$data->id) }}">Update</a>
            @if($data->status == 0 || $data->status == -1)
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to enable this offer?');" href="{{ route('traderoffers.approve',$data->id) }}">Enable</a>
            @elseif($data->status == 1)
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to disable this offer?');" href="{{ route('traderoffers.reject',$data->id) }}">Disable</a>
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
                <h3 class="card-title">{{ __('Trader Offer - ') }} {{ $data->title }}</h3>
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
                  	<td>Offer Description</td>
                  	<td>{{ $data->post_content }}</td>
                  </tr>
                  <tr>
                    <td>Full Price</td>
                    <td>{{ $data->full_price }}</td>
                  </tr>
                  <tr>
                    <td>Discount Price</td>
                    <td>{{ $data->discount_price }}</td>
                  </tr>
                  <tr>
                    <td>Valid From</td>
                    <td>{{ $data->valid_from }}</td>
                  </tr>
                  <tr>
                    <td>Valid To</td>
                    <td>{{ $data->valid_to }}</td>
                  </tr>
                  <tr>
                  	<td>Status</td>
                  	<td>{{ ($data->status == 1)?"Active":"Inactive" }}</td>
                  </tr>
	              </tbody>
                </table>
                <h5>Images</h5>
                <table class="table table-bordered table-hover">
                  <tbody>
                    @if($data->traderofferimages)
                      <tr>
                        <div class="row">
                        @foreach($data->traderofferimages as $ke => $images)
                          <div class="col-md-2">
                            <a href="{{ asset('uploads/providers/traderoffers/'.$images->offer_image) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
                                <img src="{{ asset('uploads/providers/traderoffers/'.$images->offer_image) }}" class="img-fluid mb-2" alt="Image"/>
                            </a>
                          </div>
                        @endforeach
                        </div>
                      </tr>
                    @endif
                  </tbody>
                </table>
                @if(count($data->traderoffercommentsall) > 0)
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
                    @if($data->traderoffercommentsall)
                    @foreach ($data->traderoffercommentsall as $k => $comment)
                    <tr>
                      <td> {{ ++$k }} </td>
                      <td>{{ ucfirst(($comment->user_type == "provider")?"trader":"customer") }}</td>
                      <td>{{ ($comment->user_type == "provider")?$comment->getprovider->name:$comment->getuser->name }}</td>
                      <td>{{ $comment->comment }}</td>
                      <td>
                        @if($comment->status == 0)
                        <a class="btn btn-xs btn-primary" href="{{ route('trader-offer-comment.approve',$comment->id) }}">Approve</a>
                        @elseif($comment->status == 1)
                        <a class="btn btn-xs btn-danger" href="{{ route('trader-offer-comment.reject',$comment->id) }}">Reject</a>
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