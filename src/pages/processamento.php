<?php
include('../../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados JSON enviados via POST
    $dados = json_decode($_POST['dados'], true);

    // Verifica o conteúdo de $dados 
    file_put_contents('debug.log', print_r($dados, true)); // Salva o conteúdo no log

    // Verifica se os dados foram decodificados corretamente
    if (is_array($dados)) {
        $resultados = []; // Array para armazenar os resultados
        $erros = []; // Array para armazenar erros de quantidade

        foreach ($dados as $linha) {
            // Verifica se a linha tem a quantidade esperada de elementos
            if (isset($linha[0]) && isset($linha[1]) && isset($linha[2]) && isset($linha[3])) {
                // Acessa os dados pelo índice
                $nome = $linha[0];
                $tipo = $linha[1];
                $laboratorio = $linha[2];
                $quantidade_solicitada = $linha[3]; // Garante que a quantidade é um inteiro

                // Sanitização básica
                $nome = mysqli_real_escape_string($conn, $nome);
                $tipo = mysqli_real_escape_string($conn, $tipo);
                $laboratorio = mysqli_real_escape_string($conn, $laboratorio);

                // Consulta SQL para verificar a quantidade
                $sqlConsulta = "SELECT cod_medicamento, quantidade 
                                FROM `medicamentos` 
                                WHERE nome_medicamento = '$nome' 
                                  AND tipo_medicamento = '$tipo'
                                  AND laboratorio = '$laboratorio'";

                // Executa a consulta
                $resultado = mysqli_query($conn, $sqlConsulta);

                // Verifica se a consulta retornou algum resultado
                if ($resultado) {
                    if (mysqli_num_rows($resultado) > 0) {
                        $row = mysqli_fetch_assoc($resultado);
                        
                        // Verifica se a quantidade solicitada é maior do que a disponível
                        if ($quantidade_solicitada > $row['quantidade']) {
                            // Adiciona um erro se a quantidade for insuficiente
                            $erros[] = [
                                'cod_medicamento' => $row['cod_medicamento'],
                                'mensagem' => "Quantidade insuficiente para $nome. Solicitado: {$quantidade_solicitada}, Disponível: " . $row['quantidade']
                            ];
                        } else {
                            // Adiciona o resultado ao array de resultados
                            $resultados[] = [
                                'cod_medicamento' => $row['cod_medicamento'],
                                'mensagem' => "Quantidade suficiente para $nome. Solicitado: {$quantidade_solicitada}, Disponível: " . $row['quantidade']
                            ];
                        }
                    } else {
                        // Caso não haja resultados
                        $erros[] = ['mensagem' => 'Nenhum medicamento encontrado para ' . $nome];
                    }
                } else {
                    // Adiciona erro ao array de resultados se a consulta falhar
                    $erros[] = ['status' => 'erro', 'mensagem' => 'Erro na consulta SQL: ' . mysqli_error($conn)];
                }
            } else {
                // Caso a linha tenha dados incompletos
                $erros[] = ['status' => 'erro', 'mensagem' => 'Dados da linha incompletos'];
            }
        }

        // Envia a resposta de volta para o cliente
        $response = [
            'status' => !empty($erros) ? 'erro' : 'sucesso',
            'dados' => $resultados,
            'erros' => $erros // Inclui os erros na resposta
        ];

        // Limpa o buffer de saída e envia a resposta
        ob_clean();
        echo json_encode($response);
    } else {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Erro ao decodificar os dados'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Método de requisição inválido'
    ]);
}
?>
