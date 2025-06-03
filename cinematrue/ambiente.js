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