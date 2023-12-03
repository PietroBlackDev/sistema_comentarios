<?php
    include_once("conexao.php");
    $nome_usuario = $_POST['txt_nome_usuario'];
    $email_usuario = $_POST['txt_email_usuario'];
    $senha_usuario = $_POST['txt_senha_usuario'];

    if ($nome_usuario == "") {
        header("Location: index.php");
        exit;
    }elseif ($email_usuario == "") {
        header("Location: index.php");
        exit;
    }elseif ($senha_usuario == "") {
        header("Location: index.php");
        exit;
    } 

    $pass_hash = password_hash($senha_usuario, PASSWORD_DEFAULT);

    $result_usuario = "INSERT INTO usuarios(nome, email, senha) VALUES ('$nome_usuario','$email_usuario', '$pass_hash')";
    $resultado_usuario = mysqli_query($mysqli, $result_usuario);

    if(mysqli_affected_rows($mysqli) != 0){ //mysqli_affected_rows esta verificando se alguma row foi alterada ou afetada dentro do banco de dados
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/menu_aulas/praticas/Formulario/login.php'>";    
    }else{
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/menu_aulas/praticas/Formulario/index.php'>";    
    }
    
    
?>