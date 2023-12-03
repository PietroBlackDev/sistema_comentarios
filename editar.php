<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar comentario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="color">
    <?php include('conexao.php');

    if (isset($_POST['coment'])) { //isset verifica se a variavel esta definida.

        if (strlen($_POST['coment']) == 0) {  //strlen = quantidade de caracteres
            $coment = $mysqli->real_escape_string($_POST['coment']); //real_escape_string serve pra limpar os caracteres
            $id_coment = $mysqli->real_escape_string($_POST['id_comentario']);

            $delete_coment = "DELETE FROM comentarios WHERE comentarios.id = $id_coment"; //inserindo os dados na tabela
            $deletar_comentario = mysqli_query($mysqli, $delete_coment);

            $mensagem_delete = "Comentario apagado com sucesso!";
        } else {
            $coment = $mysqli->real_escape_string($_POST['coment']); //real_escape_string serve pra limpar os caracteres
            $id_coment = $mysqli->real_escape_string($_POST['id_comentario']);

            $result_usuario = "UPDATE comentarios SET coment = '$coment' WHERE comentarios.id = $id_coment"; //inserindo os dados na tabela
            $resultado_usuario = mysqli_query($mysqli, $result_usuario);

            if ($resultado_usuario) { //quando o if nao tem uma condição ele vai retornar boolean
                $mensagem = 'Comentário editado com sucesso!';
            } else {
                $mensagem = 'Ocorreu um erro, tente novamente!';
            }
        }
    }

    if (isset($_GET['comentario'])) {
        $id_comentario = $_GET['comentario'];
        $query_coment =  "SELECT id, coment, data FROM comentarios WHERE id = $id_comentario";
        $comentario = mysqli_query($mysqli, $query_coment);
    }

    ?>

    <div class="container text-center">
        <h3>Edite seu comentário</h3>
        <?php if (isset($mensagem_delete)) :
            echo $mensagem_delete; ?>
            <div class="d-flex justify-content-center">
                <a class="link_back" href="painel.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                    </svg>Voltar</a>
            </div>
        <?php endif; ?>
        <div class="row text-start col-12">
            <div class="comentarios">
                <?php while ($row = $comentario->fetch_assoc()) { ?>
                    <div class="card">
                        <div class="row">
                            <div class="coment_nome col-6">
                                <?php if (isset($mensagem)) : ?>
                                    <?= $mensagem ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-6 text-end coment_nome">
                                <small"> <?php echo $row["data"] ?> </small>
                            </div>
                        </div>

                        <form class="tabela_coment col-12 text-center" action="" method="POST">
                            <input type="hidden" name="id_comentario" value="<?php echo $row['id'] ?>">
                            <textarea class="col-12" id="w3review" name="coment" rows="3" cols="50"><?php echo $row["coment"] ?></textarea><br><br>
                            <div class="row">
                                <a class="link text-start col-4" href="painel.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                                    </svg>Voltar</a>
                                <input class="col-4 btn_edit text-center" type="submit" value="SALVAR">
                                <small>OBS: Para apagar o comentário basta deixar vazio e salvar!</small>
                            </div>
                        </form>

                    </div>
                <?php } ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</body>

</html>