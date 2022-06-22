@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Change Pawword</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Change Password </p>
            </div>
        </div>
    </div>
</div>

<!-- inner area -->
<div class="inner-area">
    <div class="container">
        @if(isset($message))
        <div class="alert alert-{{ $message['status'] }}">
            {{ $message['message'] }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard-sec">
                    <form method="POST" action="{{ route('update-password') }}">
                            @csrf
                            <div class="row">
                            <div class="col-lg-12 account-info m20">
                                <!-- <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Current Password:</label>
                                    <div class="col-md-9">
                                      <input class="form-control" required type="password" placeholder="Current Password" name="currentpassword" aria-autocomplete="list">
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Password:</label>
                                    <div class="col-md-9">
                                      <input class="form-control" required type="password" placeholder="Password" name="password" aria-autocomplete="list">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Confirm Password:</label>
                                    <div class="col-md-9">
                                      <input class="form-control" required type="password" placeholder="Confirm Password" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 update">
                                        <button type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection