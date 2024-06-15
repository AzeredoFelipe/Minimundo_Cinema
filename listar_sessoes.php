<?php
require_once("cabecalho.html");
include 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM sessoes WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Sessão excluída com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir sessão: " . $conn->error . "</div>";
    }
}

$sql = "SELECT sessoes.id, filmes.titulo, sessoes.data, sessoes.horario 
        FROM sessoes 
        JOIN filmes ON sessoes.filme_id = filmes.id";
$result = $conn->query($sql);
?>

<div class="row">
    <div class="col">
        <h3>Lista de Sessões</h3>
    </div>
</div>

<?php if ($result->num_rows > 0): ?>
    <table class="table table-responsive table-hover table-striped mt-4">
        <thead>
            <tr>
                <th>Filme</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['titulo'] ?></td>
                    <td><?= $row['data'] ?></td>
                    <td><?= $row['horario'] ?></td>
                    <td>
                        <a href="alterar_sessao.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="excluir_sessao.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info mt-3">Nenhuma sessão encontrada.</div>
<?php endif; ?>

<?php
require_once("rodape.html");
?>
