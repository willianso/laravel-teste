<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    @yield('css-view')
</head>
<body>
    @include('templates.menu-lateral')
    @yield('conteudo-view')
    @yield('js-view')
</body>
</html>