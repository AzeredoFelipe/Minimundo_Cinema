<?php
require_once("cabecalho.html");
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $duracao = $_POST['duracao'];

    $sql = "INSERT INTO filmes (titulo, genero, duracao) VALUES ('$titulo', '$genero', $duracao)";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Novo filme cadastrado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao cadastrar filme: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>

<h3>Cadastrar Filme</h3>
<form method="POST" action="cadastrar_filme.php">
    <div class="row">
        <div class="col">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="genero" class="form-label">Gênero:</label>
            <input type="text" class="form-control" id="genero" name="genero" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="duracao" class="form-label">Duração (minutos):</label>
            <input type="number" class="form-control" id="duracao" name="duracao" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-success mt-3">Cadastrar</button>
        </div>
    </div>
</form>

<?php
require_once("rodape.html");
?>
