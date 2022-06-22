@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit Trader Offer - ') }}{{ $data->id }}</h1>
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
                <h3 class="card-title">{{ __('Edit Trader Offer - ') }}{{ $data->id }}</h3>
              </div>
              <form class="form-horizontal" action="{{ route('traderoffers.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Trader</label>
                    <div class="col-sm-10">
                      <select class="form-control select2"  name="trader_id" data-placeholder="Select Trader" required>
                        <option value="">Select</option>
                        @foreach ($providers as $key => $value)
                        <option value="{{ $value->id }}"  {{ ($value->id == $data->trader_id) ? "selected" : "" }}>{{ $value->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->title }}" class="form-control" placeholder="Title" name="title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea required class="form-control" placeholder="Description" name="description">{{ $data->description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Full Price</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->full_price }}" class="form-control" placeholder="Full Price" name="full_price">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Discount Price</label>
                      <div class="col-sm-10">
                        <input type="text" required value="{{ $data->discount_price }}" class="form-control" placeholder="Discount Price" name="discount_price">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Valid From</label>
                    <div class="col-sm-4 input-group date" data-target-input="nearest">
                      <input type="text" name="valid_from" placeholder="Valid From" required class="form-control datetimepicker-input datetimepicker" value="{{ $data->valid_from }}" data-toggle="datetimepicker"/>
                    </div>
                    <label class="col-sm-2 col-form-label">Valid To</label>
                    <div class="col-sm-4 input-group date" data-target-input="nearest">
                      <input type="text" name="valid_to" placeholder="Valid To" required class="form-control datetimepicker-input datetimepicker" value="{{ $data->valid_to }}" data-toggle="datetimepicker"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Offer Images</label>
                    @if($data->traderofferimages)
                    <div class="col-sm-10"> 
                      <div class="row"> 
                        @foreach($data->traderofferimages as $ke => $image)
                          <div class="col-md-2">
                            <input type="checkbox" name="removeImg[]" value="{{ $image->id }}"> Remove
                                <img src="{{ asset('uploads/providers/traderoffers/'.$image->offer_image) }}" class="img-fluid mb-2" alt="Trader offer image"/>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    @endif
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