<?php
require_once("cabecalho.html");
include 'db.php';

$sql = "SELECT id, nome, email FROM clientes";
$result = $conn->query($sql);
?>

<div class="row">
    <div class="col">
        <h3>Gerenciamento de Clientes</h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <a href="cadastrar_cliente.php" class="btn btn-primary mt-3">Adicionar Cliente</a>
    </div>
</div>

<div class="row">
    <div class="col">
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-responsive table-hover table-striped mt-4">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['nome'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <a href="alterar_cliente.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                <a href="excluir_cliente.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info mt-3">Nenhum cliente encontrado.</div>
        <?php endif; ?>
    </div>
</div>

<?php
require_once("rodape.html");
?>
