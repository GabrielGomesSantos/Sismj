<?php
require_once('D:/xampp/htdocs/Sismj/config/config.php');
// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente = intval($_POST['cod_paciente']);
    $nome_paciente = $_POST['nome_paciente'];
    $cpf_paciente = $_POST['cpf_paciente'];
    $cns_paciente = $_POST['cns_paciente'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $celular = $_POST['celular'];

    // Prepara a consulta SQL
    $stmt = $conn->prepare("UPDATE pacientes SET nome_paciente=?, cpf_paciente=?, cns_paciente=?, logradouro=?, numero=?, complemento=?, bairro=?, cidade=?, cep=?, estado=?, celular=? WHERE cod_paciente=?");
    $stmt->bind_param("sssssssssssi", $nome_paciente, $cpf_paciente, $cns_paciente, $logradouro, $numero, $complemento, $bairro, $cidade, $cep, $estado, $celular, $id_paciente);

    // Executa a consulta
    if ($stmt->execute()) {
        header("Location: listar_pacientes.php"); // Redireciona para a página de listagem
        exit();
    } else {
        echo "Erro ao atualizar paciente: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
