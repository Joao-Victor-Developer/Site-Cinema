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

async function EnviarMensagem() {
    const input = document.getElementById("input-mensagem");
    const texto = input.value.trim();
    if (texto === "") return;

    await fetch("enviar.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "mensagem=" + encodeURIComponent(texto)
    });

    input.value = "";
    CarregarMensagens();
}

async function CarregarMensagens() {
    const resp = await fetch("listar.php");
    const dados = await resp.text();

    const divMensagens = document.querySelector(".mensagens");
    divMensagens.innerHTML = "";
    dados.forEach(msg => {
        const p = document.createElement("p");
        p.textContent = `[${msg.data_envio}] ${msg.usuario}: ${msg.mensagem}`;
        divMensagens.appendChild(p);
    });
}

// atualiza a cada 2s
setInterval(CarregarMensagens, 2000);
CarregarMensagens();
