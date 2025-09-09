
<head>
        <meta charset="UTF-8">
        <title>Área de Segurança</title>
        <style type="text/css">
           @import url("stile.css");
        </style>
<?php
include 'connectionLogin.php';

$user = $_POST["txt_usuario"];
$email = $_POST["txt_email"];
$pass = $_POST["txt_senha"];

$sql = mysql_query("SELECT * FROM tb_cinelogin
                    WHERE usuario='$user' or email='$email'");
if (mysql_num_rows($sql) > 0) {
    echo "<center>";
    echo "<hr>";
    echo "CONTA EXISTENTE!!!";
    echo "<hr>";
    echo "<br>";
} else {
    $sql = mysql_query("INSERT INTO tb_login (usuario,email,senha)
                        VALUES ('$user','$email','$pass')");
    echo "<center>";
    echo "<hr>";
    echo "CONTA CRIADA COM SUCESSO !!!";
    echo "<hr>";
    echo "<br>";
}
   
?>