<?php
require_once("cabecalho.html");
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filme_id = $_POST['filme_id'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    $sql = "INSERT INTO sessoes (filme_id, data, horario) VALUES ($filme_id, '$data', '$horario')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Nova sessão cadastrada com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao cadastrar sessão: " . $conn->error . "</div>";
    }
}

$sql_filmes = "SELECT id, titulo FROM filmes";
$result_filmes = $conn->query($sql_filmes);
?>

<h3>Cadastrar Sessão</h3>
<form method="POST" action="cadastrar_sessao.php">
    <div class="row">
        <div class="col">
            <label for="filme_id" class="form-label">Filme:</label>
            <select class="form-select" id="filme_id" name="filme_id" required>
                <?php while ($row = $result_filmes->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['titulo'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="data" class="form-label">Data:</label>
            <input type="date" class="form-control" id="data" name="data" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="horario" class="form-label">Horário:</label>
            <input type="time" class="form-control" id="horario" name="horario" required>
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
