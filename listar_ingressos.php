<?php
require_once("cabecalho.html");
include 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM ingressos WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Ingresso excluído com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir ingresso: " . $conn->error . "</div>";
    }
}

$sql = "SELECT ingressos.id, filmes.titulo, sessoes.data, sessoes.horario, clientes.nome 
        FROM ingressos 
        JOIN sessoes ON ingressos.sessao_id = sessoes.id 
        JOIN filmes ON sessoes.filme_id = filmes.id 
        JOIN clientes ON ingressos.cliente_id = clientes.id";
$result = $conn->query($sql);
?>

<div class="row">
    <div class="col">
        <h3>Lista de Ingressos Vendidos</h3>
    </div>
</div>

<?php if ($result->num_rows > 0): ?>
    <table class="table table-responsive table-hover table-striped mt-4">
        <thead>
            <tr>
                <th>Filme</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Cliente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['titulo'] ?></td>
                    <td><?= $row['data'] ?></td>
                    <td><?= $row['horario'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td>
                        <a href="listar_ingressos.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info mt-3">Nenhum ingresso encontrado.</div>
<?php endif; ?>

<?php
require_once("rodape.html");
?>
