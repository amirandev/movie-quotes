<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($pagetitle) ? $pagetitle : __('main.quotesFromMovies') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/root-'.(isLang('ka') ? 'ka' : 'en').'.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
</head>
<body>
    @include('partials.header')
    <div class="fixedpage overflow-auto">
        <div class="childClass">
            <div class="fixedLangChanger">
                <a href="{{ url()->current().'?lang=en' }}" class="btn btn-gtu mb-2">EN</a>
                <a href="{{ url()->current().'?lang=ka' }}" class="btn btn-gtu-tomato mt-2">KA</a>
                <a href="javascript:void" class="btn btn-gtu-green mt-2" id="openthemenu"><i class="fas fa-bars"></i></a>
            </div>
            @yield('content')
        </div>
        <div class="p-5"><!--space--></div>
    </div>
    @include('partials.footer')
</body>
</html>
