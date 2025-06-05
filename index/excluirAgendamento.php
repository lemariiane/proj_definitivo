<?php
session_start(); // Make sure session is started to use $_SESSION for messages
require_once '../conexao/conecta.php'; // Correct path to your connection file
require_once 'ClassAgendamentoDAO.php'; // Correct path to your DAO class

header('Content-Type: application/json'); // Tell the browser to expect JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_agendamento'])) {
    $id_agendamento = $_POST['id_agendamento'];

    $dao = new ClassAgendamentoDAO();
    if ($dao->excluirAgendamento($id_agendamento)) {
        // Success response
        echo json_encode([
            'sucesso' => true,
            'mensagem' => $_SESSION['mensagem'] ?? 'Agendamento excluído com sucesso!'
        ]);
        // Clear session messages after use if you no longer need them for the redirect scenario
        unset($_SESSION['mensagem']);
        unset($_SESSION['status']);
    } else {
        // Error response
        echo json_encode([
            'sucesso' => false,
            'mensagem' => $_SESSION['mensagem'] ?? 'Erro ao excluir agendamento.'
        ]);
        unset($_SESSION['mensagem']);
        unset($_SESSION['status']);
    }
} else {
    // Invalid request method or missing ID
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Requisição inválida ou ID do agendamento ausente.'
    ]);
}
exit; // Always exit after sending JSON
?>