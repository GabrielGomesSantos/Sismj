<?php

require_once('../../config/config.php');

if (isset($_GET['id_processo'])) {
    $id_processo = intval($_GET['id_processo']);


    $sql_copia = "SELECT copia_processo, receita FROM processos WHERE cod_processo = $id_processo";
    $result_copia = mysqli_query($conn, $sql_copia);

    if (!$result_copia) {
        die("Erro na consulta: " . mysqli_error($conn));
    }

    $copia = '';
    $receita = ''; 

    if (mysqli_num_rows($result_copia) > 0) {
        $row = mysqli_fetch_assoc($result_copia);
        $copia = $row['copia_processo'];
        $receita = $row['receita'];
    }

    $sql = "DELETE FROM processos WHERE cod_processo = $id_processo";

    if($conn->query($sql) === true) {
        if (unlink($copia) && unlink($receita)) {
            echo "<script>
                alert('Processo excluído');
                window.location.href='dashboard.php?pag=1';
            </script>";
        } else {
            echo "<script>
                alert('Falha ao excluir o processo');
                window.location.href='dashboard.php?pag=1';
            </script>";
        }
        
    }else {
        echo "Erro!! $conn->error";
    }
} else {
    echo "ID do processo não fornecido.";
}
?>