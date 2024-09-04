<?php

require_once('../../config/config.php');

if (isset($_GET['id_processo'])) {
    $id_processo = intval($_GET['id_processo']); 

    
    $sql_copia = "SELECT numero_processo, copia_processo, receita FROM processos WHERE cod_processo = ?";
    $stmt_copia = mysqli_prepare($conn, $sql_copia);

    if ($stmt_copia === false) {
        die("Erro na preparação da consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt_copia, "i", $id_processo);
    mysqli_stmt_execute($stmt_copia);
    mysqli_stmt_bind_result($stmt_copia, $num_processo, $copia, $receita);
    mysqli_stmt_fetch($stmt_copia);
    mysqli_stmt_close($stmt_copia);

    // Verificar se os arquivos foram encontrados
    if ($num_processo && $copia && $receita) {
        $caminho_copia = "../../arquivos/" . $num_processo . "/" . $copia;
        $caminho_receita = "../../arquivos/" . $num_processo . "/" . $receita;

        // Preparar e executar a consulta para excluir o processo
        $sql_delete = "DELETE FROM processos WHERE cod_processo = ?";
        $stmt_delete = mysqli_prepare($conn, $sql_delete);

        if ($stmt_delete === false) {
            die("Erro na preparação da consulta de exclusão: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt_delete, "i", $id_processo);

        if (mysqli_stmt_execute($stmt_delete)) {
            mysqli_stmt_close($stmt_delete);

            // Verificar e excluir arquivos
            $excluir_copia = file_exists($caminho_copia) ? unlink($caminho_copia) : true; 
            $excluir_receita = file_exists($caminho_receita) ? unlink($caminho_receita) : true;

            if ($excluir_copia && $excluir_receita) {
                echo "<script>
                    alert('Processo excluído');
                    window.location.href='dashboard.php?pag=1';
                </script>";
            } else {
                echo "<script>
                    alert('Falha ao excluir alguns arquivos');
                    window.location.href='dashboard.php?pag=1';
                </script>";
            }
        } else {
            mysqli_stmt_close($stmt_delete);
            echo "Erro ao excluir o processo: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
            alert('Dados do processo não encontrados');
            window.location.href='dashboard.php?pag=1';
        </script>";
    }
} else {
    echo "<script>
        alert('ID do processo não fornecido.');
        window.location.href='dashboard.php?pag=1';
    </script>";
}

mysqli_close($conn);
?>
