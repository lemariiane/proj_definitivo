<?php
require_once '../login/id_medico.php';
require_once 'ClassMedicoDAO.php';
require_once '../conexao/conecta.php';

if (!medicoEstaLogado()) {
    header("Location: ../login/login_medico.php");
    exit;
}

$medicoId = medicoLogado();

$dao = new ClassMedicoDAO($conexao);
$agendamentos = $dao->buscarAgendamentosPorMedico($medicoId); 

function getNomeMedico($id) {
    $medicos = [
        1 => 'Cirurgia Geral - Dra. Cintia',
        2 => 'Ortopedia - Dr. Leandro',
        3 => 'Neurologia - Dr. Flavio',
        4 => 'Pediatria - Dra. Isabela'
    ];
    return $medicos[$id] ?? 'Médico Desconhecido';
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
            margin: 100px 50px 50px;
            padding: 0;
            font-size: 14px;
        }

        #calendar {
            background-color: rgba(64, 105, 121, 0.41);
        }
        form {
            margin: 0; 
            box-shadow: none; 
            background-color: transparent; 
        }
        .modal-content {
            background-color: rgba(210, 224, 230, 0.99);
            border-radius: 0.3rem; 
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); 
        }
        .mensagem-sucesso {
            background-color: rgba(156, 223, 172, 0.43);
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .mensagem-erro {
            background-color: rgba(223, 184, 187, 0.43);
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        #mensagem-flash {
            transition: opacity 2s ease-out;
        }

        input[type="datetime-local"].form-control {
            
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Bem-vindo(a), <?= htmlspecialchars($nomeMedico) ?></h2>
    <a href="../login/destroy.php" id="sair" class="btn btn-outline-danger btn-sm">Desconectar</a>
</div>

    <div id="calendar"></div>
    
    <!--Modal visualizar-->
    <div class="modal fade" id="visualizarModal" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visualizarModalLabel">Detalhe do agendamento</h5>
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
                            <dd class="col-sm-9" id="nomepac"></dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">Email:</dt>
                            <dd class="col-sm-9" id="email"></dd>
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
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="bloquearModal" tabindex="-1" aria-labelledby="bloquearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formBloqueio">
                    <input type="hidden" id="bloqueio_id" name="id">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleNovoBloqueio">Bloquear Dia</h5>
                        <h5 class="modal-title" id="modalTitleEditarBloqueio" style="display:none;">Editar Bloqueio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="bloqueio_start" class="form-label">Início</label>
                            <input type="datetime-local" class="form-control" id="bloqueio_start" name="start" required>
                        </div>
                        <div class="mb-3">
                            <label for="bloqueio_end" class="form-label">Fim</label>
                            <input type="datetime-local" class="form-control" id="bloqueio_end" name="end">
                        </div>
                        <div class="mb-3">
                            <label for="bloqueio_obs" class="form-label">Motivo do Bloqueio</label>
                            <textarea class="form-control" id="bloqueio_obs" name="obs" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="btnSalvarNovoBloqueio">Confirmar Bloqueio</button>

                        <button type="button" class="btn btn-primary" id="btnSalvarEdicaoBloqueio" style="display:none;">Salvar Alterações</button>
                        <button type="button" class="btn btn-secondary" id="btnExcluirBloqueio" style="display:none;">Excluir Bloqueio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../javascript/index.global.min.js"></script>
    <script src="../javascript/core/locales-all.global.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../javascript/custom_v1.js"></script>
    <script src='../javascript/bootstrap5/index.global.min.js'></script>

</body>

</html>