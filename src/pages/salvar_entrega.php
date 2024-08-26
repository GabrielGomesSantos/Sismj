<?php
// Inclui o arquivo de configuração, que provavelmente contém a conexão com o banco de dados e outras configurações
include('../../config/config.php');

// Verifica se o método da requisição é POST, indicando que os dados estão sendo enviados para processamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodifica os dados JSON enviados via POST e os converte em um array associativo PHP
    $dados = json_decode($_POST['dados'], true);

    // Salva o conteúdo de $dados no arquivo de log para depuração
    file_put_contents('../debugs/debug_entrega.log', print_r($dados, true));

    // Extrai o array de medicamentos do array $dados
    $medicamentos = $dados["medicamentos"];
    
    // Salva o array de medicamentos em outro arquivo de log para depuração
    file_put_contents('../debugs/debug_medicamentos.log', print_r($medicamentos, true));

    // Inicia uma transação
    mysqli_begin_transaction($conn);

    try {
        // Itera sobre o array de medicamentos para atualizar a quantidade de cada um no banco de dados
        foreach ($medicamentos as $row) {
            // Monta a consulta SQL para atualizar a quantidade de cada medicamento com base no nome, tipo e laboratório
            $updateSql = "UPDATE `medicamentos` 
                          SET `quantidade` = `quantidade` - ?
                          WHERE `nome_medicamento` = ? 
                          AND `tipo_medicamento` = ? 
                          AND `laboratorio` = ?";

            // Prepara a consulta para evitar SQL Injection
            if ($stmt = mysqli_prepare($conn, $updateSql)) {
                mysqli_stmt_bind_param($stmt, 'isss', $row[3], $row[0], $row[1], $row[2]);
                if (!mysqli_stmt_execute($stmt)) {
                    throw new Exception("Erro ao atualizar medicamento: " . mysqli_error($conn));
                }
            } else {
                throw new Exception("Erro ao preparar a consulta de atualização: " . mysqli_error($conn));
            }
        }

        // Primeiro insert
        $insert1 = "INSERT INTO `entregas` (`cod_paciente`, `cod_processo`, `cod_funcionario`) 
                    VALUES (?, ?, ?)";

        // Prepara a consulta para o insert
        if ($stmt = mysqli_prepare($conn, $insert1)) {
            mysqli_stmt_bind_param($stmt, 'iii', $dados['pacienteId'], $dados['codProcesso'], $dados['funcionarioId']);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Erro ao inserir entrega: " . mysqli_error($conn));
            }

            // Obtém o ID do último registro inserido
            $ultimoId = mysqli_insert_id($conn);
            file_put_contents('../debugs/sucesso.txt', "ID do último registro inserido: $ultimoId");

            // Confirma a transação
            mysqli_commit($conn);
        } else {
            throw new Exception("Erro ao preparar a consulta de inserção: " . mysqli_error($conn));
        }
    } catch (Exception $e) {
        // Em caso de erro, desfaz todas as operações realizadas na transação
        mysqli_rollback($conn);
        file_put_contents('../debugs/error_log.txt', "Erro: " . $e->getMessage(), FILE_APPEND);
    }
}
?>
