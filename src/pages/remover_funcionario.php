<?php

if(!isset($_SESSION['ID'])){
    session_start();
};

     if(!isset($_SESSION["Perfil"])){
        header('Location: ../../public/index.php');
   }

require_once('../../config/config.php');
if (isset($_GET['id_funcionario'])) {
    $id_funcionario = intval($_GET['id_funcionario']); 


    $sql = "DELETE FROM funcionarios WHERE cod_funcionario = $id_funcionario";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?pag=2");
        exit(); 
    } else {
        echo "Erro ao deletar funcionário: " . $conn->error;
    }
} else {
    echo "ID do funcionário não fornecido.";
}

$conn->close(); 
?>
