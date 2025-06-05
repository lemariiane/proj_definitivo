<?php $medicoId = isset($_GET['medico']) ? $_GET['medico'] : null;

function getNomeMedico($id) {
    $medicos = [
        1 => 'Cirurgia Geral - Dra. Cintia',
        2 => 'Ortopedia - Dr. Leandro',
        3 => 'Neurologia - Dr. Flavio',
        4 => 'Pediatria - Dra. Isabela'
    ];
    
    return isset($medicos[$id]) ? $medicos[$id] : 'Médico Não Encontrado';
}
$nomeMedico = getNomeMedico($medicoId);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Agendamento</title>
    <style>
        
        body{
            background-size: cover;
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

  <main class="container">
   <form action="controleAgendamento.php" method="post">
            
        <h1>Agendamento: <?php echo $nomeMedico; ?></h1><br><br>

        <div class="form-group">
            <input type="text" id="ficha" name="ficha" placeholder=" " required>
            <label for="ficha">Número da ficha</label>
            <div class="message"></div>
        </div>

        <div class="form-group">
        <input type="text" id="nomepac" name="nomepac" placeholder=" " required>
        <label for="nome">Nome completo</label>
        <div class="message"></div>
    </div>
    
    <div class="form-group">
        <input maxlength="11" type="text" id="telefonepac" name="telefonepac" placeholder=" " required>
        <label for="telefonepac">Telefone</label>
        <div class="message"></div>
    </div>

    <div class="form-group">
        <input type="datetime" id="start" name="start" placeholder=" " required>
        <label for="nome">start</label>
        <div class="message"></div>
    </div>

    <div class="form-group">
        <input type="datetime" id="end" name="end" placeholder=" " required>
        <label for="nome">End</label>
        <div class="message"></div>
    </div>
    
    <input type="hidden" name="id_medico" value="<?php echo htmlspecialchars($medicoId); ?>">

    <div class="form-group">
        <input type="submit" value="Agendar">
    </div>

   </form>
 </main>

 <script>
    document.getElementById("ficha").addEventListener("blur", function() {
    const ficha = this.value;

    if (ficha) {
        fetch(`buscarPaciente.php?ficha=${ficha}`)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert(data.erro);
                    document.getElementById("nomepac").value = "";
                    document.getElementById("telefonepac").value = "";
                } else {
                    document.getElementById("nomepac").value = data.nomepac;
                    document.getElementById("telefonepac").value = data.telefonepac;
                }
            })
            .catch(error => {
                console.error("Erro:", error);
                alert("Erro ao buscar dados do paciente.");
            });
    }
});

</script>

</body>
</html>