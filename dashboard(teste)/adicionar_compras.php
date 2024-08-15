<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- GET LAST COD_COMPRA ID FOR UPDATE -->
    <a href="insert.php">Adicionar medicamento</a>

    <form action="..\sisman_db.php" method="POST">
        <label for="nota_fiscal">Nota fiscal</label>
        <input type="text" name="nota_fiscal">

        <label for="data">Data</label>
        <input type="date" name="data">

        <label for="fornecedor">Fornecedor</label>
        <input type="text" name="fornecedor">

        <input type="submit" value="Enviar" name="finish_purchase">
    </form>

    <?php
    // INCLUINDO CONFIGURAÇÃO DO BANCO DE DADOS
    include("../config/config.php");
    //Seleciona tudo que há na tabela medicamento

    $sql = "SELECT * FROM `medicamentos` WHERE cod_compra = 0";
    $result = mysqli_query($conn, $sql);

    //Se a consulta gerar resultado irá armazenar tudo na variável "saida"
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) $saida[] = $row;
    }
    ?>

    <table border="1">
        <tbody>
            <!--Se a variável "saida" estiver vazia ele não irá tentar imprimir a tabela, caso contrário,
                a tabela aparecerá normalmente-->
            <?php if (!empty($saida)) { ?>
                <tr>
                    <th>Código de Medicamento:</th>
                    <th>Código de Compra:</th>
                    <th>Nome do Medicamento:</th>
                    <th>Tipo de Medicamento:</th>
                    <th>Categoria:</th>
                    <th>Laboratorio:</th>
                    <th>Lote:</th>
                    <th>Validade:</th>
                    <th>Quantidade:</th>
                    <th>Ações:</th>
                </tr>
                <!--Itera sobre todos os elementos da variável "saida" para imprimi-la corretamente-->
                <?php foreach ($saida as $medicamento) { ?>
                    <tr>
                        <td><?php echo $medicamento['cod_medicamento'] ?></td>
                        <td><?php echo $medicamento['cod_compra'] ?></td>
                        <td><?php echo $medicamento['nome_medicamento'] ?></td>
                        <td><?php echo $medicamento['tipo_medicamento'] ?></td>
                        <td><?php echo $medicamento['categoria'] ?></td>
                        <td><?php echo $medicamento['laboratorio'] ?></td>
                        <td><?php echo $medicamento['lote'] ?></td>
                        <td><?php echo $medicamento['validade'] ?></td>
                        <td><?php echo $medicamento['quantidade'] ?></td>
                        <!--Links para editar ou remover um elemento da tabela com base no ID-->
                        <td><a class="corDelete" href="../sisman_db.php?id_delete=<?php echo $medicamento['cod_medicamento'] ?>">Remover</a>/<a class="editarColor" href="editar.php?id=<?php echo $medicamento['cod_medicamento'] ?>">Editar</a></td>
                    </tr>
                <?php } ?>
            <?php } else {  ?>
                <!--Como dito anteriormente, se a tabela estiver vazia não irá imprimi-la, por conseguinte
                    aparecerá uma imagem e uma mensagem informando que a tabela está vazia-->
                <div class="cardVazia">
                    <p>A tabela está sem medicamentos.<br>Se tiver adicione medicamento</p>
                </div>
            <?php }
            mysqli_close($conn); ?>
        </tbody>
    </table>
</body>

</html>