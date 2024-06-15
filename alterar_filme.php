<?php
include 'db.php';
require_once("cabecalho.html");

// Verifica se o ID do filme foi passado via GET
if (isset($_GET['id'])) {
    $filme_id = $_GET['id'];

    // Verifica se o formulário foi submetido via POST para atualização
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $genero = $_POST['genero'];
        $duracao = $_POST['duracao'];

        // Query para atualizar os dados do filme no banco de dados
        $sql = "UPDATE filmes SET titulo = '$titulo', genero = '$genero', duracao = $duracao WHERE id = $filme_id";

        if ($conn->query($sql) === TRUE) {
            // Exibe mensagem de sucesso
            echo "<div class='alert alert-success'>Filme atualizado com sucesso</div>";
            // Redireciona de volta à página de listagem após 2 segundos
            echo "<script>setTimeout(function(){window.location.href='listar_filmes.php';}, 2000);</script>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao atualizar filme: " . $conn->error . "</div>";
        }

        $conn->close();
    } else {
        // Query para buscar os dados atuais do filme pelo ID
        $sql = "SELECT * FROM filmes WHERE id = $filme_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $titulo = $row['titulo'];
            $genero = $row['genero'];
            $duracao = $row['duracao'];
        } else {
            echo "<div class='alert alert-danger'>Filme não encontrado com o ID fornecido</div>";
        }
    }
} else {
    echo "<div class='alert alert-danger'>ID do filme não fornecido para alteração</div>";
}

// Formulário de alteração de filme
?>
<h3>Alterar Filme</h3>
<form method="POST" action="alterar_filme.php?id=<?= $filme_id ?>">
    <div class="row">
        <div class="col">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= isset($titulo) ? $titulo : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="genero" class="form-label">Gênero:</label>
            <input type="text" class="form-control" id="genero" name="genero" value="<?= isset($genero) ? $genero : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="duracao" class="form-label">Duração (minutos):</label>
            <input type="number" class="form-control" id="duracao" name="duracao" value="<?= isset($duracao) ? $duracao : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary mt-3">Atualizar Filme</button>
        </div>
    </div>
</form>

<?php
require_once("rodape.html");
?>
