@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit Category') }}</h1>
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
              <form class="form-horizontal" action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-1 custom-control custom-radio">
                        <input class="custom-control-input main_category" required type="radio" id="customRadio1" name="main_category" value="Seller" {{ ($category->main_category == "Seller")?"checked":"" }}>
                        <label for="customRadio1" class="custom-control-label">Seller</label>
                    </div>
                    <div class="col-sm-1 custom-control custom-radio">
                        <input class="custom-control-input main_category" required type="radio" id="customRadio2" name="main_category" value="Service" {{ ($category->main_category == "Service")?"checked":"" }}>
                        <label for="customRadio2" class="custom-control-label">Service</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Parent Category</label>
                    <div class="col-sm-10">
                      <select class="form-control parent_category" name="parent_category">
                        <option value="">Select</option>
                        @foreach ($data as $key => $value)
                        <option value="{{ $value->id }}" {{ ( $value->id == $category->parent_category) ? 'selected' : '' }}>{{ $value->category }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" value="{{ $category->category }}" placeholder="Category Name" name="category">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" placeholder="Description" name="description" cols="5">{{ $category->description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-10">
                      <img style="width: 20%;" src="{{ asset('uploads/categories/icons/'.$category->icon) }}" class="img-fluid mb-2" alt="Icon"/>
                      <div class="clearfix"></div>
                      <input type="file" name="category_icon">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" value="1" {{ ( $category->status == 1) ? 'checked' : '' }}>
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