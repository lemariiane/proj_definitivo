<?php 
    function buscaUsuario($conexao,$numcar,$senha) {

        $sql="select * from logar where numcar='$numcar'
              and senha= md5('$senha')";

        $resultado = mysqli_query($conexao, $sql);
        $usuario = mysqli_fetch_assoc($resultado);

        return $usuario;      
    }
?>