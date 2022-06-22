@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Add Trader Offer') }}</h1>
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
                <h3 class="card-title">{{ __('Add Trader Offer') }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form class="form-horizontal" autocomplete="off" action="{{ route('traderoffers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Trader</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" required name="trader_id" data-placeholder="Select Trader">
                        <option value="">Select</option>
                        @foreach ($data as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" placeholder="Title" name="title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea required class="form-control" placeholder="Description" name="description"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Full Price</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" placeholder="Full Price" name="full_price">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Discount Price</label>
                      <div class="col-sm-10">
                        <input type="text" required class="form-control" placeholder="Discount Price" name="discount_price">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Valid From</label>
                    <div class="col-sm-4 input-group date" data-target-input="nearest">
                      <input type="text" name="valid_from" placeholder="Valid From" required class="form-control datetimepicker-input datetimepicker" data-toggle="datetimepicker"/>
                    </div>
                    <label class="col-sm-2 col-form-label">Valid To</label>
                    <div class="col-sm-4 input-group date" data-target-input="nearest">
                      <input type="text" name="valid_to" placeholder="Valid To" required class="form-control datetimepicker-input datetimepicker" data-toggle="datetimepicker"/>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Images</label>
                      <div class="col-sm-10">
                        <input type="file" name="offer_images[]" multiple>
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