<?php
header('Content-Type: application/json'); // Define o cabeçalho da resposta como JSON
include('../../config/config.php');

// Inclua o arquivo de conexão com o banco de dados
// require 'caminho/para/seu/arquivo_de_conexao.php'; // Certifique-se de incluir o arquivo que define a variável $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados JSON enviados via POST
    $dados = json_decode($_POST['dados'], true);

    // Verifique o conteúdo de $dados 
    file_put_contents('debug.log', print_r($dados, true)); // Salva o conteúdo no log

    // Verifica se os dados foram decodificados corretamente
    if (is_array($dados)) {
        $resultados = []; // Array para armazenar os resultados

        foreach ($dados as $linha) {
            // Verifica se a linha tem a quantidade esperada de elementos
            if (isset($linha[0]) && isset($linha[1]) && isset($linha[2]) && isset($linha[3])) {
                // Acessa os dados pelo índice
                $nome = $linha[0];
                $tipo = $linha[1];
                $laboratorio = $linha[2];
                $quantidade = (int)$linha[3]; // Garante que a quantidade é um inteiro

                // Sanitização básica
                $nome = mysqli_real_escape_string($conn, $nome);
                $tipo = mysqli_real_escape_string($conn, $tipo);
                $laboratorio = mysqli_real_escape_string($conn, $laboratorio);

                // Consulta SQL
                $sqlConsulta = "SELECT cod_medicamento 
                                FROM `medicamentos` 
                                WHERE nome_medicamento = '$nome' 
                                  AND tipo_medicamento = '$tipo'
                                  AND laboratorio = '$laboratorio'
                                  AND quantidade >= $quantidade";

                // Executa a consulta
                $resultado = mysqli_query($conn, $sqlConsulta);

                // Verifica se a consulta retornou algum resultado
                if ($resultado) {
                    if (mysqli_num_rows($resultado) > 0) {
                        // Adiciona o resultado ao array de resultados
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $resultados[] = $row;
                        }
                    } else {
                        // Caso não haja resultados
                        $resultados[] = ['cod_medicamento' => 'Nenhum encontrado para ' . $nome];
                    }
                } else {
                    // Adiciona erro ao array de resultados se a consulta falhar
                    $resultados[] = ['status' => 'erro', 'mensagem' => 'Erro na consulta SQL: ' . mysqli_error($conn)];
                }
            } else {
                // Caso a linha tenha dados incompletos
                $resultados[] = ['status' => 'erro', 'mensagem' => 'Dados da linha incompletos'];
            }
        }

        // Envia a resposta de volta para o cliente
        $response = [
            'status' => 'sucesso',
            'dados' => $resultados // Inclui os resultados na resposta
        ];

        echo json_encode($response); // Converte o array PHP em JSON
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
