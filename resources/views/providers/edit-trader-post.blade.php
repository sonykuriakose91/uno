@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit Trader Post - ') }}{{ $data->id }}</h1>
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
                <h3 class="card-title">{{ __('Edit Trader Post - ') }}{{ $data->id }}</h3>
              </div>
              <form class="form-horizontal" action="{{ route('traderposts.update',$data->id) }}" method="POST" enctype="multipart/form-data">
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
                      <input type="text" required value="{{ $data->title }}" class="form-control" placeholder="Title" name="post_title">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Post Content</label>
                      <div class="col-sm-10">
                        <textarea class="form-control textarea" required placeholder="Post Content" name="post_content">{{ ($data->post_content) }}</textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Post Images</label>
                    @if($data->traderpostimages)
                    <div class="col-sm-10"> 
                      <div class="row"> 
                        @foreach($data->traderpostimages as $ke => $image)
                          <div class="col-md-2">
                            <input type="checkbox" name="removeImg[]" value="{{ $image->id }}"> Remove
                                <img src="{{ asset('uploads/providers/traderposts/'.$image->post_image) }}" class="img-fluid mb-2" alt="Trader post image"/>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    @endif
                </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Images</label>
                      <div class="col-sm-10">
                        <input type="file" name="post_images[]" multiple>
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