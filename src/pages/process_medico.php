<?php
require_once('D:/xampp/htdocs/Sismj/config/config.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cod_medico = $_POST['cod_medico'];
    $nome_medico = $_POST['nome_medico'];
    $cpf_medico = $_POST['cpf_medico'];
    $crm = $_POST['crm'];
    $especialidade = $_POST['especialidade'];
    $celular = $_POST['celular'];

    // Corrigir a instrução SQL
    $sql = "UPDATE medicos 
            SET nome_medico = '$nome_medico', 
                cpf_medico = '$cpf_medico', 
                crm = '$crm', 
                especialidade = '$especialidade', 
                celular = '$celular' 
            WHERE cod_medico = '$cod_medico'";

    // Executar a consulta
    if ($conn->query($sql) === TRUE) {
        header("Location: listar_medico.php");
        exit(); 
    } else {
        echo "Erro ao atualizar medico: " . $conn->error;
    }
}
?>
