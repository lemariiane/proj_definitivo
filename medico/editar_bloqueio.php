<?php
header('Content-Type: application/json');

// Inclua a conexão e a classe DAO
require_once '../conexao/conexao.php'; 
require_once 'ClassBloqueioDAO.php';   

// Lê o corpo da requisição e tenta decodificar como JSON
$input_json = file_get_contents('php://input');
$dados = json_decode($input_json, true);

// Adicione logs para depuração no servidor (checar error.log do Apache/Nginx)
error_log("[DEBUG PHP] Input JSON recebido: " . $input_json);
error_log("[DEBUG PHP] Dados decodificados: " . print_r($dados, true));

// Verifica se os dados foram decodificados corretamente e se contêm todos os campos esperados
if ($dados &&
    isset($dados['id']) &&
    isset($dados['start']) &&
    isset($dados['end']) &&
    isset($dados['obs'])
) {
    $dao = new ClassBloqueioDAO();

    // Atribui os valores do array $dados às variáveis
    $id_bloqueio = $dados['id'];
    $start_bloqueio = $dados['start'];
    $end_bloqueio = $dados['end'];
    $obs_bloqueio = $dados['obs'];

    $sucesso = $dao->editar($id_bloqueio, $start_bloqueio, $end_bloqueio, $obs_bloqueio);

    // Retorna a resposta JSON
    echo json_encode([
        'sucesso' => $sucesso,
        'id' => $id_bloqueio, // Retorne o ID para que o JS possa atualizar o evento no calendário
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