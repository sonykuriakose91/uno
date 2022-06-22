@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Add Customer') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{ __('Add Customer') }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form class="form-horizontal" autocomplete="off" action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ old('name') }}" class="form-control" placeholder="Name" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" value="{{ old('email') }}" required class="form-control" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-2">
                      <select class="form-control" name="country_code" required>
                        <option value="">Select</option>
                        @foreach($countries as $k => $country)
                        <option value="{{ $country->isd_code }}">{{ $country->name }} (+{{ $country->isd_code }})</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-8">
                      <input type="text" value="{{ old('mobile') }}" required class="form-control" placeholder="Mobile" name="mobile">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" placeholder="Address" name="address" cols="5">{{ old('address') }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ old('location') }}" required class="form-control" name="location" placeholder="Location" id="customer-location">
                      <input type="hidden" value="{{ old('loc_latitude') }}" name="loc_latitude" id="loc_latitude" />
                      <input type="hidden" value="{{ old('loc_longitude') }}" name="loc_longitude" id="loc_longitude" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Profile Image</label>
                    <div class="col-sm-10">
                      <input type="file" required name="profile_image">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" value="1" checked="checked">
                        <label class="form-check-label">Active</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  @endsection