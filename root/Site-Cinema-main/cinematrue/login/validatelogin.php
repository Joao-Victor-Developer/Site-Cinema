<?php
session_start();
include 'connectionLogin.php'; // sua conexão: $conecta_db

// Pega dados do formulário
$email = isset($_POST["txt_email"]) ? trim($_POST["txt_email"]) : '';
$senha = isset($_POST["txt_senha"]) ? $_POST["txt_senha"] : '';

if ($email === '' || $senha === '') {
    echo "<center><h2>Preencha todos os campos!</h2></center>";
    echo "<a href='login.php'>Voltar</a>";
    exit;
}

// Consulta usuário
$sql = "SELECT id_user, cine_user, cine_email, cine_password 
        FROM tb_cinelogin 
        WHERE cine_email = ?";
$stmt = mysqli_prepare($conecta_db, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conecta_db));
}

if (mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result);

    // Verifica senha (hash ou texto puro)
    if (password_verify($senha, $usuario['cine_password']) || $senha === $usuario['cine_password']) {
        // Login OK → salva sessão
        $_SESSION["user_id"]   = $usuario['id_user'];
        $_SESSION["user_nick"] = $usuario['cine_user'];
        $_SESSION["user_email"]= $usuario['cine_email'];

        echo "<center><h2>Login realizado com sucesso! Bem-vindo, {$usuario['cine_user']}!</h2></center>";
        echo "<a href='../index.html'>Ir para página inicial</a>";
    } else {
        echo "<center><h2>Email ou senha inválidos!</h2></center>";
        echo "<a href='login.php'>Tentar novamente</a>";
    }
} else {
    echo "<center><h2>Email não encontrado!</h2></center>";
    echo "<a href='login.php'>Tentar novamente</a>";
}

mysqli_close($conecta_db);
?>
<img src="img/logo.png" alt="Página inicial" onclick="window.location.href='../index.html'" style="cursor: pointer; position: fixed; top: 10px; left: 10px; width: 120px; z-index: 15;">