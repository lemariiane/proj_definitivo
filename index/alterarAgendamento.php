<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../conexao/conexao.php';

$pdo = Conexao::getInstance(); 

header('Content-Type: application/json');

// Recuperando os dados via POST
$id_agendamento = $_POST['id_agendamento'] ?? null;
$start = $_POST['start'] ?? '';
$end = $_POST['end'] ?? '';
$id_medico = $_POST['id_medico'] ?? '';
$ficha = $_POST['ficha'] ?? '';

header('Content-Type: application/json');


try {
    $sql = "UPDATE agendamento 
        SET start = :start, end = :end 
        WHERE id_agendamento = :id_agendamento";


    $stmt = $pdo->prepare($sql); 
$stmt->bindValue(':start', $start);
$stmt->bindValue(':end', $end);
$stmt->bindValue(':id_agendamento', $id_agendamento);


    if ($stmt->execute()) {
        $smt = [
            'id_agendamento' => $id_agendamento,
            'ficha' => $ficha,
            'id_medico' => $id_medico,
            'start' => $start,
            'end' => $end
        ];
        echo json_encode($smt);
        exit;
    } else {
        http_response_code(500);
        echo json_encode(['erro' => 'Falha ao editar o agendamento.']);
        exit;
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro no banco: ' . $e->getMessage()]);
    exit;
}
