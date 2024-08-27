<?php
// buscar_processos.php
if(!isset($_SESSION['ID'])){
    session_start();
};

if(!isset($_SESSION["Perfil"])){
    header('Location: ../../public/index.php');
};

if (isset($_POST['id'])) {
    $pacienteId = $_POST['id'];

    // Conexão com o banco de dados
    include('../../config/config.php');

    // Busca os processos do paciente
    $query = "SELECT numero_processo, cod_processo
              FROM processos
              WHERE cod_paciente = ?";

    $stmt = $conn->prepare($query);  // Usa a variável $conn, conforme o arquivo de configuração
    $stmt->bind_param("i", $pacienteId);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $processos = [];

    while ($row = $resultado->fetch_assoc()) {
        $processos[] = [
            'numero_processo' => $row['numero_processo'],
            'cod_processo' => $row['cod_processo']
        ];
    }

    // Retorna os dados em formato JSON
    echo json_encode([
        'processos' => $processos
    ]);

    $stmt->close();
    $conn->close();
}
?>
