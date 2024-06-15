<?php
// Inclua o arquivo de conexão com o banco de dados
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Atualiza os dados do cliente no banco de dados
    $sql = "UPDATE clientes SET nome = '$nome', telefone = '$telefone', email = '$email' WHERE id = $cliente_id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Cliente atualizado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar cliente: " . $conn->error . "</div>";
    }

    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>
