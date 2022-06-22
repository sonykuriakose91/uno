@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit Product - ') }}{{ $data->product }}</h1>
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
                <h3 class="card-title">{{ __('Edit Product - ') }}{{ $data->product }}</h3>
              </div>
              <form class="form-horizontal" action="{{ route('bazaar-products.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 bazaar_parent_category" name="category_id" required data-placeholder="Select Category">
                        <option value="">Select</option>
                        @foreach ($categories as $key => $value)
                        <option value="{{ $value->id }}"  {{ ($value->id == $data->category_id) ? "selected" : "" }}>{{ $value->category }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sub Category</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 bazaar-sub-category" name="sub_category_id" data-placeholder="Select Sub Category">
                        @if($data->sub_category_id != 0)
                        <option value="{{ $data->sub_category_id }}" selected>{{ $data->subcategory->category }}</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Product</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->product }}" class="form-control" placeholder="Product" name="product">
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control textarea" required placeholder="Description" name="description"> {{ ($data->description) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Product Images</label>
                    @if($data->bazaarimages)
                    <div class="col-sm-10"> 
                      <div class="row"> 
                        @foreach($data->bazaarimages as $ke => $image)
                          <div class="col-md-2">
                            <input type="checkbox" name="removeImg[]" value="{{ $image->id }}"> Remove
                                <img src="{{ asset('uploads/bazaar/products/'.$image->product_image) }}" class="img-fluid mb-2" alt="Product"/>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Images</label>
                    <div class="col-sm-10">
                      <input type="file" name="product_images[]" multiple>
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