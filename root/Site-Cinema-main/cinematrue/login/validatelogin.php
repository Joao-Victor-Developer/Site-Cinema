<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// login.php
session_start();
include 'connectionLogin.php'; // usa a sua conexão já existente

// Pega POST (apenas email e senha conforme você pediu)
$email = isset($_POST['txt_email']) ? trim($_POST['txt_email']) : '';
$senha = isset($_POST['txt_senha']) ? $_POST['txt_senha'] : '';

// validação simples
if ($email === '' || $senha === '') {
    // mostra mensagem simples (pode trocar para redirect se preferir)
    echo "<!doctype html><html lang='pt-BR'><head><meta charset='utf-8'><title>Erro</title></head><body style='font-family:Arial, sans-serif; text-align:center; padding:40px;'>";
    echo "<h3>Informe email e senha.</h3>";
    echo "<p><a href='login.php'>Voltar ao login</a></p>";
    echo "</body></html>";
    exit;
}

// impede injection básico (mantendo estilo simples do segundo script)
$email_safe = mysqli_real_escape_string($conecta_db, $email);

// busca usuário pelo email
$sql = "SELECT id_user, cine_user, cine_email, cine_password 
        FROM tb_cinelogin 
        WHERE cine_email = '$email_safe' 
        LIMIT 1";

$result = mysqli_query($conecta_db, $sql);

if (!$result) {
    // erro na consulta
    echo "<!doctype html><html lang='pt-BR'><head><meta charset='utf-8'><title>Erro</title></head><body style='font-family:Arial, sans-serif; text-align:center; padding:40px;'>";
    echo "<h3>Erro no sistema. Tente novamente mais tarde.</h3>";
    echo "<p>Detalhe: " . htmlspecialchars(mysqli_error($conecta_db)) . "</p>";
    echo "</body></html>";
    exit;
}

if (mysqli_num_rows($result) === 0) {
    // não encontrou email
    echo "<!doctype html><html lang='pt-BR'><head><meta charset='utf-8'><title>Falha</title></head><body style='font-family:Arial, sans-serif; text-align:center; padding:40px;'>";
    echo "<h3>Email ou senha incorretos.</h3>";
    echo "<p><a href='login.php'>Voltar ao login</a></p>";
    echo "</body></html>";
    exit;
}

$row = mysqli_fetch_assoc($result);
mysqli_free_result($result);

// pega campos do banco
$user_id = $row['id_user'];
$user_nick = $row['cine_user'];
$user_email_db = $row['cine_email'];
$pass_db = $row['cine_password'];

// valida senha: suporta hash (password_hash) e texto plano (legacy)
$senha_valida = false;

if (password_verify($senha, $pass_db)) {
    $senha_valida = true;
} else {
    // fallback legacy (texto plano) — se bater, considera válido e atualiza o hash (opcional)
    if ($senha === $pass_db) {
        $senha_valida = true;
        // re-hash para aumentar segurança
        $novo_hash = password_hash($senha, PASSWORD_DEFAULT);
        $novo_hash_safe = mysqli_real_escape_string($conecta_db, $novo_hash);
        $upd_sql = "UPDATE tb_cinelogin SET cine_password = '$novo_hash_safe' WHERE id = " . intval($user_id);
        @mysqli_query($conecta_db, $upd_sql);
    }
}

if (!$senha_valida) {
    echo "<!doctype html><html lang='pt-BR'><head><meta charset='utf-8'><title>Falha</title></head><body style='font-family:Arial, sans-serif; text-align:center; padding:40px;'>";
    echo "<h3>Email ou senha incorretos.</h3>";
    echo "<p><a href='login.php'>Voltar ao login</a></p>";
    echo "</body></html>";
    exit;
}

// Login OK: define sessão e redireciona para index.html
session_regenerate_id(true);
$_SESSION['user_id'] = $user_id;
$_SESSION['user_nick'] = $user_nick;
$_SESSION['user_email'] = $user_email_db;

// fecha conexão e redireciona
mysqli_close($conecta_db);
header('Location: index.html');
exit;
?>
