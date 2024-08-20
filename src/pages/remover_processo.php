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
        if (!empty($copia) && file_exists($copia)) {
            if (unlink($copia)) {
                echo "Arquivo '$copia' excluído com sucesso.<br>";
            } else {
                header("Location: listar_processos.php");
                exit();
            }
        } else {
            echo "Arquivo '$copia' não encontrado ou não especificado.<br>";
        }

        if (!empty($receita) && file_exists($receita)) {
            if (unlink($receita)) {
                echo "Arquivo '$receita' excluído com sucesso.<br>";
            } else {
                header("Location: listar_processos.php");
                exit();
            }
    
        } else {
            echo "Arquivo '$receita' não encontrado ou não especificado.<br>";
        }
    }else {
        echo "Erro!! $conn->error";
    }
} else {
    echo "ID do processo não fornecido.";
}
?>