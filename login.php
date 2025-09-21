<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    /* Reset básico */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    html, body {
      height: 100%;
      overflow: hidden;
      background-color: #000;
      position: relative;
    }

    /* Fundo animado */
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

    /* Sobreposição amarela suave */
    .overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(252, 227, 0, 0.45);
      z-index: 5;
      pointer-events: none;
    }

    /* Estilo do formulário original com tom amarelo */
    .login-form {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 10;
      width: 100%;
      max-width: 400px;
      background: rgba(255, 255, 255, 0.95);
      padding: 30px 25px;
      border-radius: 8px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
      border: 2px solid #e1c200;
    }

    .login-form fieldset {
      border: none;
    }

    .login-form legend {
      font-size: 1.6rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #222;
      border-bottom: 3px solid #e1c200;
      padding-bottom: 5px;
      text-align: center;
    }

    .login-form label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: #333;
    }

    .login-form input[type="text"],
    .login-form input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border: 1px solid #bbb;
      border-radius: 6px;
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    .login-form input[type="text"]:focus,
    .login-form input[type="password"]:focus {
      border-color: #e1c200;
      outline: none;
    }

    .login-form .buttons {
      display: flex;
      justify-content: space-between;
    }

    .login-form input[type="submit"],
    .login-form input[type="reset"] {
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .login-form input[type="submit"] {
      background-color: #e1c200;
      color: #000;
    }

    .login-form input[type="submit"]:hover {
      background-color: #d1af00;
    }

    .login-form input[type="reset"] {
      background-color: #e0e0e0;
      color: #333;
    }

    .login-form input[type="reset"]:hover {
      background-color: #cacaca;
    }
  </style>
</head>
<body>

  <!-- Fundos animados com pôsteres -->
  <div class="bg-row bg-top" id="top-row"></div>
  <div class="bg-row bg-bottom" id="bottom-row"></div>

  <!-- Sobreposição amarela -->
  <div class="overlay"></div>

  <!-- Formulário raiz com estilo aplicado -->
<form name="form_login" method="post" action="validatelogin.php" class="login-form" accept-charset="utf-8">
  <fieldset>
    <legend>Identificação do Login</legend>

    <label for="usuario">Usuário ou E-mail:</label>
    <input id="usuario" type="text" name="txt_usuario" required autocomplete="username" maxlength="100" autofocus>

    <label for="senha">Senha:</label>
    <input id="senha" type="password" name="txt_senha" required autocomplete="current-password" maxlength="72">

    <div class="buttons">
      <button type="submit" name="bt_autenticar">Entrar</button>
      <input type="reset" value="Limpar">
    </div>
  </fieldset>
</form>

  <!-- Script para gerar imagens animadas -->
  <script>
    const posters = [
      "../cinematrue/img/monkey.avif",
      "../cinematrue/img/flow.jpg",
      "../cinematrue/img/vitoria.jpg",
      "../cinematrue/img/aindaestouaqui.avif"
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
