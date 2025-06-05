<?php 
require_once '../login/id_medico.php';
require_once 'ClassMedicoDAO.php';
require_once 'ClassBloqueioDAO.php';

header('Content-Type: application/json');

if (!medicoEstaLogado()) {
    http_response_code(403);
    echo json_encode(["erro" => "Médico não autenticado."]);
    exit;
}

$id_medico = medicoLogado();

$daoAgendamento = new ClassMedicoDAO();
$daoBloqueio = new ClassBloqueioDAO();

$agendamentos = $daoAgendamento->buscarAgendamentosPorMedico($id_medico);
$bloqueios = $daoBloqueio->buscarBloqueiosPorMedico($id_medico);

$eventos = [];

// Formatando agendamentos (em azul)
foreach ($agendamentos as $ag) {
    $eventos[] = [
        'id' => $ag['id'],
        'title' => $ag['title'] ?? 'Agendamento',
        'start' => $ag['start'],
        'end' => $ag['end'],
        'color' => 'blue',
        'ficha' => $ag['ficha'] ?? '',
        'email' => $ag['email'] ?? '',
        'tipo' => 'agendamento',
        'id_medico' => $ag['id_medico'] ?? $id_medico
    ];
}

// Formatando bloqueios (com display de fundo e cor vermelha)
foreach ($bloqueios as $bl) {
    $eventos[] = [
        'id' => 'bloqueio_' . $bl['id'],  // prefixo para identificar
        'title' => $bl['obs'] ?? 'Bloqueado',
        'start' => $bl['start'],
        'end' => $bl['end'],
        'tipo' => 'bloqueio',
        'display' => 'background',         
        'backgroundColor' => 'red',        
        'id_medico' => $id_medico
    ];
}

echo json_encode($eventos);
exit;
?>
