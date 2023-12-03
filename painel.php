<?php

include('protect.php');
include('conexao.php');


if (isset($_POST['coment'])) { //isset verifica se a variavel esta definida.

  if (strlen($_POST['coment']) == 0) {  //strlen = quantidade de caracteres
    echo "Digite algo para comentar!";
  } else {
    $coment = $mysqli->real_escape_string($_POST['coment']); //real_escape_string serve pra limpar os caracteres

    if (!isset($_SESSION)) {
      session_start();
    }

    $result_usuario = "INSERT INTO comentarios(coment, user_id) VALUES ('" . $coment . "', " . $_SESSION['id'] . ")"; //inserindo os dados na tabela

    $resultado_usuario = mysqli_query($mysqli, $result_usuario);

    if ($resultado_usuario) { //quando o if nao tem uma condição ele vai retornar boolean
      $mensagem = 'Comentário publicado com sucesso!';
    } else {
      $mensagem = 'Ocorreu um erro, tente novamente!';
    }
  }
}

$query_coment = "SELECT comentarios.id, coment, user_id, data, usuarios.nome as name FROM comentarios INNER JOIN usuarios ON usuarios.id = comentarios.user_id order by data desc"; //usando duas tabelas para se conectar

$comentarios = mysqli_query($mysqli, $query_coment);


?>

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
  <header>
    <nav class="navbar fixed-top navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <h3>Bem vindo ao Painel <?php echo $_SESSION['nome']; ?></h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Configurações</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z" />
                  </svg> Perfil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="logout.php"> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                  </svg>
                  Sair</a>
              </li>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="container text-center pad">
    <h3>Comentários de feedback:</h3>

    <div class="row text-start col-12">
      <div class="comentarios">
        <?php while ($row = $comentarios->fetch_assoc()) { ?>
          <div class="card">
            <div class="row">
              <div class="coment_nome col-6"> <?php echo $row["name"] ?></div>
              <div class="col-6 text-end coment_nome">
                <small"> <?php echo $row["data"] ?> </small>
              </div>
            </div>
            <div class="row coment_coment"> <?php echo $row["coment"]; ?> </div>
            <?php if ($_SESSION['id'] == $row['user_id']) : ?>
              <div class="d-flex flex-row-reverse">
                <button class="btn p-2"><small><a class="coment_link" href="editar.php?comentario=<?php echo $row['id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                      </svg> editar</a></small>
                </button>
              </div>
            <?php endif; ?>
          </div>
        <?php } ?>
      </div>
    </div>


    <form class="tabela_coment col-8 position" action="" method="POST">

      <div class="row">
        <label class="text-start" for="coment">Deixe um comentario:</label>
      </div>

      <textarea class="col-12" id="w3review" name="coment" rows="3" cols="50" placeholder="Escreva aqui!" required></textarea><br><br>
      <input class="col-3 btn" type="submit" value="ENVIAR">
    </form>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>