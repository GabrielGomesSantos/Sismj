<?php
if(!isset($_SESSION['ID'])){
    session_start();
};

     if(!isset($_SESSION["Perfil"])){
        header('Location: ../../public/index.php');
   }

include ("../../config/config.php");

////////////////FUNÇÕES DE CRUD///////////////////////
function postCompra($nota_fiscal, $data, $fornecedor, $conn)
{
    $sql = "INSERT INTO `compras`(`nota_fiscal`, `data`, `fornecedor`) VALUES ('$nota_fiscal','$data','$fornecedor')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    redCompra($nota_fiscal,$conn);
}

function redCompra($nota_fiscal,$conn){
    $sql = "SELECT * FROM compras WHERE nota_fiscal = '$nota_fiscal';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
    }
    header("location: dashboard.php?pag=2&id=".$saida[0]['cod_compra']);
}

//POST
function postMed($cod_compra, $nome, $tipo, $categoria, $laboratorio, $lote, $validade, $quantidade, $conn)
{
    $sql = "INSERT INTO medicamentos (cod_compra, nome_medicamento, tipo_medicamento, categoria, laboratorio, validade, lote, quantidade) 
    VALUES ('$cod_compra', '$nome', '$tipo', '$categoria', '$laboratorio', '$validade', '$lote', '$quantidade')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("Location: /sismj/src/pages/dashboard.php?pag=3&id=".$cod_compra);
}

function deleteMed($id, $conn, $col)
{
    //Insere o id enviado do "dashboard.php" na variável delete
    $delete = $id;

    //Faz uma consulta sql para deletar o produto com base no id
    $sql = "DELETE FROM medicamentos WHERE $col = $delete;";
    $result = mysqli_query($conn, $sql);

    //VERIFICANDO SE A CONSULTA GEROU RESULTADOS
    if ($result) {
        echo "Registro deletado com sucesso";
    } else {
        echo "Erro ao deletar registro: " . mysqli_error($conn);
    }

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
    header("Location: /sismj/src/pages/dashboard.php?pag=2"); 
}

function deleteComp($id,$conn)
{
    //Insere o id enviado do "dashboard.php" na variável delete
    $delete = $id;

    //Faz uma consulta sql para deletar o produto com base no id
    $sql = "DELETE FROM compras WHERE cod_compra = $delete;";
    $result = mysqli_query($conn, $sql);

    //VERIFICANDO SE A CONSULTA GEROU RESULTADOS
    if ($result) {
        echo "Registro deletado com sucesso";
    } else {
        echo "Erro ao deletar registro: " . mysqli_error($conn);
    }

}


//Verificações de requisição
if ( isset($_GET['id_delete']) ){
    deleteMed($_GET['id_delete'],$conn,'cod_medicamento');
    header("Location: /sismj/src/pages/dashboard.php?pag=1"); 
};
if ( isset($_GET['id_deleteMed']) ){
    deleteMed($_GET['id_deleteMed'],$conn,'cod_medicamento');
    header("Location: /sismj/src/pages/dashboard.php?pag=3&id=". $_GET['id_compra']); 
};
if ( isset($_GET['id_deleteMed2']) ){
    deleteMed($_GET['id_deleteMed2'],$conn,'cod_medicamento');
    header("Location: /sismj/src/pages/dashboard.php?pag=4&id_compra=". $_GET['id_compra']); 
};


if ( isset($_GET['compra_delete']) ){
    deleteMed($_GET['compra_delete'],$conn,'cod_compra');
    deleteComp($_GET['compra_delete'],$conn);
    header("Location: /sismj/src/pages/dashboard.php?pag=2"); 
};
if ( isset($_POST['cod_medicamento']) ){
    updateMed($_POST['cod_medicamento'],$_POST['nome'],$_POST['tipo'],$_POST['categoria'],$_POST['lab'],$_POST['lote'],$_POST['valid'],$_POST['quant'],$conn);
};

if (isset($_POST['insert_med']) ){
    postMed($_POST['id_compra'], $_POST['nome'], $_POST['tipo'], $_POST['categoria'], $_POST['laboratorio'], $_POST['lote'], $_POST['validade'], $_POST['quantidade'], $conn);
};
if(isset($_POST['add_compra']))
{
    postCompra($_POST['nota_fiscal'], $_POST['data'],$_POST['fornecedor'],$conn);
};
function close_session($conn){
    mysqli_close($conn);
}


