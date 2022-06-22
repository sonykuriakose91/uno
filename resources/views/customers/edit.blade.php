@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit Customer - ') }}{{ $data->name }}</h1>
          </div>
        </div>
      </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{ __('Edit Customer') }}{{ $data->name }}</h3>
              </div>
              <form class="form-horizontal" action="{{ route('customers.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->name }}" class="form-control" placeholder="Name" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" required value="{{ $data->email }}" class="form-control" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-2">
                      <select class="form-control" name="country_code" required>
                        <option value="">Select</option>
                        @foreach($countries as $k => $country)
                        <option value="{{ $country->isd_code }}" {{ ( $country->isd_code == $data->country_code) ? 'selected' : '' }}>{{ $country->name }} (+{{ $country->isd_code }})</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-8">
                      <input type="text" required value="{{ $data->mobile }}" class="form-control" placeholder="Mobile" name="mobile">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" placeholder="Address" name="address" cols="5">{{ $data->address }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" name="location" value="{{ $data->location }}" placeholder="Location" id="customer-location">
                      <input type="hidden" name="loc_latitude" value="{{ $data->loc_latitude }}" id="loc_latitude" />
                      <input type="hidden" name="loc_longitude" value="{{ $data->loc_longitude }}" id="loc_longitude" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Profile Image</label>
                    <div class="col-sm-10">
                      <img style="width: 20%;" src="{{ asset('uploads/customers/profile/'.$data->profile_pic) }}" class="img-fluid mb-2" alt="Profile Pic"/>
                      <div class="clearfix"></div>
                      <input type="file" name="profile_image">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" value="1" {{ ( $data->status == 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection