<?php
// Inclui o arquivo de conexão com o banco de dados
$servername = "localhost"; // ou o endereço do seu servidor
$username = "root"; // seu usuário do banco de dados
$password = ""; // sua senha do banco de dados
$dbname = "trabalho_final"; // nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_GET['id_paciente'])) {
    $id_paciente = intval($_GET['id_paciente']); // Sanitiza o ID do paciente

    // Usa prepared statements para evitar SQL Injection
    $stmt = $conn->prepare("DELETE FROM pacientes WHERE cod_paciente = ?");
    $stmt->bind_param("i", $id_paciente);

    if ($stmt->execute()) {
        header("Location: ./listar_pacientes.php"); // Atualize com o caminho correto se necessário
        exit();
    } else {
        echo "Erro ao deletar paciente: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID do paciente não fornecido.";
}

$conn->close();
?>
