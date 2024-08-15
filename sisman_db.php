<?php
include ("config/config.php");

////////////////FUNÇÕES DE CRUD///////////////////////
function postCompra($nota_fiscal, $data, $fornecedor, $conn)
{
    $sql = "INSERT INTO `compras`(`nota_fiscal`, `data`, `fornecedor`) VALUES ('$nota_fiscal','$data','$fornecedor')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function postMed($cod_compra, $nome, $tipo, $categoria, $laboratorio, $lote, $validade, $quantidade, $conn)
{
    $sql = "INSERT INTO medicamentos (cod_compra, nome_medicamento, tipo_medicamento, categoria, laboratorio, validade, lote, quantidade) 
    VALUES ('$cod_compra', '$nome', '$tipo', '$categoria', '$laboratorio', '$lote', '$validade', '$quantidade')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

function assignCodCompra($id, $conn){
    $sql = "UPDATE `medicamentos` 
            SET `cod_compra` = '$id'
            WHERE `cod_compra` = 0";
    
    mysqli_query($conn, $sql);
}

function deleteMed($id, $conn)
{
    //Insere o id enviado do "dashboard.php" na variável delete
    $delete = $id;

    //Faz uma consulta sql para deletar o produto com base no id
    $sql = "DELETE FROM medicamentos WHERE cod_medicamento = $delete;";
    $result = mysqli_query($conn, $sql);

    //VERIFICANDO SE A CONSULTA GEROU RESULTADOS
    if ($result) {
        echo "Registro deletado com sucesso";
    } else {
        echo "Erro ao deletar registro: " . mysqli_error($conn);
    }
    header("Location: dashboard(teste)/index.php");
}

function updateMed($id, $nome, $tipo, $categoria, $lab, $lote, $validade, $quant, $conn) {

    // Protege as variáveis para evitar injeções de SQL
    $id = (int)$id; // Converte $id para um inteiro
    $nome = mysqli_real_escape_string($conn, $nome);
    $tipo = mysqli_real_escape_string($conn, $tipo);
    $categoria = mysqli_real_escape_string($conn, $categoria);
    $lab = mysqli_real_escape_string($conn, $lab);
    $lote = mysqli_real_escape_string($conn, $lote);
    $validade = mysqli_real_escape_string($conn, $validade);
    $quant = mysqli_real_escape_string($conn, $quant);

    // Faz uma consulta SQL para atualizar o produto com base no id
    $sql = "UPDATE `medicamentos` 
            SET `nome_medicamento` = '$nome', 
                `tipo_medicamento` = '$tipo', 
                `categoria` = '$categoria', 
                `laboratorio` = '$lab', 
                `lote` = '$lote', 
                `validade` = '$validade', 
                `quantidade` = '$quant'
            WHERE `cod_medicamento` = $id";
    
    $result = mysqli_query($conn, $sql);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        echo "Editado com sucesso";
    } else {
        echo "Erro ao editar registro: " . mysqli_error($conn);
    }

    // Redireciona para o dashboard (descomente se necessário)
    header("Location: dashboard(teste)/index.php"); 
}


//Verificações de requisição

if ( isset($_GET['id_delete']) ){
    deleteMed($_GET['id_delete'],$conn);
};
if ( isset($_POST['id_edit']) ){
    updateMed($_POST['id_edit'],$_POST['nome'],$_POST['tipo'],$_POST['categoria'],$_POST['lab'],$_POST['lote'],$_POST['valid'],$_POST['quant'],$conn);
};

if (isset($_POST['insert_med']) ){
    postMed(0, $_POST['name'], $_POST['tipo'], $_POST['categoria'], $_POST['laboratorio'], $_POST['lote'], $_POST['validade'], $_POST['quantidade'], $conn);
    header("Location: dashboard\adicionar_compras.php");
}

if (isset($_POST['finish_purchase']) && (!empty($_POST['nota_fiscal']) && !empty($_POST['data']) && !empty($_POST['fornecedor']))) {
    $nota_fiscal = $_POST['nota_fiscal'];
    $data = $_POST['data'];
    $fornecedor = $_POST['fornecedor'];

    $sql = "SELECT MAX(cod_compra) FROM compras";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row["MAX(cod_compra)"] + 1;

    postCompra($nota_fiscal, $data, $fornecedor, $conn);
    assignCodCompra($row["MAX(cod_compra)"] + 1, $conn);
    header("Location: dashboard\index.php");
}

function close_session($conn){
    mysqli_close($conn);
}

