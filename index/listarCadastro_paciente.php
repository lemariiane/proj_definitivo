<?php require_once "ClassCadastro_pacienteDAO.php"; ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/header.css">
    <title>Lista de Pacientes</title>
    <style>
        * {
        overflow-y: auto;
    }

        body {
            background-image: url('../img/hosp1.jpg');
            background-color: #000000;
        }

        header {
            top: 0;
            left: 0;
            box-shadow: 5px 5px 10px #001a247c;
            background-color: #798f99;
            position: fixed;
            width: 100%;
            height: 16vh;
            padding: 1%;
            z-index: 1000;
        }

        li {
            list-style: none;
        }

        li:hover {
            padding: 0.2%;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            color: rgb(65, 65, 65);
        }

        .container {
            max-width: 1280px;
            margin: auto;
            margin-bottom: 10vh;
            background: #436c7c5d;
            padding: 0px;
            border-radius: 10px;
        }

        h2 {
            padding-top: 20px;
            margin-top: 180px;
            text-align: center;
        }

        table {
            margin-top: 50px;
            margin-left: 14px;
            margin-right: 15px;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table,
        th,
        td {
            border: 2px solid #dddddda4;
        }

        th {
            padding: 10px;
            text-align: left;
            background-color: #012e4096;
            color: white;
        }

        td {
            padding: 5px;
        }

        tr:nth-child(even) {
            background-color: #798f99;
        }

        tr:hover {
            background-color: #798f99;
        }

        input {
            padding: 5px;
            height: 25px;
            line-height: 1;
        }

        .form-button {
            background: transparent;
            border: none;
            margin-left: 2px;
            cursor: pointer;
        }

        form {
            margin: 8px;
            padding: 15px;
            box-shadow: none;
            background-color: transparent;
        }

        .logo {
            font-family: Brush Script MT;
            color: #012e40d5;
            font-size: 3rem;
            font-weight: bold;
        }

        .search-input {
            padding: 15px;
            width: 570px;
            border: 2px solid rgb(11, 90, 121);
        }

        .search-input:hover {
            border: 2px solid #012e40;
        }

        .search-button {
            background-color: #014a68;
            color: white;
            padding: 10px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #012e40;
        }

    </style>
</head>

<body>

    <div class="container">
        <?php
        $ClassCadastro_pacienteDAO = new ClassCadastro_pacienteDAO();
        $array = $ClassCadastro_pacienteDAO->listarCadastro_paciente();

        if (!empty($_GET['cpf']) || !empty($_GET['ficha'])) {
            $cpf = $_GET['cpf'] ?? '';
            $ficha = $_GET['ficha'] ?? '';
            $array = $ClassCadastro_pacienteDAO->pesquisarCadastro_paciente($cpf, $ficha);
        } 

        echo "<h2>Lista de pacientes</h2>";
        ?>

<form method="GET">
    <input type="text" name="cpf" placeholder="Digite o CPF" class="search-input">
    <input type="text" name="ficha" placeholder="Digite a Ficha" class="search-input">
    <button type="submit" class="search-button">Pesquisar</button>
</form>

        <table>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>Telefone Secundário</th>
                <th>email</th>
                <th>CEP</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Pagamento</th>
                <th>Ficha</th>
                <th>Alterar</th>
            </tr>

            
                <?php foreach ($array as $item): ?>

                    <tr>
                        <td><?= htmlspecialchars($item['nomepac']) ?></td>
                        <td><?= htmlspecialchars($item['cpfpac']) ?></td>
                        <td><?= htmlspecialchars($item['datanasc']) ?></td>
                        <td><?= htmlspecialchars($item['telefonepac']) ?></td>
                        <td><?= htmlspecialchars($item['telefonepac2']) ?></td>
                        <td><?= htmlspecialchars($item['email']) ?></td>
                        <td><?= htmlspecialchars($item['cep']) ?></td>
                        <td><?= htmlspecialchars($item['estadopac']) ?></td>
                        <td><?= htmlspecialchars($item['cidadepac']) ?></td>
                        <td><?= htmlspecialchars($item['bairropac']) ?></td>
                        <td><?= htmlspecialchars($item['ruapac']) ?></td>
                        <td><?= htmlspecialchars($item['numeropac']) ?></td>
                        <td><?= htmlspecialchars($item['pagamento']) ?></td>
                        <td><?= htmlspecialchars($item['ficha']) ?></td>
                        <td>

                            <form action="alterarCadastro_paciente.php" method="POST">
                                <input type="hidden" name="nomepac" value="<?php echo htmlspecialchars($item['nomepac']); ?>">
                                <input type="hidden" name="cpfpac" value="<?php echo htmlspecialchars($item['cpfpac']); ?>">
                                <input type="hidden" name="datanasc" value="<?php echo htmlspecialchars($item['datanasc']); ?>">
                                <input type="hidden" name="telefonepac" value="<?php echo htmlspecialchars($item['telefonepac']); ?>">
                                <input type="hidden" name="telefonepac2" value="<?php echo htmlspecialchars($item['telefonepac2']); ?>">
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($item['email']); ?>">
                                <input type="hidden" name="cep" value="<?php echo htmlspecialchars($item['cep']); ?>">
                                <input type="hidden" name="estadopac" value="<?php echo htmlspecialchars($item['estadopac']); ?>">
                                <input type="hidden" name="cidadepac" value="<?php echo htmlspecialchars($item['cidadepac']); ?>">
                                <input type="hidden" name="bairropac" value="<?php echo htmlspecialchars($item['bairropac']); ?>">
                                <input type="hidden" name="ruapac" value="<?php echo htmlspecialchars($item['ruapac']); ?>">
                                <input type="hidden" name="numeropac" value="<?php echo htmlspecialchars($item['numeropac']); ?>">
                                <input type="hidden" name="pagamento" value="<?php echo htmlspecialchars($item['pagamento']); ?>">
                                <input type="hidden" name="ficha" value="<?php echo htmlspecialchars($item['ficha']); ?>">
                                <button class="form-button">
                                    <img src="../img/alterar.png" alt="alterar" width="25" height="25">
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            
        </table>
    </div>

    <script src="../javascript/nav.js"></script>

</body>

</html>