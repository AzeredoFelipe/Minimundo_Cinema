<?php
require_once("cabecalho.html");
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessao_id = $_POST['sessao_id'];
    $cliente_id = $_POST['cliente_id'];

    $sql = "INSERT INTO ingressos (sessao_id, cliente_id) VALUES ($sessao_id, $cliente_id)";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Ingresso vendido com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao vender ingresso: " . $conn->error . "</div>";
    }
}

$sql_sessoes = "SELECT sessoes.id, filmes.titulo 
               FROM sessoes 
               JOIN filmes ON sessoes.filme_id = filmes.id";
$result_sessoes = $conn->query($sql_sessoes);

$sql_clientes = "SELECT id, nome FROM clientes";
$result_clientes = $conn->query($sql_clientes);
?>

<h3>Vender Ingresso</h3>
<form method="POST" action="vender_ingresso.php">
    <div class="row">
        <div class="col">
            <label for="sessao_id" class="form-label">Sessão:</label>
            <select class="form-select" id="sessao_id" name="sessao_id" required>
                <?php while ($row = $result_sessoes->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['titulo'] ?> (<?= $row['id'] ?>)</option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="cliente_id" class="form-label">Cliente:</label>
            <select class="form-select" id="cliente_id" name="cliente_id" required>
                <?php while ($row = $result_clientes->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nome'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-success mt-3">Vender</button>
        </div>
    </div>
</form>

<?php
require_once("rodape.html");
?>
