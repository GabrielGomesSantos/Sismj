<?php
require_once('../../config/config.php');

if (isset($_GET['id_paciente'])) {
    $id_paciente = intval($_GET['id_paciente']); 


    $stmt = $conn->prepare("DELETE FROM pacientes WHERE cod_paciente = ?");
    $stmt->bind_param("i", $id_paciente);

    if ($stmt->execute()) {
        echo "<script>
            alert('Paciente Excluido');
            window.location.href='dashboard.php?pag=4'
            </script>";
    } else {
        echo "Erro ao deletar paciente: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID do paciente não fornecido.";
}

$conn->close();
?>
