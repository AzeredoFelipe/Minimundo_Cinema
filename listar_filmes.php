<?php
require_once("cabecalho.html");
include 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM filmes WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Filme excluído com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir filme: " . $conn->error . "</div>";
    }
}

$sql = "SELECT id, titulo, genero, duracao FROM filmes";
$result = $conn->query($sql);
?>

<div class="row">
    <div class="col">
        <h3>Lista de Filmes</h3>
    </div>
</div>

<?php if ($result->num_rows > 0): ?>
    <table class="table table-responsive table-hover table-striped mt-4">
        <thead>
            <tr>
                <th>Título</th>
                <th>Gênero</th>
                <th>Duração</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['titulo'] ?></td>
                    <td><?= $row['genero'] ?></td>
                    <td><?= $row['duracao'] ?> minutos</td>
                    <td>
                        <a href="alterar_filme.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="excluir_filme.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info mt-3">Nenhum filme encontrado.</div>
<?php endif; ?>

<?php
require_once("rodape.html");
?>
