<?php 
require_once('../../config/config.php');

if(isset($_GET['id_processo'])) {
    $id_processo = $_GET['id_processo'];
    $sql = "SELECT * FROM medicamentos_processo WHERE cod_processo = $id_processo";
    
    $result = $conn->query($sql);
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Required meta tags -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->

    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Style -->

    <!-- Fonte Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonte Awesome -->

    <!-- Titulo Lembrar de mudar! -->
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Medicamentos Processo</title>
</head>

<?php include('navbar.php') ?>


<body>
    <table class="table table-striped">
        <a href="cadastrar_medicamento_processo.php?id_processo=<?php echo $id_processo?>"
            class="btn btn-success">Cadastrar Medicamento</a>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do Medicamento:</th>
                <th scope="col">Tipo de Medicamento:</th>
                <th scope="col">Categoria Medicamento:</th>
                <th scope="col">Laboratorio</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result->num_rows > 0):?>
            <?php while($row = $result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row['cod_medicamento_processo']?></td>
                <td><?php echo $row['nome_medicamento']?></td>
                <td><?php echo $row['tipo_medicamento']?></td>
                <td><?php echo $row['categoria_medicamento']?></td>
                <td><?php echo $row['laboratorio']?></td>
                <td><?php echo $row['quantidade']?></td>
                <td><a href="editar_medicamento_processo.php?id_medicamento_processo=<?php echo $row['cod_medicamento_processo']?>" class="btn btn-warning">Editar</a></td>
            </tr>
            <?php endwhile;?>
            <?php endif?>
        </tbody>
    </table>


    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <?php include('footer.php') ?>
</body>

</html>

<?php 

}


?>