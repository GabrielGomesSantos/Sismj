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
}

//Salvandi entrega 

// Inicia uma transação
mysqli_begin_transaction($conn);

try {
    // Primeiro insert
    $insert1 = "INSERT INTO tabela1 (coluna1, coluna2) VALUES ('valor1A', 'valor2A')";
    mysqli_query($conn, $insert1);

    // Segundo insert
    $insert2 = "INSERT INTO tabela2 (coluna1, coluna2) VALUES ('valor1B', 'valor2B')";
    mysqli_query($conn, $insert2);

    // Se ambos os inserts forem bem-sucedidos, confirma a transação
    mysqli_commit($conn);
} catch (Exception $e) {
    // Em caso de erro, desfaz todas as operações realizadas na transação
    mysqli_rollback($conn);

    // Lida com o erro (por exemplo, log ou exibe uma mensagem)
    file_put_contents('error_log.txt', $e->getMessage(), FILE_APPEND);
}
$valor = mysqli_id()
?>
