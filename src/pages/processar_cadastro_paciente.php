<?php
    require_once('../../config/config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST['nome_paciente'];
        $cpf = $_POST['cpf_paciente'];
        $cns = $_POST['cns_paciente'];
        $logradouro = $_POST['logradouro_paciente'];
        $numero = $_POST['numero_paciente'];
        $complemento = $_POST['complemento_paciente'];
        $bairro = $_POST['bairro_paciente'];
        $cidade = $_POST['cidade_paciente'];
        $cep = $_POST['cep_paciente'];
        $estado = $_POST['estado_paciente'];
        $celular = $_POST['celular_paciente'];

        $sql = "INSERT INTO pacientes (nome_paciente, cpf_paciente, cns_paciente, logradouro, numero, complemento, bairro, cidade, cep, estado, celular)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssissssss", $nome, $cpf, $cns, $logradouro, $numero, $complemento, $bairro, $cidade, $cep, $estado, $celular);

        if ($stmt->execute()) {
            echo "<script>
                alert('Paciente Cadastrado');
                window.location.href='dashboard.php?pag=4'
                </script>";
            
        } else {
            echo "<p>Erro ao cadastrar paciente: " . $stmt->error . "</p>";
        
        }

        $stmt->close();
        $conn->close();
    }
?>
