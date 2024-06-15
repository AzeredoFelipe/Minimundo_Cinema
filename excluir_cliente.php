<?php
include 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    $sql = "DELETE FROM clientes WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        // Exibindo mensagem de sucesso
        echo "<div class='alert alert-success'>Cliente excluído com sucesso</div>";
        // Redirecionando de volta à página de listagem após 2 segundos
        echo "<script>setTimeout(function(){window.location.href='listar_clientes.php';}, 2000);</script>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir cliente: " . $conn->error . "</div>";
    }

    $conn->close();
} else {
    echo "<div class='alert alert-warning'>ID do cliente não especificado para exclusão</div>";
}
?>
