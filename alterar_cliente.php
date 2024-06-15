<?php
include 'db.php';
require_once("cabecalho.html");

// Verifica se o ID do cliente foi passado via GET
if (isset($_GET['id'])) {
    $cliente_id = $_GET['id'];

    // Verifica se o formulário foi submetido via POST para atualização
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        // Query para atualizar os dados do cliente no banco de dados
        $sql = "UPDATE clientes SET nome = '$nome', telefone = '$telefone', email = '$email' WHERE id = $cliente_id";

        if ($conn->query($sql) === TRUE) {
            // Exibe mensagem de sucesso
            echo "<div class='alert alert-success'>Cliente atualizado com sucesso</div>";
            // Redireciona de volta à página de listagem após 2 segundos
            echo "<script>setTimeout(function(){window.location.href='listar_clientes.php';}, 2000);</script>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao atualizar cliente: " . $conn->error . "</div>";
        }

        $conn->close();
    } else {
        // Query para buscar os dados atuais do cliente pelo ID
        $sql = "SELECT * FROM clientes WHERE id = $cliente_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome = $row['nome'];
            $telefone = $row['telefone'];
            $email = $row['email'];
        } else {
            echo "<div class='alert alert-danger'>Cliente não encontrado com o ID fornecido</div>";
        }
    }
} else {
    echo "<div class='alert alert-danger'>ID do cliente não fornecido para alteração</div>";
}

// Formulário de alteração de cliente
?>
<h3>Alterar Cliente</h3>
<form method="POST" action="alterar_cliente.php?id=<?= $cliente_id ?>">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($nome) ? $nome : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?= isset($telefone) ? $telefone : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= isset($email) ? $email : '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary mt-3">Atualizar Cliente</button>
        </div>
    </div>
</form>

<?php
require_once("rodape.html");
?>
