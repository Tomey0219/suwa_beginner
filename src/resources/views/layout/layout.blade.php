<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('ttl')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    
    <header>
        <div class="div_header">
            <h1>Atte</h1>
            @yield('header_btn')
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer>
        <p class="co_name">Atte,inc.</p>
    </footer>
</body>
</html>