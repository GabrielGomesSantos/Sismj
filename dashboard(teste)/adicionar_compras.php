<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- GET LAST COD_COMPRA ID FOR UPDATE -->
    <form action="../src/pages/sisman_db.php" method="POST">
        <label for="nota_fiscal">Nota fiscal</label>
        <input type="text" name="nota_fiscal">

        <label for="data">Data</label>
        <input type="date" name="data">

        <label for="fornecedor">Fornecedor</label>
        <input type="text" name="fornecedor">

        <input type="submit" value="Enviar" name="add_compra">
    </form>
</body>

</html>