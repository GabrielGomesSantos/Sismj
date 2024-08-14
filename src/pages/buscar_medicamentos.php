<?php
// buscar_medicamentos.php

if (isset($_POST['id'])) {
    $cod_processo = $_POST['id'];

    // Conexão com o banco de dados
    include('../../config/config.php');

    // Busca os dados dos medicamentos associados ao processo
    $query = "SELECT cod_medicamento_processo, nome_medicamento, tipo_medicamento, laboratorio, quantidade
              FROM medicamentos_processo
              WHERE cod_processo = ?";

    $stmt = $conn->prepare($query); 
    $stmt->bind_param("i", $cod_processo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $dadosTabela = [];

    while ($row = $resultado->fetch_assoc()) {
        $dadosTabela[] = [
            'cod_medicamento_processo' => $row['cod_medicamento_processo'],
            'nome_medicamento' => $row['nome_medicamento'],
            'tipo_medicamento' => $row['tipo_medicamento'],
            'laboratorio' => $row['laboratorio'],
            'quantidade' => $row['quantidade']
        ];
    }

    // Retorna os dados em formato JSON
    echo json_encode([
        'dadosTabela' => $dadosTabela
    ]);

    $stmt->close();
    $conn->close();
}
?>
