document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const bloquearModalElement = document.getElementById('bloquearModal');
    const bloquearModal = new bootstrap.Modal(bloquearModalElement);

    // Referências para os elementos do modal de bloqueio/edição
    const formBloqueio = document.getElementById('formBloqueio');
    const bloqueioIdInput = document.getElementById('bloqueio_id'); // Campo oculto para o ID
    const bloqueioStartInput = document.getElementById('bloqueio_start');
    const bloqueioEndInput = document.getElementById('bloqueio_end');
    const bloqueioObsInput = document.getElementById('bloqueio_obs');

    const modalTitleNovoBloqueio = document.getElementById('modalTitleNovoBloqueio');
    const modalTitleEditarBloqueio = document.getElementById('modalTitleEditarBloqueio');

    const btnSalvarNovoBloqueio = document.getElementById('btnSalvarNovoBloqueio');
    const btnSalvarEdicaoBloqueio = document.getElementById('btnSalvarEdicaoBloqueio');
    const btnExcluirBloqueio = document.getElementById('btnExcluirBloqueio');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        themeSystem: 'bootstrap5',
        selectable: true,
        editable: false,
        eventDisplay: 'block',
        events: 'listar_agendamento_medico.php',

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

        dateClick: function (info) {
    const clickedDateStr = info.dateStr;

    let bloqueioEncontrado = null;

    calendar.getEvents().forEach(event => {
        if (event.extendedProps && event.extendedProps.tipo === 'bloqueio') {
            const eventStartStr = event.startStr.substr(0, 10); // Pega só a data: 'YYYY-MM-DD'
            const eventEndStr = (event.endStr ? event.endStr : event.startStr).substr(0, 10);

            // Verifica se a data clicada está dentro do intervalo de bloqueio (inclusive)
            if (clickedDateStr >= eventStartStr && clickedDateStr <= eventEndStr) {
                bloqueioEncontrado = event;
            }
        }
    });

    if (bloqueioEncontrado) {
        const bloqueioId = bloqueioEncontrado.id.replace('bloqueio_', '');
        const bloqueioTitle = bloqueioEncontrado.title;
        const bloqueioStart = bloqueioEncontrado.startStr;
        const bloqueioEnd = bloqueioEncontrado.endStr;

        abrirModalBloqueioParaEdicao(bloqueioId, bloqueioTitle, bloqueioStart, bloqueioEnd);
    } else {
        abrirModalBloqueioParaCriacao(info.dateStr);
    }
},


        eventClick: function (info) {
            if (info.event.extendedProps.tipo === 'bloqueio') {
                // Abre o modal no modo de edição/exclusão de bloqueio
                const bloqueioId = info.event.id.replace('bloqueio_', '');
                const bloqueioTitle = info.event.title;
                const bloqueioStart = info.event.startStr;
                const bloqueioEnd = info.event.endStr;

                abrirModalBloqueioParaEdicao(bloqueioId, bloqueioTitle, bloqueioStart, bloqueioEnd);
                return;
            }

            // Lógica existente para agendamentos
            document.getElementById('visualizar_ficha').textContent = info.event.extendedProps.ficha;
            document.getElementById('nomepac').textContent = info.event.title;
            document.getElementById('email').textContent = info.event.extendedProps.email;
            document.getElementById('visualizar_start').textContent = info.event.startStr;
            document.getElementById('visualizar_end').textContent = info.event.endStr;

            const visualizarModal = new bootstrap.Modal(document.getElementById('visualizarModal'));
            visualizarModal.show();
        }
    });

    calendar.render();

    // Função para abrir o modal no modo de CRIAÇÃO de novo bloqueio
    function abrirModalBloqueioParaCriacao(dateStr) {
        // Limpa e prepara os campos
        bloqueioIdInput.value = ''; // Garante que o ID esteja vazio para novo bloqueio
        bloqueioStartInput.value = dateStr + 'T00:00'; // Define a data clicada e hora inicial (meia-noite)
        bloqueioEndInput.value = dateStr + 'T23:59'; // Define a data clicada e hora final (quase meia-noite)
        bloqueioObsInput.value = '';

        // Controla a visibilidade dos títulos
        modalTitleNovoBloqueio.style.display = 'block';
        modalTitleEditarBloqueio.style.display = 'none';

        // Controla a visibilidade dos botões
        btnSalvarNovoBloqueio.style.display = 'block';
        btnSalvarEdicaoBloqueio.style.display = 'none';
        btnExcluirBloqueio.style.display = 'none';

        bloquearModal.show();
    }

    // Função para abrir o modal no modo de EDIÇÃO/EXCLUSÃO de bloqueio existente
    function abrirModalBloqueioParaEdicao(id, title, start, end) {
        // Preenche os campos com os dados do bloqueio clicado
        bloqueioIdInput.value = id;
        bloqueioStartInput.value = start; // `start` já vem com data e hora
        bloqueioEndInput.value = end;     // `end` já vem com data e hora
        bloqueioObsInput.value = title;   // O título do evento é sua observação

        // Controla a visibilidade dos títulos
        modalTitleNovoBloqueio.style.display = 'none';
        modalTitleEditarBloqueio.style.display = 'block';

        // Controla a visibilidade dos botões
        btnSalvarNovoBloqueio.style.display = 'none';
        btnSalvarEdicaoBloqueio.style.display = 'block';
        btnExcluirBloqueio.style.display = 'block';

        bloquearModal.show();
    }

    // 1. Submissão do formulário para NOVO BLOQUEIO (acionado pelo click em "Confirmar Bloqueio")
    formBloqueio.addEventListener('submit', function (e) {
        e.preventDefault(); // Impede o envio padrão do formulário

        // Verifica se é um novo bloqueio (ID vazio)
        if (bloqueioIdInput.value === '') {
            const start = bloqueioStartInput.value;
            const end = bloqueioEndInput.value;
            const obs = bloqueioObsInput.value;

            fetch('salvar_bloqueio.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ start, end, obs })
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    alert('Bloqueio salvo com sucesso!');
                    calendar.refetchEvents(); // Recarrega todos os eventos
                    bloquearModal.hide();
                } else {
                    alert('Erro ao salvar bloqueio: ' + (data.erro || 'Erro desconhecido.'));
                }
            })
            .catch(error => {
                console.error('Erro na requisição de salvar bloqueio:', error);
                alert('Erro de comunicação ao tentar salvar bloqueio.');
            });
        }
        // As ações de edição/exclusão serão tratadas pelos listeners dos botões
    });


    // 2. Listener para o botão "Salvar Alterações" (EDIÇÃO)
    btnSalvarEdicaoBloqueio.addEventListener('click', function () {
        const id = bloqueioIdInput.value;
        const start = bloqueioStartInput.value;
        const end = bloqueioEndInput.value;
        const obs = bloqueioObsInput.value;

        fetch('editar_bloqueio.php', { 
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, start, end, obs })
        })
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                alert('Bloqueio alterado com sucesso!');
                calendar.refetchEvents();
                bloquearModal.hide();
            } else {
                alert('Erro ao alterar bloqueio: ' + (data.erro));
            }
        })
        .catch(error => {
            console.error('Erro na requisição de edição de bloqueio:', error);
            alert('Erro de comunicação ao tentar alterar bloqueio.');
        });
    });

    // 3. Listener para o botão "Excluir Bloqueio" (EXCLUSÃO)
    btnExcluirBloqueio.addEventListener('click', function () {
        const id = bloqueioIdInput.value;

        if (confirm('Tem certeza que deseja excluir este bloqueio?')) {
            fetch('excluir_bloqueio.php', { // Novo script PHP para exclusão
                method: 'POST', // Ou 'DELETE' se seu backend suportar e você configurar
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    alert('Bloqueio excluído com sucesso!');
                    calendar.refetchEvents();
                    bloquearModal.hide();
                } else {
                    alert('Erro ao excluir bloqueio: ' + (data.erro));
                }
            })
            .catch(error => {
                console.error('Erro na requisição de exclusão de bloqueio:', error);
                alert('Erro de comunicação ao tentar excluir bloqueio.');
            });
        }
    });

    // Oculta o modal quando ele for completamente escondido para garantir o estado
    bloquearModalElement.addEventListener('hidden.bs.modal', function () {
        formBloqueio.reset(); // Limpa o formulário quando o modal é fechado
    });
});