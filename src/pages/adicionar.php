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
</head>

<body>
    <a href="">Adicionar medicamento</a>
    <form action="..\sisman_db.php" method="POST">
        <label for="nota_fiscal">Nota fiscal</label>
        <input type="text" name="nota_fiscal">

        <label for="data">Data</label>
        <input type="date" name="data">

        <label for="fornecedor">Fornecedor</label>
        <input type="text" name="fornecedor">

        <input type="submit" value="Enviar" name="finish_purchase">
    </form>
</body>

</html>