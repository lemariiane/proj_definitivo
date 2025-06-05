<?php
session_start();
require_once '../conexao/conexao.php';
require_once '../medico/ClassMedicoDAO.php';
require_once 'id_medico.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_medico'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $dao = new ClassMedicoDAO();
    $medico = $dao->buscarMedicoPorId($id);

    if ($medico && password_verify($senha, $medico->getSenha())) {
        logaMedico($medico->getId_medico());
        header("Location: ../medico/calendario.php");
        exit;
    } else {
        header("Location: login_medico.php?erro=1");
        exit;
    }
}
?>
