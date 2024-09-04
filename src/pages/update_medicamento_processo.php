<?php 
require_once('../../config/config.php');

if($_SERVER["REQUEST_METHOD"] == 'POST') {

    $id_medicamento_processo = intval($_POST['id_medicamento_processo']);
    $nome_medicamento = mysqli_real_escape_string($conn, $_POST['nome_medicamento']);
    $tipo_medicamento = mysqli_real_escape_string($conn, $_POST['tipo_medicamento']);
    $categoria_medicamento = mysqli_real_escape_string($conn, $_POST['categoria_medicamento']);
    $laboratorio = mysqli_real_escape_string($conn, $_POST['laboratorio']);
    $cod_processo = intval($_POST['id_processo']);
    $quantidade = intval($_POST['quantidade']);
    
    $sql = "UPDATE `medicamentos_processo` SET `nome_medicamento`='$nome_medicamento',`tipo_medicamento`='$tipo_medicamento',`categoria_medicamento`='$categoria_medicamento',`laboratorio`='$laboratorio',`quantidade`='$quantidade' WHERE cod_medicamento_processo = $id_medicamento_processo";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Medicamento Editado com sucesso!');
        window.location.href='dashboard.php?pag=1';
        </script>";
    } else {
        echo "Erro ao editaro medicamento: " . mysqli_error($conn);
    }
}


?>