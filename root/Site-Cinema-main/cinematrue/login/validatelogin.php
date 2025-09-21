<?php
session_start();
include 'connectionLogin.php'; // ajuste o caminho se necessário

// pegar POST
$input = isset($_POST['txt_usuario']) ? trim($_POST['txt_usuario']) : '';
$pass  = isset($_POST['txt_senha']) ? $_POST['txt_senha'] : '';

// validação simples
if ($input === '' || $pass === '') {
    $_SESSION['login_error'] = 'Informe usuário (ou email) e senha.';
    header('Location: login.php');
    exit;
}

// preparar e executar consulta (busca por email OU nickname)
$sql = "SELECT id, cine_user, cine_email, cine_password FROM tb_cinelogin WHERE cine_email = ? OR cine_user = ? LIMIT 1";
$stmt = mysqli_prepare($conecta_db, $sql);
if (!$stmt) {
    $_SESSION['login_error'] = 'Erro no sistema. Tente novamente mais tarde.';
    header('Location: login.php');
    exit;
}
mysqli_stmt_bind_param($stmt, "ss", $input, $input);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) === 0) {
    mysqli_stmt_close($stmt);
    $_SESSION['login_error'] = 'Email ou senha incorretos.';
    header('Location: login.php');
    exit;
}

mysqli_stmt_bind_result($stmt, $id, $cine_user, $cine_email, $cine_password);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// valida a senha (suporta hash e caso legacy em texto plano)
$senha_valida = false;

if (password_verify($pass, $cine_password)) {
    $senha_valida = true;
} else {
    if ($pass === $cine_password) {
        $senha_valida = true;
        // re-hash para melhorar segurança (opcional)
        $novo_hash = password_hash($pass, PASSWORD_DEFAULT);
        $upd = mysqli_prepare($conecta_db, "UPDATE tb_cinelogin SET cine_password = ? WHERE id = ?");
        if ($upd) {
            mysqli_stmt_bind_param($upd, "si", $novo_hash, $id);
            mysqli_stmt_execute($upd);
            mysqli_stmt_close($upd);
        }
    }
}

if (!$senha_valida) {
    $_SESSION['login_error'] = 'Email ou senha incorretos.';
    header('Location: login.php');
    exit;
}

// login OK: proteger sessão e redirecionar para index.html (página inicial)
session_regenerate_id(true);
$_SESSION['user_id']    = $id;
$_SESSION['user_nick']  = $cine_user;
$_SESSION['user_email'] = $cine_email;

// fechar conexão e redirecionar para a página inicial estática
mysqli_close($conecta_db);
header('Location: index.html'); // redireciona para a sua página inicial
exit;
