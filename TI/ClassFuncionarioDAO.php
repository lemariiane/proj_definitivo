<?php require_once '../conexao/conecta.php'; ?>

<?php
class ClassFuncionarioDAO {
    
    // Cadastrar Funcionário da TI
    public function cadastrarUsuario($login, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios(login, senha) VALUES (?, ?)";
        $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $login, $senhaHash);
        return mysqli_stmt_execute($stmt);
    }
    // Cadastrar Funcionário da cirurgia
    public function cadastrarAgendamento($numcar, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO logar(numcar, senha) VALUES (?, ?)";
        $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $numcar, $senhaHash);
        return mysqli_stmt_execute($stmt);
    }
    // Cadastrar Médicos
    public function cadastrarMedico($id_medico, $nome, $departamento, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO medicos(id_medico, nome, departamento, senha) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $id_medico, $nome, $departamento, $senhaHash);
        return mysqli_stmt_execute($stmt);
    }

    // Listar Funcionários da TI
    public function listarUsuarios() {
        $sql = "SELECT * FROM usuarios";
        return mysqli_query($GLOBALS['conexao'], $sql);
    }
    // Listar Funcionário da cirurgia
    public function listarAgendamentos() {
        $sql = "SELECT * FROM logar";
        return mysqli_query($GLOBALS['conexao'], $sql);
    }
    // Listar Medico
    public function listarMedico() {
        $sql = "SELECT * FROM medicos";
        return mysqli_query($GLOBALS['conexao'], $sql);
    }

    // Alterar Funcionário da TI
    public function alterarUsuario($loginAntigo, $novoLogin, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET login=?, senha=? WHERE login=?";
        $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $novoLogin, $senhaHash, $loginAntigo);
        return mysqli_stmt_execute($stmt);
    }
    // Alterar Funcionário da cirurgia
    public function alterarAgendamento($numcarAntigo, $novoNumcar, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE logar SET numcar=?, senha=? WHERE numcar=?";
        $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $novoNumcar, $senhaHash, $numcarAntigo);
        return mysqli_stmt_execute($stmt);
    }
    // Alterar medico
    public function alterarMedico($idMedicoAntigo, $novoNome, $novoDepartamento, $senha) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "UPDATE medicos SET nome=?, departamento=?, senha=? WHERE id_medico=?";
    $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $novoNome, $novoDepartamento, $senhaHash, $idMedicoAntigo);
    return mysqli_stmt_execute($stmt);
}



    // Excluir Funcionário da TI
    public function excluirUsuario($login) {
        $sql = "DELETE FROM usuarios WHERE login=?";
        $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
        mysqli_stmt_bind_param($stmt, 's', $login);
        return mysqli_stmt_execute($stmt);
    }
    // Excluir Funcionário da cirurgia
    public function excluirAgendamento($numcar) {
        $sql = "DELETE FROM logar WHERE numcar=?";
        $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
        mysqli_stmt_bind_param($stmt, 's', $numcar);
        return mysqli_stmt_execute($stmt);
    }
    // Excluir medico
    public function excluirMedico($id_medico) {
        $sql = "DELETE FROM medicos WHERE id_medico=?";
        $stmt = mysqli_prepare($GLOBALS['conexao'], $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id_medico);
        return mysqli_stmt_execute($stmt);
    }

}
?>