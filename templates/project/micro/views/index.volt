<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>{{ title() }}</title>
        <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('/css/dashboard.css') }}">
    </head>
    <body>
        <div class="container">

            <div class="page-header">
                <h1>Congratulations!</h1>
            </div>

            <p>You're now flying with Phalcon. Great things are about to happen!</p>

            <p>This page is located at <code>views/index.volt</code></p>
        </div>

        <!-- jQuery first, then Popper.js, and then Bootstrap's JavaScript -->
        <script src="{{ url('/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('/js/dashboard.js') }}"></script>
        <script src="{{ url('/js/jquery.min.js') }}"></script>
        <script src="{{ url('/js/utils.js') }}"></script>
    </body>
</html>
