<?php
session_start();

if (!isset($_SESSION['ID']) || !isset($_SESSION["Perfil"])) {
    header('Location: ../../public/index.php');
    exit();
}

// Inclui o arquivo de configuração
include('../../config/config.php');

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodifica os dados JSON enviados via POST
    $dados = json_decode($_POST['dados'], true);
    
    // Salva o conteúdo de $dados no arquivo de log para depuração
    file_put_contents('../debugs/debug_entrega.log', print_r($dados, true));
    
    $medicamentos = $dados["medicamentos"];

    // Inicia a transação
    mysqli_begin_transaction($conn);

    try {
        // Insere na tabela `entregas`
        $insert1 = "INSERT INTO `entregas` (`cod_paciente`, `cod_processo`, `cod_funcionario`, `observacao`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert1);
        mysqli_stmt_bind_param($stmt, 'ssss', $dados["pacienteId"], $dados["codProcesso"], $dados["funcionarioId"], $dados["observacao"]);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Erro ao inserir entrega: " . mysqli_error($conn));
        }

        // Obtém o ID da última entrega inserida
        $entragaid = "SELECT MAX(cod_entrega) AS lastId FROM entregas";
        $result = mysqli_query($conn, $entragaid);
        if (!$result) {
            throw new Exception("Erro ao consultar o último ID de entrega: " . mysqli_error($conn));
        }
        $lastIdEntrega = mysqli_fetch_assoc($result)['lastId'];
        file_put_contents('../debugs/debug_sql.log', print_r($lastIdEntrega, true));

        // Itera sobre o array de medicamentos para atualizar a quantidade de cada um
        foreach ($medicamentos as $row) {
            // Consulta o código do medicamento
            $medicamentoSql = "SELECT cod_medicamento FROM `medicamentos` WHERE `nome_medicamento` = ? AND `tipo_medicamento` = ? AND `laboratorio` = ?";
            $stmt = mysqli_prepare($conn, $medicamentoSql);
            mysqli_stmt_bind_param($stmt, 'sss', $row[0], $row[1], $row[2]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $idMedicamento = mysqli_fetch_assoc($result)['cod_medicamento'];

            if (!$idMedicamento) {
                throw new Exception("Medicamento não encontrado: {$row[0]}, {$row[1]}, {$row[2]}");
            }

            // Insere o item de entrega
            $insert2 = "INSERT INTO `itens_entrega` (`cod_entrega`, `cod_medicamento`, `qtde_medicamento`) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insert2);
            mysqli_stmt_bind_param($stmt, 'sss', $lastIdEntrega, $idMedicamento, $row[3]);
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Erro ao inserir item de entrega: " . mysqli_error($conn));
            }

            // Atualiza a quantidade do medicamento
            $updateSql = "UPDATE `medicamentos` SET `quantidade` = `quantidade` - ? WHERE `cod_medicamento` = ?";
            $stmt = mysqli_prepare($conn, $updateSql);
            mysqli_stmt_bind_param($stmt, 'is', $row[3], $idMedicamento);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Erro ao atualizar quantidade do medicamento: " . mysqli_error($conn));
            }
        }

        // Confirma a transação
        mysqli_commit($conn);
        
        // Resposta de sucesso
        $response = ['status' => 'sucesso'];
        echo json_encode($response);
    } catch (Exception $e) {
        // Reverte a transação em caso de erro
        mysqli_rollback($conn);
        file_put_contents('../debugs/error_log.txt', "Erro: " . $e->getMessage(), FILE_APPEND);
        echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
    }
}
?>
