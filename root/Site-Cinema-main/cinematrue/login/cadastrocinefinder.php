<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Usuário</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body, html {
      height: 100%;
      overflow: hidden;
      background-color: #000;
      position: relative;
    }

    .bg-row {
      position: absolute;
      width: 200%;
      height: 50%;
      display: flex;
      z-index: 0;
    }

    .bg-top {
      top: 0;
      left: 0;
      animation: scrollLeft 40s linear infinite;
    }

    .bg-bottom {
      bottom: 0;
      right: 0;
      animation: scrollRight 40s linear infinite;
    }

    .bg-row img {
      height: 100%;
      object-fit: cover;
      opacity: 0.85;
    }

    @keyframes scrollLeft {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    @keyframes scrollRight {
      0% { transform: translateX(0); }
      100% { transform: translateX(50%); }
    }

    .form-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 10;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.8);
      
      
    }

    .form-container h2 {
      margin-bottom: 25px;
      font-size: 26px;
      color: #222;
    }

    .form-container input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #999;
      border-radius: 6px;
      font-size: 14px;
    }

    .form-container button {
      width: 100%;
      padding: 12px;
      background-color: #222;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
    }

    .form-container button:hover {
      background-color: #444;
    }

    .form-container p {
      margin-top: 10px;
      font-size: 13px;
    }

    .form-container a {
      color: #007bff;
      text-decoration: none;
    }

    .form-container a:hover {
      text-decoration: underline;
    }

    #msg {
      margin-top: 15px;
      font-size: 14px;
      color: #b30000;
    }
    
  </style>
</head>
<header>
<img src="img/logo.png" alt="Página inicial" onclick="window.location.href='../index.html'" style="cursor: pointer; position: fixed; top: 10px; left: 10px; width: 120px; z-index: 15;">
</header>
<body>
  <div class="bg-row bg-top" id="top-row"></div>
  <div class="bg-row bg-bottom" id="bottom-row"></div>

  <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(252, 227, 0, 0.547); z-index: 5; pointer-events: none;"></div>

  <form name="cadastro_form" method="post" action="cadastrar.php">
  <div class="form-container">
    <h2>Cadastro</h2>
    <input type="text" name="txt_nome" placeholder="Nome" />
    <input type="email" name="txt_email" placeholder="Email" />
    <input type="password" name="txt_senha" placeholder="Senha" />
    <input type="text" name="txt_nickname" placeholder="Nickname (Apelido)">
    Sua categoria de filmes favorita:
    <div>
    Ação e Aventura<input type="radio" name="Opcao" value="Acao_Aventura">
    Comédia<input type="radio" name="Opcao" value="Comedia">
    Terror<input type="radio" name="Opcao" value="Terror">
    Ficção Científica<input type="radio" name="Opcao" value="Ficcao_cientifica">
    Documentário<input type="radio" name="Opcao" value="Documentario">
    Romance<input type="radio" name="Opcao" value="Romance">
    Misterio<input type="radio" name="Opcao" value="Misterio">
    </div>
    <input type="submit" name="bt_incluir" value="Cadastrar!">
    <p>Possui uma conta? <a href="login.php">Faça o Login</a></p>
  </div>
  </form>
  

  <script>
    const posters = [
      "img/monkey.avif",
      "img/flow.jpg",
      "img/vitoria.jpg",
      "img/aindaestouaqui.avif"
    ];

    function gerarFileira(id, repeticoes = 4) {
      const container = document.getElementById(id);
      for (let i = 0; i < repeticoes; i++) {
        for (let poster of posters) {
          const img = document.createElement('img');
          img.src = poster;
          img.alt = `Cartaz ${poster}`;
          container.appendChild(img);
        }
      }
    }

    gerarFileira("top-row");
    gerarFileira("bottom-row");
  </script>
</body>
</html>
