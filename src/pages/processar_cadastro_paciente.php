<?php
    // Inclui o arquivo de conexão com o banco de dados
    $servername = "localhost"; // ou o endereço do seu servidor
    $username = "root"; // seu usuário do banco de dados
    $password = ""; // sua senha do banco de dados
    $dbname = "trabalho_final"; // nome do seu banco de dados

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checa a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
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

        // Prepara a declaração SQL
        $sql = "INSERT INTO pacientes (nome_paciente, cpf_paciente, cns_paciente, logradouro, numero, complemento, bairro, cidade, cep, estado, celular)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssissssss", $nome, $cpf, $cns, $logradouro, $numero, $complemento, $bairro, $cidade, $cep, $estado, $celular);

        // Executa a declaração
        if ($stmt->execute()) {
            echo "<p>Paciente cadastrado com sucesso!</p>";
            
        } else {
            echo "<p>Erro ao cadastrar paciente: " . $stmt->error . "</p>";
        
        }

        // Fecha a declaração e a conexão
        $stmt->close();
        $conn->close();
    }
?>
