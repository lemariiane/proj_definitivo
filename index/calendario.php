<?php
session_start();

$mensagem = "";
$classe = "";

if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    $classe = $_SESSION['status'] === "sucesso" ? "mensagem-sucesso" : "mensagem-erro";
    unset($_SESSION['mensagem'], $_SESSION['status']); // limpa 
}
?>

<?php

// salva na sessão
if (isset($_GET['medico'])) {
    $_SESSION['id_medico'] = $_GET['medico'];
}

//valor da sessão
$medicoId = isset($_SESSION['id_medico']) ? $_SESSION['id_medico'] : null;

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
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5/main.min.css" rel="stylesheet">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Calendário</title>
    <style>
        body {
            margin: 180px 50px 50px;
            padding: 0;
            font-size: 14px;
        }
        #calendar {
    max-width: 1100px;
    margin: 0 auto;
    background-color:rgba(64, 105, 121, 0.41);
  } form{
    margin: 0px;
    box-shadow: 0px 0px 0px;
    background-color: transparent;
  }
  .modal-content{
    background-color:rgba(210, 224, 230, 0.99);
    border-radius: 2%;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.205);
  }
  .mensagem-sucesso {
    background-color:rgba(156, 223, 172, 0.43);
    color: #155724;
    border: 1px solid #c3e6cb;
}

.mensagem-erro {
    background-color:rgba(223, 184, 187, 0.43);
    color: #721c24;
    border: 1px solid #f5c6cb;
}
#mensagem-flash {
    transition: opacity 2s ease-out;
}

    </style>
</head>
<body>

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

    <h1>Agendamento: <?php echo $nomeMedico; ?></h1>
    
    <?php if (!empty($mensagem)) : ?>
    <div id="mensagem-flash" class="<?= $classe ?>" style="text-align: center; margin-top: 20px; margin-bottom: 20px;
    padding: 10px; border-radius: 5px; font-weight: bold;">
        <?= $mensagem ?>
    </div>
<?php endif; ?>

    <div id='calendar'></div>

<!-- Modal visualizar -->
<div class="modal fade" id="visualizarModal" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visualizarModalLabel">Detalhe do agendamento</h5>
        <h5 class="modal-title" id="editarModalLabel" style= "display:none;">Editar agendamento: <?php echo $nomeMedico; ?></h5>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
   
      <div class="modal-body">

      <div id="visualizarAgendamento">
       
      <dl class="row" style="display: none;">
        <dd class="col-sm-9" id="visualizar_id_agendamento"></dd>
      </dl>

      <dl class="row">
        <dt class="col-sm-3">Ficha:</dt>
        <dd class="col-sm-9" id="visualizar_ficha"></dd>
      </dl>

      <dl class="row">
        <dt class="col-sm-3">Nome:</dt>
        <dd class="col-sm-9" id="visualizar_nomepac"></dd>
      </dl>

      <dl class="row">
        <dt class="col-sm-3">Email:</dt>
        <dd class="col-sm-9" id="visualizar_email"></dd>
      </dl>

      <dl class="row">
        <dt class="col-sm-3">Início:</dt>
        <dd class="col-sm-9" id="visualizar_start"></dd>
      </dl>

      <dl class="row">
        <dt class="col-sm-3">Fim:</dt>
        <dd class="col-sm-9" id="visualizar_end"></dd>
      </dl>

      <dl class="row" style="display: none;">
        <dd class="col-sm-9" id="visualizar_medico"></dd>
      </dl>

      <button id="btn_editar" type="submit" class="btn btn-primary me-2">
        <i class="bi bi-pencil-square me-1"></i> Alterar
      </button>
      <button type="button" class="btn btn-danger" id="btnExcluirAgendamento" data-agendamento-id="<?= $agendamento['id_agendamento']; ?>">Excluir Agendamento</button>

      </div>

</div>
    <!--Modal editar -->
      <div id="editarAgendamento" style="display:none;">

      <form id="formEd" method="POST">

            <input type="hidden" id="ed_id_agendamento" name="id_agendamento" required>
            

        <div class="form-group">
            <input type="text" class="ficha" id="ed_ficha" name="ficha" required readonly>
            <label for="ed_ficha">Número da ficha</label>
            <div class="message"></div>
        </div>

        <div class="form-group">
        <input type="text" class="nomepac" id="ed_nomepac" name="ed_nomepac" required readonly>
        <label for="ed_nome">Nome completo</label>
        <div class="message"></div>
    </div>
    
    <div class="form-group">
        <input type="email" class="email" id="ed_email" name="ed_email" required readonly>
        <label for="ed_email">Email</label>
        <div class="message"></div>
    </div>

    <div class="form-group">
        <input type="datetime-local" id="ed_start" name="start" required>
        <label for="ed_start">Início</label>
        <div class="message"></div>
    </div>

    <div class="form-group">
        <input type="datetime-local" id="ed_end" name="end" required>
        <label for="ed_end">Fim</label>
        <div class="message"></div>
    </div>
    
    <input type="hidden" id="ed_id_medico" name= "id_medico" value="<?php echo htmlspecialchars($medicoId); ?>">

    <div class="form-group">
        <input type="submit" id="EditAgendamento" value="Salvar">
    </div>

    <div class="form-group">
        <input type="button" id="cancelarAgendamento" value="Cancelar">
    </div>

   </form>
      
      </div>
    </div>
  </div>
</div>

<!-- Modal cadastrar -->
<div class="modal fade" id="cadastrarModal" tabindex="-1" role="dialog" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cadastrarModalLabel">Cadastrar agendamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
          
      </div>
   
      <div class="modal-body">
       
      <form id="formCad" action="controleAgendamento.php" method="post">
            
        <h1><?php echo $nomeMedico; ?></h1><br><br>

        <div class="form-group">
            <input type="text" class="ficha" id="ficha" name="ficha" required>
            <label for="ficha">Número da ficha</label>
            <div class="message"></div>
        </div>

        <div class="form-group">
        <input type="text" class="nomepac" id="nomepac" name="nomepac" readonly required>
        <label for="nomepac">Nome completo</label>
        <div class="message"></div>
    </div>
    
    <div class="form-group">
        <input type="email" class="email" id="email" name="email" readonly required>
        <label for="email">Email</label>
        <div class="message"></div>
    </div>

    <div class="form-group">
        <input type="datetime-local" id="start" name="start" required>
        <label for="start">Início</label>
        <div class="message"></div>
    </div>

    <div class="form-group">
        <input type="datetime-local" id="end" name="end" required>
        <label for="end">Fim</label>
        <div class="message"></div>
    </div>
    
    <input type="hidden" name="id_medico" value="<?php echo htmlspecialchars($medicoId); ?>">

    <div class="form-group">
        <input type="submit" value="Agendar">
    </div>

   </form>
      
      </div>
    </div>
  </div>
</div>

<script>
    
   // Seleciona todos os campos (editar e cadastrar) de ficha e aplica o evento "blur"
document.querySelectorAll(".ficha").forEach(inputFicha => {
    inputFicha.addEventListener("blur", function () {
        const ficha = this.value;

        if (ficha) {
            fetch(`buscarPaciente.php?ficha=${ficha}`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        alert(data.erro);
                        document.querySelectorAll(".nomepac").forEach(el => el.value = "");
                        document.querySelectorAll(".email").forEach(el => el.value = "");
                    } else {
                        document.querySelectorAll(".nomepac").forEach(el => el.value = data.nomepac);
                        document.querySelectorAll(".email").forEach(el => el.value = data.email);
                    }
                })
                .catch(error => {
                    console.error("Erro:", error);
                    alert("Erro ao buscar dados do paciente.");
                });
        }
    });
});


 // Mensagem de sucesso/erro com sumiço automático
 window.addEventListener('DOMContentLoaded', function () {
        const mensagem = document.getElementById('mensagem-flash');
        if (mensagem) {
            setTimeout(() => {
                mensagem.style.transition = 'opacity 2s ease-out';
                mensagem.style.opacity = '0';
                setTimeout(() => mensagem.remove(), 500);
            }, 4000);
        }
    });

  const medicoId = <?= json_encode($medicoId) ?>;

</script>

<!-- FullCalendar -->
<script src="../javascript/index.global.min.js"></script>
<script src="../javascript/core/locales-all.global.min.js"></script>

<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom FullCalendar + modal logic -->
<script src="../javascript/custom.js"></script>

    <script src='../javascript/bootstrap5/index.global.min.js'></script>
    <script src='../javascript/nav.js'></script>
</body>

</html>