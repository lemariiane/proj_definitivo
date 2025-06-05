<?php
require_once 'ClassFuncionarioDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id_medico = $_POST['id'];

    $dao = new ClassFuncionarioDAO();
    $resultado = $dao->excluirMedico($id_medico);

    if ($resultado) {
        header("Location: listarfuncionario.php?mensagem=medicoExcluido");
    } else {
        header("Location: listarfuncionario.php?erro=erroAoExcluir");
    }
    exit;
} else {
    header("Location: listarfuncionario.php");
    exit;
}
