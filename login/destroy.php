<?php session_start(); ?>

<?php
require_once 'id_medico.php';
logout();
header("Location: login_medico.php");
exit();
?>
