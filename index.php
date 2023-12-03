<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title> Cadastro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Menu</title>
</head>

<body class="color">

    <div class="container text-center pad">
        <form class="tabela col-6" method="POST" action="cadastro.php">
            <caption>
                <h3>Faça seu cadastro</h3>
            </caption>

            <div class="row">
                <label class="text-start" for="txt_nome_usuario">Insira seu nome completo:</label>
            </div>
            <input class="col-12" type="text" name="txt_nome_usuario" placeholder="Nome completo" required><br><br>

            <div class="row">
                <label class="text-start" for="txt_email_usuario">Insira seu endereço de e-mail:</label>
            </div>
            <input class="col-12" type="email" name="txt_email_usuario" placeholder="Endereço de e-mail" required><br><br>

            <div class="row">
                <label class="text-start" for="txt_senha_usuario">Insira sua palavra-passe:</label>
            </div>
            <input class="col-12" type="password" name="txt_senha_usuario" placeholder="Palavra-passe" required><br><br>

            <input class="col-12 btn" type="submit" value="FINALIZAR CADASTRO">
            <hr>

            <p>Já tem conta?</p>
            <a class="link" href="login.php">FAZER LOGIN</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>