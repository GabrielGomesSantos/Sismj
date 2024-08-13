<?php
include('../../config/config.php');

// Verificar se o parâmetro 'cod_entrega' foi passado
if (isset($_GET['cod_entrega'])) {
    $cod_entrega = $_GET['cod_entrega'];

    // Preparar e executar a consulta para buscar os detalhes da entrega e informações do paciente
    $query = "  SELECT e.*, p.nome_paciente AS nome_paciente, p.cpf_paciente AS cpf_paciente, proc.numero_processo
                FROM entregas e
                JOIN pacientes p ON e.cod_paciente = p.cod_paciente
                LEFT JOIN processos proc ON e.cod_paciente = proc.cod_paciente
                WHERE e.cod_entrega = ?";
    
    // Preparar a consulta
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Vincular o parâmetro
        mysqli_stmt_bind_param($stmt, "s", $cod_entrega);

        // Executar a consulta
        mysqli_stmt_execute($stmt);

        // Obter o resultado
        $result = mysqli_stmt_get_result($stmt);

        // Buscar os dados da entrega
        $entrega = mysqli_fetch_assoc($result);

        if ($entrega) {
            // Exibir dados da entrega
            echo "
            <h4 class='text-secondary'>PACIENTE</h4>
            <div class='border-top border-secondary p-2'> 
                <label for='nome-paciente'>Nome do paciente:</label>
                <input type='text' name='nome-paciente' class='form-control' disabled value='" . htmlspecialchars($entrega['nome_paciente']) . "'>
                
                <label for='cpf-paciente'>CPF:</label>
                <input type='text' name='cpf-paciente' class='form-control' disabled value='" . htmlspecialchars($entrega['cpf_paciente']) . "'>
                
                <label for='processo-paciente'>Processo:</label>
                <input type='text' name='processo-paciente' class='form-control' disabled value='" . htmlspecialchars($entrega['numero_processo']) . "'>
            </div>
            
            <h4 class='text-secondary'>Medicamentos</h4>
            <div class='border-top border-secondary'>
                <table class='table mt-5'>
                    <thead class='thead-light'>
                        <tr>
                            <th>Medicamento</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Laboratório</th>
                            <th>Qnts</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Buscar e exibir os medicamentos associados à entrega
            $query = "
            SELECT e.*, p.nome_paciente AS nome_paciente, p.cpf_paciente AS cpf_paciente
            FROM entregas e
            JOIN pacientes p ON e.cod_paciente = p.cod_paciente
            WHERE e.cod_entrega = ?
            ";
            
            if ($stmtMedicamentos = mysqli_prepare($conn, $queryMedicamentos)) {
                mysqli_stmt_bind_param($stmtMedicamentos, "s", $cod_entrega);
                mysqli_stmt_execute($stmtMedicamentos);
                $resultMedicamentos = mysqli_stmt_get_result($stmtMedicamentos);

                while ($medicamento = mysqli_fetch_assoc($resultMedicamentos)) {
                    echo "<tr>
                        <td>" . htmlspecialchars($medicamento['nome_medicamento']) . "</td>
                        <td>" . htmlspecialchars($medicamento['tipo_medicamento']) . "</td>
                        <td>" . htmlspecialchars($medicamento['categoria']) . "</td>
                        <td>" . htmlspecialchars($medicamento['laboratorio']) . "</td>
                        <td>" . htmlspecialchars($medicamento['quantidade']) . "</td>
                    </tr>";
                }

                mysqli_stmt_close($stmtMedicamentos);
            }

            echo "
                    </tbody>
                </table>
            </div>
            
            <h4 class='text-secondary'>Entrega</h4>
            <div class='border-top border-secondary p-2'> 
                <label for='data-entrega' class='form-label'>Data Entrega:</label>
                <input type='text' name='data-entrega' class='form-control' disabled value='" . htmlspecialchars($entrega['data_entrega']) . "'>
                
                <label for='nome-funcionario'>Nome do Funcionário:</label>
                <input type='text' name='nome-funcionario' class='form-control' disabled value='" . htmlspecialchars($entrega['nome_funcionario']) . "'>
            </div>";
        } else {
            echo "<p>Entrega não encontrada.</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Erro ao preparar a consulta.</p>";
    }

    mysqli_close($conn);
} else {
    echo "<p>Código da entrega não especificado.</p>";
}
?>
