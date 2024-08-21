<?php
include('../../config/config.php');

// Verificar se o parâmetro 'cod_entrega' foi passado
if (isset($_GET['cod_entrega'])) {
    $cod_entrega = $_GET['cod_entrega'];

    // Consultas SQL
    $sqlPaciente = "SELECT p.nome_paciente AS nome_paciente, p.cpf_paciente AS cpf_paciente
                    FROM entregas e
                    JOIN pacientes p ON e.cod_paciente = p.cod_paciente
                    WHERE e.cod_entrega = ?";

    $sqlRemedios = "SELECT mp.nome_medicamento, mp.tipo_medicamento, mp.categoria_medicamento, mp.quantidade
                    FROM entregas e
                    JOIN medicamentos_processo mp ON e.cod_processo = mp.cod_processo
                    WHERE e.cod_entrega = ?";

    $sqlEntregas = "SELECT e.cod_processo, f.nome_funcionario, e.data_entrega
                    FROM entregas e
                    JOIN funcionarios f ON e.cod_funcionario = f.cod_funcionario
                    WHERE e.cod_entrega = ?";

    // Conexão com o banco de dados
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Obter dados do paciente
    if ($stmt = $conn->prepare($sqlPaciente)) {
        $stmt->bind_param("i", $cod_entrega);
        $stmt->execute();
        $resultPaciente = $stmt->get_result();

        if ($resultPaciente->num_rows > 0) {
            $paciente = $resultPaciente->fetch_assoc();
        } else {
            $paciente = null;
        }

        $stmt->close();
    } else {
        echo "<p>Erro ao preparar a consulta para paciente.</p>";
    }

    // Obter dados dos medicamentos
    if ($stmt = $conn->prepare($sqlRemedios)) {
        $stmt->bind_param("i", $cod_entrega);
        $stmt->execute();
        $resultRemedios = $stmt->get_result();

        $medicamentos = [];
        while ($row = $resultRemedios->fetch_assoc()) {
            $medicamentos[] = $row;
        }

        $stmt->close();
    } else {
        echo "<p>Erro ao preparar a consulta para medicamentos.</p>";
    }

    // Obter dados da entrega
    if ($stmt = $conn->prepare($sqlEntregas)) {
        $stmt->bind_param("i", $cod_entrega);
        $stmt->execute();
        $resultEntregas = $stmt->get_result();

        if ($resultEntregas->num_rows > 0) {
            $entrega = $resultEntregas->fetch_assoc();
        } else {
            $entrega = null;
        }

        $stmt->close();
    } else {
        echo "<p>Erro ao preparar a consulta para entrega.</p>";
    }

    mysqli_close($conn);

    // Exibir dados do paciente
    if ($paciente) {
        echo "
        <h4 class='text-secondary'>PACIENTE</h4>
        <div class='border-top border-secondary p-2 '> 
            <label  class='mt-3' for='nome-paciente'>Nome do paciente:</label>
            <input type='text' name='nome-paciente' class='form-control' disabled value='" . htmlspecialchars($paciente['nome_paciente']) . "'>
            
            <label class='mt-3' for='cpf-paciente'>CPF:</label>
            <input type='text' name='cpf-paciente' class='form-control' disabled value='" . htmlspecialchars($paciente['cpf_paciente']) . "'>
            
            <label class='mt-3' for='processo-paciente'>Processo:</label>
            <input type='text' name='processo-paciente' class='form-control' disabled value='" . htmlspecialchars($entrega['cod_processo']) . "'>
        </div>";
    } else {
        echo "<p>Paciente não encontrado para o código de entrega {$cod_entrega}.</p>";
    }

    // Exibir medicamentos
    if (count($medicamentos) > 0) {
        echo "
        <h4 class='text-secondary mt-4'>Medicamentos</h4>
        <div class='border-top border-secondary'>
            <table class='table mt-4'>
                <thead class='thead-light'>
                    <tr>
                        <th>Medicamento</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($medicamentos as $medicamento) {
            echo "<tr>
                <td>" . htmlspecialchars($medicamento['nome_medicamento']) . "</td>
                <td>" . htmlspecialchars($medicamento['tipo_medicamento']) . "</td>
                <td>" . htmlspecialchars($medicamento['categoria_medicamento']) . "</td>
                <td>" . htmlspecialchars($medicamento['quantidade']) . "</td>
            </tr>";
        }
        echo "
                </tbody>
            </table>
        </div>";
    } else {
        echo "<p>Nenhum medicamento encontrado para o código de entrega {$cod_entrega}.</p>";
    }

    // Exibir dados da entrega
    if ($entrega) {
        echo "
        <h4 class='text-secondary'>Entrega</h4>
        <div class='border-top border-secondary p-2'> 
            <label class='mt-3' for='data-entrega' class='form-label'>Data Entrega:</label>
            <input type='text' name='data-entrega' class='form-control' disabled value='" . htmlspecialchars($entrega['data_entrega']) . "'>
            
            <label class='mt-3' for='nome-funcionario'>Nome do Funcionário:</label>
            <input type='text' name='nome-funcionario' class='form-control' disabled value='" . htmlspecialchars($entrega['nome_funcionario']) . "'>
        </div>";
    } else {
        echo "<p>Dados da entrega não encontrados para o código de entrega {$cod_entrega}.</p>";
    }
} else {
    echo "<p>Código da entrega não especificado.</p>";
}
?>
