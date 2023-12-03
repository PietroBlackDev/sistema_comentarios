<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body class="color">

    <?php
    include('conexao.php');

    if (isset($_POST['email']) || isset($_POST['senha'])) { //isset verifica se a variavel esta definida.

        if (strlen($_POST['email']) == 0) {  //strlen = quantidade de caracteres
            echo "Preencha seu e-mail";
        } else if (strlen($_POST['senha']) == 0) {
            echo "Preencha sua senha";
        } else {

            $email = $mysqli->real_escape_string($_POST['email']); //real_escape_string serve pra limpar os caracteres
            $senha = $mysqli->real_escape_string($_POST['senha']);

            $pass_verify = password_verify("SELECT senha FROM usuarios", $senha); //estou verificando se a senha criptografada dentro do banco de dados é igual a senha que o usuario inseriu

            $sql_code = "SELECT * FROM usuarios WHERE email = '$email'"; //sql_code serve para inserir codigos sql dentro do seu sistema
            $pass_verify;
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error); //sql_query envia uma consulta no banco de dados

            $quantidade = $sql_query->num_rows;

            if ($quantidade == 1) {

                $usuario = $sql_query->fetch_assoc(); //fetch_assoc() vai pegar os dados do usuario e jogar dentro da variavel $usuario

                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome']; //session é pra deixar logado durante um certo tempo, contrario do get e post

                header("Location: painel.php"); //header é para redirecionar o usuario

            } else {
                $message = " Falha ao logar! E-mail ou senha incorretos";
            }
        }
    }
    ?>
    <div class="container text-center pad">
        <form class="tabela col-6" action="" method="POST">
            <caption>
                <h3>Acesse sua conta</h3>
            </caption>
            <?php if (isset($message)) : ?>
                <p><small><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                        </svg><?= $message ?></small></p>
            <?php endif; ?>
            <div class="row">
                <label class="text-start" for="email">Insira seu e-mail:</label>
            </div>
            <input class="col-12" type="email" name="email" placeholder="E-mail" required><br><br>

            <div class="row">
                <label class="text-start" for="senha">Insira sua palavra-passe:</label>
            </div>
            <input class="col-12" type="password" name="senha" placeholder="Palavra-passe" required><br><br>

            <input class="col-12 btn" type="submit" value="ENTRAR">
            <hr>

            <p>Não tem uma conta?</p>
            <a class="link" href="index.php">CRIAR CONTA</a>
        </form>
    </div>
</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>