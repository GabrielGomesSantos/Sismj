<?php
require_once('../../config/config.php');
if (isset($_GET['id_medico'])) {
    $id_medico = intval($_GET['id_medico']); 


    $sql = "DELETE FROM medicos WHERE cod_medico = $id_medico";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?pag=3");
        exit(); 
    } else {
        echo "Erro ao deletar funcionário: " . $conn->error;
    }
} else {
    echo "ID do funcionário não fornecido.";
}

$conn->close(); 
?>