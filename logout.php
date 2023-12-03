<?php

if (!isset($_SESSION)) {
    session_start();
}

session_destroy(); //mata a sessao assim deslogando o usuario

header("Location: login.php");
