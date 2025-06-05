<?php
header('Content-Type: application/json');
require_once '../login/id_medico.php';
require_once 'ClassBloqueioDAO.php';
require_once '../conexao/conecta.php';

if (!medicoEstaLogado()) {
    http_response_code(403);
    echo json_encode(['erro' => 'Acesso negado']);
    exit;
}

$medicoId = medicoLogado();

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['start']) || empty($data['end']) || empty($data['obs'])) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados incompletos']);
    exit;
}

$start = $data['start'];
$end = $data['end'];
$obs = $data['obs'];

$bloqueioDAO = new ClassBloqueioDAO($conexao);

$sucesso = $bloqueioDAO->inserirBloqueio($medicoId, $start, $end, $obs);

if ($sucesso) {
    echo json_encode(['sucesso' => true, 'mensagem' => 'Bloqueio registrado com sucesso.']);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao salvar o bloqueio.']);
}
?>
