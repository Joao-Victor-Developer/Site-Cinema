<?php
$servidor = "localhost";
$usuario = "root";
$senha = "usbw";  // Se necessário altere para a sua senha Ivan
$banco = "chatdb";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>