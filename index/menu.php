
<?php require_once '../login/numcar.php' ?>
<?php
if (usuarioEstaLogado() == null) {
    header("Location: ../login/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">

    <style>
        body {
            align-items: center;
            background: url('../img/hosp2.jpg') no-repeat;
            background-size: 100%;
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

        #imagem {
            margin-top: 15%;
            margin-left: 20%;
            border: 5px solid #406979be;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.1s;
        }

        #imagem:hover {
            transform: scale(1.05);
            /* Aumenta ligeiramente o tamanho da imagem ao passar o mouse */
        }

        footer {
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #012e40d5;
            box-shadow: 5px 5px 13px 8px rgba(0, 0, 0, 0.56);
        }
    </style>
</head>

<body>

    <div class="index">
        <header>
            <nav class="navbar">
                <strong>
                    <p class="logo">Grupo União</p>
                </strong>

                <ul class="nav-menu">
                    <li class="nav-item"><a class="nav-link" href="../index/menu.php"><strong>Menu</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="../index/cadastro_paciente.php"><strong>Cadastrar paciente</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="../index/selecionarMedico.php"><strong>Agendamento de cirurgia</strong></a></li>
                </ul>

                <div class="nav-ham">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </header>
    </div>

    <main>

        <a href="listarCadastro_paciente.php">
            <img id="imagem" alt="" src="../img/ah.jpg"></a>

        <a href="../login/desloga.php">
            <img id="imagem" alt="" src="../img/sair.jpg"></a>

    </main>


    <footer>
        <?php echo 'Usuário - ' . usuariologado(); ?>
    </footer>

    <script src="../javascript/nav.js"></script>
    

</body>
</html>