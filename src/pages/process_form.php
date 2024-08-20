<?php
require_once('../../config/config.php');

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_processo = intval($_POST['id_processo']);
    $num_processo = $_POST['num_processo'];
    $cod_paciente = intval($_POST['cod_paciente']);
    $cod_medico = intval($_POST['cod_medico']);
    
    // Verifica se os arquivos foram enviados
    $copia_processo = isset($_FILES['copia_processo']) ? $_FILES['copia_processo'] : null;
    $receita_processo = isset($_FILES['receita_processo']) ? $_FILES['receita_processo'] : null;

    // Atualiza o banco de dados
    $stmt = $conn->prepare("
        UPDATE processos
        SET numero_processo = ?, cod_paciente = ?, cod_medico = ?
        WHERE cod_processo = ?
    ");
    $stmt->bind_param('siii', $num_processo, $cod_paciente, $cod_medico, $id_processo);
    $stmt->execute();

    // Faz o upload dos arquivos se foram enviados
    if ($copia_processo && $copia_processo['error'] === UPLOAD_ERR_OK) {
        $copia_path = '../../uploads/' . basename($copia_processo['name']);
        move_uploaded_file($copia_processo['tmp_name'], $copia_path);

        $stmt = $conn->prepare("UPDATE processos SET copia_processo = ? WHERE cod_processo = ?");
        $stmt->bind_param('si', $copia_path, $id_processo);
        $stmt->execute();
    }

    if ($receita_processo && $receita_processo['error'] === UPLOAD_ERR_OK) {
        $receita_path = '../../uploads/' . basename($receita_processo['name']);
        move_uploaded_file($receita_processo['tmp_name'], $receita_path);

        $stmt = $conn->prepare("UPDATE processos SET receita_processo = ? WHERE cod_processo = ?");
        $stmt->bind_param('si', $receita_path, $id_processo);
        $stmt->execute();
    }

    // Redireciona após a atualização
    header('Location: sucesso.php'); // Altere para a página de sucesso ou para onde você deseja redirecionar
    exit();
} else {
    // Redireciona se o acesso ao script não for via POST
    header('Location: erro.php'); // Altere para uma página de erro ou de redirecionamento
    exit();
}

$conn->close();
?>
