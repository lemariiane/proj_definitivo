<?php
header('Content-Type: application/json');

$dados = json_decode(file_get_contents('php://input'), true);

if ($dados) {
    require_once 'ClassBloqueioDAO.php';
    $dao = new ClassBloqueioDAO();

    $sucesso = $dao->excluir($dados['id']);

    echo json_encode(['sucesso' => $sucesso]);
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos']);
}
?>

