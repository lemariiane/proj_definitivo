<?php
session_start();
require_once "../conexao/conexao.php";  
require_once '../medico/ClassMedicoDAO.php';
require_once '../medico/ClassBloqueioDAO.php';

$pdo = Conexao::getInstance();

$id_medico = $_SESSION['id_medico'];

$daoAgendamento = new ClassMedicoDAO();
$daoBloqueio = new ClassBloqueioDAO();

$agendamentos = $daoAgendamento->buscarAgendamentosPorMedico($id_medico);
$bloqueios = $daoBloqueio->buscarBloqueiosPorMedico($id_medico);

$eventos = [];

$query = "
    SELECT 
        a.id_agendamento, 
        a.ficha, 
        a.start, 
        a.end, 
        a.id_medico,
        p.nomepac AS nome,
        p.email
    FROM 
        agendamento a
    LEFT JOIN 
        cadastro_paciente p ON a.ficha = p.ficha
    WHERE 
        a.id_medico = :id_medico
";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $eventos[] = [
        'id' => $row['id_agendamento'],
        'id_agendamento' => $row['id_agendamento'],
        'title' => $row['nome'] ?? 'Paciente não encontrado',
        'start' => $row['start'],
        'end' => $row['end'],
        'ficha' => $row['ficha'],
        'id_medico' => $row['id_medico'],
        'email' => $row['email'] ?? 'Email não encontrado'
    ];
}

// Bloqueios (vermelho)
foreach ($bloqueios as $bl) {
    $eventos[] = [
        'id' => 'bloqueio_' . $bl['id'],
        'title' => $bl['obs'] ?? 'Bloqueado',
        'start' => $bl['start'],
        'end' => $bl['end'],  // Confirme se o end está no dia seguinte!
        'tipo' => 'bloqueio',
        'display' => 'background',   // ESSENCIAL
        'color' => 'red',           
        'id_medico' => $id_medico
    ];
}

echo json_encode($eventos);
exit;
