<?php
include('../../config/config.php');

// Verificar se o parâmetro 'cod_entrega' foi passado
if (isset($_GET['cod_entrega'])) {
    $cod_entrega = $_GET['cod_entrega'];

    // Preparar e executar a consulta para buscar os detalhes da entrega
    $query = "SELECT * FROM entregas WHERE cod_entrega = ?";
    
    // Preparar a consulta
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Vincular o parâmetro
        mysqli_stmt_bind_param($stmt, "s", $cod_entrega);

        // Executar a consulta
        mysqli_stmt_execute($stmt);

        // Obter o resultado
        $result = mysqli_stmt_get_result($stmt);

        // Buscar os dados da entrega
        $entrega = mysqli_fetch_assoc($result);

        if ($entrega) {
            // Retornar os dados da entrega em HTML
            echo "<h5>Entrega Código: " . htmlspecialchars($entrega['cod_entrega']) . "</h5>";
            echo "<p>Cod Paciente: " . htmlspecialchars($entrega['cod_paciente']) . "</p>";
            echo "<p>Data Entrega: " . htmlspecialchars($entrega['data_entrega']) . "</p>";
            echo "<p>Cod Processo: " . htmlspecialchars($entrega['cod_processo']) . "</p>";
        } else {
            echo "<p>Entrega não encontrada.</p>";
        }

        // Fechar a declaração
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Erro ao preparar a consulta.</p>";
    }

    // Fechar a conexão
    mysqli_close($conn);
} else {
    echo "<p>Código da entrega não especificado.</p>";
}
?>
