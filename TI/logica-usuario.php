<?php
session_start();

function usuarioEstaLogado() {
    return isset ($_SESSION["usuario_logado"]);
}

function usuarioLogado() {
    return $_SESSION["usuario_logado"];
}

function logaUsuario($_login) {
    $_SESSION["usuario_logado"] = $_login;
}

function logout() {
    session_destroy();
}
?>