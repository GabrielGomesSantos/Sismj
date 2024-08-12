<?php
include('../../config/config.php');

// Verificar se o parâmetro 'cod_paciente' foi passado
if (isset($_GET['cod_paciente'])) {
    $cod_paciente = $_GET['cod_paciente'];

    // Preparar e executar a consulta para buscar os detalhes da entrega
    $query = "SELECT * FROM processos WHERE cod_paciente = ?";
    
    // Preparar a consulta
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Vincular o parâmetro
        mysqli_stmt_bind_param($stmt, "s", $cod_paciente);

        // Executar a consulta
        mysqli_stmt_execute($stmt);

        // Obter o resultado
        $result = mysqli_stmt_get_result($stmt);

        // Buscar os dados da entrega
        $entrega = mysqli_fetch_assoc($result);

        if ($entrega) {
            // Retornar os dados da entrega em HTML
            echo "<h5>Entrega Código: " . htmlspecialchars($entrega['cod_paciente']) . "</h5>";
            echo "<p>Código Paciente: " . htmlspecialchars($entrega['cod_paciente']) . "</p>";
            echo "<p>Data Entrega: " . htmlspecialchars($entrega['data_entrega']) . "</p>";
            echo "<p>Código Processo: " . htmlspecialchars($entrega['cod_processo']) . "</p>";
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
    echo "<p>Código do paciente não especificado.</p>";
}
?>
