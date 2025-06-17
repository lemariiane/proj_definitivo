<?php 
function buscaMedico($conexao, $id_medico, $senha) {
    $sql = "SELECT * FROM medicos WHERE id_medico = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id_medico);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $medico = mysqli_fetch_assoc($resultado);

    if ($medico && password_verify($senha, $medico['senha'])) {
        return $medico; // Login verificado
    }

    return null; 
}
?>
