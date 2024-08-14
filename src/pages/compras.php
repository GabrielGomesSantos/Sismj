<!DOCTYPE html>
<html lang="en">

<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <!--link para o css do dashboard-->
    <link rel="stylesheet" type="text/css" href="CSSDashboard.css">
</head>

<body>
   <?php
// INCLUINDO CONFIGURAÇÃO DO BANCO DE DADOS
include("../config.php");
//Seleciona tudo que há na tabela medicamento

$sql = "SELECT * FROM `medicamentos` WHERE cod_compra = 'ultimo_id_adicionado'";
$result = mysqli_query($conn, $sql);

//Se a consulta gerar resultado irá armazenar tudo na variável "saida"
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) $saida[] = $row;
}
?>

    <div class="table-container">
        <table border="1">
            <tbody>
                <!--Se a variável "saida" estiver vazia ele não irá tentar imprimir a tabela, caso contrário,
                a tabela aparecerá normalmente-->
                <?php if (!empty($saida)) { ?>
                    <tr>
                        <th>Código de Compra</th>
                        <th>Nota fiscal</th>
                        <th>Data</th>
                        <th>Fornecedor</th>
                    </tr>
                    <!--Itera sobre todos os elementos da variável "saida" para imprimi-la corretamente-->
                    <?php foreach ($saida as $compras) { ?>
                        <tr>
                            <td><?php echo $compras['cod_compra'] ?></td>
                            <td><?php echo $compras['nota_fiscal'] ?></td>
                            <td><?php echo $compras['data'] ?></td>
                            <td><?php echo $compras['fornecedor'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } else {  ?>
                    <!--Como dito anteriormente, se a tabela estiver vazia não irá imprimi-la, por conseguinte
                    aparecerá uma imagem e uma mensagem informando que a tabela está vazia-->
                    <div class="cardVazia">
                        <p>A tabela está sem medicamentos😪 <br>Se tiver adicione medicamento</p>
                    </div>
                <?php }
                mysqli_close($conn); ?>
            </tbody>
        </table>
    </div>
    <!--Destroi o conteúdo da variável $_POST para evitar problemas com ordenação-->
</body>

</html>