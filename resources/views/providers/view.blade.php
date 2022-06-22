@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Trader - ') }} {{ $data->name }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<a class="btn btn-sm btn-info" href="{{ route('providers.edit',$data->id) }}">Update</a>
            @if($data->status == 0 || $data->status == -1)
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to enable this provider?');" href="{{ route('providers.approve',$data->id) }}">Enable</a>
            @elseif($data->status == 1)
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to disable this provider?');" href="{{ route('providers.reject',$data->id) }}">Disable</a>
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
                <h3 class="card-title">{{ __('Trader - ') }} {{ $data->name }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                  <tr>
                  	<td>ID</td>
                  	<td>{{ $data->id }}</td>
                  </tr>
                  <tr>
                    <td>Username</td>
                    <td>{{ $data->username }}</td>
                  </tr>
                  <tr>
                    <td>QR Code</td>
                    <td><img src="{{ asset('uploads/providers/qrcode/'.$data->qrcode) }}"></td>
                  </tr>
                  <tr>
                  	<td>Type</td>
                  	<td>{{ $data->type }}</td>
                  </tr>
                  <tr>
                  	<td>Name</td>
                  	<td>{{ $data->name }}</td>
                  </tr>
                  <tr>
                  	<td>Email</td>
                  	<td>{{ $data->email }}</td>
                  </tr>
                  <tr>
                  	<td>Mobile</td>
                  	<td>{{ '+'.$data->country_code .' '. $data->mobile }}</td>
                  </tr>
                  <tr>
                  	<td>Address</td>
                  	<td>{{ $data->address }}</td>
                  </tr>
                  <tr>
                    <td>Location</td>
                    <td>{{ $data->location }}</td>
                  </tr>
                  <tr>
                    <td>Latitude</td>
                    <td>{{ $data->loc_latitude }}</td>
                  </tr>
                  <tr>
                    <td>Longitude</td>
                    <td>{{ $data->loc_longitude }}</td>
                  </tr>
                  <tr>
                    <td>Landmark</td>
                    <td>{{ $data->landmark }}</td>
                  </tr>
                  <tr>
                    <td>Landmark Latitude</td>
                    <td>{{ $data->land_latitude }}</td>
                  </tr>
                  <tr>
                    <td>Landmark Longitude</td>
                    <td>{{ $data->land_longitude }}</td>
                  </tr>
                  <tr>
                    <td>Landmark Description</td>
                    <td>{{ $data->landmark_data }}</td>
                  </tr>
                  <tr>
                    <td>Service Location Radius (Kms)</td>
                    <td>{{ $data->service_location_radius }}</td>
                  </tr>
                  <tr>
                  	<td>Available Time</td>
                  	<td>{{ date('h:i A',$data->available_time_from) .' - '. date('h:i A',$data->available_time_to) }}</td>
                  </tr>
                  <tr>
                  	<td>Available</td>
                  	<td>{{ ($data->is_available == 1)?'Yes':'No' }}</td>
                  </tr>
                  <tr>
                  	<td>Status</td>
                  	<td>{{ ($data->status == 1)?"Approved":(($data->status == -1)?"Rejected":"Pending") }}</td>
                  </tr>
                  <tr>
                  	<td>Featured</td>
                  	<td>{{ ($data->featured == 1)?"Yes":"No" }}</td>
                  </tr>
                  <tr>
                  	<td>Rating</td>
                  	<td>{{ $data->rating }}</td>
                  </tr>
                  <tr>
                  	<td>Profile Pic</td>
                  	<td><img style="width: 20%;" src="{{ asset('uploads/providers/profile/'.$data->profile_pic) }}" /></td>
                  </tr>
                  <tr>
                    <td>Reference</td>
                    <td>{{ ($data->reference == 1)?"Verified":"Not Verified" }}</td>
                  </tr>
                  <tr>
                    <td>Created On</td>
                    <td>{{ date('d-m-Y h:i A',strtotime($data->created_at)) }}</td>
                  </tr>
	              </tbody>
                </table>
                <h5>Provider Categories</h5>
                <table class="table table-bordered table-hover">
                  <thead>
                    <th>Sl.No</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Status</th>
                    <th>#</th>
                  </thead>
                  <tbody>
                    @if($data->providercategories)
                    @foreach ($data->providercategories as $k => $category)
                    <tr>
                      <td> {{ ++$k }} </td>
                      <td>{{ isset($category->getcategory->category)?$category->getcategory->category:"" }}</td>
                      <td>{{ isset($category->getsubcategory->category)?$category->getsubcategory->category:"" }}</td>
                      <td>{{ ($category->status == 1) ? "Approved" : (($category->status == -1)?"Rejected":"Pending") }}</td>
                      <td>
                            @if($category->status == 0 || $category->status == -1)
                            <a class="btn btn-xs btn-primary" onclick="return confirm('Are you sure you want to approve this category?');" href="{{ route('providers.approvecategory',$category->id) }}">Approve</a>
                            @elseif($category->status == 1)
                            <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to reject this category?');" href="{{ route('providers.rejectcategory',$category->id) }}">Reject</a>
                            @endif
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
                <h5>Documents</h5>
                <table class="table table-bordered table-hover">
                	<thead>
                		<th>Sl.No</th>
                		<th>Proof Type</th>
                		<th>ID Type</th>
                		<th>ID Number</th>
                		<th>Document</th>
                		<th>Verified</th>
                		<th>Status</th>
                		<th>Verify</th>
                	</thead>
                	<tbody>
                		@if($data->providerdocuments)
                		@foreach ($data->providerdocuments as $k => $document)
                		<tr>
                			<td> {{ ++$k }} </td>
                			<td>{{ $document->proof_type }}</td>
                			<td>{{ $document->id_type }}</td>
                			<td>{{ $document->id_number }}</td>
                			<td>
                        <a href="{{ asset('uploads/providers/documents/'.$document->document) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">{{ $document->document }}
                        </a>
                      </td>
                			<td>{{ ($document->verified == 1) ? "Yes" : "No" }}</td>
                			<td>{{ ($document->status == 1) ? "Approved" : (($document->status == -1)?"Rejected":"Pending") }}</td>
                			<td>
                            @if($document->status == 0 || $document->status == -1)
	                          <a class="btn btn-xs btn-primary" onclick="return confirm('Are you sure you want to approve this document?');" href="{{ route('providers.approvedocument',$document->id) }}">Approve</a>
                            @elseif($document->status == 1)
	                          <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to reject this document?');" href="{{ route('providers.rejectdocument',$document->id) }}">Reject</a>
                            @endif
                			</td>
                		</tr>
                		@endforeach
                		@endif
                	</tbody>
                </table>
                <h5>Services</h5>
                <table class="table table-bordered table-hover">
                	<thead>
                		<th>Sl.No</th>
                		<th>Service</th>
                		<th>Status</th>
                		<th>#</th>
                	</thead>
                	<tbody>
                		@if($data->providerservices)
                		@foreach ($data->providerservices as $k => $service)
                		<tr>
                			<td> {{ ++$k }} </td>
                			<td>{{ $service->getservice->service }}</td>
                			<td>{{ ($service->status == 1) ? "Approved" : (($service->status == -1)?"Rejected":"Pending") }}</td>
                			<td>
                            @if($service->status == 0 || $service->status == -1)
	                          <a class="btn btn-xs btn-primary" onclick="return confirm('Are you sure you want to approve this service?');" href="{{ route('providers.approveservice',$service->id) }}">Approve</a>
                            @elseif($service->status == 1)
	                          <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to reject this service?');" href="{{ route('providers.rejectservice',$service->id) }}">Reject</a>
                            @endif
                			</td>
                		</tr>
                		@endforeach
                		@endif
                	</tbody>
                </table>
                <h5>Completed Works</h5>
                <table class="table table-bordered table-hover">
                	<tbody>
                		<tr>{{ strip_tags($data->completed_works) }}</tr><br/><br/>
                		@if($data->providerworks)
                			<tr>
                				<div class="row">
                				@foreach($data->providerworks as $ke => $work)
	                				<div class="col-md-2">
	                					<a href="{{ asset('uploads/providers/works/'.$work->image) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
				                      	<img src="{{ asset('uploads/providers/works/'.$work->image) }}" class="img-fluid mb-2" alt="Completed Work"/>
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