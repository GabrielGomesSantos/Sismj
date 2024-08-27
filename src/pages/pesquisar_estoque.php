<?php  
if(!isset($_SESSION['ID'])){
    session_start();
};

if(!isset($_SESSION["Perfil"])){
    header('Location: ../../public/index.php');
}

include('../../config/config.php'); 

$valor = filter_input(INPUT_GET, "valor", FILTER_DEFAULT);

if (!empty($valor)) {
    
    $valorformt = "%" . $valor . "%";
    
    $sql_search = "SELECT nome_medicamento, cod_medicamento 
                   FROM medicamentos
                   WHERE nome_medicamento LIKE ?
                   LIMIT 5";
    
    $stmt = mysqli_prepare($conn, $sql_search);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $valorformt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $dados = []; // Inicializa o array
            
            while($row = mysqli_fetch_assoc($result)){
                $dados[] = [
                    "nome" => $row['nome_medicamento'],
                    "id" => $row['cod_medicamento']
                ];
            }

            $retorna = [
                'status' => true,
                'dados' => $dados
            ];

        } else {
            $retorna = [
                'status' => false,
                'msg' => "Nenhum produto encontrado."
            ];
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $retorna = [
            'status' => false,
            'msg' => "Erro na preparação da consulta: " . mysqli_error($conn)
        ];
    }

} else {
    $retorna = [
        'status' => false,
        'msg' => "Nenhum valor de busca fornecido."
    ];
}

header('Content-Type: application/json');
echo json_encode($retorna);
