<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('site_settings')->site_title }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>{{ $message }}</p>
                    <p>It will automatically redirect to the application in 5 seconds. Please <a href="{{ route('ui-home') }}">click here</a> to redirect now.!</p>
                </div>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
         setTimeout(function(){
            window.location.href = "{{ route('ui-home') }}";
         }, 5000);
    </script>
</html>
