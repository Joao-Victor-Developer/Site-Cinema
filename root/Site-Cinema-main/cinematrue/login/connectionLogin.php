<?php
//CONEXÃO COM O BANCO DE DADOS
$servidor="127.0.0.1";
$usuario="root";
$senha="usbw";
$banco="bd_cinefinder";
// cria a conexão
$conecta_db = mysqli_connect($servidor, $usuario, $senha, $banco);

// verifica se deu erro
if (!$conecta_db) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>