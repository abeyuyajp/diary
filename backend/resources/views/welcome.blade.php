<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
        <!-- Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- カスタマイズ -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body class="bg-cream">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-cream shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/storage/image/j-logo.png"  style="width: 100px;">
                </a>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid d-flex align-items-end" style="background:url(storage/image/header-2.png); background-size: auto; background-position: center 60%; height: 40vh;" >
            <div class="container text-center">
                <a class="btn btn-club-green btn-lg  m-2" href="{{ route('login') }}" role="button">ログイン</a>
                <a class="btn btn-club-blue btn-lg  m-2" href="{{ route('register') }}" role="button">新規登録</a>
            </div>
        </div>
        <div class="container">
            <div class="text-center">
                <h4>英語日記アプリ</h4>
                <h5>E-mail：test@example</br>Password：test0618</h5>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="card m-2" style="width: 18rem;">
                        <img src="storage/image/blog-1.png" class="card-img-top" width="100%">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card m-2" style="width: 18rem;">
                        <img src="storage/image/blog-1.png" class="card-img-top" width="100%">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card m-2" style="width: 18rem;">
                        <img src="storage/image/blog-1.png" class="card-img-top" width="100%">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>