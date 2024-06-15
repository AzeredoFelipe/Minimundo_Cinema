<?php
require_once("cabecalho.html");
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO clientes (nome, telefone, email) VALUES ('$nome', '$telefone', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Novo cliente cadastrado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao cadastrar cliente: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>

<h3>Cadastrar Cliente</h3>
<form method="POST" action="cadastrar_cliente.php">
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
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
