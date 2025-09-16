<?php
include 'connectionLogin.php';

$email = $_POST["txt_email"];
$nome = $_POST["txt_nome"];
$senha = $_POST["txt_senha"];
$nickname = $_POST["txt_nickname"];
$CategoriaFavorito = $_POST["Opcao"];

// consulta para verificar se já existe Email
$sql = "SELECT * FROM tb_cinelogin WHERE `cine_email` = '$email'";
$result = mysqli_query($conecta_db, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conecta_db));
}

if (mysqli_num_rows($result) > 0) {
    echo "<center>";
    echo "<hr>";
    echo "CONTA EXISTENTE!";
    echo "</hr>";	
} else {
    $insert = "INSERT INTO tb_cinelogin (`cine_user`, `cine_email`, `cine_password`, `cine_type_movie`) VALUES ('$nickname', '$email', '$senha', '$CategoriaFavorito')";
    if (mysqli_query($conecta_db, $insert)) {
        echo "<center>";
        echo "<hr>";
        echo "CONTA CADASTRADA";
        echo "</hr>"; 
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conecta_db);
    }
}
?>