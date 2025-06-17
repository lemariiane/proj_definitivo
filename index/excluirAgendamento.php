<?php
session_start(); 
require_once '../conexao/conecta.php'; 
require_once 'ClassAgendamentoDAO.php'; 

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_agendamento'])) {
    $id_agendamento = $_POST['id_agendamento'];

    $dao = new ClassAgendamentoDAO();
    if ($dao->excluirAgendamento($id_agendamento)) {
        
        echo json_encode([
            'sucesso' => true,
            'mensagem' => $_SESSION['mensagem'] ?? 'Agendamento excluído com sucesso!'
        ]);
        
        unset($_SESSION['mensagem']);
        unset($_SESSION['status']);
    } else {
       
        echo json_encode([
            'sucesso' => false,
            'mensagem' => $_SESSION['mensagem'] ?? 'Erro ao excluir agendamento.'
        ]);
        unset($_SESSION['mensagem']);
        unset($_SESSION['status']);
    }
} else {
    //sem ID
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Requisição inválida ou ID do agendamento ausente.'
    ]);
}
exit; 
?>