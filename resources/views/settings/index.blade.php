@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Site Settings') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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
                <h3 class="card-title">{{ __('Site Settings') }}</h3>
              </div>
              <form class="form-horizontal" action="{{ route('settings.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Site Title</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->site_title }}" class="form-control" placeholder="Site Title" name="site_title">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Site Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control textarea" placeholder="Address" required name="description">{{ $data->description }}</textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->phone_number }}" class="form-control" placeholder="Phone Number" name="phone_number">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Site URL</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->url }}" class="form-control" placeholder="Site URL" name="site_url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->email }}" class="form-control" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Address</label>
                      <div class="col-sm-10">
                        <textarea class="form-control textarea" placeholder="Address" required name="address">{{ $data->address }}</textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Facebook URL</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $data->facebook_url }}" class="form-control" placeholder="Facebook URL" name="facebook_url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Twitter URL</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $data->twitter_url }}" class="form-control" placeholder="Twitter URL" name="twitter_url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Instagram URL</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $data->instagram_url }}" class="form-control" placeholder="Instagram URL" name="instagram_url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Google Plus URL</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $data->google_plus_url }}" class="form-control" placeholder="Google Plus URL" name="google_plus_url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Linkedin URL</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $data->linkedin_url }}" class="form-control" placeholder="Linkedin URL" name="linkedin_url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Google API Key</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->google_map_api }}" class="form-control" placeholder="Google API Key" name="google_map_api">
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