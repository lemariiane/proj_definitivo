<?php require_once "ClassAgendamento.php";  ?>
<?php require_once "ClassAgendamentoDAO.php";  ?>
<?php

     $ficha = $_POST['ficha'];
    $start = $_POST['start'];  
    $end = $_POST['end'];
   
        
    $ClassAgendamentoDAO = new ClassAgendamentoDAO();

    $novoAgendamento = new ClassAgendamento();
    $novoAgendamento->setFicha($ficha); 
    $novoAgendamento->setStart($start);
    $novoAgendamento->setEnd($end);

    $array=$ClassAgendamentoDAO->alterarAgendamento($novoAgendamento);

    if($array==true) {
        header('Location:calendario.php');    
         } else {
        echo "Erro";
    }
    
?>                 