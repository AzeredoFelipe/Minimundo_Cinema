<?php
// Inclua o arquivo de conexão com o banco de dados
include 'db.php';

// Verifique se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filme_id = $_POST['filme_id'];
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $duracao = $_POST['duracao'];

    // Construa a consulta SQL para atualizar o filme
    $sql = "UPDATE filmes SET titulo = '$titulo', genero = '$genero', duracao = $duracao WHERE id = $filme_id";

    // Execute a consulta SQL e verifique se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Filme atualizado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar filme: " . $conn->error . "</div>";
    }

    // Feche a conexão com o banco de dados
    $conn->close();
} else {
    // Se o método de requisição não for POST, exiba uma mensagem de erro
    echo "<div class='alert alert-danger'>Método de requisição inválido</div>";
}
?>
