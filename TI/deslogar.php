<?php require_once 'logica-usuario.php' ?>
<?php
    logout();
    header ("Location:logininterno.php");
    die();
?>