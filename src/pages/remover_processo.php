<?php
require_once('D:/xampp/htdocs/Sismj/config/config.php');
if (isset($_GET['id_processo'])) {
    $id_processo = intval($_GET['id_processo']); 


    $sql = "DELETE FROM processos WHERE cod_processo = $id_processo";

    if ($conn->query($sql) === TRUE) {
        header("Location: ./listar_processos.php");
        exit(); 
    } else {
        echo "Erro ao deletar Processos: " . $conn->error;
    }
} else {
    echo "ID do processo não fornecido.";
}

$conn->close(); 
?>
