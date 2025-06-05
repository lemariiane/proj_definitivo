<?php 
    function buscaUsuario($conexao,$login,$senha) {

        $sql="select * from usuarios where login='$login'
              and senha= md5('$senha')";

        $resultado = mysqli_query($conexao, $sql);
        $usuario = mysqli_fetch_assoc($resultado);

        return $usuario;
        
    }
?>
