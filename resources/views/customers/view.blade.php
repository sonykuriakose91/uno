@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Customer - ') }} {{ $data->name }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<a class="btn btn-sm btn-info" href="{{ route('customers.edit',$data->id) }}">Update</a>
            @if($data->status == 0 || $data->status == -1)
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to enable this customer?');" href="{{ route('customers.approve',$data->id) }}">Enable</a>
            @elseif($data->status == 1)
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to disable this customer?');" href="{{ route('customers.reject',$data->id) }}">Disable</a>
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
                <h3 class="card-title">{{ __('Customer - ') }} {{ $data->name }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                  <tr>
                  	<td>ID</td>
                  	<td>{{ $data->id }}</td>
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
                  	<td>Status</td>
                  	<td>{{ ($data->status == 1)?"Approved":(($data->status == -1)?"Rejected":"Pending") }}</td>
                  </tr>
                  <tr>
                    <td>Created On</td>
                    <td>{{ date('d-m-Y h:i A',strtotime($data->created_at)) }}</td>
                  </tr>
                  <tr>
                  	<td>Profile Pic</td>
                  	<td><img style="width: 20%;" src="{{ asset('uploads/customers/profile/'.$data->profile_pic) }}" /></td>
                  </tr>
	              </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection