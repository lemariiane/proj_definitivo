<?php require_once '../conexao/conecta.php' ?>
<?php require_once 'logica-usuario.php' ?>
<?php require_once 'banco-usuario.php' ?>
<?php
    $usuario = buscaUsuario($conexao,
                            $_POST['login'],$_POST['senha']);
    
    if($usuario===null){
        header ("Location:logininterno.php?login=0");
    } else {
        logaUsuario($usuario['login']);
        header ("Location:menu.php?login=1");
    }
?>