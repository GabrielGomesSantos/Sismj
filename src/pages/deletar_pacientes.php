<?php
require_once('D:/xampp/htdocs/Sismj/config/config.php');

if (isset($_GET['id_paciente'])) {
    $id_paciente = intval($_GET['id_paciente']); // Sanitiza o ID do paciente

    // Usa prepared statements para evitar SQL Injection
    $stmt = $conn->prepare("DELETE FROM pacientes WHERE cod_paciente = ?");
    $stmt->bind_param("i", $id_paciente);

    if ($stmt->execute()) {
        header("Location: ./listar_pacientes.php"); // Atualize com o caminho correto se necessário
        exit();
    } else {
        echo "Erro ao deletar paciente: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID do paciente não fornecido.";
}

$conn->close();
?>
