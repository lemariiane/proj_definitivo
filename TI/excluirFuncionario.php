<?php require_once '../conexao/conecta.php'; ?>
<?php require_once 'ClassFuncionarioDAO.php'; ?>

<?php
$login = $_POST['login'];

$dao = new ClassFuncionarioDAO();
if ($dao->excluirUsuario($login)) {
    header("Location: listarfuncionario.php" . $_SERVER['listarfuncionario.php']);
exit;
} else {
    echo "Erro ao excluir usuário.";
}
?>