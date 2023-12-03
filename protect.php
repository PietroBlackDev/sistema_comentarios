<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) { //se nao houver nenhuma sessao de ID, ele mata o script
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"index.php\">Entrar</a></p>");
}
