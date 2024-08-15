<?php
        // INCLUINDO CONFIGURAÇÃO DO BANCO DE DADOS
        include("../config/config.php");
        $id = $_GET['id'];
        //Seleciona tudo que há na tabela medicamento
        $sql = "SELECT * FROM medicamentos WHERE cod_medicamento = $id";
        $result = mysqli_query($conn, $sql);

        //Se a consulta gerar resultado irá armazenar tudo na variável "saida"
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
        }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../sisman_db.php" method="post">
        <label for="nome">Nome do medicamento</label>
        <input type="text" name="nome" value="<?php echo $saida[0]['nome_medicamento']; ?>" id="nome">
        <br>
        <br>
        <label for="nome">Tipo do medicamento</label>
        <input type="text" name="tipo" value="<?php echo $saida[0]['tipo_medicamento']; ?>" id="nome">
        <br>
        <br>
        <label for="nome">Categoria</label>
        <input type="text" name="categoria" value="<?php echo $saida[0]['categoria']; ?>"  id="nome">
        <br>
        <br>
        <label for="nome">Laboratorio</label>
        <input type="text" name="lab" value="<?php echo $saida[0]['laboratorio']; ?>" id="nome">
        <br>
        <br>
        <label for="nome">Lote</label>
        <input type="text" name="lote" value="<?php echo $saida[0]['lote']; ?>" id="nome">
        <br>
        <br>
        <label for="nome">Validade</label>
        <input type="text" name="valid" value="<?php echo $saida[0]['validade']; ?>" id="nome">,
        <br>
        <br>
        <label for="nome">Quantidade</label>
        <input type="text" name="quant" value="<?php echo $saida[0]['quantidade']; ?>" id="nome">
        <input type="hidden" name="id_edit" value="<?php echo $id; ?>">
        <br>
        <input type="submit">
    </form>
</body>
</html>