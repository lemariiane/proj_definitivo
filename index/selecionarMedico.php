<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Seleção de Médico</title>
    <style>
        body{
            background-size: cover;
            height: 0vh;
        }
        main{
            margin-top: 200px;
            margin-bottom: 0px;
        }
        .form-group{
            margin-top: 10%;
            padding:0px;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar">
            <strong><p class="logo">Grupo União</p></strong>
        
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

    <main>

        <form action="calendario.php" method="GET">
            <div class="form-group">
                <select id="medico" name="medico" required>
                    <option value="">Selecione o Médico</option>
                    <option value="1">Cirurgia Geral - Dra. Cintia</option>
                    <option value="2">Ortopedia - Dr. Leandro</option>
                    <option value="3">Neurologia - Dr. Flavio</option>
                    <option value="4">Pediatria - Dra. Isabela</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Ir para  agendamento">
            </div>
        </form>
    </main>

<script src="../javascript/nav.js"></script>

</body>
</html>