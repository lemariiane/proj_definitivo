<?php require_once '../conexao/conecta.php'; ?>
<?php require_once 'ClassFuncionarioDAO.php'; ?>

<?php
$numcarAntigo = $_POST['numcarAntigo'];
$novoNumcar = $_POST['novoNumcar'];
$senha = $_POST['novaSenha'];

$dao = new ClassFuncionarioDAO();
if ($dao->alterarAgendamento($numcarAntigo, $novoNumcar, $senha)) {
    echo "Funcionário de Agendamento de Cirurgia alterado com sucesso!";
} else {
    echo "Erro ao alterar funcionário.";
}

// Redirecionar para a página de listagem após a operação
header("Location: listarfuncionario.php");
exit;
?>