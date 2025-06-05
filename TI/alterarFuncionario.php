<?php require_once '../conexao/conecta.php'; ?>
<?php require_once 'ClassFuncionarioDAO.php'; ?>

<?php
$loginAntigo = $_POST['loginAntigo'];
$novoLogin = $_POST['novoLogin'];
$senha = $_POST['senha'];

$dao = new ClassFuncionarioDAO();
if ($dao->alterarUsuario($loginAntigo, $novoLogin, $senha)) {
    header("Location: listarfuncionario.php" . $_SERVER['listarfuncionario.php']);
exit;
} else {
    echo "Erro ao alterar usuário.";
}
?>