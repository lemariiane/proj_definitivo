<?php require_once '../conexao/conecta.php'; ?>
<?php require_once 'ClassFuncionarioDAO.php'; ?>

<?php
$idMedicoAntigo = $_POST['idAntigo']; 
$novoNome = $_POST['novoNome'];
$novoDepartamento = $_POST['novoDepartamento'];
$senha = $_POST['senha'];

$dao = new ClassFuncionarioDAO();
if ($dao->alterarMedico($idMedicoAntigo, $novoNome, $novoDepartamento, $senha)) {
    header("Location: listarfuncionario.php");
    exit;
} else {
    echo "Erro ao alterar médico.";
}

?>

