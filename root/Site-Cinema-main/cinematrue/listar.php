<?php
include 'conexao.php';

$sql = "SELECT usuario, mensagem, data_envio FROM mensagens ORDER BY id DESC LIMIT 20";
$result = $conn->query($sql);

$mensagens = [];
while($row = $result->fetch_assoc()) {
    $mensagens[] = $row;
}

echo json_encode($mensagens);
$conn->close();
?>