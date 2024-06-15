<?php
// Inclua o arquivo de conexão com o banco de dados
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessao_id = $_POST['sessao_id'];
    $filme_id = $_POST['filme_id'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    // Atualiza os dados da sessão no banco de dados
    $sql = "UPDATE sessoes SET filme_id = $filme_id, data = '$data', horario = '$horario' WHERE id = $sessao_id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Sessão atualizada com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar sessão: " . $conn->error . "</div>";
    }

    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>
