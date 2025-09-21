<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
      width: 100%;
      max-width: 400px;
    }

    .form-container h2 {
      margin-bottom: 25px;
      font-size: 26px;
      color: #222;
      text-align: center;
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
      text-align: center;
    }

    .form-container a {
      color: #007bff;
      text-decoration: none;
    }

    .form-container a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <!-- Fundos animados -->
  <div class="bg-row bg-top" id="top-row"></div>
  <div class="bg-row bg-bottom" id="bottom-row"></div>

  <!-- Overlay -->
  <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(252, 227, 0, 0.55); z-index: 5; pointer-events: none;"></div>

  <!-- Formulário adaptado -->
   <form name="form_login" action="validatelogin.php" method="post">
    <div class="form-container">
      <h2>Login</h2>
            <label for="txt_email">Email:</label>
            <input type="text" id="txt_email" name="txt_email" required><br><br>

            <label for="txt_senha">Senha:</label>
            <input type="password" id="txt_senha" name="txt_senha" required><br><br>

            <input type="submit" name="bt_logar" value="Entrar">
            <input type="button" name="bt_cadastro" value="Fazer cadastro" onclick="window.location.href='cadastro.php'">
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
          img.alt = Cartaz ${poster};
          container.appendChild(img);
        }
      }
    }

    gerarFileira("top-row");
    gerarFileira("bottom-row");
  </script>
</body>
</html>