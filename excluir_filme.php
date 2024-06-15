<?php
include 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    $sql = "DELETE FROM filmes WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        // Exibindo mensagem de sucesso
        echo "<div class='alert alert-success'>Filme excluído com sucesso</div>";
        // Redirecionando de volta à página de listagem após 2 segundos
        echo "<script>setTimeout(function(){window.location.href='listar_filmes.php';}, 2000);</script>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir filme: " . $conn->error . "</div>";
    }

    $conn->close();
} else {
    echo "<div class='alert alert-warning'>ID do filme não especificado para exclusão</div>";
}
?>
