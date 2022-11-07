<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($pagetitle) ? $pagetitle : 'ციტატები ფილმებიდან' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/root-ka.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <style>
        .fixedpage{
            background: #fff;
            position: fixed;
            left:0;
            top:0;
            right:0;
            bottom: 0;
        }

        @media (min-width: 1380px) {
            .fixedpage{
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            }
        }

        .quoteimageMain{
            max-width: 500px;
            margin: auto;
        }

        .quotetextContainer{
            max-width: 600px;
            margin: auto;
        }

        .fixedLangChanger{
            position: fixed;
            left: 20px;
            top: calc(50% - 80px);
        }

        .fixedLangChanger a{
            --samesize: 50px;
            min-width: var(--samesize);
            max-width: var(--samesize);
            min-height: var(--samesize);
            max-height: var(--samesize);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .quoteBox{
            font-size: 17px;
        }

        .leftDoubleComma{
            padding: 0px 5px 0px 8px;
            margin-left: -10px;
            display: inline-block;
            margin-left: -25px;
            margin-top: -4px;
            margin-bottom: 13px;
            position: absolute;
            border-radius: 0px 0px 0px 15px;
        }

        .rightDoubleComma{
            padding: 0px 8px 0px 5px;
            margin-left: -10px;
            display: inline-block;
            margin-right: -25px;
            margin-left: auto;
            margin-top: -2px;
            margin-bottom: 10px;
            position: absolute;
            border-radius: 0px 0px 14px 0px;
        }

        .textindentQuote{
            text-indent: 15px;
            text-align: justify;
        }

        h1 a{
            text-decoration: none;
            color: #333;
        }

        h1 a:hover{
            color: #333;
            text-decoration: underline;
        }

        /* directors grid */
        .widerContainer{
            max-width: 900px;
            margin: auto;
        }

        .directors {
            display: grid;
            grid-gap: 20px;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }

        .directors2 {
            display: grid;
            grid-gap: 20px;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }

        .directors>*, .directors2>* {
            min-height: 200px;
        }

        .directors a, .directors2 a{
            font-family: var(--headingFont), sans-serif;
            text-transform: Uppercase;
            font-size: 18px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    @include('partials.header')
    <div class="fixedpage overflow-auto">
        <div class="childClass">
            <div class="fixedLangChanger">
                <a href="#" class="btn btn-gtu mb-2">EN</a>
                <a href="#" class="btn btn-gtu-green mt-2">KA</a>
            </div>
            @yield('content')
        </div>
        <div class="p-5"><!--space--></div>
    </div>
    @include('partials.footer')
</body>
</html>
