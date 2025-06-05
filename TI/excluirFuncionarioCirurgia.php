<?php require_once '../conexao/conecta.php'; ?>
<?php require_once 'ClassFuncionarioDAO.php'; ?>

<?php
$numcar = $_POST['numcar'];

$dao = new ClassFuncionarioDAO();
if ($dao->excluirAgendamento($numcar)) {
    echo "Funcionário de Agendamento de Cirurgia excluído com sucesso!";
} else {
    echo "Erro ao excluir funcionário.";
}

// Redirecionar para a página de listagem após a operação
header("Location: listarfuncionario.php");
exit;
?>