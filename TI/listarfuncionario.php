<?php require_once 'logica-usuario.php'; ?>
<?php 
if(usuarioEstaLogado() == null) {
    header("Location:logininterno.php");
} 

require_once 'ClassFuncionarioDAO.php'; 
$dao = new ClassFuncionarioDAO();

$usuarios = $dao->listarUsuarios(); // Para funcionários de informática
$agendamentos = $dao->listarAgendamentos(); // Para funcionarios de cirurgia
$medico = $dao->listarMedico(); // Para medico
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Listar Funcionários</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('img/backambulancia.jpg');
            background-color: #000;
            background-size: cover;
            overflow: hidden;
            overflow-y: auto;
        }

        .menu {
            background-color: black;
            width: 200px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            position: fixed;
        }

        .menu a {
            display: block;
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 14px;
            text-decoration: none;
            margin: 4px 0;
        }

        .menu a:hover {
            background-color: #ddd;
            color: black;
        }
        
        .menu a#sair {
            color: red;
        }

        .menu .user-info {
            color: white;
            padding: 14px;
            text-align: center;
        }

        main {
            margin: 0px 15px 15px 220px;
            padding: 20px;
            background: rgba(243, 243, 243, 0.596);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        h2 {
            margin-top: 40px;
            text-align: center;
        }

        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table, th, td {
            border: 1px solid #0000003b;
        }

        th {
            padding: 10px;
            text-align: left;
            background-color: #3a3a3a;
            color: rgba(255, 255, 255, 0.493);
        }

        td {
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #dcdcdc;
        }

        .form-button {
            background: transparent;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="menu">
    <div class="user-info">
        <?php echo 'Usuário - ' . usuariologado(); ?>
    </div>
    <div class="signup-link">
        <a href="novoCadastroFuncionarioTI.php">Novo funcionário Informática</a>
    </div>
    <div class="signup-link">
        <a href="novoCadastroFuncionarioCirurgia.php">Novo funcionário Agendamento de Cirurgia</a>
    </div>
     <div class="signup-link">
        <a href="novoMedico.php">Novo Médico</a>
    </div>
    <div class="signup-link">
        <a href="listarfuncionario.php" class="active">Listar funcionários</a>
    </div>
    <a href="deslogar.php" id="sair">Desconectar</a>
</div>

<main>
    <h1>Lista de Funcionários</h1>
    
    <h2>Funcionários da Informática</h2>
    <table>
        <thead>
            <tr>
                <th>Login</th>
                <th>Senha (criptografada)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($usuario = mysqli_fetch_assoc($usuarios)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['login']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['senha']); ?></td>
                    <td>
                        <form method="post" action="alterarFuncionario.php" style="display:inline;">
                            <input type="hidden" name="loginAntigo" value="<?php echo htmlspecialchars($usuario['login']); ?>">
                            <input type="text" name="novoLogin" placeholder="Novo Login" required>
                            <input type="password" name="novaSenha" placeholder="Nova Senha" required>
                            <button type="submit">Alterar</button>
                        </form>
                        <form method="post" action="excluirFuncionario.php" style="display:inline;">
                            <input type="hidden" name="login" value="<?php echo htmlspecialchars($usuario['login']); ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Funcionários de Agendamento de Cirurgia</h2>
    <table>
        <thead>
            <tr>
                <th>Número da carteira</th>
                <th>Senha (criptografada)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($agendamento = mysqli_fetch_assoc($agendamentos)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($agendamento['numcar']); ?></td>
                    <td><?php echo htmlspecialchars($agendamento['senha']); ?></td>
                    <td>
                        <form method="post" action="alterarFuncionarioCirurgia.php" style="display:inline;">
                            <input type="hidden" name="numcarAntigo" value="<?php echo htmlspecialchars($agendamento['numcar']); ?>">
                            <input type="text" name="novoNumcar" placeholder="Novo Número" required>
                            <input type="password" name="novaSenha" placeholder="Nova Senha" required>
                            <button type="submit">Alterar</button>
                        </form>
                        <form method="post" action="excluirFuncionarioCirurgia.php" style="display:inline;">
                            <input type="hidden" name="numcar" value="<?php echo htmlspecialchars($agendamento['numcar']); ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Médicos</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Departamento</th>
                <th>Senha (criptografada)</th>
                <th>Ações</th>
            </tr>
        </thead><?php
$medicos= $dao->listarMedico(); 
?>

<tbody>
<?php while ($medico = mysqli_fetch_assoc($medicos)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($medico['id_medico']); ?></td>
                    <td><?php echo htmlspecialchars($medico['nome']); ?></td>
                    <td><?php echo htmlspecialchars($medico['departamento']); ?></td>
                    <td><?php echo htmlspecialchars($medico['senha']); ?></td>
                    <td>
                        <form method="post" action="alterarMedico.php" style="display:inline;">

                            <input type="hidden" name="idAntigo" value="<?php echo htmlspecialchars($medico['id_medico']); ?>">
                            <input type="text" name="novoNome" placeholder="Novo Nome" required>
                            <input type="text" name="novoDepartamento" placeholder="Novo departamento" required>
                            <input type="password" name="senha" placeholder="Nova Senha" required>
                            <button type="submit">Alterar</button>
                        </form>
                        <form method="post" action="excluirMedico.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($medico['id_medico']); ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

</body>
</html>