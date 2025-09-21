<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = "Anônimo"; // depois pode trocar para login
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO mensagens (usuario, mensagem) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $mensagem);

    if ($stmt->execute()) {
        echo "Mensagem enviada!";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>