<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
<STYle>
  /* Reset básico */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f0f2f5;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

/* Formulário */
.login-form {
  width: 100%;
  max-width: 400px;
  background: #fff;
  padding: 30px 25px;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

/* Fieldset e legend */
.login-form fieldset {
  border: none;
}

.login-form legend {
  font-size: 1.4rem;
  font-weight: bold;
  margin-bottom: 20px;
  color: #333;
  border-bottom: 2px solid #4a90e2;
  padding-bottom: 5px;
}

/* Labels e inputs */
.login-form label {
  display: block;
  margin-bottom: 6px;
  font-weight: 500;
  color: #444;
}

.login-form input[type="text"],
.login-form input[type="password"] {
  width: 100%;
  padding: 10px 12px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 1rem;
  transition: border-color 0.3s;
}

.login-form input[type="text"]:focus,
.login-form input[type="password"]:focus {
  border-color: #4a90e2;
  outline: none;
}

/* Botões */
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
  background-color: #4a90e2;
  color: white;
}

.login-form input[type="submit"]:hover {
  background-color: #357ABD;
}

.login-form input[type="reset"] {
  background-color: #e0e0e0;
  color: #333;
}

.login-form input[type="reset"]:hover {
  background-color: #cacaca;
}

</STYle>
</head>
<body>
 


  
      <form name="form_login" method="post" class="login-form">
  <fieldset>
    <legend>Identificação do Login</legend>

    <label for="usuario">Usuário ou E-mail:</label>
    <input id="usuario" type="text" name="txt_usuario" required>

    <label for="senha">Senha:</label>
    <input id="senha" type="password" name="txt_senha" required>

    <div class="buttons">
      <input type="submit" name="bt_autenticar" value="Entrar" onclick="document.form_login.action='validatelogin.php'">
      <input type="reset" value="Limpar">
    </div>
  </fieldset>
</form>

    


</body>
</html>
