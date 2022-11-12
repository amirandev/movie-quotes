<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ isset($pagetitle) ? $pagetitle : __('main.quotesFromMovies') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link href="{{ asset('assets/css/root-ka.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">
</head>
<body>
    <div class="authSection">
        <div class="authBox">
            @yield('content')
        </div>
    </div>
</body>
</html>

