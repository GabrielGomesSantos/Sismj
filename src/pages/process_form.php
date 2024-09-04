<?php
require_once('../../config/config.php');

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_processo = intval($_POST['id_processo']);
    $num_processo = $_POST['num_processo'];
    $cod_paciente = intval($_POST['cod_paciente']);
    $cod_medico = intval($_POST['cod_medico']);
    
    // Atualiza o banco de dados
    $sql = "
        UPDATE processos
        SET numero_processo = '$num_processo', cod_paciente = $cod_paciente, cod_medico = $cod_medico
        WHERE cod_processo = $id_processo
    ";
    mysqli_query($conn, $sql);

    // Verifica se os arquivos foram enviados
    $copia_processo = isset($_FILES['copia_processo']) ? $_FILES['copia_processo'] : null;
    $receita_processo = isset($_FILES['receita_processo']) ? $_FILES['receita_processo'] : null;

    // Faz o upload dos arquivos se foram enviados
    if ($copia_processo && $copia_processo['error'] === UPLOAD_ERR_OK) {
        $copia_path = basename($copia_processo['name']);
        move_uploaded_file($copia_processo['tmp_name'], $copia_path);

        $sql = "UPDATE processos SET copia_processo = '$copia_path' WHERE cod_processo = $id_processo";
        mysqli_query($conn, $sql);
    }

    if ($receita_processo && $receita_processo['error'] === UPLOAD_ERR_OK) {
        $receita_path = basename($receita_processo['name']);
        move_uploaded_file($receita_processo['tmp_name'], $receita_path);

        $sql = "UPDATE processos SET receita = '$receita_path' WHERE cod_processo = $id_processo";
        mysqli_query($conn, $sql);
    }

    // Redireciona após a atualização
    header('Location: listar_processos.php');
    exit();
} else {
    // Redireciona se o acesso ao script não for via POST
    header('Location: erro.php');
    exit();
}


