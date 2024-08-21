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

    // Itera sobre o array de medicamentos para atualizar a quantidade de cada um no banco de dados
    foreach ($medicamentos as $row) {
        // Monta a consulta SQL para atualizar a quantidade de cada medicamento com base no nome, tipo e laboratório
        $updateSql = "UPDATE `medicamentos` 
                      SET `quantidade` = `quantidade` - {$row[3]}
                      WHERE `nome_medicamento` = '{$row[0]}' 
                      AND `tipo_medicamento` = '{$row[1]}' 
                      AND `laboratorio` = '{$row[2]}'";

        // Executa a consulta SQL usando a conexão $conn, que deve ter sido definida no arquivo de configuração incluído
        if (mysqli_query($conn, $updateSql)) {
            // Caso a atualização seja bem-sucedida, nenhuma ação adicional é tomada
        } else {
            // Se ocorrer um erro na execução da consulta, o erro é registrado no arquivo de log
            file_put_contents('../debugs/debug_entrega.log', "Erro: " . mysqli_error($conn) . "\n", FILE_APPEND);
        }
    }
    
    //Salvandi entrega 
    
    //Inicia uma transação 
    mysqli_begin_transaction($conn);
    
    try {
        // Insert na tabela `entregas`
        $insert1 = "INSERT INTO `entregas`(`cod_paciente`, `cod_processo`, `cod_funcionario`) VALUES ('{$dados["pacienteId"]}','{$dados["codProcesso"]}','{$dados["funcionarioId"]}')";
        mysqli_query($conn, $insert1);
        
        $entragaid = "SELECT MAX(cod_entrega) AS lastId FROM entregas";
        $result = mysqli_query($conn, $entragaid);
        $lastIdEntrega = mysqli_fetch_assoc($result)['lastId'];
        file_put_contents('../debugs/debug_sql.log', print_r($lastIdEntrega, true));
        
        foreach ($medicamentos as $row) {
            $medicamentoSql = "SELECT cod_medicamento FROM `medicamentos` WHERE `nome_medicamento` = '{$row[0]}' AND `tipo_medicamento` = '{$row[1]}' AND `laboratorio` = '{$row[2]}'";
            $result = mysqli_query($conn, $medicamentoSql);
            $idMedicamento = mysqli_fetch_assoc($result)['cod_medicamento'];
            
            $insert2 = "INSERT INTO `itens_entrega`(`cod_entrega`, `cod_medicamento`, `qtde_medicamento`) VALUES ('{$lastIdEntrega}','{$idMedicamento}','{$row[3]}')";
            mysqli_query($conn, $insert2);
            
            // Atualiza a quantidade do medicamento
            $updateSql = "UPDATE `medicamentos` SET `quantidade` = `quantidade` - {$row[3]} WHERE `nome_medicamento` = '{$row[0]}' AND `tipo_medicamento` = '{$row[1]}' AND `laboratorio` = '{$row[2]}'";
            if (!mysqli_query($conn, $updateSql)) {
                file_put_contents('../debugs/debug_entrega.log', "Erro: " . mysqli_error($conn) . "\n", FILE_APPEND);
            }
        }
        $response = [
            'status' => 'sucesso',
        ];
        
        mysqli_commit($conn);
    } catch (Exception $e) {
        mysqli_rollback($conn);
        file_put_contents('error_log.txt', $e->getMessage(), FILE_APPEND);
    }
    
}
    echo json_encode($response);
    
    ?>