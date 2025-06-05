// Só é executado quando o HTML for totalmente carregado
document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');
    const visualizarModal = new bootstrap.Modal(document.getElementById("visualizarModal"));

    let dataInicial = localStorage.getItem('ultimaDataCalendario');
    if (!dataInicial) {
        const hoje = new Date();
        dataInicial = hoje.toISOString();
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        initialDate: dataInicial,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        locale:'pt-br',
        navLinks: true,
        selectable: true,
        selectMirror: true,
        editable: true,
        dayMaxEvents: true,
        events: 'listar_agendamento.php?medico=' + medicoId,
        
        dayCellDidMount: function (info) {
            const today = new Date();
            const cellDate = new Date(info.date);
            today.setHours(0, 0, 0, 0);
            cellDate.setHours(0, 0, 0, 0);

            if (cellDate < today) {
                info.el.style.opacity = "0.5";
                info.el.style.color = "#363636";
            }
        },

        datesSet: function () {
            const dataAtual = calendar.getDate();
            localStorage.setItem('ultimaDataCalendario', dataAtual.toISOString());
        },

        eventClick: function(info) {
            const idAgendamento = info.event.extendedProps.id_agendamento;

            document.getElementById("visualizar_id_agendamento").innerText = idAgendamento;
            document.getElementById("visualizar_ficha").innerText = info.event.extendedProps.ficha;
            document.getElementById("visualizar_nomepac").innerText = info.event.title;
            document.getElementById("visualizar_email").innerText = info.event.extendedProps.email;
            document.getElementById("visualizar_start").innerText = info.event.start.toLocaleString();
            document.getElementById("visualizar_end").innerText = info.event.end !== null ? info.event.end.toLocaleString() : info.event.start.toLocaleString();
            document.getElementById("visualizar_medico").innerText = info.event.extendedProps.id_medico;
            
            document.getElementById("ed_id_agendamento").value = idAgendamento;
            document.getElementById("ed_ficha").value = info.event.extendedProps.ficha;
            document.getElementById("ed_nomepac").value = info.event.title;
            document.getElementById("ed_email").value = info.event.extendedProps.email;
            document.getElementById("ed_start").value = converterData(info.event.start);
            document.getElementById("ed_end").value = info.event.end !== null ? converterData(info.event.end) : converterData(info.event.start);
            document.getElementById("ed_id_medico").value = info.event.extendedProps.id_medico;
            
            // Atualiza o data-id do botão excluir
            const btnExcluir = document.getElementById("btnExcluirAgendamento");
            btnExcluir.setAttribute('data-agendamento-id', idAgendamento);

            visualizarModal.show();
        },

        select: function (info) {
            const cadastrarModal = new bootstrap.Modal(document.getElementById("cadastrarModal"));
            document.getElementById("start").value = converterData(info.start);
            document.getElementById("end").value = converterData(info.start);
            cadastrarModal.show();
        }
    });

    calendar.render();

    function converterData(data) {
        const dataObj = new Date(data);
        const ano = dataObj.getFullYear();
        const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
        const dia = String(dataObj.getDate()).padStart(2, '0');
        const hora = String(dataObj.getHours()).padStart(2, '0');
        const minuto = String(dataObj.getMinutes()).padStart(2, '0');
        return `${ano}-${mes}-${dia} ${hora}:${minuto}`;
    }

    const cadastrarModalEl = document.getElementById('cadastrarModal');
    const formCad = document.getElementById('formCad');

    cadastrarModalEl.addEventListener('hidden.bs.modal', function () {
        formCad.reset();
        document.activeElement.blur();
    });

    const btn_editar = document.getElementById("btn_editar");
    if (btn_editar) {
        btn_editar.addEventListener("click", () => {
            document.getElementById("visualizarAgendamento").style.display = "none";
            document.getElementById("visualizarModalLabel").style.display = "none";
            document.getElementById("editarAgendamento").style.display = "block";
            document.getElementById("editarModalLabel").style.display = "block";
        });
    }

    const cancelarAgendamento = document.getElementById("cancelarAgendamento");
    if (cancelarAgendamento) {
        cancelarAgendamento.addEventListener("click", () => {
            document.getElementById("visualizarAgendamento").style.display = "block";
            document.getElementById("visualizarModalLabel").style.display = "block";
            document.getElementById("editarAgendamento").style.display = "none";
            document.getElementById("editarModalLabel").style.display = "none";
        });
    }

    const formEd = document.getElementById("formEd");
    if (formEd) {
        formEd.addEventListener("submit", async (e) => {
            e.preventDefault();
            btn_editar.value = "Salvando...";
            const dadosForm = new FormData(formEd);

            try {
                const resposta = await fetch("alterarAgendamento.php", {
                    method: "POST",
                    body: dadosForm,
                });
                const smt = await resposta.json();
                console.log("Resposta do PHP:", smt);

                formEd.reset();
                const agendamentoexiste = calendar.getEventById(smt['id_agendamento']);
                if (agendamentoexiste) {
                    agendamentoexiste.setProp('title', smt['ficha']);
                    agendamentoexiste.setStart(smt['start']);
                    agendamentoexiste.setEnd(smt['end']);
                }
                visualizarModal.hide();

            } catch (erro) {
                console.error("Erro ao salvar:", erro);
            }
            btn_editar.value = "Salvar";
        });
    }

    const btnExcluir = document.getElementById("btnExcluirAgendamento");

    if (btnExcluir) {
        btnExcluir.addEventListener("click", async () => {
            const idAgendamento = btnExcluir.getAttribute('data-agendamento-id');
            if (!idAgendamento) {
                alert("ID do agendamento não encontrado.");
                return;
            }

            if (!confirm("Tem certeza que deseja excluir este agendamento?")) {
                return;
            }

            try {
                const resposta = await fetch("excluirAgendamento.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id_agendamento=' + encodeURIComponent(idAgendamento)
                });

                const data = await resposta.json();
                if (data.sucesso) {
                    alert(data.mensagem);
                    visualizarModal.hide();
                    calendar.refetchEvents();
                } else {
                    alert("Erro ao excluir: " + data.mensagem);
                }
            } catch (erro) {
                console.error("Erro na exclusão:", erro);
            }
        });
    }

});
