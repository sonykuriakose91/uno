<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('site_settings')->site_title }}</title>
    <link rel="canonical" href="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('ui/images/favicon.ico') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('ui/css/main.css') }}">
    <!-- <link rel="stylesheet" href="css/aos.css"> -->

</head>
<body>
<header>
</header>
<!-- inner area -->
<div class="inner-area">
    <div class="review-section reset-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if(Session::get('danger'))
                    <div class="alert alert-danger">
                        {{ Session::get('danger') }}
                    </div>
                    @endif
                    <div class="main-review">
                        <div class="review-profile">
                            <h5>Reset Password</h5>
                        </div>
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
                        <div class="review-box">
                            <form method="POST" action="{{ route('reset_password') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="retoken" value="{{ $decrypt_token }}">
                                <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Password</label>
                                    <input class="form-control" required type="password" placeholder="Password" name="password" aria-autocomplete="list">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Confirm Password</label>
                                    <input class="form-control" required type="password" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="reset" type="submit">Reset Password</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>