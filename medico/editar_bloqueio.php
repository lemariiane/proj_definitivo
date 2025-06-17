<?php
header('Content-Type: application/json');

require_once '../conexao/conexao.php'; 
require_once 'ClassBloqueioDAO.php';   


$input_json = file_get_contents('php://input');
$dados = json_decode($input_json, true);

error_log("[DEBUG PHP] Input JSON recebido: " . $input_json);
error_log("[DEBUG PHP] Dados decodificados: " . print_r($dados, true));

//todos os dados inseridos
if ($dados &&
    isset($dados['id']) &&
    isset($dados['start']) &&
    isset($dados['end']) &&
    isset($dados['obs'])
) {
    $dao = new ClassBloqueioDAO();

    $id_bloqueio = $dados['id'];
    $start_bloqueio = $dados['start'];
    $end_bloqueio = $dados['end'];
    $obs_bloqueio = $dados['obs'];

    $sucesso = $dao->editar($id_bloqueio, $start_bloqueio, $end_bloqueio, $obs_bloqueio);

    // Retorna a resposta JSON
    echo json_encode([
        'sucesso' => $sucesso,
        'id' => $id_bloqueio, 
        'start' => $start_bloqueio,
        'end' => $end_bloqueio,
        'obs' => $obs_bloqueio
    ]);
} else {
    echo json_encode([
        'sucesso' => false,
        'erro' => 'Dados inválidos ou incompletos. Verifique se ID, START, END e OBS foram enviados.',
        'dados_recebidos' => $dados,
        'input_json_raw' => $input_json
    ]);
}
?>