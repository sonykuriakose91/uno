@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Change Password</h1>
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
                <h3 class="card-title">Change Password</h3>
              </div>
              <form class="form-horizontal" action="{{ route('updatepassword') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Current Password</label>
                    <div class="col-sm-10">
                      <input type="password" required class="form-control" placeholder="Current Password" name="current_password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" required class="form-control" placeholder="New Password" name="password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" required class="form-control" placeholder="Confirm Password" name="password_confirmation">
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