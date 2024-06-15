<?php
include 'db.php';
require_once("cabecalho.html");

// Verifica se o ID da sessão foi passado via GET
if (isset($_GET['id'])) {
    $sessao_id = $_GET['id'];

    // Verifica se o formulário foi submetido via POST para atualização
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $filme_id = $_POST['filme_id'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];

        // Query para atualizar os dados da sessão no banco de dados
        $sql = "UPDATE sessoes SET filme_id = $filme_id, data = '$data', horario = '$horario' WHERE id = $sessao_id";

        if ($conn->query($sql) === TRUE) {
            // Exibe mensagem de sucesso
            echo "<div class='alert alert-success'>Sessão atualizada com sucesso</div>";
            // Redireciona de volta à página de listagem após 2 segundos
            echo "<script>setTimeout(function(){window.location.href='listar_sessoes.php';}, 2000);</script>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao atualizar sessão: " . $conn->error . "</div>";
        }

        $conn->close();
    } else {
        // Query para buscar os dados atuais da sessão pelo ID
        $sql = "SELECT * FROM sessoes WHERE id = $sessao_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $filme_id = $row['filme_id'];
            $data = $row['data'];
            $horario = $row['horario'];
        } else {
            echo "<div class='alert alert-danger'>Sessão não encontrada com o ID fornecido</div>";
        }
    }
} else {
    echo "<div class='alert alert-danger'>ID da sessão não fornecido para alteração</div>";
}

// Query para buscar todos os filmes para o dropdown
$filmes_sql = "SELECT id, titulo FROM filmes";
$filmes_result = $conn->query($filmes_sql);

// Formulário de alteração de sessão
?>
<h3>Alterar Sessão</h3>
<form method="POST" action="alterar_sessao.php?id=<?= $sessao_id ?>">
    <div class="row">
        <div class="col">
            <label for="filme_id" class="form-label">Filme:</label>
            <select class="form-select" id="filme_id" name="filme_id" required>
                <?php
                while ($filme = $filmes_result->fetch_assoc()) {
                    $selected = ($filme_id == $filme['id']) ? 'selected' : '';
                    echo "<option value='" . $filme['id'] . "' $selected>" . $filme['titulo'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="data" class="form-label">Data:</label>
            <input type="date" class="form-control" id="data" name="data" value="<?= isset($data) ? $data : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="horario" class="form-label">Horário:</label>
            <input type="time" class="form-control" id="horario" name="horario" value="<?= isset($horario) ? $horario : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary mt-3">Atualizar Sessão</button>
        </div>
    </div>
</form>

<?php
require_once("rodape.html");
?>
