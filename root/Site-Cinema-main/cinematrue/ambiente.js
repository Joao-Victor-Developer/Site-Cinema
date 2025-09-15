function home() {
            window.location.href = "index.html";
        }
        function comunidade() {
            window.location.href = "comunidade.html";
        }
        function login() {
            window.location.href = "login.html";
        }

        function buscar() {
            window.location.href = "busca_localizacao.html";
        }

        window.onload = function () {
            var botao = document.body;
            var img = document.getElementById("inverter");

            if (!botao.classList.contains("modo_escuro")) {
                img.style.filter = "invert(0)";
            }

            function abrirPagina(imagem) {
                window.location.href = `pagina_filme.html?img=${encodeURIComponent(imagem)}`;
            }
        };

        function escuro() {
            var botao = document.body;
            botao.classList.toggle("modo_escuro");

            var img = document.getElementById("inverter");
            if (botao.classList.contains("modo_escuro")) {
                img.style.filter = "invert(1)";
            } else {
                img.style.filter = "invert(0)";
            }

        }

window.onload = function () {
    const mensagensdiv = document.getElementsByClassName('mensagens')[0];
    const mensagem = document.getElementById('input-mensagem');
    const agora = new Date()
    const Tempo = agora.toLocaleString

    window.EnviarMensagem = function () {
        const div = document.createElement('div');
        const linha = document.createElement('hr');
        div.textContent = mensagem.value // Mais seguro que innerHTML
        mensagensdiv.appendChild(div);
        mensagensdiv.appendChild(linha);
        mensagensdiv.scrollTop = mensagensdiv.scrollHeight;
        mensagem.value = ''; // Limpa o input após envio
    };
};

document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('input-mensagem');
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                EnviarMensagem();
            }
        });
    });