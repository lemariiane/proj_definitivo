<?php 
if(!function_exists("protect")){

    function protect(){

        if(!isset($SESSION))
            session_start();
        if(!isset($_SESSION["usuario_logado"]) || is_numeric($_SESSION["usuario_logado"])){
            header("Location: ../login/login.php");
        }
        
    }
}
?>