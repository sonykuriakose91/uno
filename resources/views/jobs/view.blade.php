@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Job - ') }} {{ $data->id }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<!-- <a class="btn btn-sm btn-info" href="{{ route('faq.edit',$data->id) }}">Update</a> -->
            @if($data->status == "Pending")
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to approve this Job?');" href="{{ route('jobs.approve',$data->id) }}">Approve</a>
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this Job?');" href="{{ route('jobs.reject',$data->id) }}">Reject</a>
            @elseif($data->status == "Approved")
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this Job?');" href="{{ route('jobs.reject',$data->id) }}">Reject</a>
            @elseif($data->status == "Rejected")
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to approve this Job?');" href="{{ route('jobs.approve',$data->id) }}">Approve</a>
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
                <h3 class="card-title">{{ __('Job - ') }} {{ $data->id }}</h3>
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
                  	<td>{{ ($data->user_type == "provider")?$data->getprovider->name:$data->getcustomer->name }}</td>
                  </tr>
                  <tr>
                    <td>Category</td>
                    <td>{{ isset($data->getcategory->category)?$data->getcategory->category:"---" }}</td>
                  </tr>
                  <tr>
                    <td>Sub Category</td>
                    <td>{{ isset($data->getsubcategory->category)?$data->getsubcategory->category:"---" }}</td>
                  </tr>
                  <tr>
                    <td>Title</td>
                    <td>{{ $data->title }}</td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td>{{ $data->description }}</td>
                  </tr>
                  <tr>
                    <td>Budget</td>
                    <td>{{ $data->budget }}</td>
                  </tr>
                  <tr>
                    <td>Time for Completion</td>
                    <td>{{ $data->job_completion }}</td>
                  </tr>
                  <tr>
                  	<td>Status</td>
                  	<td>{{ $data->job_status }}</td>
                  </tr>
                  <tr>
                    <td>Materials Purchased</td>
                    <td>{{ ($data->material_purchased == 1)?"Yes":"No" }}</td>
                  </tr>
                  @if(count($data->jobquotes) > 0)
                  <tr>
                    <td>Quotes</td>
                    <td>Yes</td>
                  </tr>
                  @endif
	              </tbody>
                </table>
                @if(count($data->jobquotes) > 0)
                <h5>Quotes</h5>
                <table class="table table-bordered table-hover">
                  <thead>
                    <th>Sl.No</th>
                    <th>Trader</th>
                    <th>Quoted Price</th>
                    <th>Quote Reason</th>
                  </thead>
                  <tbody>
                    @if($data->jobquotes)
                    @foreach ($data->jobquotes as $k => $quote)
                    <tr>
                      <td> {{ ++$k }} </td>
                      <td>{{ $quote->gettrader->name }}</td>
                      <td>{{ $quote->quoted_price }}</td>
                      <td>{{ $quote->quote_reason }}</td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
                @endif
                <h5>Images</h5>
                <table class="table table-bordered table-hover">
                  <tbody>
                    @if($data->jobimages)
                      <tr>
                        <div class="row">
                        @foreach($data->jobimages as $ke => $image)
                          <div class="col-md-2">
                            <a href="{{ asset('uploads/jobs/'.$image->job_image) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
                                <img src="{{ asset('uploads/jobs/'.$image->job_image) }}" class="img-fluid mb-2" alt="Job Image"/>
                            </a>
                          </div>
                        @endforeach
                        </div>
                      </tr>
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