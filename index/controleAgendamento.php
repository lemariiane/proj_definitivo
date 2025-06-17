<?php
require_once "../index/ClassAgendamento.php";
require_once "../index/ClassAgendamentoDAO.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ficha = $_POST['ficha'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id_medico = $_POST['id_medico'];

    $novoAgendamento = new ClassAgendamento();
    $novoAgendamento->setFicha($ficha);
    $novoAgendamento->setStart($start);
    $novoAgendamento->setEnd($end);
    $novoAgendamento->setId_Medico($id_medico); 

    $ClassAgendamentoDAO = new ClassAgendamentoDAO();

    // Verificar conflito de horários antes de ocorrer o agendamento
    $conflitos = $ClassAgendamentoDAO->verificarConflito($start, $end, $id_medico);


    if (count($conflitos) > 0) {
        $_SESSION['mensagem'] = "Já possui agendamento para esse horário. Selecione outro, por favor!";
        $_SESSION['status'] = "erro";
    } else {
        $ClassAgendamentoDAO->cadastrarAgendamento($novoAgendamento);
    }

    header("Location: calendario.php");
    exit;
} else {
    echo "Acesso inválido: Formulário não submetido.";
}
