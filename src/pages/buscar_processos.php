<?php
// buscar_processos.php

if (isset($_POST['id'])) {
    $pacienteId = $_POST['id'];

    // Conexão com o banco de dados
    include('../../config/config.php');

    // Busca os processos do paciente
    $query = "SELECT numero_processo FROM processos WHERE cod_paciente = ?";
    $stmt = $conn->prepare($query);  // Use a variável $conn, conforme o arquivo de configuração
    $stmt->bind_param("i", $pacienteId);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $processos = [];

    while ($row = $resultado->fetch_assoc()) {
        $processos[] = $row['numero_processo'];
    }

    // Retorna os dados em formato JSON
    echo json_encode([
        'processos' => $processos,  // Aqui, o array de processos é retornado corretamente
        'dadosTabela' => [] // Mantendo o array vazio, caso precise ser preenchido posteriormente
    ]);

    $stmt->close();
    $conn->close();
}
?>
