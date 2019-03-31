<!DOCTYPE html>
<html>
    <head>
        <meta charset="uft-8" />
        <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
        <title>Login</title>
    </head>
    <body>
        <h1>Investindo</h1>
        <h3>O investindo teste</h3>

        <section id="conteudo-view" class="login">
            <form method="POST" action="/login">
                @csrf

                <p>Acesse:</p>

                <label>
                    <input name="username" type="text" placeholder="usu" class="input" />
                </label>
                <label>
                    <input name="passw" type="password" placeholder="senha" class="input" />
                </label>

                <button type="submit">Entrar</button>
            </form>
        </section>
    </body>
</html>