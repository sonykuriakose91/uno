@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Add Category') }}</h1>
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
                <h3 class="card-title">{{ __('Add Category') }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form class="form-horizontal" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-1 custom-control custom-radio">
                        <input class="custom-control-input main_category" required type="radio" id="customRadio1" name="main_category" value="Seller">
                        <label for="customRadio1" class="custom-control-label">Seller</label>
                    </div>
                    <div class="col-sm-1 custom-control custom-radio">
                        <input class="custom-control-input main_category" required type="radio" id="customRadio2" name="main_category" value="Service">
                        <label for="customRadio2" class="custom-control-label">Service</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Parent Category</label>
                    <div class="col-sm-10">
                      <select class="form-control parent_category" name="parent_category">
                        <option value="">Select</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" placeholder="Category Name" name="category">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" placeholder="Description" name="description" cols="5"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-10">
                      <input type="file" name="category_icon">
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