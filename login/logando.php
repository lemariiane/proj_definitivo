<?php require_once '../conexao/conecta.php' ?>
<?php require_once 'numcar.php' ?>
<?php require_once 'banco-logar.php' ?>
<?php
    $numcar = buscaUsuario($conexao,
                            $_POST['numcar'],$_POST['senha']);
    
    if($numcar===null){

        header ("Location: /proj_definitivo/login/login.php?numcar=0");
        exit();
    }else {
        logaUsuario($numcar['numcar']);
        header ("Location: /proj_definitivo/index/menu.php?numcar=1");
    }
?>