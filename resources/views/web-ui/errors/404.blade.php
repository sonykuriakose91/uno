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


<div class="inner-area over-flow">
    <div class="container">
        <div class="pricing-sec">
            <div class="row text-center" style="min-height: 60%;">
                <h1>404</h1>
                <p>The page you are looking for is unavailable at the moment. Please try again later.!!</p>
                <button style="padding: 10px 23px;border: none;background: #55AA47;font-size: 13px;text-align: center;
                                font-weight: 400;color: #FFF;border-radius: 70px;-webkit-transition: 0.3s all ease-in-out;
                                transition: 0.3s all ease-in-out;text-decoration: none;"
                type="button" onclick="history.back();">Go Back</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>