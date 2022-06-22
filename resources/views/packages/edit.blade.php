@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit Package') }}</h1>
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
                <h3 class="card-title">{{ __('Edit Package') }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('packages.update',$package->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Package Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" value="{{ $package->package_name }}" placeholder="Package Name" name="package_name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control textarea" placeholder="Description" name="description" cols="5">{{ $package->description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Package Price</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $package->price }}" class="form-control" placeholder="Package Price" name="package_price">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Package Price Type</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="package_price_type">
                        <option value="">Select</option>
                        <option value="Monthly" {{ ( $package->price_type == "Monthly") ? 'selected' : '' }}>Monthly</option>
                        <option value="Yearly" {{ ( $package->price_type == "Yearly") ? 'selected' : '' }}>Yearly</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Package Limit</label>
                    <div class="col-sm-10">
                      <input type="number" required value="{{ $package->package_limit }}" class="form-control" placeholder="Package Limit" name="package_limit">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" value="1" {{ ( $package->status == 1) ? 'checked' : '' }}>
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