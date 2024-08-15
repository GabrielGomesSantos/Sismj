<?php
require_once('../../config/config.php');
if (isset($_GET['id_funcionario'])) {
    $id_funcionario = intval($_GET['id_funcionario']); 


    $sql = "DELETE FROM funcionarios WHERE cod_funcionario = $id_funcionario";

    if ($conn->query($sql) === TRUE) {
        header("Location: ./listar_funcionario.php");
        exit(); 
    } else {
        echo "Erro ao deletar funcionário: " . $conn->error;
    }
} else {
    echo "ID do funcionário não fornecido.";
}

$conn->close(); 
?>
