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
                <img src="storage/image/j-logo.png"  style="width: 100px;">
                </a>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid d-flex align-items-end" style="background:url(storage/image/header-2.png); background-size: auto; background-position: center 60%; height: 40vh;" >
            <div class="container text-center">
                <a class="btn btn-club-green btn-lg  m-2" href="{{ route('login') }}" role="button">ログイン</a>
                <a class="btn btn-club-blue btn-lg  m-2" href="{{ route('register') }}" role="button">新規登録</a>
            </div>
        </div>
        <div class="container marketing">
            <div class="text-center">
                <h5>E-mail：test@example</br>Password：test0618</h5>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4 text-center">
                    <img src="storage/image/card-1.png" class="rounded-circle" width="140" height="140">
                    <h2>今日の出来事を英語で投稿しましょう</h2>
                    <p>
                        楽しかったこと、嬉しかったこと、悲しかったこと、勉強したことなど貴重な体験を
                        英語で残しましょう。英語で綴る習慣をつけることで、1日を振り返れるだけでなく、
                        英語力も同時に身につけることができます。
                    </p>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="storage/image/card-2.png" class="rounded-circle" width="140" height="140">
                    <h2>投稿は自分だけが見ることができます</h2>
                    <p>
                        あなたが投稿した内容は、他のユーザーには公開されません。検索もされません。
                        完全プライペート空間で日記を楽しむことができます。
                    </p>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="storage/image/card-3.png" class="rounded-circle" width="140" height="140">
                    <h2>分からなかった単語や文法はメモしておきましょう</h2>
                    <p>
                        Journalyにはメモ機能があります。この機能を活用することで、あなたの英語力の可能性は
                        さらに広がります。分からなかった単語や文法はこのメモ機能を使って、記録に残しておきましょう。
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>