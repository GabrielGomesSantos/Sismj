<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="../sisman_db.php">
        <label for="name">Medicamento</label><br>
        <input type="text" name="name" id="name"><br>
        <label for="tipo">Tipo</label><br>
        <input type="text" name="tipo" id="tipo"><br>
        <label for="categoria">Categoria</label><br>
        <input type="text" name="categoria" id="categoria"><br>
        <label for="laboratorio">Laboratório</label><br>
        <input type="text" name="laboratorio" id="laboratorio"><br>
        <label for="lote">Lote</label><br>
        <input type="text" name="lote" id="lote"><br>
        <label for="validade">Validade</label><br>
        <input type="date" name="validade" id="validade"><br>
        <label for="quantidade">Quantidade</label><br>
        <input type="number" name="quantidade" id="quantidade" value="1" min="1"><br>

        <input type="submit" value="Enviar" name="insert_med">
    </form>
</body>

</html>