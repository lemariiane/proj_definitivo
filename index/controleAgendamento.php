<?php

require_once "../index/ClassAgendamento.php";
require_once "../index/ClassAgendamentoDAO.php";

// a requisição é do tipo POST
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
    $ClassAgendamentoDAO->cadastrarAgendamento($novoAgendamento);

} else {
    echo "Acesso inválido: Formulário não submetido.";
}

?>