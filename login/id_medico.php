<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function medicoEstaLogado() {
    return isset($_SESSION["medico_logado"]);
}

function medicoLogado() {
    return $_SESSION["medico_logado"] ?? null;
}

function logaMedico($id_medico) {
    $_SESSION["medico_logado"] = $id_medico;
}

function logout() {
    session_destroy();
}
?>
