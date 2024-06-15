<?php
include 'db.php';
require_once("cabecalho.html");

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    $sql = "DELETE FROM sessoes WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        // Exibindo mensagem de sucesso
        echo "<div class='alert alert-success'>Sessão excluída com sucesso</div>";
        // Redirecionando de volta à página de listagem após 2 segundos
        echo "<script>setTimeout(function(){window.location.href='listar_sessoes.php';}, 2000);</script>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir sessão: " . $conn->error . "</div>";
    }

    $conn->close();
} else {
    echo "<div class='alert alert-danger'>ID de sessão não fornecido para exclusão</div>";
}

require_once("rodape.html");
?>
